<?php
namespace index\controller;
use index\model\Fablog as Fabloger;
use framework\Verify;
class Fablog extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->fabloger = new Fabloger();
			
	}
	public function faBlog()
	{
		$this->assign('name', $_SESSION['name']);
		if (empty($_POST)) {
			$this->display();
		} else if ($this->fabloger->faBlog($_POST) != 1) {
			$notice = $this->fabloger->notice[0];
			$this->notice($notice, 'index.php?m=index&c=fablog&a=fablog');
		} else {
			$this->notice('发表成功', 'index.php');
		}
		
	}
}