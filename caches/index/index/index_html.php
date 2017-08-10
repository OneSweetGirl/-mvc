
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
                    
	<ul class="sf-menu"><li class="menu-item current-menu-item"><a href="<?php echo WEB_SITE;?>">首页</a></li>
	<li class="menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$sblog[0]['zid']; ?>">博客</a></li>

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
	
    <!-- Start Featured Carousel -->
    <div class="container zerogrid">
        <div class="list_carousel">
       <ul id="featured-posts">
        
        
                <li class="first carousel-item">
            <div class="post-margin">
                <h6><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$sblog[0]['zid']; ?>"><?=$sblog[0]['title']; ?></a></h6>
                <span><i class="fa fa-clock-o"></i><?=$sblog[0]['time']; ?></span>
            </div>
            
            <div class="featured-image">
             <img width="290" height="130" src="<?php echo IMG_PATH;?>images/<?=$sblog[0]['picture']; ?>"  />               
                <div class="post-icon">
                    <span class="fa-stack fa-lg"></span>
                </div>
            </div>
                        
            <div class="post-margin">
                <p><?=$sblog[0]['con']; ?></p>
            </div>
        </li>
              <li class="first carousel-item">
            <div class="post-margin">
                <h6><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$sblog[1]['zid']; ?>"><?=$sblog[1]['title']; ?></a></h6>
                <span><i class="fa fa-clock-o"></i> <?=$sblog[1]['time']; ?></span>
            </div>
            
                        <div class="featured-image">
            <img width="290" height="130" src="<?php echo IMG_PATH;?>images/<?=$sblog[0]['picture']; ?>"  />                <div class="post-icon">
                    <span class="fa-stack fa-lg">
                                         </span>
                </div>
            </div>
                        
            <div class="post-margin">
                <p><?=$sblog[1]['con']; ?></p>
            </div>
        </li>
                <li class="last carousel-item">
            <div class="post-margin">
                <h6><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$sblog[2]['zid']; ?>"><?=$sblog[2]['title']; ?></a></h6>
                <span><i class="fa fa-clock-o"></i> <?=$sblog[2]['time']; ?></span>
            </div>
            
                        <div class="featured-image">
            <img width="290" height="130" src="<?php echo IMG_PATH;?>images/<?=$sblog[0]['picture']; ?>"  />                <div class="post-icon">
                    <span class="fa-stack fa-lg">
                                       </span>
                </div>
            </div>
                        
            <div class="post-margin">
                <p><?=$sblog[2]['con']; ?></p>
            </div>
        </li>
                <li class="first carousel-item">
            <div class="post-margin">
                <h6><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$sblog[3]['zid']; ?>"><?=$sblog[3]['title']; ?></a></h6>
                <span><i class="fa fa-clock-o"></i> <?=$sblog[3]['time']; ?></span>
            </div>
            
                        <div class="featured-image">
            <img width="290" height="130" src="<?php echo IMG_PATH;?>images/<?=$sblog[3]['picture']; ?>"  />                <div class="post-icon">
                    <span class="fa-stack fa-lg">
                                         </span>
                </div>
            </div>
                        
            <div class="post-margin">
                <p><?=$sblog[3]['con']; ?></p>
            </div>
        </li>
                <li class="first carousel-item">
            <div class="post-margin">
                <h6><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$sblog[4]['zid']; ?>"><?=$sblog[4]['title']; ?></a></h6>
                <span><i class="fa fa-clock-o"></i> <?=$sblog[4]['time']; ?></span>
            </div>
            
                        <div class="featured-image">
            <img width="290" height="130" src="<?php echo IMG_PATH;?>images/<?=$sblog[4]['picture']; ?>"  />                <div class="post-icon">
                    <span class="fa-stack fa-lg">
                                           </span>
                </div>
            </div>
                        
            <div class="post-margin">
                <p><?=$sblog[4]['con']; ?></p>
            </div>
        </li>
                <li class="last carousel-item">
            <div class="post-margin">
                <h6><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$sblog[5]['zid']; ?>"><?=$sblog[5]['title']; ?></a></h6>
                <span><i class="fa fa-clock-o"></i> <?=$sblog[5]['time']; ?></span>
            </div>
            
                        <div class="featured-image">
            <img width="290" height="130" src="<?php echo IMG_PATH;?>images/<?=$sblog[5]['picture']; ?>"  />                <div class="post-icon">
                    <span class="fa-stack fa-lg">
                                         </span>
                </div>
            </div>
                       
            <div class="post-margin">
                <p><?=$sblog[5]['con']; ?></p>
            </div>
        </li>
                
        </ul>
        
        <div class="clear"></div>
            
            <div class="carousel-controls">
                <a id="prev2" class="prev" href="#"><i class="fa fa-angle-left"></i></a>
                <a id="next2" class="next" href="#"><i class="fa fa-angle-right"></i></a>
              <div class="clear"></div>
            </div>
      </div>
    </div>
    <!-- Start Featured Carousel -->
    
    	
    
    <!-- Start Main Container -->
    <div class="container zerogrid">
    
        <!-- Start Posts Container -->
        <div class="col-2-3" id="post-container">
 			<div class="wrap-col">
                 
        	<!-- Start Post Item -->
            <?php foreach($blog as $value): ?>
            <div class="post">
            	<div class="post-margin">
                
                 <!--<div class="post-avatar">
                    <div class="avatar-frame"></div>
                   <img alt='' src="" class='avatar avatar-70 photo' height='70' width='70' />               </div> -->
                
                <h4 class="post-title">
                    <a href="#">
                    <?=$value['title']; ?>
                    </a>
                </h4>
                	<ul class="post-status">
                    <li><i class="fa fa-clock-o"></i><?=$value['time']; ?></li>
                    <li><i class="fa fa-folder-open-o"></i><a href="#" title="View all posts in Illustration" rel="category"><?=$value['look']; ?></a></li>
                    <li><i class="fa fa-comment-o"></i><?=$value['said']; ?></li>
                     <li><i class="">赞</i><?=$value['love']; ?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                
            		                    <div class="featured-image">
                    <img src="<?php echo IMG_PATH;?>images/Port_Harbor1-610x350.jpg" class="attachment-post-standard "  />                    
                    <div class="post-icon">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    </span>
                    </div>
                    </div>
                                
            <div class="post-margin">
            <p><?=$value['con']; ?></p>
            </div>
            
             <ul class="post-social">
                <!--
             <li><a href="#" target="_blank">
             <i class="fa fa-facebook"></i></a>
             </li>
                        
             <li>
             <a href="#" target="_blank">
             <i class="fa fa-twitter"></i></a>
             </li>
                        
             <li>
             <a href="#" target="_blank">
             <i class="fa fa-google-plus"></i></a>
             </li>
            
            <li>
            <a href="#" target="_blank">
            <i class="fa fa-linkedin"></i></a>
            </li>-->
            
            <li>
            <a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$value['zid']; ?>" class="readmore">详情 <i class="fa fa-arrow-circle-o-right"></i></a>
            </li>
            </ul>
            
            <div class="clear"></div>
            </div>
            <?php endforeach;?>
           
            <!-- End Post Item -->
            
                        
        <!-- Start Pagination -->
            <div class="spacing-20"></div>
            <ul class="pagination">
                <li class='current'>
                    <a  href="<?=$page['head']; ?>">首页</a>
                </li>
                <li>
                    <a  href="<?=$page['prev']; ?> "> 上一页</a>
                </li>
                <li>
                    <a  href="<?=$page['next']; ?>">下一页</a>
                </li>
                <li>
                   <a  href="<?=$page['tail']; ?>">尾页</a> 
                </li>
            </ul>
        <!-- End Pagination -->
            
        <div class="clear"></div>
		</div>
        </div>
        <!-- End Posts Container -->
		
        <!-- Start Sidebar -->
    	<div class="col-1-3">
		<div class="wrap-col">
	    	<div class="widget-container"><form role="search" method="get" id="searchform" class="searchform" action="http://sc.chinaz.com/?euclid/">
				<!--<div>
					<label class="screen-reader-text" for="s">Search for:</label>
					<input type="text" value="" name="s" id="s" />
					<input type="submit" id="searchsubmit" value="搜索Search" />
				</div>->
			</form><div class="clear"></div></div><div class="widget-container"><!-<h6 class="widget-title">Categories</h6>		<ul>
	<li class="cat-item cat-item-5"><a href="#" title="View all posts filed under Apps">Apps</a>
</li>
	<li class="cat-item cat-item-3"><a href="#" title="View all posts filed under Illustration">Illustration</a>
</li>
	<li class="cat-item cat-item-4"><a href="#" title="View all posts filed under Logo">Logo</a>
</li>
		</ul>-->
<div class="clear"></div></div><div class="widget-container"><h6 class="widget-title">最新博客</h6>	<!-- Start Widget -->
                <ul class="widget-recent-posts"> 
                <?php foreach($tblog as $value): ?>              
                    <li>
                    <div class="post-image">
                        <div class="post-mask"></div>
                        <img width="70" height="70" src="<?php echo IMG_PATH;?>images/<?=$value['picture']; ?>" class="attachment-post-widget #"  />                
                    </div>
                    
                    <h6><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$value['zid']; ?>"><?=$value['title']; ?></a></h6>
                    <span><?=$value['time']; ?></span>
                    <div class="clear"></div>
                    </li> 
                <?php endforeach;?>  
                </ul>
   <!-- End Widget -->
<div class="clear"></div></div>    <div class="clear"></div>
</div></div>        <!-- End Sidebar -->
    
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