<?php
namespace index\controller;
use \index\model\Index as Indexer;
use index\model\Fablog ;
	
class About extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->indexer = new Indexer();
		$this->blog = new Fablog();	
	}
	//关于
	public function about()
	{
		$this->selectUser();
		$this->selectsaidBlog();
		$this->tuiChul();
	}
	//是否登录
	protected function selectUser()
	{
		if ($this->indexer->selectUser()) {
			$name = $this->indexer->selectUser();
			$this->assign('name', $name);
			
		}
		
	}
	//遍历按评论最多排序的博文
	public function selectsaidBlog()
	{
		$blog = $this->blog->tselectBlog('', 'said desc', '0, 6');
		$this->assign('sblog',$blog);
	}
	//退出
	public function tuiChul()
	{
		if (empty($_POST['tuichu'])) {
			$this->display();
		}else{
			if ($this->tuiChu() == 1) {
				$this->notice('退出成功', 'index.php');
			}else{
				$this->display();
			}
		}
	}	
	public function tuiChu()
	{
		if (!empty($_POST['tuichu']) && !empty($_SESSION)) {
			session_destroy();
			return 1;
		}
		return 2;	
	}

}