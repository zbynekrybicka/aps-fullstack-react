import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
<?php foreach ($components as $component) { ?>
import <?=$component; ?> from './<?=$component; ?>';
<?php } ?>
<?php foreach ((array) $actions as $action) { ?>
import <?=$action; ?> from '../actions/<?=$action; ?>.js';
<?php } ?>

const { <?=implode(', ', $reducers); ?> } = reducer.actions;

<?php foreach ((array) $state as $value => $path) { ?>
const <?=$value; ?>Selector = state => <?=$path; ?>;
<?php } ?>

function <?=$title; ?>({<?=implode(', ', $props); ?>}) {
  const dispatch = useDispatch();
<?php foreach ($state as $value => $path) { ?>
  const <?=$value; ?> = useSelector(<?=$value; ?>Selector);
<?php } ?>
<?php if (count($content) == 1) {
    list($element) = $content;
?>
  return (<?=$element->open; ?><<?=$element->title; ?>

    <?php foreach ((array) $element->attributes as $attribute => $value) { ?>
        <?=$attribute; ?>={<?=$value; ?>}
    <?php } ?>
    <?=$element->close; ?>);
<?php } else { ?>
  return (
    <div className="<?=$title; ?>">
<?php foreach ($content as $element) { ?>
<?php if ((array) $element->attributes) { ?>
        <?=$element->open; ?><<?=$element->title; ?>

<?php foreach ((array) $element->attributes as $attribute => $value) { ?>
            <?=$attribute; ?>={<?=$value; ?>}
<?php } ?>
        <?=$element->close; ?>

<?php } else { ?>
        <?=$element->open; ?><<?=$element->title; ?><?=$element->close; ?>

<?php } ?>
<?php } ?>
    </div>
  );
<?php } ?>
}

export default <?=$title; ?>;
