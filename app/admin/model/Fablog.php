<?php
namespace admin\model;
use framework\Model;
use framework\Page;

class Fablog extends Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
	//遍历博文
	public function selectBlog($where=null)
	{
		return $this->where($where)->select();
	}
	//分页遍历博文
	public function pagesblog()
	{
		$count = $this->count();
		$this->page = new Page($count[0]);
		$limit = $this->page->limit();
		$blog = $this->limit($limit)->select();
		foreach ($blog as $key => $value) {
			$value['time']      = date("Y-m-d", $value['time']);
			$hbk[$key] = $value;
		}
		$blog = $hbk;
		$page = $this->page->listed();
		return ['blog'=>$blog, 'page'=>$page];
	}
}