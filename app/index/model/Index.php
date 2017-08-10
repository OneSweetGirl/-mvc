<?php
namespace index\model;
use framework\Model;
//use framework\page;
class index extends Model
{
	public function __construct()
	{
		parent::__construct();
		//$this->page = new Page();
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