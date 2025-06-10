<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ContactForms Controller
 *
 * @property \App\Model\Table\ContactFormsTable $ContactForms
 */
class ContactFormsController extends AppController
{

       /**
     * Controller initialize override
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        // By default, CakePHP will (sensibly) default to preventing users from accessing any actions on a controller.
        // These actions, however, are typically required for users who have not yet logged in.
        $this->Authentication->allowUnauthenticated(['add']);
    }

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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ContactForms->find();

        $this->paginate = [
            'limit' => 8,
            'order' => ['ContactForms.created' => 'desc']
        ];

        $contactForms = $this->paginate($query);

        $this->set(compact('contactForms'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact Form id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactForm = $this->ContactForms->get($id, contain: []);
        $this->set(compact('contactForm'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['get', 'post']);

        $privatekey = "0x4AAAAAAA_U6TV78xX1OV8vamah3-6ZGNE"; // Use your Cloudflare Turnstile secret key

        $contactForm = $this->ContactForms->newEmptyEntity();

        if ($this->request->is('post')) {
            $captchaResponse = $this->request->getData('cf-turnstile-response');

            if ($captchaResponse) {
                $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
                $data = [
                    'secret' => $privatekey,
                    'response' => $captchaResponse
                ];

                $options = [
                    'http' => [
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data),
                    ],
                ];

                $context = stream_context_create($options);
                $verifyResult = file_get_contents($url, false, $context);
                $verifyData = json_decode($verifyResult);

                if (!empty($verifyData->success) && $verifyData->success === true) {
                    // Turnstile passed – process form
                    $contactForm = $this->ContactForms->patchEntity($contactForm, $this->request->getData());

                    if ($this->ContactForms->save($contactForm)) {
                        $this->Flash->success(__('We have received your contact form and will be in touch shortly!'));
                        return $this->redirect(['action' => 'add']);
                    } else {
                        $this->Flash->error(__('The contact form could not be saved. Please, try again.'));
                    }
                } else {
                    $this->Flash->error(__('Please complete the TurnStile verification.'));
                }
            } else {
                $this->Flash->error(__('TurnStile Challenge not completed.'));
            }
        }

        $this->set(compact('contactForm'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Form id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactForm = $this->ContactForms->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactForm = $this->ContactForms->patchEntity($contactForm, $this->request->getData());
            if ($this->ContactForms->save($contactForm)) {
                $this->Flash->success(__('The contact form has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact form could not be saved. Please, try again.'));
        }
        $this->set(compact('contactForm'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Form id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactForm = $this->ContactForms->get($id);
        if ($this->ContactForms->delete($contactForm)) {
            $this->Flash->success(__('The contact form has been deleted.'));
        } else {
            $this->Flash->error(__('The contact form could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
