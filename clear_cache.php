<?php

$path = 'application/cache/';

$files = glob($path . '*'); // Obtém todos os arquivos no diretório de cache

foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file); // Remove cada arquivo
    }
}

echo "Cache limpo com sucesso.";
?>