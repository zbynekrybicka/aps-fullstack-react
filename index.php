<?php
use App\Aps;
use App\Process;

require_once __DIR__ . '/vendor/autoload.php';

$process = new Process();

$aps = new Aps();
$app = $process->init($aps);
    $process->Langs($app);
    $process->LoginForm($app);

$admin = $process->Admin($app);

    $operator = $process->Operator($admin);
        $process->ClientData($operator);
        $process->CallHistory($operator);
        $process->CallScript($operator);

    $manager = $process->Manager($admin);
        $process->ManagerMenu($manager);
        $process->ContactSection($manager);
        $process->CampaignSection($manager);
        $process->CallSection($manager);


$aps->execute();