<?php 
function loadEnv($filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("The .env file does not exist.");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            // Skip comments
            continue;
        }

        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $name = trim($parts[0]);
            $value = trim($parts[1]);

            // Remove quotes if the value is wrapped in quotes
            $value = trim($value, '"\'');
            
            // Set the variable
            putenv("$name=$value");
            $_ENV[$name] = $value;
            // $_SERVER[$name] = $value;
        }
    }
}