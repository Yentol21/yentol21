<?php
// ===== KONFIGURASI =====
$articleFilename = 'article.txt';   // file berisi template artikel
$titleFilename   = 'title.txt';     // file berisi template judul
$listFilename    = 'list.txt';      // file berisi daftar nama folder

// ===== FUNGSI PEMBUAT INDEX =====
function createIndexContent($folderName, $title, $article) {
    // Escape HTML agar aman
    $safeTitle   = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $safeArticle = $article; // biarkan HTML jika template memang HTML

    $html  = "<!DOCTYPE html>\n";
    $html .= "<html lang=\"id\">\n<head>\n";
    $html .= "  <meta charset=\"UTF-8\">\n";
    $html .= "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $html .= "  <title>{$safeTitle}</title>\n";
    $html .= "</head>\n<body>\n";
    $html .= "  <h1>{$safeTitle}</h1>\n";
    $html .= "  <div class=\"content\">{$safeArticle}</div>\n";
    $html .= "</body>\n</html>\n";

    return $html;
}

// ===== CEK FILE ARTIKEL =====
if (!file_exists($articleFilename)) {
    die("File '$articleFilename' tidak ditemukan.");
}
$articleContents = file($articleFilename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// ===== CEK FILE JUDUL =====
if (!file_exists($titleFilename)) {
    die("File '$titleFilename' tidak ditemukan.");
}
$titleContents = file($titleFilename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// ===== CEK FILE DAFTAR FOLDER =====
if (!file_exists($listFilename)) {
    die("File '$listFilename' tidak ditemukan.");
}
$folderNames = file($listFilename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Validasi: pastikan ada konten untuk dipilih
if (empty($articleContents)) {
    die("File '$articleFilename' kosong.");
}
if (empty($titleContents)) {
    die("File '$titleFilename' kosong.");
}

// ===== LOOPING PEMBUATAN FOLDER =====
foreach ($folderNames as $folderName) {
    $folderName = trim($folderName);

    // Skip baris kosong
    if ($folderName === '') {
        continue;
    }

    // Sanitasi nama folder (cegah path traversal)
    if (strpos($folderName, '..') !== false || strpos($folderName, '/') !== false || strpos($folderName, '\\') !== false) {
        echo "Nama folder tidak valid: '$folderName'.<br>";
        continue;
    }

    if (!is_dir($folderName)) {
        if (mkdir($folderName, 0755, true)) {
            echo "Folder '$folderName' berhasil dibuat.<br>";

            $randomArticle = $articleContents[array_rand($articleContents)];
            $randomTitle   = $titleContents[array_rand($titleContents)];

            // Ganti placeholder dengan nama folder
            $randomArticle = str_replace('$titleContent', $folderName, $randomArticle);
            $randomTitle   = str_replace('$titleContent', $folderName, $randomTitle);

            $indexContent = createIndexContent($folderName, $randomTitle, $randomArticle);
            $indexPath    = $folderName . DIRECTORY_SEPARATOR . 'index.html';

            if (file_put_contents($indexPath, $indexContent) !== false) {
                echo "File index.html berhasil dibuat di folder '$folderName'.<br>";
            } else {
                echo "Gagal membuat file index.html di folder '$folderName'.<br>";
            }
        } else {
            echo "Gagal membuat folder '$folderName'.<br>";
        }
    } else {
        echo "Folder '$folderName' sudah ada.<br>";
    }
}
?>
