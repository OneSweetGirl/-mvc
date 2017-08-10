<?php
namespace admin\model;
use framework\Model;
use framework\Page;
use admin\model\Hblog;
class User extends Model
{
	public $notice = [];
	public function __construct()
	{
		parent::__construct();
		$this->hblog = new Hblog();
		
	}
	//分页遍历用户评论
	public function pagesUser()
	{
		$count = $this->hblog->count();
		$this->page = new Page($count[0]);
		$limit = $this->page->limit();
		$blog = $this->hblog->limit($limit)->select();
		foreach ($blog as $key => $value) {
			$uid = $value['uid'];
			$user = $this->where("uid = $uid")->select();
			$value['name']      = $user[0]['name'];
			$value['email']     = $user[0]['email'];
			$value['time']      = date("Y-m-d", $value['time']);
			$value['zhucetime'] = date("Y-m-d", $user[0]['zhucetime']);
			$value['ip']        = $user[0]['ip'];
			$hbk[$key] = $value;
		}
		$blog = $hbk;
		$page = $this->page->listed();
		return ['blog'=>$blog, 'page'=>$page];
	}
	//分页遍历用户信息
	public function pageUser()
	{
		$count = $this->count();
		$this->page = new Page($count[0]);
		$limit = $this->page->limit();
		$user = $this->limit($limit)->select();
		foreach ($user as $key => $value) {
			$value['zhucetime'] = date("Y-m-d", $user[0]['zhucetime']);
			$use[$key] = $value;
		}
		$user = $use;
		$page = $this->page->listed();
		return ['user'=>$user, 'page'=>$page];
	}
	//登录
	public function check($data)
	{
		if ($this->empty($data) == 1) {
			$name = $this->getByName($data['name']);
			if (empty($name)) {
				return $this->notice[] = '该用户不存在';
			}
			if ($name[0]['pwd'] != md5($data['pwd'])) {
				return $this->notice[] = '用户名密码不匹配';
			}
			if ($_SESSION['code'] != $data['code']) {
				return $this->notice[] = '验证码不正确';
			}
			if ($name[0]['level'] != 1) {
				return $this->botice[] = '只有管理员才能登录';
			}
			return 1;
		}
		return $this->notice;
	}
	
	//接收值是否为空
	public function empty($data)
	{
		foreach ($data as $key => $value) {
			if (empty($value)) {
				return $this->notice[] = '不能为空';
			}
		}
		return 1;
	}
	//查询用户
	public function selectUser($where=null)
	{
		return $this->where($where)->select();
	}
	//修改
	public function update($data)
	{
		if ($this->empty($data) == 1 && $this->panDuan($data) == 1) {
			$newpwd = md5($data['newpwd']);
			$this->where('uid = 1')->update(['pwd' => $newpwd]);
			return 1;
		}
		return $this->notice;
	}
	//判断修改密码
	public function panDuan($data)
	{
		$user = $this->where("uid = 1")->select();
		 if ($user[0]['pwd'] != md5($data['pwd'])) {
		 	return $this->notice[] = '密码不正确';
		 }
		 if ($data['newpwd'] < 6) {
		 	return $this->notice[] = '密码不能小于6位';
		 }
		 if ($data['newpwd'] != $data['renewpwd']) {
		 	return $this->notice[] = '两次密码不一致';
		 }	
		return 1; 
	}
}
