<?php

/*

Template Name: 随机阅读

*/

?>
<title>正在加载...</title>	
<?php $rand_post=get_posts('numberposts=1&orderby=rand'); foreach($rand_post as $post) : ?>
<script> location="<?php the_permalink(); ?>";</script>
<?php endforeach; ?>