<div id="header"><?php if($options['custom_logo'] ) : ?><div id="logo"><a id="custom_logo" href="<?php bloginfo('url');?>" title="<?php bloginfo('description'); ?>"></a></div><style>#custom_logo{background:url('<?php echo($options['logo_url']); ?>');float:left;width:268px;height:60px;position:absolute;margin-top:-5px;}</style><?php else : ?><div id="logo"><a href="<?php bloginfo('url');?>" title="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>"><img src="<?php echo stripslashes(get_option('swt_logodress')); ?>" alt="<?php bloginfo('name'); ?>" /></a></div><?php endif; ?>

<div id="notice"><div class="noticeavatar"><?php echo tearsnow_get_avatar(get_option('swt_Gravatar'), 42); ?></div><div class="notocebg"><div class="noticecontent"><?php echo stripslashes(get_option('swt_isay')); ?></div></div></div>
<div id="sns"><div id="rss"><ul>
<li class="rssfeed"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" class="icon1" title="欢迎订阅RSS源"></a></li>
<?php if (get_option('swt_tqq') == 'Display') { ?><li class="tqq"><a href="<?php echo stripslashes(get_option('swt_tqqurl')); ?>" rel="nofollow" target="_blank" class="icon2" title="我的腾讯微博"></a></li><?php { echo ''; } ?><?php } else { } ?>
<?php if (get_option('swt_tsina') == 'Display') { ?><li class="tsina"><a href="<?php echo stripslashes(get_option('swt_tsinaurl')); ?>" rel="nofollow" target="_blank" class="icon3" title="我的新浪微博"></a></li><?php { echo ''; } ?><?php } else { } ?>
<?php if (get_option('swt_mailqq') == 'Display') { ?><li class="rssmail"><a href="http://mail.qq.com/cgi-bin/feed?u=<?php bloginfo('rss2_url'); ?>" rel="nofollow" target="_blank" class="icon4" title="用QQ邮箱订阅博客"></a></li><?php { echo ''; } ?><?php } else { } ?>
</ul></div><div id="dingyue">
<?php if (get_option('swt_maildy') == 'Display') { ?>
<form action="http://list.qq.com/cgi-bin/qf_compose_send" rel="nofollow" target="_blank" method="post">
			<input type="hidden" name="t" value="qf_booked_feedback">
			<input type="hidden" name="id" value="<?php echo stripslashes(get_option('swt_emailid')); ?>">
			<input id="to" onfocus="if (this.value == '输入邮箱 订阅本站') {this.value = '';}" onblur="if (this.value == '') {this.value = '输入邮箱 订阅本站';}" value="输入邮箱 订阅本站" name="to" type="text" class="feed-mail-input"><input class="feed-mail-btn" type="submit" value="订阅">
	  </form><?php { echo ''; } ?><?php } else { } ?>
</div></div>
</div>