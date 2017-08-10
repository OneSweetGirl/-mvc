<?php
namespace index\controller;

use index\model\Fablog as BlogModel;
use \index\model\Index as Indexer;
use index\model\User;
use index\model\Loveuser;
use index\model\Hblog;
use framework\Page;
use framework\Verify;
class Blog extends controller
{
	public function __construct()
	{
		parent::__construct();
		$this->blog     = new BlogModel();
		$this->hblog    = new Hblog();
		$this->user     = new User();
		$this->indexer  = new Indexer();
		$this->loveuser = new Loveuser();
	}
	//博客页
	public function blog()
	{
		$this->updateLook();
		$this->selectBlog();
		$this->selectallBlog();
		$this->selectsaidBlog();
		$hblog = $this->selecthBlog();
		$this->assign('hblog',$hblog['hblog']);
		$this->assign('page', $hblog['page']);
		$this->assign('zid', $_GET['zid']);
		if (!empty($_SESSION)) {
			$this->assign('name',$_SESSION['name']);
		}	
		$this->hBlog();
	}
	//是否登录
	protected function selectUser()
	{
		if ($this->indexer->selectUser()) {
			$name = $this->indexer->selectUser();
			$this->assign('name', $name);
		}
		
	}
	//退出
	public function tuiChul($zid)
	{
		if (empty($_POST['tuichu'])) {
			$this->display();
		}else{
			if ($this->tuiChu() == 1) {
				$this->notice('退出成功', "index.php?m=index&c=blog&a=blog&zid=$zid");
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
		
	//遍历博文
	public function selectBlog()
	{
		$zid = $_GET['zid'];
		$blog = $this->blog->tselectBlog("zid = $zid");
		return $this->assign('blog',$blog[0]);
	}
	//遍历全部博文
	public function selectallBlog()
	{
		$allblog = $this->blog->selectBlog(4,'time desc');
		$this->assign('allblog',$allblog['blog']);
	}
	//评论博文
	public function hBlog()
	{
		$zid = $_GET['zid'];
		if (empty($_POST['submit'])) {
			if (empty ($_POST['love'])) {
				$this->tuiChul($zid);
			}
			$this->loveUser();
			
		} else if ($this->hblog->hBlog($_POST) != 1) {
			$notice = $this->hblog->notice[0];
			$this->notice($notice, "index.php?m=index&c=blog&a=blog&zid=$zid");
		} else {
			$this->updateSaid();
			$this->notice('评论成功', "index.php?m=index&c=blog&a=blog&zid=$zid");
		}
		
	}
	//修改博文评论量
	public function updateSaid()
	{
		$zid = $_GET['zid'];
		$count = $this->hblog->where("zid = $zid")->count();
		$count = $count['hid']; 
		$this->blog->updateblog(['said' => $count]);
	}
	//修改博文浏览量
	public function updateLook()
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		if (!strcmp($ip,'::1') ){
			$ip = '127.0.0.1';
		}else{
			$ip = ip2long($ip);	
		}
		$zid = $_GET['zid'];
		$count = $this->blog->where("zid = $zid")->select();
		if ($ip != $count[0]['lastip'] || time() > $count[0]['lasttime']+3600) {
			$count = $count[0]['look']+1; 
			$this->blog->updateblog(['look' => $count,'lastip' => $ip, 'lasttime' => time()]);
		}
		
	}
	//修改博文点赞
	public function loveUser() {
		$zid = $_GET['zid'];
		if (!empty($_POST['love'])) {
			if (!empty($_SESSION)) {
				$user = $this->loveuser->where("zid = $zid")->select();
				if (empty($user)) {
					$uid = $_SESSION['uid'];
					$this->blog->where("zid = $zid")->update(['love' => 1]);
					$this->loveuser->insert(['zid'=>$zid, 'uid'=> $uid]);
					$this->notice('点赞成功啦' , "index.php?m=index&c=blog&a=blog&zid=$zid");
				} else {
					foreach ($user as $key => $value) {
						if ($value['uid'] == $_SESSION['uid']) {
							$a = 1;
						} else {
							$a = 2;
						}
					}
					if ($a == 2) {
						$uid = $_SESSION['uid'];
						$this->loveuser->insert(['zid' => $zid, 'uid' => $uid]);
						$count = $this->loveuser->where("zid = $zid")->count();
						$count = $count['loid'];
						$this->blog->where("zid = $zid")->update(['love' => $count]);
						$this->notice('点赞成功啦' , "index.php?m=index&c=blog&a=blog&zid=$zid");
					}else{
					$this->notice('你已点过赞喽' , "index.php?m=index&c=blog&a=blog&zid=$zid");
					}
				}
			} else {
				 $this->notice('只有登录才能点赞呦' , "index.php?m=index&c=blog&a=blog&zid=$zid");
			}
		} 
		 
	}
	//遍历博文评论
	public function selecthBlog()
	{
		$zid = $_GET['zid'];
		$hblog = $this->hblog->selecthBlog("zid = $zid");
		if ($hblog['hblog'][0]['uid']==null) {
			$hblog['hblog'][0]['name'] = '';
		} else {
			foreach ($hblog['hblog'] as $key => $value) {
				$uid = $value['uid'];
				$huser = $this->user->selectUser("uid = $uid");
				$value['name'] = $huser[0]['name'];
				$blog[$key] = $value;
			}
			$hblog['hblog'] = $blog;
		}
		return $hblog;
	}
	//遍历按评论最多排序的博文
	public function selectsaidBlog()
	{
		$blog = $this->blog->tselectBlog('', 'said desc', '0, 6');
		$this->assign('sblog',$blog);
	}
	
}