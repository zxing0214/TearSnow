<?php get_header(); ?>
<meta http-equiv="refresh" content="10;URL=<?php bloginfo('url') ?>" />
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="查看评论" id="ct"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main">
<div class="left">
<div class="articles">
<h3>抱歉，您打开的页面未能找到。如有不便深感抱歉！</h3></br>
<p>请尝试以下操作：<br />
  1. 如果您已经在地址栏中输入该网页的地址，请确认其拼写正确；<br />
  2. 您可以使用本站的搜索框搜索您想要的内容；<br />
  3.单击<span class="light">浏览器后退</span>按钮，尝试其他链接； <br />
  4.点击首页进入 <a href="<?php bloginfo('url') ?>">
  <?php bloginfo('name') ?></a> 主页。</p>
<p>提醒：系统将在 10 秒后自动转到<a href="<?php bloginfo('url') ?>">
  <?php bloginfo('name') ?>
</a>首页</p>
</div>
</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>