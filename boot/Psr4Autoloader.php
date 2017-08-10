<?php

class Psr4Autoloader
{
	//保存命名空间和真实文件的关系
	protected $namespaces;
	public function __construct($namespace = null)
	{
		spl_autoload_register([$this, 'loadClass']);
		if (is_array($namespace)) {
			$this->addNameSpace($namespace);
		}
		
	}
	public function loadClass($className)
	{
		//将类名和命名空间分开
		$pos = strrpos($className, '\\');
		//命名空间
		$namespace = substr($className, 0, $pos + 1);
		//类名
		$realClass  = substr($className, $pos + 1);
		//调用加载真实的
		$this->loadMappedFile($namespace, $realClass);
		
	}
	protected function loadMappedFile($namespace, $realClass)
	{
		if (empty($this->namespaces)) {
			$className = str_replace('\\', '/', $namespace) . $realClass.'.php';
				if (file_exists($className)) {
					include $className;
					return true;
				}
		}
		
		foreach ($this->namespaces[$namespace] as  $value) {
			$className = $value . $realClass . '.php';
			if (file_exists($className)) {
				include $className;
				return true;
			}
		}
		return false;
	}

	//存储对应关系  
	public function addNameSpace($namespace, $realPath= null)
	{
		if (is_array($namespace)) {
			foreach ($namespace as $key => $value) {
				$this->addPser4($value, $key);
			}
		} else {
			$this->addPser4($namespace, $realPath);
		}
	}
	protected function addPser4($namespace, $realPath) {
		$namespace = trim($namespace, '\\') .'\\';
		$realPath  = str_replace('\\', '/', $realPath);
		$realPath  =  rtrim($realPath, '/') . '/';
		$this->namespaces[$namespace][] = $realPath; 
	}
	
}