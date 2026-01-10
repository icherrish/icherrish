<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="<?php echo e(asset('admin_assets/css/styles.css?v=2')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('admin_assets/css/app.css')); ?>" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <link rel="stylesheet" href="<?php echo e(asset('admin_assets/plugins/summernote/summernote-bs4.min.css')); ?>">
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>

            <link href="<?php echo e(asset('admin_assets/bower_components/jquery.filer/css/jquery.filer.css')); ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo e(asset('admin_assets/bower_components/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css')); ?>" type="text/css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        
        <!-- RTL CSS for RTL languages -->
        <?php
            use App\Helpers\TranslationHelper;
            $currentLanguage = TranslationHelper::getCurrentLanguage();
        ?>
        <?php if($currentLanguage && $currentLanguage->is_rtl): ?>
            <link rel="stylesheet" href="<?php echo e(asset('css/rtlstyle.css')); ?>">
        <?php endif; ?>
        
        <!-- Styles -->
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

        <script type="text/javascript">
          var base_url = "<?php echo url('/'); ?>"
          var images_limit = 1
        </script>
        <!-- Scripts -->
        <?php echo $__env->yieldPushContent('css'); ?>
        
    </head>
    <body class="nav-fixed">
        <input type="hidden" id="user-type" value="<?php echo Auth::user()->role; ?>">
        <?php if(auth()->user() && auth()->user()->hasRole('admin')): ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.common.navbar', []);

$__html = app('livewire')->mount($__name, $__params, 'DIDDJJn', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <?php else: ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('common.navbar', []);

$__html = app('livewire')->mount($__name, $__params, '1IJr1SD', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <?php endif; ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <?php if(auth()->user() && auth()->user()->hasRole('admin')): ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.common.sidebar', []);

$__html = app('livewire')->mount($__name, $__params, 'dAqfIha', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <?php else: ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('common.sidebar', []);

$__html = app('livewire')->mount($__name, $__params, 'VhFLhw5', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <?php endif; ?>    
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <?php echo e($slot); ?>

                </main>
            </div>
        </div> 

        <?php echo $__env->yieldPushContent('modals'); ?>

        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo e(asset('admin_assets/js/scripts.js')); ?>"></script>
        <script src="<?php echo e(asset('admin_assets/js/sidebar.js')); ?>"></script>
        <script src="<?php echo e(asset('admin_assets/assets/js/dynamic-form.js')); ?>"></script>
        
        <!-- Custom Dashboard Styles -->
        <style>
            .dashboard-card {
                transition: all 0.3s ease;
            }
            .dashboard-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }
            
            .chart-container {
                position: relative;
                height: 300px;
            }
            
            .stats-card {
                background: linear-gradient(135deg, var(--tw-gradient-stops));
                transition: all 0.3s ease;
            }
            
            .stats-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            }
            
            .recent-booking-item {
                transition: all 0.2s ease;
            }
            
            .recent-booking-item:hover {
                background-color: #f8fafc;
                transform: translateX(2px);
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="<?php echo e(asset('admin_assets/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('admin_assets/bower_components/jquery.filer/js/jquery.filer.min.js')); ?>"></script>
        <script src="<?php echo e(asset('admin_assets/js/jquery.dataTables.min.js')); ?>"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

        <?php echo $__env->yieldPushContent('js'); ?>
        
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    </body>
</html>
<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/layouts/admin.blade.php ENDPATH**/ ?>