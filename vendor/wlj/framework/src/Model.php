<?php
namespace framework;
$config = include 'config/database.php';
class Model
{
	//数据库链接
	protected $link;
	//主机名
	protected $host;
	//用户名
	protected $user;
	//密码
	protected $pwd;
	//数据库名
	protected $dbName;
	//字符集
	protected $charset;
	//表名
	protected $tableName;
	//表前缀
	protected $prefix;
	//保存所有的参数
	protected $option;
	//保存sql语句
	protected $sql ;
	//缓存cache
	protected $cache;
	//数据库字段
	protected $fields;
	//聚合函数列表
	protected $funcList = ['count', 'sum', 'max', 'min', 'avg'];
	public function __construct($config = null)
	{
		if (empty($config)) {
			if(empty($GLOBALS['database'])) {
				$config = include 'config/database.php';
			}else {
				$config = $GLOBALS['database'];
			}
		}
		$this->host 	= $config['DB_HOST'];
		$this->user 	= $config['DB_USER'];
		$this->pwd 		= $config['DB_PWD'];
		$this->dbName 	= $config['DB_NAME'];
		$this->charset  = $config['DB_CHARSET'];
		$this->prefix   = $config['DB_PREFIX'];
		$this->cache 	= $this->checkCache($config['DB_CACHE']);
		if(!$this->link = $this->connect()) {
			exit('数据库链接失败');
		}
		$this->tableName = $this->getTableName();
		$this->fields   = $this->getFields();
		$this->option  = $this->initOption();
	}
	protected function  connect()
	{
		$link = mysqli_connect($this->host, $this->user, $this->pwd);
		if (!$link) {
			return false;
		}
		if (!mysqli_select_db($link, $this->dbName)) {
			mysqli_close($link);
			return false;
		}
		if(!mysqli_set_charset($link, $this->charset)) {
			mysqli_close($link);
			return false;
		}
		return $link;
	}
	//初始化参数
	protected function initOption()
	{
		return [
				'where' => '',
				'order' => '',
				'group' => '',
				'having' => '',
				'limit' => '',
				'fields' => '*',
				'table' => $this->tableName,
			];
	}
	//拼接表名
	protected function getTableName()
	{
		if ($this->tableName) {
			return $this->prefix . $this->tableName;
		}
		//\admin\model\user  user
		$className = get_class($this);
		if ($pos = strrpos($className, '\\')) {
			$className = strtolower(substr($className, $pos+1));
		}
		return $this->prefix .$className;

	}
	public function __call($methods, $args) 
	{
		//getBy***
		if (strncmp($methods, 'getBy', 5) == 0) {
			$field = substr($methods, 5);
			return $this->getBy($field, $args[0]);
		}
		//聚合函数
		if (in_array($methods, $this->funcList)) {
			$arg = empty($args) ? null : $args[0];
			return $this->calc($methods, $arg);
		}
	}
	//聚合函数 count sum......
	protected function calc($methods, $arg=null)
	{
		if (is_null($arg)) {
			$field = $this->fields['_pk'];
		}
		$where = $this->option['where'];
		$sql = "select $methods($field)  as $field from $this->tableName $where";
		$this->sql = $sql;
		$result = $this->query($sql);
		return $result[0];
	}
	//当前字段 eg:money = money+10
	public function setInc($field, $value)
	{
		if (empty($this->option['where'])) {
			return 'where条件不能为空';
		}
		if (!in_array($field, $this->fields)) {
			return '字段错了';
		}
		$this->option['set'] = "$field = $field + $value";
		$sql = "update %table% set %set% %where%";
		$sql = str_replace(
				[
					'%set%',
					'%table%',
					'%where%',
				],
				[
					$this->option['set'],
					$this->option['table'],
					$this->option['where'],
				],
				$sql
			);
		return $this->exec($sql);

	}
	//主键查询
	public function  priKey($num)
	{
		$field = $this->fields['_pk'];
		if (is_string($num) && strpos($num, ',')) {
			$num = trim($num, ',');
			$this->option['where'] = " where $field in($num)";
		} else if (is_int($num)) {
			$this->option['where'] = " where $field=$num";
		} else if (is_array($num)) {
			$num = join(',', $num);
			$this->option['where'] = " where $field in($num)";
		}
		return $this->select();
	}
	//getBy  查询指定字段
	public function getBy($field, $value)
	{
		$realField = strtolower($field[0]);
		$len = strlen($field);
		// /驼峰转成_ eg:CreateTime--> create_time
		for ($i = 1; $i < $len; $i++) {
			$lower = strtolower($field[$i]);
			if ($lower != $field[$i]) {
				$realField .= '_';
			}
			$realField .= $lower;
		}
		if (is_string($value)) {
			$value = '\'' . $value . '\''; //'dabobo'
		}
		//eg: username = 'wangmeili';
		$where = $realField . '=' . $value;
		return $this->where($where)->select();
	}
	//查询结果是指定的字段
	public function field($field)
	{

		if (is_string($field)) {
			$this->option['fields'] = $field;
		} else if (is_array($field)) {
			$this->option['fields'] = join(',', $field);
		}
		return $this;
	}
	public function where($where)
	{
		if (is_string($where)) {
			if (empty($where)) {
				return $this;
			}
			$this->option['where'] = ' where ' . $where;
		} else if (is_array($where)) {
			$this->option['where'] = ' where ' . join(' and ', $where);
		}
		return $this;
	} 
	public function limit($limit)
	{
		if (is_string($limit)) {
			if (empty($limit)) {
				return $this;
			}
			$this->option['limit'] = ' limit ' . $limit;
		} else if (is_array($limit)) {
			$this->option['limit'] = ' limit ' . join(',', $limit);
		}
		return $this;
	}
	public function order($order)
	{
		if (is_string($order)) {
			if (empty($order)) {
				return $this;
			}
			$this->option['order'] = ' order by ' . $order;
		} else if (is_array($order)) {
			$this->option['order'] = ' order by  ' . join(',', $order);
		}
		return $this;
	}

	public function group($group)
	{
		if (is_string($group)) {
			$this->option['group'] = ' group by ' . $group;
		} else if (is_array($group)) {
			$this->option['group'] = ' group by ' . join(',', $group);
		}
		return $this;
	}

	public function having($having)
	{
		if (is_string($having)) {
			$this->option['having'] = ' having ' . $having;
		} else if (is_array($having)) {
			$this->option['having'] = ' having ' . join('and ', $having);
		}
		return $this;
	}
	public function select($resultType = MYSQLI_BOTH)
	{
		$sql = "select %fields% from %table% %where% %order% %group% %having% %limit%";
		$sql = str_replace(
				[
					'%fields%',
					'%table%',
					'%where%',
					'%order%',
					'%group%',
					'%having%',
					'%limit%',
				],
				[
					$this->option['fields'],
					$this->option['table'],
					$this->option['where'],
					$this->option['order'],
					$this->option['group'],
					$this->option['having'],
					$this->option['limit'],
				],
				$sql
			);
		//var_dump($sql);
		return $this->query($sql, $resultType);
	}
	public function insert($data)
	{
		if (!is_array($data)) {
			return '插入数据的时候传一个数组过来';
		}
		//过滤key是不是表字段
		$data = $this->checkInsert($data);
		$this->option['fields'] = join(',', array_keys($data));
		$this->option['values'] = join(',', $data);

		$sql = "insert into %table%(%fields%) values(%values%)";
		$sql = str_replace(
				[
					'%fields%',
					'%table%',
					'%values%',
				],
				[
					$this->option['fields'],
					$this->option['table'],
					$this->option['values'],
					
				],
				$sql
			);
		return (int)$this->exec($sql , true);
	}
	public function update($data)
	{
		if (!is_array($data)) {
			return '插入数据的时候传一个数组过来';
		}
		if (empty($this->option['where'])) {
			return '必须有where条件';
		}
		//过滤字段 加上''
		$data = $this->checkUpdate($data);
		$this->option['set'] = $data;
		$sql = "update %table% set %set% %where% %order% %limit%";
		$sql = str_replace(
				[
					'%set%',
					'%table%',
					'%where%',
					'%order%',
					'%limit%',
				],
				[
					$this->option['set'],
					$this->option['table'],
					$this->option['where'],
					$this->option['order'],
					$this->option['limit'],
					
				],
				$sql
			);
		//var_dump($sql);
		return $this->exec($sql);
	}
	public function delete()
	{
		if (empty($this->option['where'])) {
			return '必须有where条件';
		}
		$sql ='delete from %table% %where% %order% %limit%';
		$sql = str_replace(
				[
					'%table%',
					'%where%',
					'%order%',
					'%limit%',
				],
				[
					$this->option['table'],
					$this->option['where'],
					$this->option['order'],
					$this->option['limit'],
					
				],
				$sql
			);
		return $this->exec($sql);

	}
	//执行sql语句，返回状态  如果是insert 返回id
	protected function exec($sql, $insertId = false)
	{
		$this->sql = $sql;
		//每一次执行sql之后初始化一次参数
		$this->option = $this->initOption();
		$result = mysqli_query($this->link, $sql);
		if ($result && $insertId) {
			return mysqli_insert_id($this->link);
		}
		return $result;
	}
	//检测过滤字段
	protected function checkInsert($data)
	{
		//校验数组
		$fields = array_flip($this->fields);
		$data = array_intersect_key($data, $fields);
		//加上引号
		$data = $this->addQuotes($data);
		return $data;
	}
	protected function checkUpdate($data)
	{
		$data = $this->checkInsert($data);
		$realData = '';
		foreach ($data as $key => $value) {
			$realData .= $key . '=' . $value . ',';
		}
		return rtrim($realData, ',');
	}
	//字符串加上单引号
	protected function addQuotes($data)
	{
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (is_string($value)) {
					$data[$key] = '\''. $value . '\'';
				}
			}
		}
		return $data;
	}
	//查询时候用，返回所有的结果集
	protected function query($sql, $resultType= MYSQLI_BOTH)
	{
		$this->sql = $sql;
		//每一次执行sql之后初始化一次参数
		$this->option = $this->initOption();
		$result = mysqli_query($this->link, $sql);
		if ($result) {
			return mysqli_fetch_all($result, $resultType);//MYSQL_BOTH MYSQL_ASSOC MYSQLI_ROW
		}
		return $result;
	} 
	//上一次执行的sql语句
	public function getLastSql()
	{
		return $this->sql;
	}
	//校验缓存文件
	protected function checkCache($dir)
	{
		$dir = rtrim($dir, '/') . '/';
		if (!is_dir($dir)) {
			mkdir($dir, 0777, true);
		}
		if (!is_readable($dir) || !is_writable($dir)) {
			chmod($dir, 0777);
		}
		return $dir;
	}
	//获取表字段
	protected function getFields()
	{
		//拼接全文件路径
		$cacheFile = $this->cache . $this->tableName . '.php';
		if (file_exists($cacheFile)) {
			return include($cacheFile);
		}
		//不存在 处理 新建 库里读取， 数组
		$sql = 'desc ' . $this->tableName;
		$result = $this->query($sql, MYSQLI_ASSOC);
		//$result = mysqli_query($this->link, $sql);
		//$result = mysqli_fetch_all($result, MYSQLI_ASSOC); 
		$fields = [];
		foreach ($result as $key => $value) {
			if ($value['Key'] == 'PRI') {
				$fields['_pk'] = $value['Field'];
			}
			$fields[] = $value['Field'];
		}
		$data =  "<?php \n return " . var_export($fields, true) .';';
		file_put_contents($cacheFile, $data);
		return $fields;
			//return $result;

	}
	
}