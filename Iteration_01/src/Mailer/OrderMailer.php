<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;

class OrderMailer extends Mailer
{
    /**
     * @param string $recipientEmail
     * @param \App\Model\Entity\Order $order
     * @param array $items
     * @param string $method
     */
    public function sendConfirmation(string $recipientEmail, $order, array $items, string $method): void
    {
        $this
            ->setTo($recipientEmail)
            ->setSubject('Your PowerProShop Order #' . $order->id . ' Confirmation')
            ->setEmailFormat('html')
            ->setViewVars(compact('order', 'items', 'method'));
        $this->viewBuilder()
            ->setTemplate('order_confirm')
            ->setLayout('default');
    }
}
