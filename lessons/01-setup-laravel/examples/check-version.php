<?php

// Laravel 10 requires PHP 8.1 or newer.
// Run: php examples/check-version.php

$required = '8.1.0';
$current = PHP_VERSION;

echo "PHP version: {$current}\n";

if (version_compare($current, $required, '>=')) {
    echo "✅ OK — you can run Laravel 10.\n";
} else {
    echo "❌ Too old — Laravel 10 needs PHP {$required}+. Please upgrade.\n";
    exit(1);
}
