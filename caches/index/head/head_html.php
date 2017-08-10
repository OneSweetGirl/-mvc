<!DOCTYPE html lang="en-US">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>首页</title>

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

<script type="text/javascript" language="javascript">
	$(function() {
		
		/* Start Carousel */
		$('#featured-posts').carouFredSel({
			auto: true,
					prev: '#prev2',
					next: '#next2',
		});
		/* End Carousel */
		
		
		/* Start Orbit Slider */
		$(window).load(function() {
			$('.post-gallery').orbit({
				animation: 'fade',
			});
		});
		/* End Orbit Slider */
			
			
		/* Start Super fish */
		jQuery(document).ready(function(){
			jQuery('ul.sf-menu').superfish({
				delay:         100,
				speed:         'fast',
				speedOut:      'fast',
			});
		});
		/* End Of Super fish */
			
	});
</script>
</head>

<body class="home blog">

	<!-- Start Header -->
    <div class="container zerogrid">
        <div class="col-full"><div class="wrap-col">
        	<div id="header-nav-container">
            
                    <a href="#">
                    <img src="<?php echo IMG_PATH;?>/logo.png" id="logo" />
                    </a>
                    
					<!-- Navigation Menu -->
                    
	<ul class="sf-menu"><li class="menu-item "><a href="<?php echo WEB_SITE;?>">首页</a></li>
	<li class="menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog">博客</a></li>

    <?php if(empty($_SESSION)):?>
    <li class="menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=user&a=regist">
    登录注册</a></li>
    <?php else:?>
    <li class="menu-item"><a href="<?php echo WEB_SITE;?>">
        你好，<?=$name; ?>
        </a>
        <ul class="sub-menu">
            <form action="<?php echo WEB_SITE;?>index.php" method="post" />
                <li class="menu-item">
                  <span style="padding:10px;color:#AAAAAA;font-size:15px;">真的要退出吗？</span> 
                  <input style="width:50px;height:25px;margin:10px;" type="submit" name="tuichu" value="退出" />
                </li>
                <li class="menu-item">
                    <a href="<?php echo WEB_SITE;?>?m=index&c=fablog&a=fablog">发帖</a>
                </li>
                <li class="menu-item">
                    <a href="#">收藏</a>
                </li>
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

<li class="menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=index&a=about">关于我</a></li>
</ul>	
         </div>
			</div>
        </div>
    <div class="clear"></div> 
    </div>
    </body>