<?php
    foreach ($this->container as $page) {
        if($page->getVisible()){
            echo '<span x-data="{ open: false }">';
            echo '<span x-on:mouseenter="open = true" x-on:mouseleave="open = false" class="relative top-links">';
            echo $this->navigation()->menu()->htmlify($page);
            if($page->hasChildren()){
                echo get_view()->navigation()->menu($page)->setPartial('/common/dropdown.php');
            }
            echo '</span>';
            echo '</span>';
        }
    }
?>