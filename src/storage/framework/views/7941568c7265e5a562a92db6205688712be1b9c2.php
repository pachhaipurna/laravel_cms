<?php $__env->startSection('title'); ?>
    404 Page Not Found
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="center-me positionabsolute">
    <div class="error-page">
        <h2 class="headline text-yellow mt25neg"> 404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="">return to dashboard</a>.
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMP\htdocs\Laravel Projects\Yaraku\web-developer-assignment\src\resources\views/errors/404.blade.php ENDPATH**/ ?>
