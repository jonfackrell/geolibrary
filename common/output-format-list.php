<?php if ($output_formats): ?>
    <?php if ($list): ?>
        <div id="output-format-list" class="flex space-x-4 items-center">
        <?php foreach ($output_formats as $output_format): ?>
            <?php $query['output'] = $output_format; ?>
            <a class="bg-sub-headline text-uic-white text-base px-4"
               href="<?php echo html_escape(url() . '?' . http_build_query($query)); ?>"><?php echo $output_format; ?></a>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p id="output-format-list" class="flex space-x-4">
        <?php foreach ($output_formats as $key => $output_format): ?><?php $query['output'] = $output_format; ?>
            <a class="bg-sub-headline text-uic-white text-base px-4"
               href="<?php echo html_escape(url() . '?' . http_build_query($query)); ?>">
                <?php echo $output_format; ?>
            </a>
            <?php echo $key == (count($output_formats) - 1) ? '' : $delimiter; ?>
        <?php endforeach; ?>
        </p>
    <?php endif; ?>
<?php endif; ?>
