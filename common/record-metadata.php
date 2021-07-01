<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
<div class="element-set metadata">
    <?php if ($showElementSetHeadings): ?>
    <h2 class="text-2xl uppercase font-bold my-4"><?php echo html_escape(__($setName)); ?></h2>
    <?php endif; ?>
    <?php foreach ($setElements as $elementName => $elementInfo): ?>
    <div id="<?php echo text_to_id(html_escape("$setName $elementName")); ?>" class="element grid grid-cols-4 my-2">
        <h3 class="text-lg font-semibold col-span-1"><?php echo html_escape(__($elementName)); ?></h3>
        <div class="col-span-3">
            <?php foreach ($elementInfo['texts'] as $text): ?>
                <div class="element-text font-normal text-lg"><?php echo $text; ?></div>
            <?php endforeach; ?>
        </div>

    </div><!-- end element -->
    <?php endforeach; ?>
</div><!-- end element-set -->
<?php endforeach;
