<div class="row">
  	<div class="col-md-12">
     	<div class="form-group">
        	<?php echo Form::label('title', 'Menu Title', ['class' => 'font-weight-bold']); ?>

        	<?php echo Form::text('title', null, array('class'=>'form-control', 'id'=>'title', 'placeholder'=>'Menu Title')); ?>

        	<?php echo APFrmErrHelp::showErrors($errors, 'title'); ?>

     	</div>
  	</div>

  	<div class="col-md-12">
    	<div class="form-group">
            <?php echo Form::label('slug', 'Menu Link', ['class' => 'font-weight-bold']); ?>

            <?php echo Form::text('slug', null, array('class'=>'form-control', 'id'=>'slug', 'placeholder'=>'Menu Link')); ?>

            <?php echo APFrmErrHelp::showErrors($errors, 'slug'); ?>

    	</div>
  	</div>

  	<div class="col-md-12">
     	<div class="form-group">
        	<?php echo Form::label('menu_type_id', 'Menu Type', ['class' => 'font-weight-bold']); ?>

        	<?php echo Form::select('menu_type_id', $menu_types, null, array('class'=>'form-control', 'id'=>'menu_type_id')); ?>

        	<?php echo APFrmErrHelp::showErrors($errors, 'menu_type_id'); ?>

     	</div>
  	</div>
</div>
<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/menus/inc/form.blade.php ENDPATH**/ ?>