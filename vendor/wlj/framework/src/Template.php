<?php
namespace framework;
class Template
{
	//模板文件路径
	protected $tplPath;
	//缓存文件路径
	protected $tplCache;
	//保存变量
	protected $vars = [];
	protected $validTime;

	public function __construct($tplPath = './view/', $tplCache = './cache/template/', $validTime = 3600 )
	{
		$this->tplPath = $this->checkDir($tplPath);
		$this->tplCache = $this->checkDir($tplCache);
		$this->validTime = $validTime;
	}
	//检测文件夹权限和是否存在
	protected function checkDir($dir)
	{
		$dir = rtrim($dir, '/') .'/';
		if (!is_dir($dir)) {
			mkdir($dir, 0777, true);
		}
		if (!is_readable($dir) || !is_writable($dir)) {
			chmod($dir, 0777);
		}
		return $dir;
	}

	public function assign($name, $value)
	{
		$this->vars[$name] = $value;
	}


	public function display($tplFile, $isExcute= true) 
	{
		//生成的缓存的名
		$cacheFile = $this->getCacheFile($tplFile);
		//拼接模板文件
		$tplFile = $this->tplPath . $tplFile;
		//判断模板文件是否存在
		if (!file_exists($tplFile)) {
			exit("$tplFile 模板文件不存在");
		}
		if (!file_exists($cacheFile) 
			|| filemtime($cacheFile) < filemtime($tplFile) 
			|| (filemtime($cacheFile) + $this->validTime) < time() 
			) {
			$this->checkDir(dirname($cacheFile));
			//读取替换
			$file = $this->compile($tplFile);
			//index.html==》index_html.php

			file_put_contents($cacheFile, $file);
		} else {
			//更新包含文件
			$this->updateInclude($tplFile);
		}
		
		if (!empty($this->vars)) {
			extract($this->vars);
		}
		

		if ($isExcute) {
			include $cacheFile;
		}
		 
	}
	protected function compile($tplFile)
	{
		$file = file_get_contents($tplFile);
		$keys = [
				'__%%__' 	 		  => '<?php echo \1;?>',
				'${%%}'     		  => '<?=\1; ?>',
				'{elseif %%}'		  => '<?php elseif(\1):?>',
				'{$%%}'		 		  => '<?=$\1; ?>',
				'{if %%}'		 	  => '<?php if(\1):?>',
				'{else}' 		 	  => '<?php else:?>',
				'{/if}'				  => '<?php endif;?>',
				'{switch %% case %%}' => '<?php switch(\1): case \2: ?>',
				'{case %%}'  		  => '<?php case \1:?>',
				'{break}'    		  => '<?php break;?>',
				'{/switch}'  		  => '<?php endswitch;?>',
				'{include %%}' 		  => '<?php include "\1"?>',
				'{for %%}'  		  => '<?php for(\1):?>',
				'{/for}'  			  => '<?php endfor;?>',
				'{foreach %%}' 		  => '<?php foreach(\1): ?>',
				'{/foreach}' 		  => '<?php endforeach;?>',
				'{section}' 		  =>'<?php ',
				'{/section}' 		  => '?>',
				];

		foreach ($keys as $key => $value) {
			//添加转义
			$key = preg_quote($key, '#');
			//%%==>(.+)
			$reg = '#' . str_replace('%%', '(.+)', $key) . '#U';
			if (strpos($reg, 'include')) {
				$file = preg_replace_callback($reg, [$this, 'compileInclude'], $file);
			} else {
				$file = preg_replace($reg, $value, $file);
			}
		}
		return $file;

	}
	protected function compileInclude($matches)
	{
		$fileName = $matches[1];
		$this->display($fileName, false);
		$cacheFile = $this->getCacheFile($fileName);
		return "<?php include '$cacheFile' ;?>";
	}
	protected function updateInclude($tplFile)
	{
		$con = file_get_contents($tplFile);
		$reg = '/\{include (.+)\}/U';
		if (preg_match_all($reg, $con, $matches)) {
			$this->display($matches[1][0],false);
		}
	}
	protected function getCacheFile($tplFile)
	{
		return $this->tplCache . str_replace('.', '_', $tplFile) . '.php';
	}
	public function clearCache()
	{	
		$this->clearDir($this->tplCache);
		
	}
	protected function clearDir($dir)
	{
		$dp = opendir($dir);
		while ($file = readdir($dp)) {
			if ($file == '.' || $file == '..') {
				continue;
			}
			$fileName = $dir . $file;
			if (is_dir($fileName)) {
				$this->clearDir($fileName);
			} else {
				unlink($fileName);
			}
		}
		closedir($dp);
		rmdir($dir);
	}

}
