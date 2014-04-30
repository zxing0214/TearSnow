<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="author" content="Fanly">
<?php include('includes/seo.php'); ?>
<?php if (get_option('swt_alt_stylesheet')==''):?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style.css" />
<?php endif;?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon" />
<?php if (get_option('swt_loading') == 'Display') { ?><script type="text/javascript">window.jQuery || document.write('<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js">\x3C/script>')</script><?php } else { } ?>
<?php if ( is_single() ) { ?><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/images/pirobox/style.css" /><?php } ?>
<?php wp_enqueue_script('jquery'); ?>
<?php wp_head(); ?>
<!-- Head -->
<script>
	$(function(){
		$(".nav>li").hover(function(){
			$(this).children('ul').stop(true,true).show(300);
		},function(){
			$(this).children('ul').stop(true,true).hide(300);
		})
	})
</script>

</head>

<body>
<?php if (get_option('swt_loading') == 'Display') { ?>
<!--加载中start-->
<div id="circle"></div>
<div id="circletext"></div>
<div id="circle1"></div>
<script type="text/javascript">
jQuery(document).ready(function(){
$("#circletext").text("加载中");
$(window).load(function() {
$("#circle").fadeOut(400);
$("#circle1").fadeOut(600);
$("#circletext").text("完成了").fadeOut(800);
});
});
</script>
<!--加载中end--><?php } else { } ?>
<div id="topbar">
<div class="topbar_width"><a class="homeicon" href="<?php bloginfo('url');?>"></a>
<div id="topnav">
<div id="nav-auto">
    	<ul class="nav">
			<?php wp_nav_menu(
				array(
					'container' => false,//移除DIV
					'items_wrap' => '%3$s',//移除UL
					'theme_location' => 'top-menu',
					'depth' => 2,
					)
				); 
			?>
        </ul>
</div></div>
<div id="secondnav"><?php wp_nav_menu( array( 'theme_location' => 'second-menu')); ?></div>
<div id="sear"><div class="search">		
			<form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="30" />
				<button type="submit"><?php _e("Search"); ?></button>
			</form>
		</div></div>
  <div class="clear"><div id="subscibe"></div></div>
</div>
</div>
<div id="height11">TearSnow</div>
<div id="layout"><div id="container">
<?php if (get_option('swt_toplan') == 'Hide') { ?>
			<?php } else { include(TEMPLATEPATH . '/includes/head.php'); } ?>
    <?php { echo ''; } ?>
</div><div class="clear"></div>
<div id="breadcrunbs"><?php breadcrunbs(); ?>
</div></div><div class="clear"></div></body>