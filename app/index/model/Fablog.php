<?php
namespace index\model;
use framework\Model;
use framework\Page;
use framework\Verify;
class Fablog extends Model
{
	public $notice = [];
	//发博客
	public function faBlog($data)
	{
		if ($this->empty($data) == 1 && $this->verify($data) == 1) {
			$data['uid'] = $_SESSION['uid'];
			$data['time'] = time();
			$this->insert($data);
			return 1;
		}
		return $this->notice;
	}
	//接收值是否为空
	protected function empty($data)
	{
		foreach ($data as $key => $value) {
			if (empty($value)) {
				return $this->notice[] = '不能为空';
			}
		}
		return 1;
	}
	//验证码是否正确
	public function verify($data)
	{
		if ($data['ver'] != $_SESSION['code']) {
			unset($_SESSION['code']);
			return $this->notice[] = '验证码错误';
		}
		unset($_SESSION['code']);
		return 1;
	}
	//按最新时间遍历 分页
	public function selectBlog($num=3, $order)
	{
		$this->page = new Page($this->count()[0], $num);
		$limit = $this->page->limit();
		$blog = $this->limit($limit)->order($order)->select();
		foreach ($blog as $key => $value) {
			$value['time'] = date('Y-m-d H:i:s', $value['time']+3600*8);
			$bk[$key] = $value;
		}	
		$blog = $bk;
		$page = $this->page->listed();
		return ['blog' =>$blog , 'page' => $page];
	} 
	//查询博文
	public function tselectBlog($where=null , $order=null, $limit=null)
	{
		$blog = $this->where($where)->order($order)->limit($limit)->select();
		if (!empty($blog)){
			foreach ($blog as $key => $value) {
				$value['time'] = date('Y-m-d H:i:s', $value['time']+3600*8);
				$bk[$key] = $value;
			}
		$blog = $bk;	
		return $blog;
		}
	}
	//修改博客
	public function updateblog($data)
	{
		$zid = $_GET['zid'];
		$this->where("zid = $zid")->update($data);
	}
	
}