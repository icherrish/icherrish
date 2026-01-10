<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<?php $__env->startSection('title', 'Tour Booking Details'); ?>



<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-2 px-4">
    <!-- Page Header -->

        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tour Booking Details</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.tour-bookings.index')); ?>">Tour Bookings</a></li>
                    <li class="breadcrumb-item active"><?php echo e($booking->booking_reference); ?></li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('admin.tour-bookings.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
                
            </div>
        </div>
  

    <div class="row">
        <!-- Main Booking Details -->
        <div class="col-lg-8">
            <!-- Booking Overview Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-plane"></i> Booking Overview
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="font-weight-bold">Booking Reference:</label>
                                <p class="text-primary"><?php echo e($booking->booking_reference); ?></p>
                            </div>
                            <div class="info-group">
                                <label class="font-weight-bold">Tour Title:</label>
                                <p><?php echo e($booking->tour->title ?? 'N/A'); ?></p>
                            </div>
                            <div class="info-group">
                                <label class="font-weight-bold">Departure Date:</label>
                                <p><?php echo e($booking->departure_date ? date('d M Y, D', strtotime($booking->departure_date)) : 'N/A'); ?></p>
                            </div>
                            <div class="info-group">
                                <label class="font-weight-bold">Tour Duration:</label>
                                <p><?php echo e($booking->tour->extra_field_3 ?? 'N/A'); ?> Days</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                                                         <div class="info-group">
                                 <label class="font-weight-bold">Booking Status:</label>
                                 <span class="badge bg-<?php echo e($booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'secondary')); ?> fs-6">
                                     <?php echo e(ucfirst($booking->status)); ?>

                                 </span>
                             </div>
                             <div class="info-group">
                                 <label class="font-weight-bold">Payment Status:</label>
                                 <span class="badge bg-<?php echo e($booking->payment_status == 'completed' ? 'success' : ($booking->payment_status == 'pending' ? 'warning' : 'danger')); ?> fs-6">
                                     <?php echo e(ucfirst($booking->payment_status)); ?>

                                 </span>
                             </div>
                            <div class="info-group">
                                <label class="font-weight-bold">Payment Method:</label>
                                <p>
                                    <?php if($booking->payment_method === 'stripe'): ?>
                                        <i class="fab fa-stripe"></i> Credit/Debit Card
                                    <?php elseif($booking->payment_method === 'paypal'): ?>
                                        <i class="fab fa-paypal"></i> PayPal
                                    <?php else: ?>
                                        <?php echo e(ucfirst($booking->payment_method)); ?>

                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="info-group">
                                <label class="font-weight-bold">Payment ID:</label>
                                <p class="font-monospace"><?php echo e($booking->payment_id ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-user"></i> Customer Information
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="font-weight-bold">Full Name:</label>
                                <p><?php echo e($booking->user->name ?? 'N/A'); ?></p>
                            </div>
                            <div class="info-group">
                                <label class="font-weight-bold">Email:</label>
                                <p><?php echo e($booking->user->email ?? 'N/A'); ?></p>
                            </div>
                            <div class="info-group">
                                <label class="font-weight-bold">Phone:</label>
                                <p><?php echo e($booking->user->phone ?? 'N/A'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                                                         <div class="info-group">
                                 <label class="font-weight-bold">Country:</label>
                                 <p>
                                     <?php if($booking->user->country && $booking->user->countryData): ?>
                                         <?php echo e($booking->user->countryData->name); ?>

                                     <?php else: ?>
                                         <span class="text-muted">Not specified</span>
                                     <?php endif; ?>
                                 </p>
                             </div>
                             <div class="info-group">
                                 <label class="font-weight-bold">State/Province:</label>
                                 <p>
                                     <?php if($booking->user->state && $booking->user->stateData): ?>
                                         <?php echo e($booking->user->stateData->name); ?>

                                     <?php else: ?>
                                         <span class="text-muted">Not specified</span>
                                     <?php endif; ?>
                                 </p>
                             </div>
                             <div class="info-group">
                                 <label class="font-weight-bold">City:</label>
                                 <p>
                                     <?php if($booking->user->city && $booking->user->cityData): ?>
                                         <?php echo e($booking->user->cityData->name); ?>

                                     <?php else: ?>
                                         <span class="text-muted">Not specified</span>
                                     <?php endif; ?>
                                 </p>
                             </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passenger Details Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-users"></i> Passenger Details
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                                                 <div class="col-md-6">
                             <div class="info-group">
                                 <label class="font-weight-bold">Total Adults:</label>
                                 <span class="badge bg-primary fs-6"><?php echo e($booking->adults); ?></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="info-group">
                                 <label class="font-weight-bold">Total Children:</label>
                                 <span class="badge bg-info fs-6"><?php echo e($booking->children); ?></span>
                             </div>
                         </div>
                    </div>

                    <?php if($booking->passengers): ?>
                        <div class="passenger-list">
                            <h6 class="font-weight-bold mb-3">Passenger Information:</h6>
                            <?php $__currentLoopData = $booking->passengers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $passenger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="passenger-item border rounded p-3 mb-2">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Passenger <?php echo e($index + 1); ?>:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <p class="mb-1">
                                                <strong><?php echo e($passenger['title'] ?? 'N/A'); ?> <?php echo e($passenger['first_name'] ?? 'N/A'); ?> <?php echo e($passenger['last_name'] ?? 'N/A'); ?></strong>
                                            </p>
                                                                                         <?php if(isset($passenger['country']) && $passenger['country']): ?>
                                                 <?php
                                                     $country = \App\Models\Country::find($passenger['country']);
                                                 ?>
                                                 <small class="text-muted">Country: <?php echo e($country ? $country->name : 'Invalid Country ID'); ?></small>
                                             <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tour Details Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-map-marked-alt"></i> Tour Information
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="font-weight-bold">Tour Start Date:</label>
                                <p><?php echo e($booking->tour->extra_field_1 ? date('d M Y', strtotime($booking->tour->extra_field_1)) : 'N/A'); ?></p>
                            </div>
                            <div class="info-group">
                                <label class="font-weight-bold">Tour End Date:</label>
                                <p><?php echo e($booking->tour->extra_field_2 ? date('d M Y', strtotime($booking->tour->extra_field_2)) : 'N/A'); ?></p>
                            </div>
                            <div class="info-group">
                                <label class="font-weight-bold">Total Nights:</label>
                                <p><?php echo e($booking->tour->extra_field_4 ?? 'N/A'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                                                         <div class="info-group">
                                 <label class="font-weight-bold">Departure Country:</label>
                                 <p>
                                     <?php if($booking->tour->extra_field_5 && $booking->tour->departureCountry): ?>
                                         <?php echo e($booking->tour->departureCountry->name); ?>

                                     <?php else: ?>
                                         <span class="text-muted">Not specified</span>
                                     <?php endif; ?>
                                 </p>
                             </div>
                             <div class="info-group">
                                 <label class="font-weight-bold">Departure State:</label>
                                 <p>
                                     <?php if($booking->tour->extra_field_6 && $booking->tour->departureState): ?>
                                         <?php echo e($booking->tour->departureState->name); ?>

                                     <?php else: ?>
                                         <span class="text-muted">Not specified</span>
                                     <?php endif; ?>
                                 </p>
                             </div>
                             <div class="info-group">
                                 <label class="font-weight-bold">Departure City:</label>
                                 <p>
                                     <?php if($booking->tour->extra_field_7 && $booking->tour->departureCity): ?>
                                         <?php echo e($booking->tour->departureCity->name); ?>

                                     <?php else: ?>
                                         <span class="text-muted">Not specified</span>
                                     <?php endif; ?>
                                 </p>
                             </div>
                        </div>
                    </div>
                    
                    <?php if($booking->tour->extra_field_12): ?>
                        <div class="info-group mt-3">
                            <label class="font-weight-bold">Terms & Conditions:</label>
                            <div class="border rounded p-3 bg-light">
                                <?php echo nl2br(e($booking->tour->extra_field_12)); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Pricing Summary Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-calculator"></i> Pricing Summary
                    </h4>
                </div>
                <div class="card-body">
                    <div class="pricing-breakdown">
                        <div class="price-item d-flex justify-content-between mb-2">
                            <span>Adult Price:</span>
                            <strong><?php echo e($currencySymbol); ?> <?php echo e(number_format($booking->adult_price)); ?> × <?php echo e($booking->adults); ?></strong>
                        </div>
                        <?php if($booking->children > 0): ?>
                            <div class="price-item d-flex justify-content-between mb-2">
                                <span>Children Price:</span>
                                <strong><?php echo e($currencySymbol); ?> <?php echo e(number_format($booking->children_price ?? 0)); ?> × <?php echo e($booking->children); ?></strong>
                            </div>
                        <?php endif; ?>
                        <hr>
                        <div class="price-item d-flex justify-content-between mb-2">
                            <span class="font-weight-bold">Total Amount:</span>
                            <strong class="text-primary text-lg"><?php echo e($currencySymbol); ?> <?php echo e(number_format($booking->total_amount)); ?></strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Timeline Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fas fa-clock"></i> Booking Timeline
                    </h4>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content mb-3">
                                <h6 class="timeline-title">Booking Created</h6>
                                <p class="timeline-text"><?php echo e($booking->created_at->format('d M Y, h:i A')); ?></p>
                            </div>
                        </div>
                        <?php if($booking->updated_at != $booking->created_at): ?>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content mb-3">
                                    <h6 class="timeline-title">Last Updated</h6>
                                    <p class="timeline-text"><?php echo e($booking->updated_at->format('d M Y, h:i A')); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($booking->departure_date): ?>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title">Departure Date</h6>
                                    <p class="timeline-text"><?php echo e(date('d M Y, D', strtotime($booking->departure_date))); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

             <!-- Quick Actions Card -->
             <div class="card mb-3">
                 <div class="card-header">
                     <h4 class="card-title">
                         <i class="fas fa-tools"></i> Quick Actions
                     </h4>
                 </div>
                 <div class="card-body">
                     <div class="d-grid gap-2">
                         <a href="<?php echo e(route('tour.detail', $booking->tour->slug ?? '')); ?>" target="_blank" class="btn btn-outline-primary">
                             <i class="fas fa-external-link-alt"></i> View Tour Page
                         </a>
                         <button class="btn btn-outline-success" onclick="updateStatus('<?php echo e($booking->id); ?>', 'confirmed')">
                             <i class="fas fa-check"></i> Mark Confirmed
                         </button>
                         <button class="btn btn-outline-warning" onclick="updateStatus('<?php echo e($booking->id); ?>', 'pending')">
                             <i class="fas fa-clock"></i> Mark Pending
                         </button>
                         <button class="btn btn-outline-danger" onclick="updateStatus('<?php echo e($booking->id); ?>', 'cancelled')">
                             <i class="fas fa-times"></i> Mark Cancelled
                         </button>
                     </div>
                 </div>
             </div>
            <!-- Related Bookings Card -->
            <?php if($relatedBookings->count() > 0): ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fas fa-link"></i> Other Bookings For This User
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="related-bookings">
                            <?php $__currentLoopData = $relatedBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="related-booking-item border-bottom pb-2 mb-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong><?php echo e($related->user->name ?? 'N/A'); ?></strong>
                                            <br><small class="text-muted"><?php echo e($related->booking_reference); ?></small>
                                        </div>
                                        <div class="text-right">
                                                                                         <span class="badge bg-<?php echo e($related->status == 'confirmed' ? 'success' : 'warning'); ?>">
                                                 <?php echo e(ucfirst($related->status)); ?>

                                             </span>
                                            <br><small class="text-muted"><?php echo e($related->created_at->format('d M Y')); ?></small>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <a href="<?php echo e(route('admin.tour-bookings.show', $related->id)); ?>" class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

                         
             
             
            
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Booking Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="statusForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="mb-3">
                        <label class="form-label">Booking Status</label>
                        <select class="form-select" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <select class="form-select" name="payment_status" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitStatusUpdate()">Update Status</button>
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

<?php $__env->startPush('styles'); ?>
<style>
.info-group {
    margin-bottom: 1rem;
}

.info-group label {
    color: #6c757d;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.info-group p {
    margin-bottom: 0;
    font-size: 1rem;
}

.passenger-item {
    background-color: #f8f9fa;
}

.timeline {
    position: relative;
    padding-left: 1.5rem;
}

.timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
}

.timeline-marker {
    position: absolute;
    left: -1.5rem;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-content {
    margin-left: 0.5rem;
}

.timeline-title {
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.timeline-text {
    margin-bottom: 0;
    font-size: 0.8rem;
    color: #6c757d;
}

.related-booking-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

 .badge-lg {
     font-size: 0.875rem;
     padding: 0.5rem 0.75rem;
 }
 
 .fs-6 {
     font-size: 0.875rem !important;
 }

.text-lg {
    font-size: 1.25rem;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
let currentBookingId = null;

function updateStatus(bookingId, status) {
    currentBookingId = bookingId;
    
    // Set default values
    document.querySelector('select[name="status"]').value = status;
    document.querySelector('select[name="payment_status"]').value = 'pending';
    
    const modal = new bootstrap.Modal(document.getElementById('statusModal'));
    modal.show();
}

function submitStatusUpdate() {
    if (!currentBookingId) return;
    
    const formData = new FormData(document.getElementById('statusForm'));
    
    fetch(`/admin/tour-bookings/${currentBookingId}/status`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            status: formData.get('status'),
            payment_status: formData.get('payment_status')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('statusModal'));
            modal.hide();
            location.reload();
        } else {
            alert('Error updating status: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating status. Please try again.');
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/tour-bookings/show.blade.php ENDPATH**/ ?>