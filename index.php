<?php echo head(array('bodyid'=>'home', 'bodyclass' => 'bg-gray-300')); ?>



<?php fire_plugin_hook('public_home', array('view' => $this)); ?>


<?php echo foot(); ?>
