<?='<?php';?>

namespace App\Service;

use App\Request;
use App\Response;
<?php foreach ((array) $resources as $attribute => $resource) { ?>
use App\Resource\<?=$resource; ?>;
<?php } ?>

class <?=ucfirst($title); ?>Service
{
<?php foreach ($resources as $attribute => $resource) { ?>
    private $<?=$attribute; ?>;
<?php } ?>

    public static function get() {
        static $<?=lcfirst($title); ?>Service;
        if (!$<?=lcfirst($title); ?>Service) {
            $<?=lcfirst($title); ?>Service = new <?=ucfirst($title); ?>Service();
        }
        return $<?=lcfirst($title); ?>Service;
    }

    public function __construct() {
<?php foreach ($resources as $attribute => $resource) { ?>
        $this-><?=$attribute; ?> = <?=$resource; ?>::get();
<?php } ?>
    }

<?php foreach ($methods as $method) { ?>
    public function <?=$method->title; ?>(Request $request) {
<?php foreach ($method->lines as $line) { ?>
        <?=$line; ?>

<?php } ?>
    }
<?php } ?>

}