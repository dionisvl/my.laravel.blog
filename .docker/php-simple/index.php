<?php
header('Content-Type: text/html; charset=utf-8');
$host = $_SERVER['HTTP_HOST'] ?? 'unknown';
echo "Hello " . htmlspecialchars($host, ENT_QUOTES, 'UTF-8');
