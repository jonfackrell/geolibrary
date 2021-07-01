<?php
$pageTitle = __('Search Items');
echo head(array('title' => $pageTitle,
           'bodyclass' => 'items advanced-search'));
?>

<div id="primary" class="relative max-w-7xl mx-auto px-4 py-4 bg-white min-h-screen">

    <h1 class="text-headline text-4xl font-bold border-b-2 border-gray-2 pb-2 mb-2">
        <?php echo $pageTitle; ?>
    </h1>

    <?php echo $this->partial('items/search-form.php',
        array('formAttributes' =>
            array('id' => 'advanced-search-form'))); ?>

</div>

<?php echo foot(); ?>
