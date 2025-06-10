<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PowerProShop - Equip with Confidence</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PowerProShop - Equip with Confidence</title>

    <!--FOR CALENDAR-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="<?= $this->Url->build('/js/fullcalendar/index.global.min.js') ?>"></script>
    <script src="<?= $this->Url->build('/js/calendar.js') ?>"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="sb-nav-fixed">
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-5">
                <h1 class="mt-4">ADMIN DASHBOARD</h1>
                <div class="row">
                    <!-- View All Orders Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>View All Orders</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Go', ['controller' => 'Orders', 'action' => 'index'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>

                    <!-- View All Products Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>View All Products</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Go', ['controller' => 'Products', 'action' => 'index'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>

                    <!-- View All Product Categories Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>View All Product Categories</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Go', ['controller' => 'Product-Categories', 'action' => 'index'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>

                    <!-- View All Services Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>View All Services</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Go', ['controller' => 'Services', 'action' => 'index'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- View All Customer Inquiries Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>View All Customer Inquiries</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Go', ['controller' => 'ContactForms', 'action' => 'index'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>

                    <!-- View All Appointments Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>View All Appointments</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Go', ['controller' => 'Appointments', 'action' => 'index'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>

                    <!-- View All Users Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>View All Users</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Go', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>

                    <!-- View Customer Home Page Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>View Customer Home Page</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Go', ['controller' => 'Pages', 'action' => 'home'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- View Customer Reviews Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>View Customer Reviews</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Go', ['controller' => 'Reviews', 'action' => 'index'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>

                    <!-- Content Blocks Card -->
                    <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card bg-dark text-white mb-4 shadow">
                            <div class="card-body text-center pb-0">
                                <h4>Content Blocks</h4>
                            </div>
                            <div class="card-footer d-flex justify-content-center pt-2">
                                <?= $this->Html->link('Content Blocks', ['plugin' => 'ContentBlocks', 'controller' => 'ContentBlocks', 'action' => 'index'], ['class' => 'btn btn-warning px-4 py-2']) ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


<!--                <div class="card mb-4">-->
<!--                    <div class="card text-center">-->
<!--                        <div class="card-header">-->
<!--                            <ul class="nav nav-pills card-header-pills" id="myTab" role="tablist">-->
<!--                                <li class="nav-item" role="presentation">-->
<!--                                    <a href="#inquiries" class="nav-link active custom-tab" id="inquiries-tab" data-bs-toggle="tab" data-bs-target="#inquiries" role="tab" aria-controls="inquiries" aria-selected="true">Customer Inquiries</a>-->
<!--                                </li>-->
<!---->
<!--                                <li class="nav-item" role="presentation">-->
<!--                                    <a href="#appointments" class="nav-link custom-tab" id="appointments-tab" data-bs-toggle="tab" data-bs-target="#appointments" role="tab" aria-controls="appointments" aria-selected="false">Appointment Requests</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!---->
<!--                        <div class="card-body">-->
<!--                            <div class="tab-content" id="myTabContent">-->
<!--                                <div class="tab-pane fade show active" id="inquiries" role="tabpanel" aria-labelledby="inquiries-tab">-->
<!--                                    <div class="d-flex justify-content-end mb-2">-->
<!--                                        <div class="btn-group">-->
<!--                                            --><?php //= $this->Html->link(__('View All'), ['controller' => 'ContactForms', 'action' => 'index'], ['class' => 'btn btn-primary me-2']) ?>
<!--                                            --><?php //= $this->Html->link(__('New Inquiry'), ['controller' => 'ContactForms', 'action' => 'add'], ['class' => 'btn btn-success']) ?>
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!---->
<!--                                <div class="tab-pane fade" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">-->
<!--                                    <div class="d-flex justify-content-end mb-2">-->
<!--                                        <div class="btn-group">-->
<!--                                            --><?php //= $this->Html->link(__('View All'), ['controller' => 'Appointments', 'action' => 'index'], ['class' => 'btn btn-primary me-2']) ?>
<!--                                            --><?php //= $this->Html->link(__('New Appointment'), ['controller' => 'Appointments', 'action' => 'add'], ['class' => 'btn btn-success']) ?>
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="card-body table-responsive p-0">-->
<!--                                        <table class="table table-striped table-bordered align-middle mb-0">-->
<!--                                            <thead class="table-dark">-->
<!--                                            <tr>-->
<!--                                                <th>--><?php //= __('ID') ?><!--</th>-->
<!--                                                <th>--><?php //= __('Name') ?><!--</th>-->
<!--                                                <th>--><?php //= __('Email') ?><!--</th>-->
<!--                                                <th>--><?php //= __('Phone') ?><!--</th>-->
<!--                                                <th>--><?php //= __('Address') ?><!--</th>-->
<!--                                                <th>--><?php //= __('Scheduled Date') ?><!--</th>-->
<!--                                                <th>--><?php //= __('Status') ?><!--</th>-->
<!--                                                <th>--><?php //= __('Actions') ?><!--</th>-->
<!--                                            </tr>-->
<!--                                            </thead>-->
<!--                                            <tbody>-->
<!--                                            --><?php //foreach ($appointments as $appointment): ?>
<!--                                                <tr>-->
<!--                                                    <td>--><?php //= $this->Number->format($appointment->id) ?><!--</td>-->
<!--                                                    <td>--><?php //= h($appointment->name) ?><!--</td>-->
<!--                                                    <td>--><?php //= h($appointment->email) ?><!--</td>-->
<!--                                                    <td>--><?php //= h($appointment->phone) ?><!--</td>-->
<!--                                                    <td>--><?php //= h($appointment->address) ?><!--</td>-->
<!--                                                    <td>--><?php //= $this->Time->format($appointment->scheduled_date, 'dd MMM yyyy hh:mm a') ?><!--</td>-->
<!--                                                    <td>--><?php //= h($appointment->status) ?><!--</td>-->
<!--                                                    <td>-->
<!--                                                        <div class="btn-group btn-group-sm" role="group">-->
<!--                                                            --><?php //= $this->Html->link(__('View'), ['action' => 'view', $appointment->id], ['class' => 'btn btn-outline-primary']) ?>
<!--                                                            --><?php //= $this->Form->postLink(__('Delete'), ['action' => 'delete', $appointment->id], [
//                                                                'confirm' => __('Are you sure you want to delete Appointment #{0}?', $appointment->id),
//                                                                'class' => 'btn btn-outline-danger'
//                                                            ]) ?>
<!--                                                        </div>-->
<!--                                                    </td>-->
<!--                                                </tr>-->
<!--                                            --><?php //endforeach; ?>
<!--                                            </tbody>-->
<!--                                        </table>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->


            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar me-2"></i>
                        <h4 class="mb-0">Appointment Calendar</h4>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <?= $this->Html->link(__('View All Appointments'), ['controller' => 'Appointments', 'action' => 'index'], ['class' => 'btn btn-warning']) ?>
                        <?= $this->Html->link(__('Create an Appointment'), ['controller' => 'Appointments', 'action' => 'add'], ['class' => 'btn btn-warning']) ?>
                    </div>
                </div>
                <div class="card-body">
                    <div id="event-popup" class="event-popup hidden">
                        <div class="popup-content">
                            <span id="popup-close">&times;</span>
                            <h4 id="popup-title"></h4>
                            <p id="popup-details"></p>
                        </div>
                    </div>
                    <div id="calendar" class="mb-5"></div>
                </div>
            </div>
</div>
</body>
</html>


<style>
    .event-popup {
        position: absolute;
        background: white;
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 15px;
        display: none;
        z-index: 1000;
    }
    .popup-content {
        position: relative;
    }
    .hidden {
        display: none;
    }
    .fc-event {
        pointer-events: all !important;
        z-index: 9999 !important;
    }
    pointer-events: auto;
</style>

