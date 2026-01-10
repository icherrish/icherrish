<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>   

<?php $__env->startPush('css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('/admin_assets/toastr/toastr.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('/admin_assets/menu/css/nestable.css')); ?>">



<link rel="stylesheet" href="<?php echo e(asset('/admin_assets/menu/css/menu.css')); ?>">

<?php $__env->stopPush(); ?>

<div>   

<section class="content mt-2">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

            <!-- /.card -->

            <?php 

            $menu_types = App\Models\Menu_types::where('status','active')->get();



              $menu= new App\Models\Menu;

               ?> 

            <?php if(null!==($menu_types)): ?>

            <?php $__currentLoopData = $menu_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="card card-primary">

              <div class="card-header">

                <div class="row">

                    <div class="col-md-9 "><h3 class="card-title m-1"><span class="align-middle"><?php echo e($type->title); ?> <?php echo e(__('List')); ?></span></h3></div>

                    <div class="col-md-3 text-right"><a href="<?php echo e(url('admin/add-menu')); ?>" class="btn btn-danger btn-sm"><i class="fas fa-list"></i> &nbsp <?php echo e(__('Add new Menu')); ?></a></div>

                </div>

                

              </div>

                        <div class="card-block table-border-style">

                           

                           <div class="dt-responsive table-responsive">

                              <div class="page-body">

               <div class="row">

                  <div class="col-sm-12">

                     <!-- Basic Form Inputs card start -->

                     <div class="card">

                        

                        <div class="card-block p-10">

                          <div class="dd" id="nestable">

                           <?php echo $menu->getHTML(App\Models\Menu::where('menu_type_id',$type->id)->orderBy('order')->get()); ?>


                         </div>

                        </div>

                     </div>

                  </div>

               </div>

            </div>

                           </div>

                        </div>

                     </div>



                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                     <?php endif; ?>



                  </div>

               </div>

            </div>

         </section>

      </div>



 







<?php $__env->startPush('js'); ?>

<script type="text/javascript" src="<?php echo e(asset('/admin_assets/toastr/toastr.min.js')); ?>"></script>

 <script src="<?php echo e(asset('/admin_assets/menu/js/jquery.nestable.js')); ?>"></script>

 <script src="<?php echo e(asset('/admin_assets/menu/js/menu.js')); ?>"></script>

<?php $__env->stopPush(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?><?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/menus/index.blade.php ENDPATH**/ ?>