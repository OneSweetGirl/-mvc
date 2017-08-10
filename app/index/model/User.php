<?php
namespace index\model;
use framework\Model;
class User extends Model
{
	public $tishi = [];
	//登录
	public function check($data)
	{
		if ($this->empty($data) == 1) {
			$name = $this->getByName($data['name']);
			if (empty($name)) {
				return $this->tishi[] = '该用户不存在，请注册';
			}
			if ($name['0']['pwd'] != md5($data['pwd'])) {
				return $this->tishi[] = '用户名密码不匹配';
			}
			$this->setSession($data);
			return $name = (int)$name[0]['uid'];
		}
		return $this->tishi;
	}
	//设置session
	public function setSession($data)
	{
		$name = $data['name'];
		$user = $this->where("name = '$name'")->select();
		$_SESSION['uid'] = $user[0]['uid'];
		$_SESSION['name'] = $user[0]['name'];
		$_SESSION['pwd'] = $user[0]['pwd'];
		$_SESSION['email'] = $user[0]['email'];
		$_SESSION['zhucetime'] = $user[0]['zhucetime'];
		$_SESSION['ip'] = $user[0]['ip'];
		$_SESSION['level'] = $user[0]['level'];
	}
	
	//注册
	public function regist($data)
	{
		if ($this->empty($data) == 1 && $this->panDuan($data) == 1) {
			$zhucetime = time();
			$ip = $_SERVER['REMOTE_ADDR'];
			if (!strcmp($ip,'::1') ){
			$ip = '127.0.0.1';
			}else{
				$ip = ip2long($ip);	
			}
			$data['pwd'] = md5($data['pwd']);
			$data['zhucetime'] = $zhucetime;
			$data['ip'] = $ip;
			return $this->insert($data);
		}else{
			return $this->tishi;
		}
		
	}
	//接收值是否为空
	public function empty($data)
	{
		foreach ($data as $key => $value) {
			if (empty($value)) {
				return $this->tishi[] = '不能为空';
			}
		}
		return 1;
	}
	//判断输入内容
	public function panDuan($data)
	{
		if ($data['pwd'] < 6) {
			return $this->tishi[] =  '密码不能小于6位';
		}
		if ($data['pwd'] != $data['repwd']) {
			return $this->tishi[] =  '两次密码不一致';
		}
		$name = $this->getByName($data['name']);
		if (!empty($name)) {
			return $this->tishi[] = '用户名已存在';
		}
		$pat = '/\w+@\w+\.(com|cn|net)$/';
		if (preg_match($pat, $data['email'], $result)) {
			$data['email'] = $result[0];
		} else {
			return  $this->tishi[] = '邮箱格式不正确';
		}	
		return 1;
	}
	//查用户
	public function selectuser($where)
	{
		return $this->where($where)->select();
	}
}
