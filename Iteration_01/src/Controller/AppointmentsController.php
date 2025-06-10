<?php
declare(strict_types=1);
namespace App\Controller;
use Cake\Mailer\MailerAwareTrait;


/**
 * Appointments Controller
 *
 * @property \App\Model\Table\AppointmentsTable $Appointments
 */
class AppointmentsController extends AppController
{
    use MailerAwareTrait;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Allow shop page to be accessed without admin login
        $this->Authentication->addUnauthenticatedActions(['add']);
        // Only restrict admin actions, not the shop
        $publicActions = ['add']; // add more if needed
        if (!in_array($this->request->getParam('action'), $publicActions)) {
            $this->requireAdmin();
        }// This will restrict access to admin users only
    }
    public function index()
    {
        $query = $this->Appointments->find()->contain(['Services']);

        $this->paginate = [
            'limit' => 8,
            'order' => ['Appointments.created' => 'desc']
        ];

        $appointments = $this->paginate($query);

        $this->set(compact('appointments'));
    }

    /**
     * View method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // Ensure ID is valid before proceeding
        if (!$id) {
            $this->Flash->error(__('Invalid appointment ID.'));
            return $this->redirect(['action' => 'index']);
        }

        // Fetch the appointment with the related service
        $appointment = $this->Appointments->get($id, contain: ['Services']);

        // Handle update requests
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());

            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('Service updated successfully.'));
                return $this->redirect(['action' => 'view', $id]);
            }

            $this->Flash->error(__('Unable to update appointment.'));
        }

        // Get services for dropdown with ID and name
        $services = $this->Appointments->Services->find(
            type: 'list',
            keyField: 'id',
            valueField: function ($service) {
                return $service->id . ' - ' . $service->name;
            }
        )->toArray();

        $this->set(compact('appointment', 'services'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
//    public function add()
//    {
//        $appointment = $this->Appointments->newEmptyEntity();
//        if ($this->request->is('post')) {
////            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
//            $data = $this->request->getData();
//            $data['status'] = 'processing';
//
//
//            if ($this->Appointments->save($appointment)) {
//                $this->Flash->success(__('The appointment has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
//        }
//        $services = $this->Appointments->Services->find('list', limit: 200)->all();
//        $this->set(compact('appointment', 'services'));
//    }


    public function add()
    {
        $appointment = $this->Appointments->newEmptyEntity();

        if ($this->request->is('post')) {
            // Cloudflare Turnstile verification
            $cfToken = $this->request->getData('cf-turnstile-response');
            $cfSecretKey = '0x4AAAAAAA_U6TV78xX1OV8vamah3-6ZGNE';

            $verifyUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
            $data = http_build_query([
                'secret' => $cfSecretKey,
                'response' => $cfToken,
                'remoteip' => $this->request->clientIp()
            ]);

            $options = ['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $data
            ]];

            $context  = stream_context_create($options);
            $result = file_get_contents($verifyUrl, false, $context);
            $resultData = json_decode($result);

            if ($resultData && $resultData->success) {
                // CAPTCHA passed
                $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
                $appointment->status = 'processing';

                if ($this->Appointments->save($appointment)) {
                    $this->_sendBookingConfirmationEmail($appointment);
                    $this->Flash->success(__('The appointment has been booked.'));
                    return $this->redirect(['action' => 'add']);
                } else {
                    $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
                }
            } else {
                // CAPTCHA failed
                $this->Flash->error(__('Please complete the CAPTCHA to submit your appointment.'));
            }
        }

        $services = $this->Appointments->Services->find('list', limit: 200)->all();
        $this->set(compact('appointment', 'services'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appointment = $this->Appointments->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());

            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved.'));

                $this->_sendBookingStatusEmail($appointment);

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
        }

        $services = $this->Appointments->Services->find('list', limit: 200)->all();
        $this->set(compact('appointment', 'services'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appointment = $this->Appointments->get($id);
        if ($this->Appointments->delete($appointment)) {
            $this->Flash->success(__('The appointment has been deleted.'));
        } else {
            $this->Flash->error(__('The appointment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function calendar()
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');

        $appointments = $this->Appointments->find()
//            ->select(['id', 'name', 'scheduled_date', 'service_id'])
            ->contain(['Services'])
            ->all();

        $events = [];
        foreach ($appointments as $appointment) {
            $serviceName = $appointment->service->name ?? '(No service)';

            $events[] = [
                'id'    => $appointment->id,
                'title' => $appointment->name,
                'service' => ($serviceName ? : ''),
                'address' => $appointment->address,
                'start' => $appointment->scheduled_date->format('Y-m-d\TH:i:s'),
                'color' => '#28a745',
            ];
        }

        // Clear any output buffer before sending JSON
        while (ob_get_level()) {
            ob_end_clean();
        }

        error_log('Calendar events: ' . json_encode($events));

        // Output JSON
        header('Content-Type: application/json');
        echo json_encode($events);
        exit;
    }
    /**
     * Private method to send booking confirmation email
     */
    protected function _sendBookingConfirmationEmail($appointment): void
    {
        $appointment = $this->Appointments->get($appointment->id, [
            'contain' => ['Services']
        ]);
        try {
            $this->getMailer('Booking')->send('sendConfirmation', [
                $appointment->email,
                $appointment
            ]);
        } catch (\Exception $e) {
            \Cake\Log\Log::error('Appointment email failed: ' . $e->getMessage());
        }
    }

    protected function _sendBookingStatusEmail(\App\Model\Entity\Appointment $appointment): void
    {
        $appointment = $this->Appointments->get($appointment->id, [
            'contain' => ['Services']
        ]);

        $recipientEmail = $appointment->email;
        $status = $appointment->status;

        try {
            if ($status === 'confirmed') {
                $this->getMailer('Booking')->send('sendConfirmation', [$recipientEmail, $appointment]);
            } elseif ($status === 'rescheduled') {
                $this->getMailer('Booking')->send('sendReschedule', [$recipientEmail, $appointment]);
            } elseif ($status === 'cancelled') {
                $this->getMailer('Booking')->send('sendCancellation', [$recipientEmail, $appointment]);
            }
        } catch (\Exception $e) {
            \Cake\Log\Log::error("Appointment #{$appointment->id} email failed: " . $e->getMessage());
        }
    }


}
