<div class="clear"></div>
<?php if (get_option('swt_fm') == 'Display') { ?>
<div id="footer_menu">
<?php if (get_option('swt_mycode') == 'Display') { ?><?php echo stripslashes(get_option('swt_mycodes')); ?><?php } else { } ?>
<?php if (get_option('swt_fma') == 'Display') { ?><a href="<?php echo stripslashes(get_option('swt_fmalink')); ?>" rel="external"><?php echo stripslashes(get_option('swt_fmaname')); ?></a><?php { echo ' | '; } ?><?php } else { } ?>
<?php if (get_option('swt_fmb') == 'Display') { ?><a href="<?php echo stripslashes(get_option('swt_fmblink')); ?>" rel="external"><?php echo stripslashes(get_option('swt_fmbname')); ?></a><?php { echo ' | '; } ?><?php } else { } ?>
<?php if (get_option('swt_fmc') == 'Display') { ?><a href="<?php echo stripslashes(get_option('swt_fmclink')); ?>" rel="external"><?php echo stripslashes(get_option('swt_fmcname')); ?></a><?php { echo ' | '; } ?><?php } else { } ?>
<?php if (get_option('swt_fmd') == 'Display') { ?><a href="<?php echo stripslashes(get_option('swt_fmdlink')); ?>" rel="external"><?php echo stripslashes(get_option('swt_fmdname')); ?></a><?php { echo ' | '; } ?><?php } else { } ?>
<?php if (get_option('swt_fme') == 'Display') { ?><a href="<?php echo stripslashes(get_option('swt_fmelink')); ?>" rel="external"><?php echo stripslashes(get_option('swt_fmename')); ?></a><?php { echo '  '; } ?><?php } else { } ?>
<?php { echo ''; } ?><?php } else { } ?></div>
<div class="clear"></div>
<?php $options = get_option('tearsnow_options'); ?>
<?php wp_footer(); ?>
</div>
<?php TearSnow_show_notify(); ?>
</body>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/realgravatar.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/hoveraccordion.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tearsnow.js"></script>
<?php include('includes/lazyload.php'); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js" ></script>
<?php if ( is_single() ) { ?><script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/pirobox.min.js"></script><?php } ?>
<script type="text/javascript">   
$(document).ready(function() {   
    $().piroBox({   
            my_speed: 400, //animation speed   
            bg_alpha: 0.3, //background opacity   
            slideShow : true, // true == slideshow on, false == slideshow off   
            slideSpeed : 4, //slideshow duration in seconds(3 to 6 Recommended)   
            close_all : '.piro_close,.piro_overlay'// add class .piro_overlay(with comma)if you want overlay click close piroBox   
    });   
});   
</script>  

</html>