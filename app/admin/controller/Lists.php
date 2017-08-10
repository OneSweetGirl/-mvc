<?php
namespace admin\controller;
use admin\model\Fablog;
class Lists extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->fablog = new Fablog();
	}
	//博文管理
	public function lists()
	{
		$fablog = $this->fablog->pagesBlog();
		$this->assign('fablog', $fablog['blog']);
		$this->assign('page', $fablog['page']);
		if (!empty($_POST['allx']) || !empty($_POST['piliang'])) {
			$this->allDelete();
			$this->pldelete();
		} else {
			$this->display();
		}	
	}
	//全删
	public function allDelete()
	{
		if (!empty($_POST['allx'])) {
			$fablog = $this->fablog->pagesblog();
			foreach ($fablog['blog'] as $key => $value) {
				$zid = $value['zid'];
				$this->fablog->where("zid=$zid")->delete();
			}
			$this->notice('删除成功', 'index.php?m=admin&c=lists&a=lists');
		} 		
	}
	//批量删除
	public function pldelete()
	{
		if (!empty($_POST['piliang'])) {
			if (empty($_POST['zid'])) {
				$this->notice( '未选中，删除失败','index.php?m=admin&c=lists&a=lists');
			} else {
				$zid = join(',', $_POST['zid']);
				$this->fablog->where("zid in ($zid)")->delete();
				$this->notice('删除成功', 'index.php?m=admin&c=lists&a=lists');
			}
			
		}	
	}

}