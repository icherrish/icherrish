<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        
        <?php 

        $seo = seo (collect(request()->segments())->last());

        ?>
        <title><?php echo e(@$seo['title']); ?></title>
        <meta name="description" content="<?php echo e(@$seo['meta_description']); ?>">
        <meta name="keywords" content="<?php echo e(@$seo['meta_keywords']); ?>">

        <!-- Fav Icon -->

    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">

        <!-- Fontawesome css -->
        <link rel="stylesheet" href="<?php echo e(asset('css/all.css')); ?>">

        <!-- Magnific-popup css -->
        <link rel="stylesheet" href="<?php echo e(asset('css/magnific-popup.css')); ?>">

        <!-- Owl Carousel css -->
        <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>">
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <!-- Main css -->
        <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
        
        <!-- RTL CSS for RTL languages -->
        <?php
            use App\Helpers\TranslationHelper;
            $currentLanguage = TranslationHelper::getCurrentLanguage();
        ?>
        <?php if($currentLanguage && $currentLanguage->is_rtl): ?>
            <link rel="stylesheet" href="<?php echo e(asset('css/rtlstyle.css')); ?>">
        <?php endif; ?>
        
        <!-- Styles -->
        <script type="text/javascript">
          var base_url = "<?php echo url('/'); ?>"
          var images_limit = 1
        </script>
        <!-- Scripts -->
        <?php echo $__env->yieldPushContent('css'); ?>

        <style type="text/css">
            .display-block{
                display: block;
            }
        </style>
        
    </head>
    <body class="nav-fixed">
        <?php echo $__env->make('livewire.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo e($slot); ?>

        <?php echo $__env->make('livewire.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldPushContent('modals'); ?>
        <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script> 
        <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script> 

        <!-- Popup --> 
        <script src="<?php echo e(asset('js/jquery.magnific-popup.min.js')); ?>"></script> 
        <script src="<?php echo e(asset('js/magnific-popup-options.js')); ?>"></script> 

        <!-- Carousel --> 
        <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script> 


        <!-- Google Map --> 
        <?php if(empty($disableGmapAndCustomJs)): ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMqMG_n4C0aAi3F8a82Q6s3hxDLrTXxe8&callback=initMap" async defer></script> 
        <script src="<?php echo e(asset('js/gmap.js')); ?>"></script> 
        <?php endif; ?>

        <!-- Custom --> 
        <?php if(empty($disableGmapAndCustomJs)): ?>
        <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
        <?php endif; ?>

        <?php echo $__env->yieldPushContent('scripts'); ?>
        <?php echo $__env->yieldPushContent('js'); ?>
    </body>
</html>
<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/layouts/app.blade.php ENDPATH**/ ?>