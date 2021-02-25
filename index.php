<?php
use App\Relations\FullStack;
use App\Process;

require_once __DIR__ . '/vendor/autoload.php';

define('API_URL', 'http://localhost:8081');

$fullStack = new FullStack();
$component = new Process($fullStack);

$component->App();
$component->LoginForm();
$component->Admin();

$fullStack->execute();