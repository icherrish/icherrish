<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Currency Settings</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Currency Settings</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Default Currency</h4>
                        <p class="text-muted mb-0">Configure your default currency for tours and hotels</p>
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('admin.currency-settings.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="default_currency" class="form-label">Select Default Currency</label>
                                        <select class="form-select <?php $__errorArgs = ['default_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                id="default_currency" name="default_currency" required>
                                            <option value="">Choose Currency</option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $selected = false;
                                                    if (isset($settings['default_currency'])) {
                                                        $selected = $settings['default_currency']->value == $country->currency;
                                                    } else {
                                                        $selected = $country->currency == 'PKR';
                                                    }
                                                ?>
                                                <option value="<?php echo e($country->id); ?>" <?php echo e($selected ? 'selected' : ''); ?>>
                                                    <?php echo e($country->name); ?> (<?php echo e($country->currency); ?> - <?php echo e($country->currency_symbol); ?>)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['default_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small class="form-text text-muted">
                                            This currency will be used throughout the site for displaying prices in tours and hotels
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">&nbsp;</label>
                                        <div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Update Currency
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Currency Display -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Current Currency Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="current-currency-display">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="currency-icon me-3">
                                            <i class="fas fa-money-bill-wave fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1"><?php echo e($settings['default_currency_name']->value ?? 'Pakistani Rupee'); ?></h5>
                                            <p class="text-muted mb-0">
                                                <strong>Code:</strong> <?php echo e($settings['default_currency']->value ?? 'PKR'); ?> |
                                                <strong>Symbol:</strong> <?php echo e($settings['default_currency_symbol']->value ?? 'Rs'); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="currency-preview">
                                        <small class="text-muted">Price Display Preview:</small>
                                        <div class="preview-examples mt-2">
                                            <div class="badge bg-light text-dark me-2">
                                                <?php echo e($settings['default_currency_symbol']->value ?? 'Rs'); ?> 15,000
                                            </div>
                                            <div class="badge bg-light text-dark me-2">
                                                <?php echo e($settings['default_currency_symbol']->value ?? 'Rs'); ?> 25,500
                                            </div>
                                            <div class="badge bg-light text-dark">
                                                <?php echo e($settings['default_currency_symbol']->value ?? 'Rs'); ?> 50,000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <h6><i class="fas fa-info-circle text-info"></i> How It Works</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success"></i> Tours will display prices in selected currency</li>
                                        <li><i class="fas fa-check text-success"></i> Hotels will display prices in selected currency</li>
                                        <li><i class="fas fa-check text-success"></i> All price displays will use the currency symbol</li>
                                        <li><i class="fas fa-check text-success"></i> Changes apply immediately across the site</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .current-currency-display {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid var(--bs-primary);
        }
        
        .currency-preview .preview-examples {
            font-size: 1.1rem;
        }
        
        .info-box {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #0dcaf0;
        }
        
        .info-box ul li {
            padding: 5px 0;
        }
        
        .info-box ul li i {
            width: 20px;
        }
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?><?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>