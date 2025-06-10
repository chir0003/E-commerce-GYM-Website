<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<?= $this->Html->css('table') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mb-8">
            <div class="text-end mb-3">
                <a href="<?= $this->Url->build(['controller' => 'Services', 'action' => 'dashboard']) ?>" class="btn btn-warning">
                    <i class="fas fa-house me-2"></i>Back to Admin Dashboard
                </a>
            </div>

            <div class="card shadow-sm">
                <!-- Header with toggle button -->
                <div class="card-header bg-black text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Actions</h3>
                    <button class="btn btn-sm btn-light text-dark toggle-arrow" type="button" data-bs-toggle="collapse" data-bs-target="#actionButtons" aria-expanded="true" aria-controls="actionButtons">
                        <i class="fas fa-chevron-up"></i>
                    </button>
                </div>

                <div class="collapse show" id="actionButtons">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], [
                                    'confirm' => __('Are you sure you want to delete Order #{0}?', $order->id),
                                    'class' => 'btn btn-outline-danger w-100'
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- View -->
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-black">
            <h3 class="mb-0">Order #<?= h($order->id) ?> Details</h3>
        </div>

        <div class="card-body">
            <!-- detail-->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Customer Information</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> <?= h($order->customer->name) ?></li>
                        <li class="list-group-item">
                            <strong>Email:</strong>
                            <span id="emailText"><?= h($order->customer->email) ?></span>
                            <i class="fas fa-copy ms-2" style="cursor: pointer;" onclick="copyToClipboard('emailText', 'emailCopyMessage')" title="Copy email"></i>
                            <span id="emailCopyMessage" class="ms-2 text-success" style="opacity: 0; transition: opacity 0.3s;">Copied!</span>
                        </li>
                        <li class="list-group-item"><strong>Address:</strong> <?= h($order->customer->address) ?></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Order Summary</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Status:</strong> <?= h($order->status) ?></li>
                        <li class="list-group-item"><strong>Delivery Method:</strong> <?= h($order->delivery_method ?? 'N/A') ?></li>
                        <li class="list-group-item"><strong>Delivery Status:</strong> <?= h($order->delivery_status ?? 'N/A') ?></li>
                        <li class="list-group-item"><strong>Delivery Date:</strong> <?= h($order->delivery_date ?? 'N/A') ?></li>
<!--                        <li class="list-group-item"><strong>Stripe Payment ID:</strong> --><?php //= h($order->stripe_payment_id) ?><!--</li>-->
                        <li class="list-group-item">
                            <strong>Stripe Payment ID:</strong>
                            <span id="paymentText"><?= h($order->stripe_payment_id ?? 'N/A') ?></span>
                            <i class="fas fa-copy ms-2" style="cursor: pointer;" onclick="copyToClipboard('paymentText', 'paymentCopyMessage')" title="Copy Payment ID"></i>
                            <span id="paymentCopyMessage" class="ms-2 text-success" style="opacity: 0; transition: opacity 0.3s;">Copied!</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- list -->
            <h5 class="mb-3">Ordered Products</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Retail Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orderProducts as $item): ?>
                        <tr>
                            <td><?= h($item->product->name) ?></td>
                            <td>$<?= number_format($item->price, 2) ?></td>
                            <td><?= h($item->quantity) ?></td>
                            <td>$<?= number_format($item->price * $item->quantity, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <h4 class="text-end mt-3">Total Amount: <span class="text-success">$<?= number_format($order->total_amount, 2) ?></span></h4>

            <hr>

            <!-- state -->
            <h5 class="mb-3">Update Order Status</h5>
            <?= $this->Form->create($order) ?>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('status', [
                        'options' => ['processed' => 'Processed', 'shipped' => 'Shipped', 'completed' => 'Completed'],
                        'label' => 'Order Status',
                        'class' => 'form-select'
                    ]) ?>
                </div>

                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('delivery_status', [
                        'options' => ['in transit' => 'In Transit', 'delivered' => 'Delivered'],
                        'label' => 'Delivery Status',
                        'class' => 'form-select'
                    ]) ?>
                </div>

                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('delivery_date', [
                        'type' => 'date',
                        'label' => 'Delivery Date',
                        'value' => $order->delivery_date,
                        'class' => 'form-control'
                    ]) ?>
                </div>
            </div>

            <!-- notice -->
            <div class="mb-3">
                <?= $this->Form->control('notes', [
                    'type' => 'textarea',
                    'label' => 'Order Notes',
                    'class' => 'form-control',
                    'rows' => 4,
                    'placeholder' => 'Add any relevant notes about this order...'
                ]) ?>
            </div>

            <div class="d-grid">
                <?= $this->Form->button('Update Order', ['class' => 'btn btn-success btn-lg']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<br>
<script>
    function copyToClipboard(textId, messageId) {
        const text = document.getElementById(textId).innerText;
        const message = document.getElementById(messageId);

        navigator.clipboard.writeText(text).then(() => {
            message.style.opacity = '1';
            setTimeout(() => {
                message.style.opacity = '0';
            }, 1000);
        });
    }
</script>

<script>
    const toggleBtn = document.querySelector('.toggle-arrow');
    const icon = toggleBtn.querySelector('i');
    const target = document.querySelector('#actionButtons');

    target.addEventListener('show.bs.collapse', () => {
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    });

    target.addEventListener('hide.bs.collapse', () => {
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deliveryStatusSelect = document.getElementById('delivery-status');
        const orderStatusSelect = document.getElementById('status');

        function validateStatusOptions() {
            const isDelivered = deliveryStatusSelect.value === 'delivered';
            const completedOption = [...orderStatusSelect.options].find(opt => opt.value === 'completed');

            if (completedOption) {
                completedOption.disabled = !isDelivered;

                // If "completed" is selected but delivery is not "delivered", reset
                if (!isDelivered && orderStatusSelect.value === 'completed') {
                    orderStatusSelect.value = 'processed'; // or 'shipped'
                }
            }
        }

        // Initial validation
        validateStatusOptions();

        // Add change listener
        deliveryStatusSelect.addEventListener('change', validateStatusOptions);
    });
</script>

