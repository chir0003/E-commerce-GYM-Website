<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;
use App\Model\Entity\Appointment;

class BookingMailer extends Mailer
{
    public function sendConfirmation(string $recipientEmail, Appointment $appointment): void
    {
        $this
            ->setTo($recipientEmail)
            ->setSubject('PowerProShop Booking Confirmation #' . $appointment->id)
            ->setEmailFormat('html')
            ->setViewVars(compact('appointment'))
            ->viewBuilder()
            ->setTemplate('booking_confirmed')
            ->setLayout('default');
    }

    public function sendReschedule(string $recipientEmail, Appointment $appointment): void
    {
        $this
            ->setTo($recipientEmail)
            ->setSubject('Your Booking Has Been Rescheduled')
            ->setEmailFormat('html')
            ->setViewVars(compact('appointment'))
            ->viewBuilder()
            ->setTemplate('booking_rescheduled')
            ->setLayout('default');
    }

    public function sendCancellation(string $recipientEmail, Appointment $appointment): void
    {
        $this
            ->setTo($recipientEmail)
            ->setSubject('Your Booking Has Been Cancelled')
            ->setEmailFormat('html')
            ->setViewVars(compact('appointment'))
            ->viewBuilder()
            ->setTemplate('booking_cancelled')
            ->setLayout('default');
    }
}
