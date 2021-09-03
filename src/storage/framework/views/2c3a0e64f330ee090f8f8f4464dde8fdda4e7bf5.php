<?php $__env->startSection('title'); ?>
    <?php echo e($book->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-12" style="margin-top: 20px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('assignment_dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('books_list')); ?>">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row" id="filter_div">
        <div class="col-md-8" id="custom_filter">
            <h4 class="text-left pull-left">
                Edit book
            </h4>
        </div>
        <div class="col-md-4" id="custom_filter">
            <h2 class="text-right pull-right">
                <a class="btn bg-olive btn-flat margin"  href="<?php echo e(route('books_list')); ?>">Books List
                </a>
            <a class="btn bg-olive btn-flat margin"  href="<?php echo e(route('create_book')); ?>">Create Book
                </a>
            </h2>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">

                        <form action="<?php echo e(route('update_book', $book->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="card-body">
                                <div class="form-group <?php echo e(($errors->has('title'))?'has-error':''); ?>">
                                    <label for="title">Book Title <strong style="color: red;font-size: 20px">*</strong>
                                    </label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter book title." value="<?php echo e($book->title); ?>">
                                    <?php if($errors->has('title')): ?>
                                        <span class="help-block" style="color: red">
                                        <strong>  <?php echo e($errors->first('title')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group <?php echo e(($errors->has('author_name'))?'has-error':''); ?>">
                                    <label for="author_name">Author Name<strong
                                            style="color: red;font-size: 20px">*</strong> </label>
                                    <input type="text" class="form-control" name="author_name" id="author_name"
                                           placeholder="Enter author name." value="<?php echo e($book->author_name); ?>">
                                    <?php if($errors->has('author_name')): ?>
                                        <span class="help-block" style="color: red">
                                        <strong>  <?php echo e($errors->first('author_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-flat">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMP\htdocs\Laravel Projects\Yaraku\web-developer-assignment\src\resources\views/assignment/edit.blade.php ENDPATH**/ ?>