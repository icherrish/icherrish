<?php $__env->startPush('js'); ?>
<script type="text/javascript">
	var extra_image_1_height_<?php echo e($wid->id); ?> = "<?php echo e($wid->extra_image_1_height); ?>";
	var extra_image_1_width_<?php echo e($wid->id); ?> = "<?php echo e($wid->extra_image_1_width); ?>";

  var extra_image_2_height_<?php echo e($wid->id); ?> = "<?php echo e($wid->extra_image_2_height); ?>";
  var extra_image_2_width_<?php echo e($wid->id); ?> = "<?php echo e($wid->extra_image_2_width); ?>";
</script>
<?php $__env->stopPush(); ?>
<input type="hidden" name="widget_page" value="<?php echo e($page->slug); ?>">
<input type="hidden" id="data_filer_widget_image_1_<?php echo e($wid->id); ?>" <?php if(isset($widget_data)){echo 'value="'.$widget_data->extra_image_1.'"';} ?> name="extra_image_1">

<input type="hidden" id="data_filer_widget_image_2_<?php echo e($wid->id); ?>" <?php if(isset($widget_data)){echo 'value="'.$widget_data->extra_image_2.'"';} ?> name="extra_image_2">


<div class="row">



  

  <?php if($wid->extra_fields): ?>
  <?php for($i = 1 ; $i<=$wid->extra_fields; $i++): ?>
    <div class="col-md-12">
      <div class="mb-3">
      	<?php
      	$label = 'extra_field_title_'.$i;
      	$name = 'extra_field_'.$i;
      	?>
	    <?php echo Form::label($name, $wid->$label, ['class' => 'font-weight-bold']); ?>

	    <?php echo Form::text($name, null, array('class'=>'form-control', 'id'=>$name, 'placeholder'=>$wid->$label, 'required'=>'required')); ?>

	  </div>
	</div>
	<?php endfor; ?>
  <?php endif; ?>

  <?php if($wid->is_extra_image_title_1): ?>
    <div class="col-md-12">
      <div class="mb-3">
	    <div class="sub-title"><?php echo e($wid->extra_image_title_1); ?></div>
	    <input type="file" name="image" id="filer_widget_image_1_<?php echo e($wid->id); ?>">
	  </div>
	</div>
  <?php endif; ?>

  <?php if($wid->is_extra_image_title_2): ?>
    <div class="col-md-12">
      <div class="mb-3">
      <div class="sub-title"><?php echo e($wid->extra_image_title_2); ?></div>
      <input type="file" name="image" id="filer_widget_image_2_<?php echo e($wid->id); ?>">
    </div>
  </div>
  <?php endif; ?>

  <?php if($wid->is_description): ?>
  <div class="col-md-12">
     <div class="mb-3">
        <?php echo Form::label('description', $wid->title.' Description', ['class' => 'font-weight-bold']); ?>

        <?php echo Form::textarea('description', null, array('class'=>'form-control editor1', 'id'=>'description', 'placeholder'=>$wid->title.' Description', 'required'=>'required')); ?>

     </div>
  </div>
  <?php endif; ?>


 <?php if($wid->radio_buttons): ?>
  <?php for($i = 1 ; $i<=$wid->radio_buttons; $i++): ?>
      <?php
        $label = 'radio_button_title_'.$i;
        $name = 'radio_button_'.$i;
      ?>
      <div class="col-md-12 col-xl-6 m-b-30">
      <h4 class="sub-title"><?php echo e($wid->$label); ?></h4>
      <div class="form-radio">
      <div class="radio radio-inline">

      <label>
      <input type="radio" name="<?php echo e($name); ?>" value="1" <?php 
        if(isset($widget_data) && $widget_data->$name == 1){echo 'checked';} else if(!isset($widget_data)){ echo 'checked';}
      ?> >
      <i class="helper"></i>Yes
      </label>
      </div>
      <div class="radio radio-inline">
      <label>
      <input type="radio" value="0" name="<?php echo e($name); ?>" <?php if(isset($widget_data) && $widget_data->$name == 0){echo 'checked';}
      ?>>
      <i class="helper"></i>No
      </label>
      </div>
      </div>
      </div>
  <?php endfor; ?>
  <?php endif; ?>
	
	
</div>
<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/widgets_data/inc/form.blade.php ENDPATH**/ ?>