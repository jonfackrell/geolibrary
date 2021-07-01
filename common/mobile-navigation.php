<?php
    foreach ($this->container as $page) {
        if($page->getVisible()){
            echo $this->navigation()->menu()->htmlify($page);
        }
    }
?>