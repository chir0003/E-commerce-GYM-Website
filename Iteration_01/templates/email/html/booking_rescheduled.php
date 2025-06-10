<?php /** @var \App\Model\Entity\Appointment $appointment */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Rescheduled</title>
</head>
<body>
<h2>Your Appointment Has Been Rescheduled</h2>
<p>Hi <?= h($appointment->name) ?>,</p>
<p>Your booking has been rescheduled. Please see the updated details below:</p>

<ul>
    <li><strong>New Date & Time:</strong> <?= h($appointment->scheduled_date->format('Y-m-d H:i')) ?></li>
    <li><strong>Service Address:</strong> <?= h($appointment->address) ?></li>
    <li><strong>Service:</strong> <?= h($appointment->service_id) ?></li>
</ul>

<p>If this time doesn't work, contact us at <a href="mailto:support@powerproshop.com">support@powerproshop.com</a>.</p>
</body>
</html>
