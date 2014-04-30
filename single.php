<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="查看评论" id="ct"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main">
	<?php if (get_option('swt_adb') == 'Display') { ?><div style="text-align:center;"><?php echo stripslashes(get_option('swt_adbcode')); ?></div><?php { echo ''; } ?><?php } else { } ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="left">
<h1><?php the_title(); ?></h1>
<div class="post_date">
<span class="date_d"><?php the_time('d') ?></span>
<span class="date_y"><?php the_time('Y') ?>.<?php echo date('m',get_the_time('U'));?></span>
</div>
<div class="article">
<div class="article_info">作者：<?php the_author() ?> &nbsp; 发布：<?php the_time('Y-m-d H:i') ?> &nbsp; 字符数：<?php echo count_words ($text); ?> &nbsp; 分类：<?php the_category(', ') ?> &nbsp; 阅读：<?php post_views(' ', ' 次'); ?> &nbsp; <?php comments_popup_link ('抢沙发','1条评论','%条评论'); ?> &nbsp; <?php edit_post_link('编辑', ' [ ', ' ] '); ?></div><div class="clear"></div>
        <div class="context">
<?php the_content('Read more...'); ?><p><div><?php wp_link_pages(array('before' => '<div class="fenye">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '上一页', 'nextpagelink' => "")); ?>   <?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>   <?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "下一页")); ?></div></p>
        <p>转载请注明本文地址: <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_permalink() ?> | <?php bloginfo('name');?></a></p></div>
        <?php if (get_option('swt_adc') == 'Display') { ?><p style="text-align:center;"><?php echo stripslashes(get_option('swt_adccode')); ?></p><?php { echo ''; } ?><?php } else { } ?>
</div>

</div>
<div class="articles">
<div class="author_pic">
					<a href="#" title="<?php the_author_description(); ?>"><?php echo get_avatar( get_the_author_email(), '48' ); ?></a>
				</div>
<div class="author_text">
			<span class="spostinfo">
            	<?php the_tags('标签: ', ', ', ''); ?></br>
				该日志由 <?php the_author() ?> 于<?php the_time('Y年m月d日') ?>发表在 <?php the_category(', ') ?> 分类下，
				<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {?>
				您可以<a href="#respond">发表不同观点</a>
				<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) { ?>
				通告目前不可用，你可以至底部留下评论。
				<?php } ?><br/>
				原创文章，转载请注明: <a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> | <?php bloginfo('name');?></a><br/>
			</span>
				</div>
</div>

<div class="articles">
<?php previous_post_link('【上一篇】%link') ?><br/><?php next_post_link('【下一篇】%link') ?>
</div>

<div class="articles">
<?php include('includes/related.php'); ?>
<div class="clear"></div>
</div>

<div class="articles">
<?php comments_template(); ?>
</div>

	<?php endwhile; else: ?>
	<?php endif; ?>
</div>

<?php include('sidebar_single.php'); ?>
<?php get_footer(); ?>