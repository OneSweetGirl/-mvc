<?php
namespace admin\controller;
use admin\model\User;
class Column extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->user = new User();
	}
	//用户管理
	public function column()
	{
		$user = $this->user->pageUser();
		$this->assign('user', $user['user']);
		$this->assign('page', $user['page']);
		$this->display();
	}

}