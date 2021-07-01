<?php

if(! is_current_url('/') && ! is_current_url('/search') && ! is_current_url('/collections/browse')){
    if(is_current_url('/items/browse')){
        $options['form_attributes']['action'] = url(array('controller' => 'items',
            'action' => 'browse'));
        $options['form_attributes']['method'] = 'GET';
    }
    $searchField = 'search';
} else {
    $searchField = 'query';
}
?>

<div>
    <?php echo $this->form('search-form', $options['form_attributes']); ?>
    <?php if ($options['show_advanced']): ?>
        <div id="advanced-form">
            <fieldset id="query-types">
                <legend><?php echo __('Search using this query type:'); ?></legend>
                <?php echo $this->formRadio('query_type', $filters['query_type'], null, $query_types); ?>
            </fieldset>

            <?php if ($record_types): ?>

                <fieldset id="record-types">
                    <legend><?php echo __('Search only these record types:'); ?></legend>
                    <?php foreach ($record_types as $key => $value): ?>
                    <?php echo $this->formCheckbox('record_types[]', $key, array('checked' => in_array($key, $filters['record_types']), 'id' => 'record_types-' . $key)); ?> <?php echo $this->formLabel('record_types-' . $key, $value);?><br>
                    <?php endforeach; ?>
                </fieldset>

            <?php elseif (is_admin_theme()): ?>

                <p><a href="<?php echo url('settings/edit-search'); ?>"><?php echo __('Go to search settings to select record types to use.'); ?></a></p>

            <?php endif; ?>

            <p><?php echo link_to_item_search(__('Advanced Search (Items only)')); ?></p>
        </div>
    <?php else: ?>

        <div class="mt-1 flex rounded-md shadow-sm">
            <div class="relative flex items-stretch flex-grow focus-within:z-10">
                <label for="query" class="sr-only">Search query</label>
                <?php echo $this->formText($searchField, ($filters['query'])?:@$_REQUEST['search'], ['title' => __('Search'), 'placeholder' => __('Enter a search term'), 'class' => 'md:text-lg md:leading-7 focus:ring-link focus:border-link block w-full rounded-none py-2 px-2 sm:text-sm border border-body-text']); ?>
            </div>
            <?php echo $this->formHidden('query_type', $filters['query_type']); ?>

            <?php if(is_current_url('/items/browse')): ?>
                <?php echo $this->formHidden('record_types[]', 'Item'); ?>
            <?php elseif (is_current_url('/collections/browse')): ?>
                <?php echo $this->formHidden('record_types[]', 'Collection'); ?>
            <?php else: ?>
                <?php foreach ($filters['record_types'] as $type): ?>
                    <?php echo $this->formHidden('record_types[]', $type); ?>
                <?php endforeach; ?>
            <?php endif ?>

            <?php echo $this->formButton('submit_search', $options['submit_value'], ['type' => 'submit', 'class' => 'ml-4 relative inline-flex items-center space-x-2 px-4 py-2 border border-link text-lg font-medium rounded-none text-uic-white bg-link hover:bg-body-text focus:outline-none focus:ring-1 focus:ring-body-text focus:border-body-text rounded-full']); ?>
        </div>

    <?php endif; ?>

    </form>
</div>