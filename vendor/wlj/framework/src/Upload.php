<?php
namespace framework;
class Upload
{
	protected $savePath = './upload'; //保存的路径
	protected $randName = true ; //随机名
	protected $datePath = true; 
	protected $mime = ['image/png', 'image/jpeg', 'image/gif'];//mime
	protected $extension = 'png';
	protected $suff = ['png','jpeg', 'jpg', 'gif'];//允许上传
	protected $maxSize = 2000000;
	protected $errorNumber = 0;
	protected $errorMessage = '成功';
	protected $uploadInfo;
	protected $pathName;

	public function __construct($options = null)
	{
		$this->setOption($options);
	}
	protected function setOption($options)
	{
		if (is_Array($options)) {
			$keys = get_class_vars(__CLASS__);
			foreach ($options as $key => $value) {
				//判断一下成员属性
				if (in_array($key, $keys)) {
					$this->$key = $value;
				}
			}
		}
	}
	public function uploadFile($field)
	{
		//1.检查路径
		if (!$this->checkSavePath()) {
			return false;
		}
		//2检查上传信息
		if (!$this->checkUploadInfo($field)) {
			return false;
		}
		//3检查error错误信息
		if (!$this->checkUploadError()) {
			return false;
		}
		//4检查自定义的错误
		if (!$this->checkAllowOption()) {
			return false;
		}
		//5检查是不是上传文件
		if (!$this->checkUploadFile()) {
			return false;
		} 
		//6.拼接路径
		$this->joinPathName();
		//7.移动文件
		if (!$this->moveUploadFile()) {
			return false;
		}
		return true;

	}
	protected function moveUploadFile()
	{
		if (!move_uploaded_file($this->uploadInfo['tmp_name'], $this->pathName)) {
			$this->errorNumber = -8;
			$this->errorMessage = '移动失败' ;
			return false;
		}
		return true;
	}
	protected function joinPathName()
	{
		//路径
		$this->pathName = $this->savePath;
		if ($this->datePath) {
			//upload/2017/04/17/hdkjdhd.png
			$this->pathName .= date('Y/m/d/');
			if (!file_exists($this->pathName)) {
				mkdir($this->pathName, 0777,true);
			}
		}
		//名字
		if ($this->randName) {
			$this->pathName .= uniqid();
		} else {
			$info = pathinfo($this->uploadInfo['name']);
			$this->pathName .=  $info['filename'];
		}
		//后缀
		$this->pathName .=  '.' . $this->extension;


	}
	protected function checkUploadFile()
	{
		if(!is_uploaded_file($this->uploadInfo['tmp_name'])) {
			$this->errorNumber = -7;
			$this->errorMessage = '不是上传的文件' ;
			return false;
		}
		return true;
	}
	protected function checkAllowOption()
	{
		if (!in_array($this->uploadInfo['type'], $this->mime)) {
			$this->errorNumber = -4;
			$this->errorMessage = '不是允许的mime类型' ;
			return false;
		}
		if (!in_array($this->extension, $this->suff)) {
			$this->errorNumber = -5;
			$this->errorMessage = '不是允许的后缀' ;
			return false;
		}
		if ($this->uploadInfo['size'] > $this->maxSize) {
			$this->errorNumber = -6;
			$this->errorMessage = '超出规定的大小' ;
			return false;
		}
		return true;
	}	
	protected function checkUploadError() 
	{
		if (!$this->uploadInfo['error']) {
			return true;
		}
		switch($this->uploadInfo['error']) {
			case UPLOAD_ERR_INI_SIZE:
				$this->errorMessage = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$this->errorMessage = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值';
				break;
			case UPLOAD_ERR_PARTIAL:
				$this->errorMessage = '文件只有部分被上传';
				break;
			case UPLOAD_ERR_NO_FILE:
				$this->errorMessage = '没有文件被上传' ;
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$this->errorMessage = '找不到临时文件';
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$this->errorMessage = '文件写入失败';
				break;
		}
		$this->errorNumber = $this->uploadInfo['error'];
		return false;
	}
	protected function checkUploadInfo($field)
	{
		if (empty($_FILES[$field])) {
			$this->errorNumber = -3;
			$this->errorMessage = '没有' . $field . '上传信息' ;
			return false;
		}
		$this->uploadInfo = $_FILES[$field];
		return true;
	}
	protected function checkSavePath()
	{
		if (!is_dir($this->savePath)) {
			$this->errorNumber = -1;
			$this->errorMessage = '保存的路径不存在';
			return false;
		}
		if (!is_writable($this->savePath)) {
			$this->errorNumber = -2;
			$this->errorMessage = '保存的路径不可写';
			return false;
		}
		$this->savePath = rtrim($this->savePath, '/') . '/';
		return true;
	}
	public function __get($name)
	{
		if ($name == 'errorNumber' || $name == 'errorMessage') {
			return $this->$name;
		}
		
	}
}