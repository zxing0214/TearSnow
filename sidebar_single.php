<div id="sidebar">

<div class="widget">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('（通用）小工具') ) : ?>
	<?php endif; ?>
</div>
<div class="widget">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('（文章页）小工具①') ) : ?>
	<?php endif; ?>
</div>

<div class="widget"><div id="tab-title">
  <?php include('includes/t_tab_new.php'); ?>
</div></div>
<div class="widget"><h3>分类目录</h3>
<div class="sidebar-categories">
<div class="sidebar-categories li">
<ul>
<?php wp_list_categories('orderby=name&show_count=1&title_li='); ?>
</ul>
</div>
</div>
</div>
<?php if (get_option('swt_adaaa') == 'Display') { ?>
<div class="widget"><h3>广而告之</h3>
  <p><?php echo stripslashes(get_option('swt_adxxxcode')); ?>
    <?php echo stripslashes(get_option('swt_adyyycode')); ?>
    <?php echo stripslashes(get_option('swt_adzzzcode')); ?></p>
</div>
<?php { echo ''; } ?><?php } else { } ?>

<div class="widget">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('（文章页）小工具②') ) : ?>
	<?php endif; ?>
</div>

<div class="widget"><div class="top_comment">
	<?php if (get_option('swt_wallreaders') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/top_comment.php'); } ?></div>
</div>

<div class="widget">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('（文章页）小工具③') ) : ?>
	<?php endif; ?>
</div>

<div class="widget"><?php include('includes/t_comment.php'); ?></div>

<div class="widget"><?php include('includes/t_tags.php'); ?></div>

</div>
</div>
