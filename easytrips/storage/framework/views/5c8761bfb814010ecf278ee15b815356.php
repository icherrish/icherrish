<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>   

<div>   

<section class="content mt-2">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

            <!-- /.card -->



            <div class="card card-primary">

              <div class="card-header">

                <div class="row">

                    <div class="col-md-9 "><h3 class="card-title m-1"><span class="align-middle"><?php echo e(__('Add Menu')); ?></span></h3></div>

                    <div class="col-md-3 text-right"><a href="<?php echo e(url('admin/menus')); ?>" class="btn btn-danger btn-sm"><i class="fas fa-list"></i> &nbsp <?php echo e(__('List Menus')); ?></a></div>

                </div>

                

              </div>

                           <?php echo Form::open(array('method' => 'post', 'route' => 'admin.menus.store', 'class' => 'form', 'files'=>true)); ?>


                           <div class="card-body">

                            <div class="border p-3">

                           <?php echo $__env->make('admin.menus.inc.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                           <div class="row">

                              <div class="col-md-5"></div>

                              <div class="col-md-4"><button type="submit" class="btn btn-primary"><?php echo e(__('Create')); ?></button></div>

                           </div>

                        </div>

                     </div>



                           </form>

                        </div>



                     </div>

                  </div>

               </div>

            </div>

            <!-- Page body end -->

         </div>

      </div>

   </div>

</div>

</section>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>

<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/menus/add.blade.php ENDPATH**/ ?>