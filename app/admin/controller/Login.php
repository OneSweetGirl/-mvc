<?php
namespace admin\controller;
use admin\model\User;
class Login extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->user = new User();
	}
	public function login()
	{
		if (empty($_POST)) {
			$this->display();
		}else {
			$notice = $this->user->check($_POST);
			if ($notice == 1) {
				$this->notice('欢迎管理员', 'index.php?m=admin&c=index&a=index');
			} else {
			$notice = $notice[0];
			$this->notice($notice, 'index.php?m=admin&c=login&a=login');
			}
		}
	}
	
}