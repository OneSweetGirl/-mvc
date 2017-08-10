
<!DOCTYPE html lang="en-US">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>about</title>

<link rel='stylesheet' id='reset-css'  href='<?php echo CSS_PATH;?>reset.css' type='text/css' media='all' />
<link rel='stylesheet' id='superfish-css'  href='<?php echo CSS_PATH;?>superfish.css' type='text/css' media='all' />
<link rel='stylesheet' id='fontawsome-css'  href='<?php echo CSS_PATH;?>font-awsome/css/font-awesome.css' type='text/css' media='all' />
<link rel='stylesheet' id='orbit-css-css'  href='<?php echo CSS_PATH;?>orbit.css' type='text/css' media='all' />
<link rel='stylesheet' id='style-css'  href='<?php echo CSS_PATH;?>style.css' type='text/css' media='all' />
<link rel='stylesheet' id='color-scheme-css'  href='<?php echo CSS_PATH;?>color/green.css' type='text/css' media='all' />
<link rel="stylesheet" href="<?php echo CSS_PATH;?>zerogrid.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo CSS_PATH;?>responsive.css" type="text/css" media="screen">
<script type='text/javascript' src='<?php echo JS_PATH;?>jquery.js'></script>
<script type='text/javascript' src='<?php echo JS_PATH;?>jquery-migrate.min.js'></script>
<script type='text/javascript' src='<?php echo JS_PATH;?>jquery-1.10.2.min.js'></script>
<script type='text/javascript' src='<?php echo JS_PATH;?>jquery.carouFredSel-6.2.1-packed.js'></script>
<script type='text/javascript' src='<?php echo JS_PATH;?>hoverIntent.js'></script>
<script type='text/javascript' src='<?php echo JS_PATH;?>superfish.js'></script>
<script type='text/javascript' src='<?php echo JS_PATH;?>orbit.min.js'></script>
 <script src="<?php echo JS_PATH;?>css3-mediaqueries.js"></script>
</head>

<body class="page page-id-56 page-template-default">

	<!-- Start Header -->
    <div class="container zerogrid">
        <div class="col-full"><div class="wrap-col">
            <div id="header-nav-container">
            
                    <a href="#">
                    <img src="<?php echo IMG_PATH;?>/logo.png" id="logo" />
                    </a>
                    
                    <!-- Navigation Menu -->
                    
    <ul class="sf-menu"><li class="menu-item "><a href="<?php echo WEB_SITE;?>">首页</a></li>
    <li class="menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$sblog[0]['zid']; ?>">博客</a></li>

    <?php if(empty($_SESSION)):?>
    <li class="menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=user&a=regist">
    登录注册</a></li>
    <?php else:?>
    <li class="menu-item"><a href="<?php echo WEB_SITE;?>">
        你好，<?=$name; ?>
        </a>
        <ul class="sub-menu">
            <form action="<?php echo WEB_SITE;?>index.php?m=index&c=about&a=about" method="post" />
                <li class="menu-item">
                  <span style="padding:10px;color:#AAAAAA;font-size:15px;">真的要退出吗？</span> 
                  <input style="width:50px;height:25px;margin:10px;" type="submit" name="tuichu" value="退出" />
                </li>
                <?php if($_SESSION['level'] == 1):?>
                <li class="menu-item">
                    <a href="<?php echo WEB_SITE;?>?m=index&c=fablog&a=fablog">发博客</a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo WEB_SITE;?>?m=admin&c=login&a=login">后台管理</a>
                </li>
               <?php endif;?>
            </form>
        </ul>
    </li>
    
    
    <?php endif;?>

<!--<ul class="sub-menu">
    <li class="menu-item">
        <a href="#">Menu 01</a>
    </li>
    <li class="menu-item"><a href="#">Menu 02</a></li>
    <li class="menu-item"><a href="#">Menu 03</a></li>
</ul>-->

<li class="menu-item current-menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=about&a=about">关于我</a></li>
</ul>   
                    <!-- End Navigation Menu -->
                    
                    <div class="clear"></div>
                    
            </div>
            </div>
        </div>
    <div class="clear"></div> 
    </div>

    <div class="spacing-30"></div>
    <!-- End Header -->
    
    
    <!-- Start Main Container -->
    <div class="container zerogrid">
        
    <div class="col-full page-conainer">
	<div class="wrap-col">
    <div class="post-margin">
    <h5 class="page-title">关于我</h5>
    
    <!-- Start Entry -->
    <p>姓名：黄春杰</p>
    <p>电话：15726660511</p>


<div class="symple-clear-floats"></div>
    <!-- End Entry -->
    
    </div>
	</div>
    </div>
    
    <div class="clear"></div>
        </div>
	<!-- End Main Container -->
	
	
    
    
    <!-- Start Footer -->
    <div class="spacing-30"></div>
    <div class="container zerogrid">
        <div id="footer-container" class="col-full">
        <div class="wrap-col">	
            <!-- Footer Copyright -->
            <p>&copy; Copyright &copy; 2014.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p>
            <!-- End Footer Copyright -->
            
            <!-- Footer Logo -->
			<img src="<?php echo IMG_PATH;?>/footer-logo.png" id="footer-logo" />
            <!-- End Footer Logo -->
        
        <div class="clear"></div>
		</div>
        </div>
    </div>
    <!-- End Footer -->

<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>