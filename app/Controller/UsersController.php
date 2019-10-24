<?php

class UsersController extends AppController
{
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'login'); // Permitindo que os usuários se registrem
	}

	public function add() {
		if ($this->request->is('Post')) {
			$this->User->create();

			if ($this->User->save($this->request->data)) {
				$this->Flash->success("Succefull account created");
			} else {
				$this->Flash->error("Can't create the account");
			}
		}
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}


}