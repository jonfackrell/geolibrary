<?php
if ($this->pageCount > 1):
    $getParams = $_GET;
?>

<nav class="pagination-nav my-4" aria-label="<?php echo __('Pagination'); ?>">
    <ul class="pagination flex-1 flex justify-between sm:justify-start">
        <?php if (isset($this->previous)): ?>
        <!-- Previous page link -->
        <li class="pagination_previous">
            <?php $getParams['page'] = $previous; ?>
            <a class="mr-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-uic-white bg-link hover:bg-body-text"
               rel="prev" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo __('Previous Page'); ?></a>
        </li>
        <?php endif; ?>

        <li class="page-input">
        <form action="<?php echo html_escape($this->url()); ?>" method="get" accept-charset="utf-8">
        <?php
        $hiddenParams = array();
        $entries = explode('&', http_build_query($getParams));
        foreach ($entries as $entry) {
            if (!$entry) {
                continue;
            }
            list($key, $value) = explode('=', $entry);
            $hiddenParams[urldecode($key)] = urldecode($value);
        }

        foreach ($hiddenParams as $key => $value) {
            if ($key != 'page') {
                echo $this->formHidden($key, $value);
            }
        }

        // Manually create this input to allow an omitted ID
        $pageInput = '<input class="w-20 p-1" type="text" name="page" title="'
                    . html_escape(__('Current Page'))
                    . '" value="'
                    . html_escape($this->current) . '">';
        echo __('%s of %s', $pageInput, $this->last);
        ?>
        </form>
        </li>

        <?php if (isset($this->next)): ?>
        <!-- Next page link -->
        <li class="pagination_next">
            <?php $getParams['page'] = $next; ?>
            <a class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-uic-white bg-link hover:bg-body-text"
                rel="next" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo __('Next Page'); ?></a>
        </li>
        <?php endif; ?>
    </ul>
</nav>

<?php endif; ?>
