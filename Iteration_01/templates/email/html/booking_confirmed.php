<?php /** @var \App\Model\Entity\Appointment $appointment */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Confirmed</title>
</head>
<body>
<h2>Your Appointment is Confirmed</h2>
<p>Hi <?= h($appointment->name) ?>,</p>
<p>Your booking with PowerProShop has been confirmed. Here are the details:</p>

<ul>
    <li><strong>Date & Time:</strong> <?= h($appointment->scheduled_date->format('Y-m-d H:i')) ?></li>
    <li><strong>Service Address:</strong> <?= h($appointment->address) ?></li>
    <li><strong>Service:</strong> <?= h($appointment->service_id) ?></li>
</ul>

<p>If you have questions, contact us at <a href="mailto:support@powerproshop.com">support@powerproshop.com</a>.</p>
</body>
</html>
