
<div class="pl-6 divide-y divide-gray-200">
    <?php
    foreach ($this->container as $page) {
            if($page->getVisible() && ! in_array($page->getLabel(), ['About', 'Suggest Materials'])){
                echo $this->navigation()->menu()->htmlify($page);
                if($page->hasChildren()){
                    echo '<div class="sub-menu hidden">';
                    echo get_view()->navigation()->menu($page);
                    echo '</div>';
                }
            }
        }
    ?>
</div>
