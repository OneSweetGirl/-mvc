<!DOCTYPE html lang="en-US">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>blog</title>

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
<script type='text/javascript' src='<?php echo JS_PATH;?>comment-reply.min.js'></script>
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

<body class="single single-post postid-49 single-format-standard">

	<!-- Start Header -->
    <div class="container zerogrid">
        <div class="col-full"><div class="wrap-col">
        	<div id="header-nav-container">
            
                    <a href="#">
                    <img src="<?php echo IMG_PATH;?>/logo.png" id="logo" />
                    </a>
                    
					<!-- Navigation Menu -->
                    
	<ul class="sf-menu"><li class="menu-item"><a href="<?php echo WEB_SITE;?>">首页</a></li>
	<li class="menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog">博客</a></li>
    <?php if(empty($_SESSION['uid'])):?>
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
                    <?php if($_SESSION['level']==1):?>
                    <li class="menu-item">
                        <a href="<?php echo WEB_SITE;?>?m=index&c=fablog&a=fablog">发帖</a>
                    </li>
                    <li class="menu-item">
                     <a href="<?php echo WEB_SITE;?>?m=admin&c=login&a=login">后台管理</a>
                     </li>
                    <?php endif;?>
                </form>
            </ul>
        </li>
        
        
        <?php endif;?>
<li class="menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=about&a=about">关于我</a></li>
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
    
        <!-- Start Posts Container -->
        <div class="col-2-3" id="post-container">
        	<div class="wrap-col">
			<!-- Comments -->
            <div class="comment-container">
            
            <h6 id="comment-header">发博</h6>
            
            <ul class="comment-list">
                        </ul>
            
            
            <!-- Comment Form -->
            <div class="commen-form">
            	<div id="respond" class="comment-respond">
				    <h3 id="reply-title" class="comment-reply-title">
                        <small>
                            <a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Cancel Reply</a>
                        </small>
                    </h3>
					<form action="<?php echo WEB_SITE;?>?m=index&c=fablog&a=fablog" method="post" id="comment-form-container" class="comment-form">
						<p class="comment-notes"></p>
                        <input type="text" name="title" placeholder="博文标题" class="comment-name"  />
                        <textarea name="con" placeholder="博文内容" class="comment-text-area"></textarea>				
                        <p class="form-allowed-tags">
                           验证码 : <input name="ver" type="text" id="comment-submit"  /><img style="vertical-align:middle;margin-left:10px;" src="<?php echo WEB_SITE;?>vendor/wlj/framework/src/Verify.php" />
                        </p>					
                        <p class="form-submit">
							<input name="submit" type="submit" id="comment-submit" value="发表" />
						</p>
					</form>
				</div><!-- #respond -->
			<div class="clear"></div>
            </div>
            <!-- End Comment Form -->
            
            </div>
            <!-- End Comments -->            
            
            
        <div class="clear"></div>
		</div>
        </div>
        <!-- End Posts Container -->
		
        <!-- Start Sidebar -->
		<div class="col-1-3"><div class="wrap-col">
			<div class="widget-container"><form role="search" method="get" id="searchform" class="searchform" action="http://demo.themesmarts.com/euclid/">
				<div>
					<label class="screen-reader-text" for="s">Search for:</label>
					<input type="text" value="" name="s" id="s" />
					<input type="submit" id="searchsubmit" value="搜索" />
				</div>
			</form><div class="clear"></div></div><div class="widget-container"><h6 class="widget-title">Categories</h6>		<ul>
	<li class="cat-item cat-item-5"><a href="#" title="View all posts filed under Apps">Apps</a>
</li>
	<li class="cat-item cat-item-3"><a href="#" title="View all posts filed under Illustration">Illustration</a>
</li>
	<li class="cat-item cat-item-4"><a href="#" title="View all posts filed under Logo">Logo</a>
</li>
		</ul>
<div class="clear"></div></div><div class="widget-container"><h6 class="widget-title">Latest Posts</h6>	<!-- Start Widget -->
                <ul class="widget-recent-posts">
                                
                <li>
                <div class="post-image">
                <div class="post-mask"></div>
                <img width="70" height="70" src="<?php echo IMG_PATH;?>images/HighRes-70x70.jpg" class="attachment-post-widget #"  />                </div>
                
                <h6><a href="#">The Lighthouse Effect</a></h6>
                <span>November 02, 2013</span>
                <div class="clear"></div>
                </li> 
                
                                
                <li>
                <div class="post-image">
                <div class="post-mask"></div>
                <img width="70" height="70" src="<?php echo IMG_PATH;?>images/one-more-beer-70x70.png" class="attachment-post-widget #"  />                </div>
                
                <h6><a href="#">One More Beer</a></h6>
                <span>November 02, 2013</span>
                <div class="clear"></div>
                </li> 
                                
                <li>
                <div class="post-image">
                <div class="post-mask"></div>
                <img width="70" height="70" src="<?php echo IMG_PATH;?>images/Timothy-J-Reynolds-2560x14401-70x70.jpg" class="attachment-post-widget #"  />                </div>
                
                <h6><a href="#">Underground Volcano</a></h6>
                <span>November 02, 2013</span>
                <div class="clear"></div>
                </li> 
                
                 
                </ul>
   <!-- End Widget -->
<div class="clear"></div>
</div>

   
</div>
</div>        <!-- End Sidebar -->
    
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