<?php
/**
 * @var \App\Model\Entity\Appointment $appointment
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
<div style="text-align:center; margin-bottom:20px;">
    <img src="https://your-domain.com/img/logo.png" alt="PowerProShop" style="max-width:150px;">
</div>

<h2>Thank you for your booking!</h2>
<p>Here are your booking details:</p>

<table>
    <tr><th>Booking Reference</th><td><?= h($appointment->id) ?></td></tr>
    <tr><th>Service Type</th><td><?= h($appointment->service_type) ?></td></tr>
    <tr><th>Date & Time</th><td><?= h($appointment->scheduled_date->format('Y-m-d H:i')) ?></td></tr>
    <tr><th>Full Name</th><td><?= h($appointment->customer_name) ?></td></tr>
    <tr><th>Email</th><td><?= h($appointment->email) ?></td></tr>
    <tr><th>Phone</th><td><?= h($appointment->phone) ?></td></tr>
    <tr><th>Service Address</th><td><?= h($appointment->address) ?></td></tr>
    <tr><th>Notes</th><td><?= h($appointment->notes ?? 'N/A') ?></td></tr>
</table>

<p>If you have any questions, feel free to contact us at <a href="mailto:support@powerproshop.com">support@powerproshop.com</a>.</p>

<p>Best regards,<br>
    The PowerProShop Team</p>
</body>
</html>
