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
            
           
                
               <div class="tab-content" id="nav-tabContent"> 
                <div class="tab-pane fade show active" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
            <div class="row">
            
            <?php if(null!==($widgets)): ?>
            <?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $widget_data = null; ?> 
            <div class="col-12 widgets mb-3">
            <!-- /.card -->

            <div class="card card-primary">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="card-title m-1"><span class="align-middle" style="color: #000;"><?php echo e($wid->title); ?></span></h3>
                    </div>
                    <div class="col-md-2">
                        <div class="text-right mb-1">
                            <a class="btn btn-warning btn-widget btn-sm" href="javascript:;" data-widget="<?php echo e($wid->id); ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    
                </div>
              </div>
            
            <div id="widget_<?php echo e($wid->id); ?>" class="show_hide">
               <div class="row">
                  <div class="col-sm-12">
                     <!-- Basic Form Inputs card start -->
                     <div class="">
                      
                        <div class="card-block">
                        <?php 

                            $widget_data = App\Models\WidgetsData::where('widget_id',$wid->id)->first()
                        ?>
                          <?php if(null!==($widget_data)): ?>
                          <?php echo Form::model($widget_data, array('method' => 'post', 'route' => array('admin.widget_data.store',$wid->id), 'class' => 'form', 'files'=>true)); ?>

                           
                          <?php else: ?>
                          <?php echo Form::open(array('method' => 'post', 'route' => array('admin.widget_data.store',$wid->id), 'class' => 'form', 'files'=>true)); ?>

                           
                          <?php endif; ?>
                           <?php echo Form::hidden('id', $wid->id); ?>

                           
                            <div class="card-body">
                                <div class="border p-3">
                                    <div>
                                        <?php echo $__env->make('admin.widgets_data.inc.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="row">
                                            <div class="col-md-5"></div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                           </div>

                           <?php echo Form::close(); ?>

                           
                        </div>

                     </div>
                  </div>
               </div>
            </div>
            </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <!-- Page body end -->
         </div>
      </div>
   </div>
</div>
<?php $__env->startPush('js'); ?>

<?php echo $__env->make('admin.widgets_data.widgetfiler', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.ckeditor.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/widgets_data/index.blade.php ENDPATH**/ ?>