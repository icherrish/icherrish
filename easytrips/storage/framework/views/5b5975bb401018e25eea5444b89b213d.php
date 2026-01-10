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
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Content Translations - <?php echo e($module->name); ?></h3>
                        <div class="card-tools">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                    Switch Module
                                </button>
                                <div class="dropdown-menu">
                                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.content.translations.index', ['module' => $mod->slug])); ?>">
                                            <?php echo e($mod->name); ?>

                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(session('message.added')): ?>
                            <div class="alert alert-<?php echo e(session('message.added')); ?> alert-dismissible fade show" role="alert">
                                <?php echo e(session('message.content')); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <!-- Bulk Translation Form -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Bulk Translation Setup</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo e(route('admin.content.translations.bulk')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="module_id" value="<?php echo e($module->id); ?>">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="target_locale">Target Language</label>
                                                        <select name="target_locale" id="target_locale" class="form-control" required>
                                                            <option value="">Select Language</option>
                                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($language->code !== 'en'): ?>
                                                                    <option value="<?php echo e($language->code); ?>"><?php echo e($language->name); ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Fields to Translate</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="fields[]" value="title" id="field_title" checked>
                                                            <label class="form-check-label" for="field_title">Title</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="fields[]" value="description" id="field_description" checked>
                                                            <label class="form-check-label" for="field_description">Description</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="fields[]" value="meta_title" id="field_meta_title">
                                                            <label class="form-check-label" for="field_meta_title">Meta Title</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="fields[]" value="meta_description" id="field_meta_description">
                                                            <label class="form-check-label" for="field_meta_description">Meta Description</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="fields[]" value="meta_keywords" id="field_meta_keywords">
                                                            <label class="form-check-label" for="field_meta_keywords">Meta Keywords</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="fields[]" value="extra_fields" id="field_extra_fields">
                                                            <label class="form-check-label" for="field_extra_fields">Extra Fields (1-50)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary btn-block">Create Translation Placeholders</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Items Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Translations</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($item->id); ?></td>
                                            <td><?php echo e($item->title); ?></td>
                                            <td>
                                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($language->code !== 'en'): ?>
                                                        <?php
                                                            $translation = $item->translations->where('locale', $language->code)->first();
                                                        ?>
                                                        <span class="badge bg-<?php echo e($translation ? 'success' : 'secondary'); ?> mr-1">
                                                            <?php echo e($language->name); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('admin.content.translations.show', $item->id)); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Manage Translations
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            <?php echo e($items->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/content-translations/index.blade.php ENDPATH**/ ?>