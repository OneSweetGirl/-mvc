<?php
namespace index\controller;
use framework\Template;
include 'config/config.php';
class Controller extends Template
{
	public function __construct()
	{
		parent::__construct('app/index/view/', 'caches/index/');
	}
	public function display($tplFile=null, $isExcute= true)
	{
		if (is_null($tplFile)) {
			$tplFile = $_GET['c'] . '/'. $_GET['a'] . '.html';
		}
		parent::display($tplFile, $isExcute);
	}
	public function notice($con, $url = null, $sec = 3)
	{
		if (empty($url)) {
			$url = $_SERVER['HTTP_REFERER'];
		}
		$this->assign('con', $con);
		$this->assign('url', $url);
		$this->assign('sec', $sec);
		$this->display('notice.html');
	}
}