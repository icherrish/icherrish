<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <li>
 <div class="reviewhead">
    <div class="avatar avatar-lg me-2 flex-shrink-0">
        <?php if(Laravel\Jetstream\Jetstream::managesProfilePhotos()): ?>

        <img class="img-fluid" src="<?php echo e($review->user->profile_photo_url); ?>" />

        <?php else: ?>
        <img class="img-fluid" src="https://ui-avatars.com/api/?name=<?php echo e($review->user->name[0]); ?>" />
        

        <?php endif; ?></div>
    <div class="">
    <h4><?php echo e($review->user->name); ?></h4>
        <div class="userrateinfo">
        <span><?php echo e($review->created_at->format('F j, Y')); ?></span>
        <div class="comprating">
            <?php for($i = 1; $i <= 5; $i++): ?>
                <i class="fas fa-star <?php echo e($i <= $review->rating ? 'text-warning' : 'text-muted'); ?>"></i>
            <?php endfor; ?>
        </div>
        <span>(<?php echo e($review->reason); ?>!)</span>
    </div>

        
    </div>
    <?php if(auth()->user() && auth()->user()->id == 1 && $review->reply== ''): ?>
    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#replyreview" data-review="<?php echo e($review->id); ?>" data-feedback="<?php echo e($review->review); ?>" class="replybtn"><i class="fas fa-reply"></i> Reply</a>
    <?php endif; ?>                       
 </div>                     
 <p><?php echo e($review->review); ?></p> 
<?php if($review->reply): ?>
 <div class="replymsg">
                        <div class="avatar avatar-lg me-2 flex-shrink-0">
                           <img src="https://ui-avatars.com/api/?name=S" alt="">
                        </div>

                        <div class="">
                           <h5><?php echo e(@$hotel->title); ?></h5>
                           <div class="dateposted"><?php echo e($review->updated_at->format('F j, Y')); ?></div>
                           <p><?php echo e($review->reply); ?></p>  
                        </div>                      
                     </div>                      
 <?php endif; ?>
</li>  
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/reviews/list.blade.php ENDPATH**/ ?>