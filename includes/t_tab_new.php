<h3><span class="selected">最新发表</span><span>热评文章</span><span>猜你喜欢</span></h3>
	<div id="tab-content">
		<ul><?php $myposts = get_posts('numberposts=10&offset=0');foreach($myposts as $post) :?>
					<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,37); ?></a></li>
					<?php endforeach; ?></ul>
		<ul class="hide"><?php simple_get_most_viewed(); ?>
</ul>
		<ul class="hide"><?php $myposts = get_posts('numberposts=10&orderby=rand');foreach($myposts as $post) :?>
					<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,37); ?></a></li>
					<?php endforeach; ?></ul>
					</div>