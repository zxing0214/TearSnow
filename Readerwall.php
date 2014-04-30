<?php
/*
Template Name: 读者墙
*/
?>

<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="查看评论" id="ct"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="left left_page">
<div class="article_page">
<h2><?php the_title(); ?></h2>
        <div class="single_context">
<!-- start 读者墙-->
<?php
$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != 'leixue@leiue.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 18";//大家把管理员的邮箱改成你的,最后的这个18是选取多少个头像，大家可以按照自己的主题进行修改,来适合主题宽度
$wall = $wpdb->get_results($query);
$maxNum = $wall[0]->cnt;
foreach ($wall as $comment)
{
$width = round(40 / ($maxNum / $comment->cnt),3);//此处是对应的血条的宽度
if( $comment->comment_author_url )
$url = $comment->comment_author_url;
else $url="#";
$avatar = get_avatar( $comment->comment_author_email, $size = '36', $default = get_bloginfo('wpurl').'/avatar/default.jpg' );
$tmp = "<li><a target=\"_blank\" href=\"".$comment->comment_author_url."\">".$avatar."<em>".$comment->comment_author."</em> <strong>+".$comment->cnt."</strong></br>".$comment->comment_author_url."</a></li>";
$output .= $tmp;
}
$output = "<ul class=\"readers-list\">".$output."</ul>";
echo $output ;
?>
<!-- end 读者墙 -->
<?php the_content('Read more...'); ?></div>
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