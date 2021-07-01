<?php
$pageTitle = __('Browse Items');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse'));
?>

<div class="relative max-w-7xl mx-auto pr-10 py-4 bg-white min-h-screen">

    <div class="grid grid-cols-4">

        <div x-data="{

        }"
             id="collections-sidebar"
             class="col-span-4 md:col-span-1">
            <div class="uppercase font-semibold text-sub-headline pl-4 py-2">
                GeoLibrary
            </div>
            <div class="">
                <?php echo public_nav_main()->setPartial('/common/collection-navigation.php'); ?>
            </div>
            <script>
                jQuery(function($){
                    let $collections = $('#collections-sidebar a');
                    $collections.each(function(i, val){
                        let $collection = jQuery(this);
                        $collection.text($collection.text().split(' - ').pop().trim());
                    });
                });
                <?php
                // Find and set the active collection search
                $nav = new Omeka_Navigation;
                $nav->loadAsOption(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_OPTION_NAME);
                $nav->addPagesFromFilter(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_FILTER_NAME);
                $activeMenu = public_nav_main()->findActive($nav);
                $label = array_shift($activeMenu);
                $label = explode(" - ", $label);
                $label = array_pop($label);
                if(! empty($label)){
                ?>
                    jQuery(function($){
                        let $active = $('#collections-sidebar a:contains("<?php echo $label ?>")');
                        $active.addClass('active');
                        $active.next('.sub-menu').removeClass('hidden');
                        $active.parents('.sub-menu').removeClass('hidden');
                    });
                <?php } ?>

            </script>
        </div>

        <div class="col-span-4 md:col-span-3 pl-10">
            <div class="mt-8 sm:mt-4 sm:mb-4">
                <div class="">
                    <h2 class="text-headline text-4xl font-bold mt-4 mb-2">Search</h2>
                    <? echo search_form(); ?>
                    <nav class="items-nav navigation secondary-nav">
                        <?php echo public_nav_items()->setPartial(null); ?>
                    </nav>
                </div>
            </div>
            <div>
                <?php echo __('%s Results', $total_results); ?>
                <hr />
            </div>

            <?php echo item_search_filters(); ?>

            <?php echo pagination_links(); ?>

            <?php if ($total_results > 0): ?>

                <?php
                $sortLinks[__('Title')] = 'Dublin Core,Title';
                $sortLinks[__('Creator')] = 'Dublin Core,Creator';
                $sortLinks[__('Date Added')] = 'added';
                ?>
                <div id="sort-links" class="mb-6">
                    <span class="sort-label font-semibold"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
                </div>

            <?php endif; ?>

            <?php foreach (loop('items') as $item): ?>
                <div class="item hentry my-4">
                    <h2 class="text-sub-headline text-xl font-medium"><?php echo link_to_item(null, array('class' => 'underline')); ?></h2>
                    <div class="item-meta">
                        <?php if (metadata('item', 'has files')): ?>
                            <div class="item-img">
                                <?php echo link_to_item(item_image()); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
                            <div class="item-description px-8">
                                <?php echo $description; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (metadata('item', 'has tags')): ?>
                            <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                                    <?php echo tag_string('items'); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>

                    </div><!-- end class="item-meta" -->
                </div><!-- end class="item hentry" -->
            <?php endforeach; ?>

            <?php echo pagination_links(); ?>

            <div id="outputs" class="py-8">
                <h3 class="text-lg font-semibold col-span-1 mb-2"><?php echo __('Output Formats'); ?></h3>
                <div class="element-text font-normal text-lg"><?php echo output_format_list(true); ?></div>
            </div>

            <?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>
        </div>
        </div>

    </div>

<?php echo foot(); ?>
