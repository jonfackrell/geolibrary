<?php
    echo '<div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute z-10 -ml-4 mt-3 transform px-2 sm:px-0 w-max lg:ml-0 lg:left-1/2 lg:-translate-x-1/2 border-2 border-white" x-ref="panel" @click.away="open = false" x-cloak>';
    echo '<div class="dropdown shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden min-w-[200px]">';
    echo '<div class="relative bg-white">';
    foreach ($this->container as $page) {
        if($page->getVisible()){
            echo $this->navigation()->menu()->htmlify($page);
        }
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
?>