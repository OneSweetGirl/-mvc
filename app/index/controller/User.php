<?php
namespace index\controller;
use \index\model\User as UserModel;
class User extends Controller
{
	protected $user;
	public function __construct()
	{
		parent::__construct();
		$this->user = new UserModel();
	}
	public function login()
	{
		$this->display();
	}
	//登录&注册
	public function regist()
	{
		if (empty($_POST)) {
			$this->display();
		} else {
			if (isset($_POST['check'])) {
				$this->check();
			} else {
				$this->register();
			} 	
		}	
	}
	//校验登录
	public function check()
	{
		if (empty($_POST)) {
			$this->display();
		} else { 
			if (is_int($this->user->check($_POST))) {
				$this->notice('登录成功', 'index.php');
			} else {
				$notice = $this->user->tishi[0];
				$this->notice($notice, 'index.php?m=index&c=user&a=regist');
			}
		}	
		
	}
	
	
	//注册
	public function register()
	{
		if (!empty($_POST['reset'])) {
			//提交了注册信息
			$this->display();
			
		} else if (!empty($_POST['regist'])) { 
			
			//验证提交注册信息
			if (is_int($this->user->regist($_POST))) {
				$this->notice('注册成功', 'index.php?m=index&c=user&a=regist');
			}else{
				$notice = $this->user->tishi[0];
				$this->notice($notice, 'index.php?m=index&c=user&a=regist');
			}
			
		}else{
			$this->display();
		}
	}
	

}