<?php
$pageTitle = __('Browse Collections');
echo head(array('title' => $pageTitle, 'bodyclass' => 'collections browse'));
?>

<div class="relative max-w-7xl mx-auto pr-10 py-4 bg-white min-h-screen px-8">
<h2 class="text-headline text-4xl font-bold mt-4 mb-4"><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h2>

        <?php echo pagination_links(); ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links">
    <span class="sort-label font-semibold"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<div class="px-4 py-8">

<?php foreach (loop('collections') as $collection): ?>

<div class="collection my-4">

    <h3 class="text-xl font-medium"><?php echo link_to_collection(); ?></h3>
    <?php if ($collectionImage = record_image('collection')): ?>
        <?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
    <?php endif; ?>

    <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
    <div class="collection-description px-8">
        <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet' => 150))); ?>
    </div>
    <?php endif; ?>

    <?php if ($collection->hasContributor()): ?>
    <div class="collection-contributors">
        <p>
        <strong><?php echo __('Contributors'); ?>:</strong>
        <?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all' => true, 'delimiter' => ', ')); ?>
        </p>
    </div>
    <?php endif; ?>

    <?php echo link_to_items_browse(__('View the items in %s', metadata('collection', 'rich_title', array('no_escape' => true))), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link')); ?>

    <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>

</div><!-- end class="collection" -->

<?php endforeach; ?>

<?php fire_plugin_hook('public_collections_browse', array('collections' => $collections, 'view' => $this)); ?>
</div>
    <?php echo pagination_links(); ?>
</div>
<?php echo foot(); ?>
