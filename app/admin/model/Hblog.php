<?php
namespace admin\model;
use framework\Model;
class Hblog extends Model
{
	//查评论
	public function selectHblog($where)
	{
		$this->where($where)->select();
	}
}