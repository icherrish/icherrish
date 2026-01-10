<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container-xl px-4">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10"><?php echo e(__('Messages List')); ?></div>
                    <div class="col-md-2">
                        <div class="input-group input-group-joined border-0 add-button">
                            
                        </div>
                    </div>
                </div>
                
            </div>
                <?php if(session()->has('message.added')): ?>
                <div class="alert alert-<?php echo session('message.added'); ?> alert-dismissible fade show" role="alert">
                  <strong><?php echo e(__('Congratulations')); ?>!</strong> <?php echo session('message.content'); ?>.
                </div>
                <?php endif; ?>

               <div class="row">
                  <div class="col-sm-12">
                     <!-- Basic Form Inputs card start -->
                     <div class="card">
                        
                        <div class="card-block">
                           <div class="dt-responsive table-responsive">
                              <table id="fix-header" class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Dated')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php if(null!==($messages)): ?>
                                 <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                    <td><?php echo e($data->first_name); ?> <?php echo e($data->last_name); ?></td>

                                    <td><?php echo e($data->email_address); ?></td>
                                    
                                    <td><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)); ?></td>
                                    <td>
                                      <a href="<?php echo e(route('admin.contact-us-detail',[$data->id])); ?>" class="tabledit-edit-button btn btn-primary btn-sm waves-effect waves-light"><span class="icofont icofont-eye-alt"></span>&nbsp <?php echo e(__('View Detail')); ?></a>
                                      
                                      
                                    </td>
                                 </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <?php endif; ?>
                              </tbody>
                           </table>
                           </div>
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
<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/contact_us/index.blade.php ENDPATH**/ ?>