<?php

namespace Controllers;

use Models\User;

Class UserController extends BaseController
{
    public function __construct() {
		//var_dump($_REQUEST);
        switch($_REQUEST['method']) {
			case 'index' :
				$this->index();
				break;
			case 'edit' :
				$this->edit();
				break;
			case 'update' :
				$this->update();
				break;
			case 'delete' :
				$this->delete();
				break;
			case 'create' :
				$this->create();
				break;
            case 'store' :
                $this->store();
                break;
			case 'default' :
				return 'No action';
				break;
		}
    }

	public function index()
	{
		$users = User::all();
		require_once ROOT . '/views/user/index.php';
	}

	public function edit()
	{
		$id = $_REQUEST['id'];
		$user = User::findById($id);
		var_dump($user);
		require_once ROOT . '/views/user/edit.php';
	}

	public function create()
	{
		require_once ROOT . '/views/user/create.php';
	}

	public function delete() 
	{
		$id = $_REQUEST['id'];
		$user = User::findById($id);
		//$user = User::deleteById($id);
		var_dump($user);
		require_once ROOT . '/views/user/delete.php';
	} 

	public function update()
	{
		$userData = [
			'name' => $_REQUEST['name'],
			'age' => $_REQUEST['age'],
			'occupation' => $_REQUEST['occupation'],
		];

		User::updateById($_REQUEST['id'], $userData);

		header('location: index.php?method=index');
	}

    public function store()
    {
        $userData = [
            'name' => $_REQUEST['name'],
            'age' => $_REQUEST['age'],
            'occupation' => $_REQUEST['occupation'],
        ];

        User::create($userData);

        header('location: index.php?method=index');
    }

}

$userControllerObj = new UserController();