<?php
namespace index\model;
use framework\Model;
use index\model\Fablog;

class Loveuser extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->blog = new Fablog();
	}
	//点赞
	public function loveUser() {
		$zid = $_GET['zid'];
		if (!empty($_POST['love'])) {
			if (!empty($_SESSION)) {
				$user = $this->where("zid = $zid")->select();
				if (empty($user)) {
					$uid = $_SESSION['uid'];
					$this->blog->where("zid = $zid")->update(['love' => 1]);
					$this->insert(['zid'=>$zid, 'uid'=> $uid]);
					//$this->notice('点赞成功啦' , 'index.php?m=index&c=blog&a=blog&zid=$zid');
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
						$this->insert(['zid' => $zid, 'uid' => $uid]);
						$count = $this->where("zid = $zid")->count();
						$this->blog->where("zid = $zid")->update(['love' => $count]);
						////$this->notice('点赞成功啦' , 'index.php?m=index&c=blog&a=blog&zid=$zid');
					}
					//$this->notice('你已点过赞喽' , 'index.php?m=index&c=blog&a=blog&zid=$zid');
				}
			} else {
				var_dump(1);
				// $this->notice('只有登录才能点赞呦' , 'index.php?m=index&c=blog&a=blog&zid=$zid');
			}
		} 
		 $this->display();
	}
}