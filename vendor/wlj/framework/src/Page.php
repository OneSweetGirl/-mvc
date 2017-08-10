<?php
namespace framework;
class Page
{
	protected $total;//总条数
	protected $pageSize;//每一页显示
	protected $page;//当前页
	protected $pageCount;
	protected $url;
	protected $pageName;
	public function __construct($total, $pageSize = 5, $pageName = 'page')
	{
		$this->total = $total;
		$this->pageSize = $pageSize;
		$this->page = $this->getPage();
		$this->pageName = $pageName;
		$this->pageCount = ceil($this->total / $this->pageSize);
		$this->url = $this->getUrl();

	}
	//首页
	public function headPage()
	{
		return $this->setPage(1);
	}
	//尾页
	public function tailPage()
	{
		return $this->setPage($this->pageCount);
	}
	//上一页
	public function prevPage()
	{
		if ($this->page < 2) {
			return $this->headPage();
		} else{
			return $this->setPage($this->page - 1);
		}
		
	}
	//下一页
	public function nextPage()
	{
		if ($this->page < $this->pageCount) {
			return $this->setPage($this->page + 1);
		} else{
			return $this->tailPage();
		}
		
	}
	//指定要跳转的页面
	public function givenPage($page)
	{
		if ($page < 1)
		{
			$page = 1;
		} else if ($page > $this->pageCount) {
			$page = $this->pageCount;
		}
		return $this->setPage($page);
	}
	public function listed()
	{
		return [
			'head' => $this->headPage(),
			'prev' => $this->prevPage(),
			'next' => $this->nextPage(),
			'tail' => $this->tailPage()
			];
	}
	protected function getUrl()
	{
		$url  = $_SERVER['REQUEST_SCHEME'];//协议
		$url .= '://' . $_SERVER['HTTP_HOST'];
		$url .= ':' .  $_SERVER['SERVER_PORT'];
		$url .= $_SERVER['REQUEST_URI'];
		$replaceStr = 'page=' . $this->page;
		// ?page=3
		//?tid=5%page= 3
		//?tid=5&page=3
		//?tid=5&page=3&uid=4
		$replaceArr = [
					$replaceStr . '&',
					'&' . $replaceStr,
					'?' . $replaceStr,
					 
				];
		$replaceUrl = str_replace($replaceArr, '', $url);
		return $replaceUrl;

	}
	//拼接 page
	protected function setPage($page)
	{
		if (strpos($this->url, '?'))
		{
			return $this->url . '&page=' . $page;
		} else {
			return $this->url . '?page='. $page;
		}
		
	}
	//获取当前页面
	protected function getPage()
	{
		return empty($_GET['page']) ? 1 : (int)$_GET['page']; 
	}
	public function limit()
	{
		//0,5 5,5 10,5 
		return ($this->page - 1) * $this->pageSize . ',' . $this->pageSize;
	}
}


