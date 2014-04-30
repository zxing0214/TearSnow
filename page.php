<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="查看评论" id="ct"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main"><?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="left">
<h1><?php the_title(); ?></h1>
<div class="post_date">
<span class="date_d"><?php the_time('d') ?></span>
<span class="date_y"><?php the_time('Y') ?>.<?php echo date('m',get_the_time('U'));?></span>
</div>
<div class="article">
<div class="article_info">作者：<?php the_author() ?> &nbsp; 发布：<?php the_time('Y-m-d H:i') ?> &nbsp; 字符数：<?php echo count_words ($text); ?> &nbsp; 阅读：<?php post_views(' ', ' 次'); ?> &nbsp; <?php comments_popup_link ('抢沙发','1条评论','%条评论'); ?> &nbsp; <?php edit_post_link('编辑', ' [ ', ' ] '); ?></div><div class="clear"></div>
        <div class="context"><?php the_content('Read more...'); ?></div>
</div>
</div>

<div class="articles">
<?php comments_template(); ?>
</div>

	<?php endwhile; else: ?>
	<?php endif; ?>
</div>

<?php include('sidebar_page.php'); ?>
<?php get_footer(); ?>