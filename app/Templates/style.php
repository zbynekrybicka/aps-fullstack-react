<?php
$width = [
        'mobile' => 0,
        'tablet' => 640,
        'pc' => 1024
];
foreach ($style as $component => $modes) { ?>
<?php foreach ($modes as $mode => $definition) { ?>
@media (min-width: <?=$width[$mode]; ?>px) {
    .<?=$component; ?> {
<?php foreach ($definition as $attribute => $value) { ?>
        <?=$attribute; ?>: <?=$value; ?>;
<?php } ?>
    }
}
<?php } ?>
<?php } ?>