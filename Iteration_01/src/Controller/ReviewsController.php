<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 */
class ReviewsController extends AppController
{

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
        $query = $this->Reviews->find()
            ->contain(['Users', 'Products'])
            ->order(['Reviews.created_date' => 'DESC']);

        $this->paginate = [
            'limit' => 8,
            'order' => ['Reviews.created_date' => 'desc']
        ];

        $reviews = $this->paginate($query);

        // Debug log
        foreach ($reviews as $review) {
            $this->log("Review ID: " . $review->id . " Status: " . $review->status, 'debug');
        }

        $this->set(compact('reviews'));
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Reviews->get($id, contain: ['Users', 'Products']);
        $this->set(compact('review'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
// src/Controller/ReviewsController.php

    public function add($productId = null)
    {
        $this->request->allowMethod(['post']);

        if (!$this->Authentication->getIdentity()) {
            $this->Flash->error('Please log in to submit a review.');
            return $this->redirect($this->referer());
        }

        $userId = $this->Authentication->getIdentity()->get('id');

        // Check if user already submitted a review
        $existingReview = $this->Reviews->find()
            ->where(['user_id' => $userId, 'product_id' => $productId])
            ->first();

        if ($existingReview) {
            $this->Flash->error('You have already submitted a review for this product.');
            return $this->redirect($this->referer());
        }

        $review = $this->Reviews->newEmptyEntity();
        $review = $this->Reviews->patchEntity($review, $this->request->getData());
        $review->user_id = $userId;
        $review->product_id = $productId;
        $review->status = 0; // Set initial status as pending

        if ($this->Reviews->save($review)) {
            $this->Flash->success('Your review has been submitted .');
        } else {
            $this->Flash->error('Unable to submit your review. Please try again.');
        }

        return $this->redirect($this->referer());
    }

    public function approve($id = null)
    {
        $this->request->allowMethod(['get', 'post']);

        $review = $this->Reviews->get($id);
        $review = $this->Reviews->patchEntity($review, ['status' => 1]);
        
        if ($this->Reviews->save($review)) {
            $this->Flash->success(__('The review has been approved.'));
        } else {
            $this->Flash->error(__('The review could not be approved. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
    

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
