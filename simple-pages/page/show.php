<?php
$bodyclass = 'page simple-page';
if ($is_home_page):
    $bodyclass .= ' simple-page-home';
endif;

echo head(array(
    'title' => metadata('simple_pages_page', 'title'),
    'bodyclass' => $bodyclass,
    'bodyid' => metadata('simple_pages_page', 'slug')
));
?>
<div id="primary" class="relative max-w-7xl mx-auto">
    <div class="relative pb-16 bg-white overflow-hidden">
        <div class="relative px-4 sm:px-6 lg:px-8">
            <?php if (!$is_home_page): ?>
                <p id="simple-pages-breadcrumbs" class="py-4"><?php echo simple_pages_display_breadcrumbs(); ?></p>
                <h2 class="text-sub-headline text-3xl font-bold mt-4 mb-6"><?php echo metadata('simple_pages_page', 'title'); ?></h2>
            <?php endif; ?>
            <?php
            $text = metadata('simple_pages_page', 'text', array('no_escape' => true));
            echo $this->shortcodes($text);
            ?>
        </div>
    </div>
</div>

<?php echo foot(); ?>