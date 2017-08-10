<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>后台管理中心</title>  
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>pintuer.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>admin.css">
    <script src="<?php echo JS_PATH;?>jquery.js"></script>   
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
  <div class="logo margin-big-left fadein-top">
    <h1><img src="<?php echo IMG_PATH;?>images/y.jpg" class="radius-circle rotate-hover" height="50" alt="" />后台管理中心</h1>
  </div>
  <div class="head-l">
    <a class="button button-little bg-green" href="index.php" target="_blank">
      <span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp;
      
    <a class="button button-little bg-red" href="index.php?m=admin&c=index&a=index&tui=1">
      <span class="icon-power-off"></span>
    退出后台
   </a> 
  </div>
</div>
<div class="leftnav">
  <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
  <h2><span class="icon-user"></span>基本设置</h2>
  <ul style="display:block">
    <!--<li><a href="info.html" target="right"><span class="icon-caret-right"></span>网站设置</a></li>-->
    <li><a href="<?php echo WEB_SITE;?>?m=admin&c=pass&a=pass" target="right"><span class="icon-caret-right"></span>修改密码</a></li>   
    <li><a href="<?php echo WEB_SITE;?>?m=admin&c=book&a=book" target="right"><span class="icon-caret-right"></span>评论管理</a></li>     
    <li><a href="<?php echo WEB_SITE;?>?m=admin&c=column&a=column" target="right"><span class="icon-caret-right"></span>用户管理</a></li>
    <li><a href="<?php echo WEB_SITE;?>?m=admin&c=lists&a=lists" target="right"><span class="icon-caret-right"></span>博文管理</a></li>
  </ul>
    
</div>
<script type="text/javascript">
$(function(){
  $(".leftnav h2").click(function(){
	  $(this).next().slideToggle(200);	
	  $(this).toggleClass("on"); 
  })
  $(".leftnav ul li a").click(function(){
	    $("#a_leader_txt").text($(this).text());
  		$(".leftnav ul li a").removeClass("on");
		$(this).addClass("on");
  })
});
</script>
<ul class="bread">
  <li><b>当前语言：</b><span style="color:red;">中文</php></span>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li>
</ul>
<div class="admin">
  <iframe scrolling="auto" rameborder="0" src="<?php echo WEB_SITE;?>?m=admin&c=pass&a=pass" name="right" width="100%" height="100%"></iframe>
</div>
<div style="text-align:center;">
</div>
</body>
</html>