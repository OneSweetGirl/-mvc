<?php
namespace admin\controller;
use admin\model\User;
use admin\model\Hblog;
class Book extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->user = new User();
		$this->hblog = new Hblog();
	}
	//评论管理
	public function book()
	{
		$hblog = $this->user->pagesUser();
		$blog = $hblog['blog'];
		$this->assign('hblog', $blog);
		$this->assign('page', $hblog['page']);
		if (!empty($_POST['allx'])) {
			$this->allDelete();
		}
		if (!empty($_POST['piliang'])) {
			$this->pldelete();
		}		
			$this->display();		
	}
	//全删
	public function allDelete()
	{
		if (!empty($_POST['allx'])) {
			$hblog = $this->user->pagesuser();
			foreach ($hblog['blog'] as $key => $value) {
				$hid = $value['hid'];
				$this->hblog->where("hid=$hid")->delete();
			}
			$this->notice('删除成功', 'index.php?m=admin&c=book&a=book');
		} 		
	}
	//批量删除
	public function pldelete()
	{
		if (!empty($_POST['piliang'])) {
			if (empty($_POST['hid'])) {
				$this->notice( '未选中，删除失败','index.php?m=admin&c=book&a=book');
			} else {
				$hid = join(',', $_POST['hid']);
				$this->hblog->where("hid in ($hid)")->delete();
				$this->notice('删除成功', 'index.php?m=admin&c=book&a=book');
			}
			
		}	
	}
}