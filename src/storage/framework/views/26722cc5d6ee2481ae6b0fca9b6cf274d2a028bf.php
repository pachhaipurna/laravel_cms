<?xml version="1.0" encoding="UTF-8"?>
<documents>
<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <assignment>
        <?php if($param_type == "all"): ?>
                <title><?php echo e($book->title); ?></title>
                <author_name><?php echo e($book->author_name); ?></author_name>
        <?php elseif($param_type == "author"): ?>
                <author_name><?php echo e($book->author_name); ?></author_name>

        <?php elseif($param_type =="title"): ?>
            <title><?php echo e($book->title); ?></title>
          <?php endif; ?>
    </assignment>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</documents>
<?php /**PATH D:\XAMP\htdocs\Laravel Projects\Yaraku\web-developer-assignment\src\resources\views/xml/xml.blade.php ENDPATH**/ ?>