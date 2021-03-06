<?php
$title = metadata('item', 'display_title');
echo head(array('title' => $title, 'bodyclass' => 'items show'));
?>

<div class="relative max-w-7xl mx-auto px-10 py-4 bg-white min-h-screen">

<h2 class="text-sub-headline text-3xl font-bold mt-4 mb-6"><?php echo metadata('item', 'rich_title', array('no_escape' => true)); ?></h2>

<?php echo all_element_texts('item'); ?>

<!-- The following returns all of the files associated with an item. -->
<?php if (metadata('item', 'has files')): ?>
<div id="itemfiles" class="element my-2">
    <h3><?php echo __('Files'); ?></h3>
    <div class="element-text font-normal text-lg"><?php echo files_for_item(); ?></div>
</div>
<?php endif; ?>

<!-- If the item belongs to a collection, the following creates a link to that collection. -->
<?php if (metadata('item', 'Collection Name')): ?>
<div id="collection" class="metadata element grid grid-cols-4 my-2">
    <h3 class="text-lg font-semibold col-span-1"><?php echo __('Collection'); ?></h3>
    <div class="element-text font-normal text-lg col-span-3"><p><?php echo link_to_collection_for_item(); ?></p></div>
</div>
<?php endif; ?>

<!-- The following prints a list of all tags associated with the item -->
<?php if (metadata('item', 'has tags')): ?>
<div id="item-tags" class="element grid grid-cols-4 my-2">
    <h3 class="text-lg font-semibold col-span-1"><?php echo __('Tags'); ?></h3>
    <div class="element-text font-normal text-lg col-span-3"><?php echo tag_string('item'); ?></div>
</div>
<?php endif;?>

<!-- The following prints a citation for this item. -->
<div class="my-8">
    <blockquote class="pl-2 border-l-2 border-gray-200">
        <h3 class="text-lg font-semibold col-span-1"><?php echo __('Citation'); ?></h3>
        <p class="font-normal text-lg">
            <?php echo metadata('item', 'citation', array('no_escape' => true)); ?>
        </p>
    </blockquote>
</div>

<div id="item-output-formats" class="element">
    <h3 class="text-lg font-semibold col-span-1 mb-2"><?php echo __('Output Formats'); ?></h3>
    <div class="element-text font-normal text-lg"><?php echo output_format_list(); ?></div>
</div>

<?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

<nav class="my-8">
<ul class="item-pagination navigation flex space-x-4">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>
</nav>
</div>
<?php echo foot(); ?>
