
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
	<li class="menu-item current-menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$sblog[0]['zid']; ?>">博客</a></li>
    <?php if(empty($_SESSION['uid'])):?>
        <li class="menu-item"><a href="<?php echo WEB_SITE;?>?m=index&c=user&a=regist">
        登录注册</a></li>
        <?php else:?>
        <li class="menu-item"><a href="<?php echo WEB_SITE;?>">
            你好，<?=$name; ?>
            </a>
            <ul class="sub-menu">
                <form action="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$zid; ?>" method="post" />
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
-
  
    <!-- Start Main Container -->
    <div class="container zerogrid">
    
        <!-- Start Posts Container -->
        <div class="col-2-3" id="post-container">
        	<div class="wrap-col">
            
            
            
                    	<!-- Start Post Item -->
            <div class="post">
            	<div class="post-margin">
                
                <!--<div class="post-avatar">
                    <div class="avatar-frame"></div>
                    <img alt='' src="" class='avatar avatar-70 photo' height='70' width='70' />              </div>-->  
                
                <h4><?=$blog['title']; ?></h4>
                	<ul class="post-status">
                    <li><i class="fa fa-clock-o"></i><?=$blog['time']; ?></li>
                    <li><i class="fa fa-folder-open-o"></i><a href="#" title="View all posts in Illustration" rel="category"><?=$blog['look']; ?></a></li>
                    <li><i class="fa fa-comment-o"></i><?=$blog['said']; ?></li>
                    <li><i class="#">赞</i><?=$blog['love']; ?></li>
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
            <p><?=$blog['con']; ?></p>
                <ul class="post-social">
                    <form action="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$zid; ?>" method="post">
                    <li><a style="padding:7px;" href="#" target="_blank"><input  type="submit" name="love" value="赞" /></a></li>
                    <li><a href="#ping" target="_blank" >评论</a></li>
                </form>
                </ul>
             <div class="clear"></div> 
			<!-- Post Tags -->
            <?php foreach($hblog as $value): ?>
            <div class="post-tags">
            <span class="fa-stack fa-lg">
               <i class="fa fa-circle fa-stack-2x"></i>
               <i class="fa fa-tags fa-stack-1x fa-inverse"></i>   
            </span>
           <?=$value['name']; ?>&nbsp;<?=$value['con']; ?>
        </div>
            <div class="clear"></div>            <!-- End Post Tags -->
             <?php endforeach;?>
        <!-- End Pagination -->
            </div>
             
            
            <!-- End Post Social -->
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
            <!-- Post Social -->
            <div class="clear"></div>
            </div>
            <!-- End Post Item -->
            
            
                        
            
<div class="post">

    
</div>            
            
			     <div class="comment-container">
            
            <h6 id="comment-header"><a name="ping">评论</a></h6>
            
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
                    <form action="<?php echo WEB_SITE;?>?m=index&c=blog&a=blog&zid=<?=$zid; ?>" method="post" id="comment-form-container" class="comment-form">
                        <p class="comment-notes"></p>
                        <textarea name="con" placeholder="评论内容" class="comment-text-area"></textarea>               <p class="form-allowed-tags"></p>                   
                        <p class="form-submit">
                            <input name="submit" type="submit" id="comment-submit" value="评论" />
                        </p>
                    </form>
                </div><!-- #respond -->
            <div class="clear"></div>
            </div>
            <!-- End Comment Form -->
            
            </div>       
            
            
        <div class="clear"></div>
		</div>
        </div>
        <!-- End Posts Container -->
		
        <!-- Start Sidebar -->
		<div class="col-1-3"><div class="wrap-col">
			<div class="widget-container"><form role="search" method="get" id="searchform" class="searchform" action="http://demo.themesmarts.com/euclid/">
				<!--<div>
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
		</ul>-->
<div class="clear"></div></div><div class="widget-container"><h6 class="widget-title">最新博客</h6>	<!-- Start Widget -->
                <ul class="widget-recent-posts">
                                
                <?php foreach($allblog as $value): ?>              
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
                
                 
                </ul>
   <!-- End Widget -->
<div class="clear"></div></div><div class="widget-container"><h6 class="widget-title">Tag Cloud</h6><div class="tagcloud"><a href='#' class='tag-link-12' title='1 topic' style='font-size: 8pt;'>Color Schemes</a>
<a href='#gallery' class='tag-link-6' title='1 topic' style='font-size: 8pt;'>Gallery</a>
<a href='#images' class='tag-link-8' title='1 topic' style='font-size: 8pt;'>Images</a>
<a href='#light' class='tag-link-11' title='1 topic' style='font-size: 8pt;'>Light</a>
<a href='#post' class='tag-link-7' title='1 topic' style='font-size: 8pt;'>Post</a>
<a href='#slider' class='tag-link-9' title='1 topic' style='font-size: 8pt;'>Slider</a>
<a href='#standard' class='tag-link-10' title='1 topic' style='font-size: 8pt;'>Standard</a></div>
<div class="clear"></div></div> 
    <div class="clear"></div>
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