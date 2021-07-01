<?php
$collectionTitle = metadata('collection', 'display_title');
$totalItems = metadata('collection', 'total_items');
?>

<?php echo head(array('title' => $collectionTitle, 'bodyclass' => 'collections show')); ?>

<div class="relative max-w-7xl mx-auto px-10 py-4 bg-white min-h-screen">
    <h2 class="text-sub-headline text-3xl font-bold mt-4 mb-6"><?php echo metadata('collection', 'rich_title', array('no_escape' => true)); ?></h2>

    <?php echo all_element_texts('collection'); ?>

    <div id="collection-items" class="my-8">
        <h2 class="text-2xl uppercase font-bold my-4"><?php echo __('Collection Items'); ?></h2>
        <?php if ($totalItems > 0): ?>
            <?php foreach (loop('items') as $item): ?>
            <?php $itemTitle = metadata('item', 'display_title'); ?>
            <div class="item hentry my-4">
                <h3 class="text-sub-headline text-xl font-medium"><?php echo link_to_item($itemTitle, array('class' => 'underline')); ?></h3>

                <?php if (metadata('item', 'has thumbnail')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image(null, array('alt' => $itemTitle))); ?>
                </div>
                <?php endif; ?>

                <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
                <div class="item-description px-8">
                    <?php echo $description; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <div class="text-xl font-semibold text-sub-headline flex items-center my-8">
                <?php echo link_to_items_browse(__(plural('View item', 'View all %s items', $totalItems), $totalItems), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link')); ?>
                <span class=" py-0.5 px-3">
                    <svg class="w-4 h-4 text-sub-headline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
                <?php else: ?>
                    <p><?php echo __("There are currently no items within this collection."); ?></p>
                <?php endif; ?>
            </div>
    </div><!-- end collection-items -->

    <?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

</div>

<?php echo foot(); ?>
