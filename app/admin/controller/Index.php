<?php
namespace admin\controller;
class Index extends Controller
{
	public function index()
	{
		if (empty($_GET['tui'])) {
			$this->display();
		} else {
			$this->notice('已成功退出后台', 'index.php');
		}
	}
}