<?php /** @var \App\Model\Entity\Appointment $appointment */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Cancelled</title>
</head>
<body>
<h2>Your Appointment Has Been Cancelled</h2>
<p>Hi <?= h($appointment->name) ?>,</p>
<p>We regret to inform you that your appointment has been cancelled.</p>

<ul>
    <li><strong>Originally Scheduled:</strong> <?= h($appointment->scheduled_date->format('Y-m-d H:i')) ?></li>
    <li><strong>Address:</strong> <?= h($appointment->address) ?></li>
</ul>

<p>If you need to rebook or have questions, please contact us at <a href="mailto:support@powerproshop.com">support@powerproshop.com</a>.</p>
</body>
</html>
