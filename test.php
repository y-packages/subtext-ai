<?php

// Simulate Composer autoload for testing purposes without running 'composer install'
require_once __DIR__ . '/src/Subtext.php';

use YakNet\Subtext\App;

// Bu bir test yorumudur.
// YakNet markası tarafından geliştirilmiştir.
// Subtext kütüphanesi json çıktısı verir.

// Check for query parameter or command line argument to toggle enable
$enable = false;

// For CLI testing: php test.php true
if (isset($argv[1]) && $argv[1] === 'true') {
    $enable = true;
}

// Normal code execution...
echo "Kod normal akışında çalışıyor.\n";

App::run($enable);

echo "Bu satır sadece enable=false olduğunda görünmeli.\n";

// Başka bir yorum satırı.
