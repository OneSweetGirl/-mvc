<?php
namespace index\model;
use framework\Model;
use framework\Page;
use index\model\Fablog;
class Hblog extends Model
{
    public $notice = [];
    //评论博客
    public function __construct()
    {
        parent::__construct();
        $this->fablog = new Fablog();
    }
    public function hBlog($data)
    {
        if ($this->empty($data) == 1) {
            
            if (!empty($_POST['submit'])) {
                if (empty($_SESSION) ) {
                $zid = $_GET['zid'];
                return $this->notice[]='请登录后评论';
                } else {
                $zid = $_GET['zid'];
                $data['uid']  = $_SESSION['uid'];
                $data['time'] = time();
                $data['zid']  = $zid;
                $this->insert($data);
                $count = $this->where("zid=$zid")->select();
                $this->fablog->update(['said'=> $count]);
                return 1;
                }
            }
             return $this->notice;
        }
       
    }
    //接收值是否为空
    protected function empty($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                return $this->notice[] = '不能为空';
            }
        }
        return 1;
    }
    //按最新时间遍历博文评论 分页
    public function selecthBlog($where)
    {
        $count = $this->where($where)->count()[0];
        $this->page = new Page($count , 5);
        $limit = $this->page->limit();
        $hblog = $this->where($where)->limit($limit)->order('time desc')->select();
        $page = $this->page->listed();
        if ($hblog == false) {
             $hblog[0] = [
                        'hid'     => '',
                        'uid'     => '',
                        'con'     => '',
                        'isclose' => '',
                        ];
        } 
        return ['hblog' =>$hblog , 'page' => $page];
    } 
    //查询博文评论
    public function tselectBlog()
    {
        $zid = $_GET['zid'];
        $blog = $this->where("zid = $zid")->select();
        return $blog;
    }
}