<?php
namespace index\model;
user framework\Model;
class About extends Model
{
	public function getInfo()
	{
		return $this->select();
	}
	public function index()
	{
		
		$result = $this->blog->getInfo();	
	}
	public function selectUser()
	{
		if (!empty($_SESSION))
		{
			return $_SESSION['name'];
		}
		return false;
	}
}