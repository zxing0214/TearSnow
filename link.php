<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="查看评论" id="ct"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main"><?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
$(".tearsnowlink a").each(function(e){
	$(this).prepend("<img src=http://www.google.com/s2/favicons?domain="+this.href.replace(/^(http:\/\/[^\/]+).*$/, '$1').replace( 'http://', '' )+" style=float:left;padding:5px;>");
}); 
});
</script>
<div class="left left_page">
<div class="article_page">
<div class="tearsnowlink"><ul>
<?php wp_list_bookmarks('orderby=id&category_orderby=id'); ?></ul>
</div>
<div class="clear"></div>
<div class="linkstandard">
<h2 style="color:#FF0000">申请友情链接前请看：</h2>
<ul>
  <li>一、在您申请本站友情链接之前请先做好<a href="<?php bloginfo('url'); ?>" title="如：<?php bloginfo('name'); ?> <?php bloginfo('url'); ?>"><strong>本站链接 </strong></a>，否则不会通过，谢谢！</li>
  <li>二、<span style="color:#FF0066">谢绝第一次来我博客就申请友情链接</span>，在做链接前我希望的是交流，博客与博客的交流，而不是一上来就是交换链接。</li>
  <li>三、本站目前只招优秀的站长、设计，编程类原创IT博客，其他类别的博客申请将有可能不被通过，当然如果你站确实优秀的话我会考虑添加的。</li>
  <li>四、如果您的站还未被baidu或google收录，申请链接暂不予受理！</li>
  <li>五、如果您的站原创内容少之又少，申请连接不予受理！</li>
  <li>六、如果您不能保证在一周之内更新博客或网站内容，链接将自动解除！</li>
  <li>七、<span style="color:#f00">本博客链接信息：</span></li>
  <li>『博客名称』<?php bloginfo('name'); ?></li>
  <li>『博客地址』<?php bloginfo('siteurl'); ?></li>
  <li>『博客简介』<?php bloginfo('description'); ?></li>
</ul>
</div>

</div>
</div>

<div class="articles_page">
<?php comments_template(); ?>
</div>

	<?php endwhile; else: ?>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>