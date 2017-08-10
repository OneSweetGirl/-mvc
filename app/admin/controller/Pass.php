<?php
namespace admin\controller;
use admin\model\User;
class Pass extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->user = new User();
	}
	//改密码
	public function pass()
	{
		$this->selectUser();
		if (empty($_POST['submit'])) {
			$this->display();
		} else {
			if ($this->user->update($_POST)==1) {
				$this->notice('更改成功', 'index.php?m=admin&c=pass&a=pass');
			} else {
				$notice = $this->user->update($_POST);
				$this->notice($notice[0], 'index.php?m=admin&c=pass&a=pass');
			}
		}			
	}
	//查名字
	public function selectUser()
	{
		$where = " level = 1";
		$user = $this->user->selectUser($where);
		$this->assign('name', $user[0]['name']);
	}

}