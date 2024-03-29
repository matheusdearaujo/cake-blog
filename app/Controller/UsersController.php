<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public $helpers = ['Html','Form'];
    public $name = 'Users';

	public function register()
	{
		$this->layout = 'auth';
    }

    public function validation()
	{
        $this->layout = 'ajax';
		$this->autoRender = false;
		
        $response['error'] = true;
		$response['msg'] = "Não foi possível fazer o registro. Dados inválidos ou usuário já existe.";

        if ($this->request->is('post')) {
            $this->request->data['User']['username'] = str_replace(' ', '', $this->request->data['User']['username']);

            $this->User->create();

            if ($this->User->save($this->request->data)) {
                $response['error'] = false;
                $response['msg'] = "Registrado!";
            }
        }

		$this->response->body(json_encode($response));
    }

	public function login()
	{
		$this->layout = 'auth';
	}

    public function authentication()
	{
        $this->layout = 'ajax';
		$this->autoRender = false;
		
        $response['error'] = true;
		$response['msg'] = "Não foi possível fazer o login. Dados incorretos ou usuário inválido.";

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $response['error'] = false;
				$response['msg'] = "Logado!";
            }
        }

		$this->response->body(json_encode($response));
	}

	public function logout()
	{
		$this->redirect($this->Auth->logout());
	}

    public function profile($username = null)
    {
        $this->loadModel('Post');
		$this->layout = 'default';

		$dados = $this->User->findByUsername($username);

        if (empty($dados)) {
            throw new NotFoundException(__('Usuário Inválido'));
        }

        $postAuthor = $this->Post->find('all', [
            'conditions' => ['Post.user_id' => $dados['User']['id']],
            'order' => ['Post.id' => 'DESC']
        ]);

        $this->set(compact('dados', 'postAuthor'));
    }

	public function schedule()
    {
		$this->layout = 'default';

        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

	public function edit($id = null)
	{
        $this->User->id = $id;
        $this->loadModel('Group');

        $groups = $this->Group->find('list');

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuário Inválido'));
        }

		if ($this->request->is('get')) {
			$this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
		}

        $this->set(compact('groups'));
    }

	public function update($id = null)
	{
		$this->layout = "ajax";
		$this->autoRender = false;

		$response['error'] = true;
		$response['msg'] = "Não foi possível atualizar o usuário.";

		if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['username'] = str_replace(' ', '', $this->request->data['User']['username']);
            
            if ($this->User->save($this->request->data)) {
				$response['error'] = false;
				$response['msg'] = "Usuário atualizado!";
                
                //if ($this->Auth->User('id') == $id) {
                //    $this->Session->write('Auth.User.username', $this->request->data['User']['username']);
                //}
			}
        }

		$this->response->body(json_encode($response));
	}

	public function delete($id = null)
	{
		$this->layout = "ajax";
		$this->autoRender = false;

        $this->User->id = $id;

		$response['error'] = true;
		$response['msg'] = "Não foi possível excluir o registro.";

        if (!$this->User->exists()) {
            $response['error'] = true;
			$response['msg'] = "Usuário inválido";
        }

        if ($this->User->delete()) {
            $response['error'] = false;
			$response['msg'] = "Usuário excluído com sucesso!";
        }

		$this->response->body(json_encode($response));
    }

	public function changePhoto()
    {
		$id = $this->request->data['user_id'];

		if (!empty($_FILES)) {
            $parts = pathinfo($_FILES['file']['name']);
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = 'img/upload/avatar/';
            $newFileName = $id . '.' . strtolower($parts['extension']);
            $targetFile = $targetPath . $newFileName;
            $error = 0;

            if (move_uploaded_file($tempFile, $targetFile)) {
                $data['User']['id'] = $id;
                $data['User']['photo'] = strtolower($newFileName);
                $data['User']['modified'] = date('d/m/Y H:i:s');
                $this->User->id = $id;

                $this->User->save($data, false);
                $this->Session->write('Auth.User.photo', $data['User']['photo']);

                $error = 0;
            } else {
                $error = 1;
            }

            echo json_encode(compact('error'));
            exit;
        }
    }
}
