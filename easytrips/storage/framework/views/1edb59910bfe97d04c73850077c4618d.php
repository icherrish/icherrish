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
        <div class="row justify-content-center">
            <div class="col-md-12">
                
            <div class="card mt-5">
<div class="card-header">
    <h3 class="card-title">FLights Booking</h3>
</div>

<div class="card-body">
             <table class="table table-hover table-striped table-bordered myjobtable">
                            <thead>
                                <tr>
                                   <th>#</th>
        <th>Airline</th>
        <th>Status</th>
        <th>Passenger(s)</th>
        <th>Flight From</th>
        <th>Flight To</th>
        <th>Adults</th>
        <th>Departure</th>
        <th>Total</th>
        <th>Booked On</th>
        <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php $__empty_1 = true; $__currentLoopData = $flight_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
        $passengerDetails = is_string($order->passenger_details)
            ? json_decode($order->passenger_details, true)
            : $order->passenger_details;
        $passengers = array_values($passengerDetails ?? []);

        $fullNames = collect($passengers)->map(function($p) {
            return trim(($p['given_name'] ?? '') . ' ' . ($p['family_name'] ?? ''));
        })->unique()->implode(', ');

        $adultsCount = collect($passengers)->where('type', 'adults')->count();
        $nextDeparture = $order->departure_date ? \Carbon\Carbon::parse($order->departure_date)->format('d/m/Y H:i') : '-';
    ?>
    <tr>
        <td><?php echo e($loop->iteration); ?></td>
        <td>
            <?php if($order->airline_code ?? false): ?>
                <img src="https://assets.duffel.com/img/airlines/for-light-background/full-color-logo/<?php echo e($order->airline_code); ?>.svg"
                     alt="<?php echo e($order->airline_code); ?>"
                     style="height:40px;">
            <?php else: ?>
                -
            <?php endif; ?>
        </td>
        <td>
            <span class="badge bg-<?php echo e($order->booking_status == 'confirmed' ? 'success' : 'warning'); ?>">
                <?php echo e(ucfirst($order->booking_status)); ?>

            </span>
        </td>
        <td><b><?php echo e($fullNames); ?></b></td>
        <td><?php echo e($order->origin_code ?? '-'); ?></td>
        <td><?php echo e($order->destination_code ?? '-'); ?></td>
        <td><?php echo e($order->adults ?? 0); ?></td>
        <td><?php echo e($nextDeparture); ?></td>
        <td><?php echo e($order->currency); ?> <?php echo e(number_format($order->total_amount, 2)); ?></td>
        <td><?php echo e($order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') : '-'); ?></td>
        <td>
            <a href="<?php echo e(route('admin.flight-order', $order->id)); ?>" class="btn btn-primary">View</a>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="11">No flight orders found.</td>
    </tr>
<?php endif; ?>
</tbody>

              </table>
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
<?php endif; ?> <?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/admin/flight-orders/list.blade.php ENDPATH**/ ?>