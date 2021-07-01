<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?> min-h-full min-w-full" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo img('icons/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo img('icons/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo src('manifest.json'); ?>">
    <meta name="theme-color" content="#D50032">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="University of Illinois at Chicago">
    <link rel="apple-touch-icon" href="<?php echo img('icons/apple-touch-icon-152x152.png'); ?>">
    <link rel="mask-icon" href="<?php echo img('icons/safari-pinned-tab.svg'); ?>" color="#D50032">
    <meta name="msapplication-TileImage" content="<?php echo img('icons/msapplication-icon-144x144.png'); ?>">
    <meta name="msapplication-TileColor" content="#000000">

    <?php if ($description = option('description')): ?>
        <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_url('//fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
    /*queue_css_file('print', 'print');*/
    queue_css_file(array('app'), 'screen', false, 'css', '1.0.1');
    echo head_css();
    function get_featured_collections($num = 3)
    {
        return get_records('Collection', array('featured' => '1', 'sort_field' => 'added', 'sort_dir' => 'a'), $num);
    }
    function slugify($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }
    ?>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <!-- JavaScripts -->
    <?php echo head_js(); ?>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <?php
    function theme_background_header_image()
    {
        $headerImage = get_theme_option('Header Background');
        if ($headerImage) {
            $storage = Zend_Registry::get('storage');
            $headerImage = $storage->getUri($storage->getPathByType($headerImage, 'theme_uploads'));
            return $headerImage;
        }
    }
    ?>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => 'bg-uic-white min-w-full min-h-screen text-body-text font-sans')); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view' => $this)); ?>

    <div id="wrap" class="min-h-screen flex flex-col align-stretch">

        <header x-data="{
                    mobile: false
                }"
                class="bg-uic-white">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Top">
                <div class="w-full pt-2 pb-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="pt-4 w-[270px]">
                            <span class="sr-only"><?php echo option('site_title') ?></span>
                            <?php echo link_to_home_page(theme_logo()); ?>
                        </div>
                    </div>
                    <div class="-mr-2 -my-2 lg:hidden ml-10">
                        <button x-on:click="mobile = true;"
                                type="button" class="bg-uic-white p-2 inline-flex items-center justify-center text-sub-headline hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-sub-headline" aria-expanded="false" :aria-expanded="mobile.toString()">
                            <span class="sr-only">Open menu</span>
                            <!-- Heroicon name: outline/menu -->
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                    <div class="hidden lg:block ml-6 space-y-3">
                        <div class="w-full flex items-center justify-between">
                            <div class="pt-4 ml-4 space-x-5 ">
                                <a href="https://uihealth.uic.edu/" class="text-sm font-normal text-link hover:border-b-4 hover:border-headline">
                                    UI Health
                                </a>

                                <a href="https://www.uic.edu/" class="text-sm font-normal text-link hover:border-b-4 hover:border-headline">
                                    UIC.edu
                                </a>

                                <a href="http://maps.uic.edu/" class="text-sm font-normal text-link hover:border-b-4 hover:border-headline">
                                    Campus Map
                                </a>
                            </div>
                            <div class="hidden pt-4 ml-4 space-x-5 lg:block">
                                <a href="https://publichealth.uic.edu/" class="text-sm font-normal text-link hover:border-b-4 hover:border-headline">
                                    School of Public Health
                                </a>
                            </div>
                        </div>
                        <div class="main-menu hidden ml-2 space-x-4 lg:block">
                            <?php echo public_nav_main()->setPartial('/common/navigation.php'); ?>
                        </div>
                    </div>
                </div>
            </nav>
            <!--
                Mobile menu, show/hide based on mobile menu state.

                Entering: "duration-200 ease-out"
                  From: "opacity-0 scale-95"
                  To: "opacity-100 scale-100"
                Leaving: "duration-100 ease-in"
                  From: "opacity-100 scale-100"
                  To: "opacity-0 scale-95"
              -->
            <div x-show="mobile"
                 class="absolute z-30 top-0 inset-x-0 p-2 transition transform origin-top-right lg:hidden">
                <div class="shadow-lg ring-1 ring-black ring-opacity-5 bg-uic-white divide-y-2 divide-gray-50">
                    <div class="pt-5 pb-6 px-5 sm:pb-8">
                        <div class="flex items-center justify-between">
                            <div class="w-[270px]">
                                <span class="sr-only">UIC GeoLibrary</span>
                                <?php echo link_to_home_page(theme_logo()); ?>
                            </div>
                            <div class="-mr-2">
                                <button x-on:click="mobile = false;"
                                        type="button" class="bg-uic-white rounded-md p-2 inline-flex items-center justify-center text-sub-headline hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-sub-headline">
                                    <span class="sr-only">Close menu</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-6 sm:mt-8">
                            <nav>
                                <div class="mobile-menu grid gap-7 sm:grid-cols-2 sm:gap-y-8 sm:gap-x-4">
                                    <?php echo public_nav_main()->setPartial('/common/mobile-navigation.php'); ?>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="py-6 px-5">
                        <div class="grid grid-cols-2 gap-4">
                            <a href="https://uihealth.uic.edu/" class="text-base font-medium text-link hover:text-gray-700">
                                UI Health
                            </a>
                            <a href="https://www.uic.edu/" class="text-base font-medium text-link hover:text-gray-700">
                                UIC.edu
                            </a>
                            <a href="http://maps.uic.edu/" class="text-base font-medium text-link hover:text-gray-700">
                                Campus Map
                            </a>
                            <a href="https://publichealth.uic.edu/" class="text-base font-medium text-link hover:text-gray-700">
                                School of Public Health
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="bg-sub-headline py-4">
            <div class="max-w-7xl mx-auto px-8">
                <h1 class="text-2xl text-white font-medium">
                    Global Environmental and Occupational Health e-Library
                </h1>
            </div>
        </div>

        <div id="content" role="main" tabindex="-1" class="flex-1">
            <?php
                if(! is_current_url(WEB_ROOT)) {
                    fire_plugin_hook('public_content_top', array('view' => $this));
                }else{
                    $storage = Zend_Registry::get('storage');
                    echo get_view()->partial('common/banner.php', [
                        'image' => $storage->getUri($storage->getPathByType(get_theme_option('Banner Background'), 'theme_uploads')),
                        'text' => get_theme_option('Banner Text'),
                    ]);
                    echo get_view()->partial('common/link-box.php', [

                    ]);
                    echo get_view()->partial('common/hero.php', [

                    ]);
                }
            ?>

