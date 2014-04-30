<?php
include("functions/theme_options.php");
include("functions/foot.php");
include("functions/shortcode.php");
include('functions/basefunctions.php');
include('functions/function-user.php');
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
if ( function_exists( 'register_sidebar' ) ) {
    register_sidebar( array(
        'name' => '（通用）小工具',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
        'after_widget' => '',
    ) );
}
/**
  {
  register_sidebar( array(
  'name' => '（首页）小工具①',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'after_widget' => '',
  ) );
  } {
  register_sidebar( array(
  'name' => '（首页）小工具②',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'after_widget' => '',
  ) );
  } {
  register_sidebar( array(
  'name' => '（首页）小工具③',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'after_widget' => '',
  ) );
  } {
  register_sidebar( array(
  'name' => '（页面）小工具①',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'after_widget' => '',
  ) );
  } {
  register_sidebar( array(
  'name' => '（页面）小工具②',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'after_widget' => '',
  ) );
  } {
  register_sidebar( array(
  'name' => '（页面）小工具③',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'after_widget' => '',
  ) );
  } {
  register_sidebar( array(
  'name' => '（文章页）小工具①',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'after_widget' => '',
  ) );
  } {
  register_sidebar( array(
  'name' => '（文章页）小工具②',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'after_widget' => '',
  ) );
  } {
  register_sidebar( array(
  'name' => '（文章页）小工具③',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'after_widget' => '',
  ) );
  }
 */
// 自定义菜单
register_nav_menus(
        array(
            'top-menu' => __( '浮动导航菜单（一）' ),
            'second-menu' => __( '浮动导航菜单（二）' )
        )
);

//移除菜单的多余CSS选择器
add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1 );
add_filter( 'nav_menu_item_id', 'my_css_attributes_filter', 100, 1 );
add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1 );

function my_css_attributes_filter( $var ) {
    return is_array( $var ) ? array_intersect( $var, array( 'current-menu-item', 'current-post-ancestor', 'current-menu-ancestor', 'current-menu-parent' ) ) : '';
}

//Anti-Spam 防止垃圾评论
class anti_spam {

    function anti_spam() {
        if ( !current_user_can( 'read' ) ) {
            add_action( 'template_redirect', array( $this, 'w_tb' ), 1 );
            add_action( 'init', array( $this, 'gate' ), 1 );
            add_action( 'preprocess_comment', array( $this, 'sink' ), 1 );
        }
    }

    // 设栏位
    function w_tb() {
        if ( is_singular() ) {
            // 非中文语系
            if ( stripos( $_SERVER['HTTP_ACCEPT_LANGUAGE'], 'zh' ) === false ) {
                add_filter( 'comments_open', create_function( '', "return false;" ) ); // 关闭评论
            } else {
                ob_start( create_function( '$input', 'return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
        "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);' ) );
            }
        }
    }

    // 检查
    function gate() {
        $w = 'w';
        if ( !empty( $_POST[$w] ) && empty( $_POST['comment'] ) ) {
            $_POST['comment'] = $_POST[$w];
        } else {
            $request = $_SERVER['REQUEST_URI'];
            $way = isset( $_POST[$w] ) ? '手动操作' : '未经评论表格';
            $spamcom = isset( $_POST['comment'] ) ? $_POST['comment'] : '';
            $_POST['spam_confirmed'] = "请求: " . $request . "\n方式: " . $way . "\n内容: " . $spamcom . "\n -- 记录成功 --";
        }
    }

    // 处理
    function sink( $comment ) {
        // 不管 Trackbacks/Pingbacks
        if ( in_array( $comment['comment_type'], array( 'pingback', 'trackback' ) ) )
            return $comment;

        // 已确定为 spam
        if ( !empty( $_POST['spam_confirmed'] ) ) {
            // 方法一: 直接挡掉, 将 die(); 前面两斜线删除即可.
            die();
            // 方法二: 标记为 spam, 留在数据库检查是否误判.
            //add_filter('pre_comment_approved', create_function('', 'return "spam";'));
            //$comment['comment_content'] = "[ 小雪判断这是Spam! ]\n". $_POST['spam_confirmed'];
            //$this->add_black( $comment );
        } else {
            // 检查头像
            $f = md5( strtolower( $comment['comment_author_email'] ) );
            $g = sprintf( "http://%d.gravatar.com", (hexdec( $f{0} ) % 2 ) ) . '/avatar/' . $f . '?d=404';
            $headers = @get_headers( $g );
            if ( !preg_match( "|200|", $headers[0] ) ) {
                // 没头像的列入待审
                add_filter( 'pre_comment_approved', create_function( '', 'return "0";' ) );
                //$this->add_black( $comment );
            }
        }
        return $comment;
    }

    // 列入黑名单
    function add_black( $comment ) {
        if ( !($comment_author_url = $comment['comment_author_url']) )
            return;
        if ( strpos( $comment_author_url, '//' ) )
            $comment_author_url = substr( $comment_author_url, strpos( $comment_author_url, '//' ) + 2 );
        if ( strpos( $comment_author_url, '/' ) )
            $comment_author_url = substr( $comment_author_url, 0, strpos( $comment_author_url, '/' ) );
        update_option( 'blacklist_keys', $comment_author_url . "\n" . get_option( 'blacklist_keys' ) );
    }

}

$anti_spam = new anti_spam();

// 获得热评文章
function simple_get_most_viewed( $posts_num = 10, $days = 90 ) {
    global $wpdb;
    $sql = "SELECT ID , post_title , comment_count
            FROM $wpdb->posts
           WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
		   AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit')
           ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
    $posts = $wpdb->get_results( $sql );
    $output = "";
    foreach ( $posts as $post ) {
        $output .= "\n<li><a href= \"" . get_permalink( $post->ID ) . "\" rel=\"bookmark\" title=\"" . $post->post_title . " (" . $post->comment_count . "条评论)\" >" . mb_strimwidth( $post->post_title, 0, 36 ) . "</a></li>";
    }
    echo $output;
}

//标题文字截断
function cut_str( $src_str, $cut_length ) {
    $return_str = '';
    $i = 0;
    $n = 0;
    $str_length = strlen( $src_str );
    while ( ($n < $cut_length) && ($i <= $str_length) ) {
        $tmp_str = substr( $src_str, $i, 1 );
        $ascnum = ord( $tmp_str );
        if ( $ascnum >= 224 ) {
            $return_str = $return_str . substr( $src_str, $i, 3 );
            $i = $i + 3;
            $n = $n + 2;
        } elseif ( $ascnum >= 192 ) {
            $return_str = $return_str . substr( $src_str, $i, 2 );
            $i = $i + 2;
            $n = $n + 2;
        } elseif ( $ascnum >= 65 && $ascnum <= 90 ) {
            $return_str = $return_str . substr( $src_str, $i, 1 );
            $i = $i + 1;
            $n = $n + 2;
        } else {
            $return_str = $return_str . substr( $src_str, $i, 1 );
            $i = $i + 1;
            $n = $n + 1;
        }
    }
    if ( $i < $str_length ) {
        $return_str = $return_str . '';
    }
    if ( get_post_status() == 'private' ) {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}

//分页
function pagination( $query_string ) {
    global $posts_per_page, $paged;
    $my_query = new WP_Query( $query_string . "&posts_per_page=-1" );
    $total_posts = $my_query->post_count;
    if ( empty( $paged ) )
        $paged = 1;
    $prev = $paged - 1;
    $next = $paged + 1;
    $range = 5; // 修改数字,可以显示更多的分页链接
    $showitems = ($range * 2) + 1;
    $pages = ceil( $total_posts / $posts_per_page );
    if ( 1 != $pages ) {
        echo "<div class='pagination'>";
        echo ($paged > 2 && $paged + $range + 1 > $pages && $showitems < $pages) ? "<a href='" . get_pagenum_link( 1 ) . "' class='fir_las'>最前</a>" : "";
        echo ($paged > 1 && $showitems < $pages) ? "<a href='" . get_pagenum_link( $prev ) . "' class='page_previous'>« 上一页</a>" : "";
        for ( $i = 1; $i <= $pages; $i++ ) {
            if ( 1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) ) {
                echo ($paged == $i) ? "<span class='current'>" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class='inactive' >" . $i . "</a>";
            }
        }
        echo ($paged < $pages && $showitems < $pages) ? "<a href='" . get_pagenum_link( $next ) . "' class='page_next'>下一页 »</a>" : "";
        echo ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) ? "<a href='" . get_pagenum_link( $pages ) . "' class='fir_las'>最后</a>" : "";
        echo "</div>\n";
    }
}

//日志归档
class hacklog_archives {

    function GetPosts() {
        global $wpdb;
        if ( $posts = wp_cache_get( 'posts', 'ihacklog-clean-archives' ) )
            return $posts;
        $query = "SELECT DISTINCT ID,post_date,post_date_gmt,comment_count,comment_status,post_password FROM $wpdb->posts WHERE post_type='post' AND post_status = 'publish' AND comment_status = 'open'";
        $rawposts = $wpdb->get_results( $query, OBJECT );
        foreach ( $rawposts as $key => $post ) {
            $posts[mysql2date( 'Y.m', $post->post_date )][] = $post;
            $rawposts[$key] = null;
        }
        $rawposts = null;
        wp_cache_set( 'posts', $posts, 'ihacklog-clean-archives' );
        ;
        return $posts;
    }

    function PostList( $atts = array() ) {
        global $wp_locale;
        global $hacklog_clean_archives_config;
        $atts = shortcode_atts( array(
            'usejs' => $hacklog_clean_archives_config['usejs'],
            'monthorder' => $hacklog_clean_archives_config['monthorder'],
            'postorder' => $hacklog_clean_archives_config['postorder'],
            'postcount' => '1',
            'commentcount' => '1',
                ), $atts );
        $atts = array_merge( array( 'usejs' => 1, 'monthorder' => 'new', 'postorder' => 'new' ), $atts );
        $posts = $this->GetPosts();
        ( 'new' == $atts['monthorder'] ) ? krsort( $posts ) : ksort( $posts );
        foreach ( $posts as $key => $month ) {
            $sorter = array();
            foreach ( $month as $post )
                $sorter[] = $post->post_date_gmt;
            $sortorder = ( 'new' == $atts['postorder'] ) ? SORT_DESC : SORT_ASC;
            array_multisort( $sorter, $sortorder, $month );
            $posts[$key] = $month;
            unset( $month );
        }
        $html = '<div class="car-container';
        if ( 1 == $atts['usejs'] )
            $html .= ' car-collapse';
        $html .= '">' . "\n";
        if ( 1 == $atts['usejs'] )
            $html .= '<a href="#" class="car-toggler">展开所有月份' . "</a>\n\n";
        $html .= '<ul class="car-list">' . "\n";
        $firstmonth = TRUE;
        foreach ( $posts as $yearmonth => $posts ) {
            list( $year, $month ) = explode( '.', $yearmonth );
            $firstpost = TRUE;
            foreach ( $posts as $post ) {
                if ( TRUE == $firstpost ) {
                    $spchar = $firstmonth ? '<span class="car-toggle-icon car-minus">-</span>' : '<span class="car-toggle-icon car-plus">+</span>';
                    $html .= '	<li><span class="car-yearmonth" style="cursor:pointer;">' . $spchar . ' ' . sprintf( __( '%1$s %2$d' ), $wp_locale->get_month( $month ), $year );
                    if ( '0' != $atts['postcount'] ) {
                        $html .= ' <span title="文章数量">(共' . count( $posts ) . '篇文章)</span>';
                    }
                    if ( $firstmonth == FALSE ) {
                        $html .= "</span>\n		<ul class='car-monthlisting' style='display:none;'>\n";
                    } else {
                        $html .= "</span>\n		<ul class='car-monthlisting'>\n";
                    }
                    $firstpost = FALSE;
                    $firstmonth = FALSE;
                }
                $html .= '			<li>' . mysql2date( 'd', $post->post_date ) . '日: <a target="_blank" href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>';
                if ( '0' != $atts['commentcount'] && ( 0 != $post->comment_count || 'closed' != $post->comment_status ) && empty( $post->post_password ) )
                    $html .= ' <span title="评论数量">(' . $post->comment_count . '条评论)</span>';
                $html .= "</li>\n";
            }
            $html .= "		</ul>\n	</li>\n";
        }
        $html .= "</ul>\n</div>\n";
        return $html;
    }

    function PostCount() {
        $num_posts = wp_count_posts( 'post' );
        return number_format_i18n( $num_posts->publish );
    }

}

if ( !empty( $post->post_content ) ) {
    $all_config = explode( ';', $post->post_content );
    foreach ( $all_config as $item ) {
        $temp = explode( '=', $item );
        $hacklog_clean_archives_config[trim( $temp[0] )] = htmlspecialchars( strip_tags( trim( $temp[1] ) ) );
    }
} else {
    $hacklog_clean_archives_config = array( 'usejs' => 1, 'monthorder' => 'new', 'postorder' => 'new' );
}
$hacklog_archives = new hacklog_archives();

//密码保护提示
function password_hint( $c ) {
    global $post, $user_ID, $user_identity;
    if ( empty( $post->post_password ) )
        return $c;
    if ( isset( $_COOKIE['wp-postpass_' . COOKIEHASH] ) && stripslashes( $_COOKIE['wp-postpass_' . COOKIEHASH] ) == $post->post_password )
        return $c;
    if ( $hint = get_post_meta( $post->ID, 'password_hint', true ) ) {
        $url = get_option( 'siteurl' ) . '/wp-pass.php';
        if ( $hint )
            $hint = '密码提示：' . $hint;
        else
            $hint = "请输入您的密码";
        if ( $user_ID )
            $hint .= sprintf( '欢迎进入，您的密码是：', $user_identity, $post->post_password );
        $out = <<<END
<form method="post" action="$url">
<p>这篇文章是受保护的文章，请输入密码继续阅读：</p>
<div>
<label>$hint<br/>
<input type="password" name="post_password"/></label>
<input type="submit" value="输入密码" name="Submit"/>
</div>
</form>
END;
        return $out;
    }else {
        return $c;
    }
}

add_filter( 'the_content', 'password_hint' );

//支持外链缩略图
if ( function_exists( 'add_theme_support' ) )
    add_theme_support( 'post-thumbnails' );

function catch_first_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
    $first_img = $matches [1] [0];
    if ( empty( $first_img ) ) {
        $random = mt_rand( 1, 20 );
        echo get_bloginfo( 'stylesheet_directory' );
        echo '/images/random/tb' . $random . '.jpg';
    }
    return $first_img;
}

//自定义头像
add_filter( 'avatar_defaults', 'fb_addgravatar' );

function fb_addgravatar( $avatar_defaults ) {
    $myavatar = get_bloginfo( 'template_directory' ) . '/images/gravatar.png';
    $avatar_defaults[$myavatar] = '自定义头像';
    return $avatar_defaults;
}

// 评论回复/头像缓存
function tearsnow_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    global $commentcount, $wpdb, $post;
    if ( !$commentcount ) { //初始化楼层计数器
        $comments = $wpdb->get_results( "SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent" );
        $cnt = count( $comments ); //获取主评论总数量
        $page = get_query_var( 'cpage' ); //获取当前评论列表页码
        $cpp = get_option( 'comments_per_page' ); //获取每页评论显示数量
        if ( ceil( $cnt / $cpp ) == 1 || ($page > 1 && $page == ceil( $cnt / $cpp )) ) {
            $commentcount = $cnt + 1; //如果评论只有1页或者是最后一页，初始值为主评论总数
        } else {
            $commentcount = $cpp * $page + 1;
        }
    }
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
            <?php $add_below = 'div-comment'; ?>
            <div class="comment-author vcard"><?php if ( get_option( 'swt_type' ) == 'Display' ) { ?>
                    <?php
                    $p = 'avatar/';
                    $f = md5( strtolower( $comment->comment_author_email ) );
                    $a = $p . $f . '.jpg';
                    $e = ABSPATH . $a;
                    if ( !is_file( $e ) ) { //当头像不存在就更新
                        $d = get_bloginfo( 'wpurl' ) . '/avatar/default.jpg';
                        $s = '40'; //头像大小 自行根据自己模板设置
                        $r = get_option( 'avatar_rating' );
                        $g = 'http://www.gravatar.com/avatar/' . $f . '.jpg?s=' . $s . '&d=' . $d . '&r=' . $r;
                        $avatarContent = file_get_contents( $g );
                        file_put_contents( $e, $avatarContent );
                        if ( filesize( $e ) == 0 ) {
                            copy( $d, $e );
                        }
                    };
                    ?>
                    <img src='<?php bloginfo( 'wpurl' ); ?>/<?php echo $a ?>' alt='' class='avatar' />
                    <?php {
                        echo '';
                    }
                    ?>
                    <?php
                } else {
                    include(TEMPLATEPATH . '/comment_gravatar.php');
                }
                ?>
                <div class="floor"><?php
            if ( !$parent_id = $comment->comment_parent ) {
                switch ( $commentcount ) {
                    case 2 :echo "沙发";
                        --$commentcount;
                        break;
                    case 3 :echo "板凳";
                        --$commentcount;
                        break;
                    case 4 :echo "地板";
                        --$commentcount;
                        break;
                    default:printf( '%1$s楼', --$commentcount );
                }
            }
                ?>
                </div><strong><?php comment_author_link() ?></strong><?php get_author_class( $comment->comment_author_email, $comment->user_id ) ?>:<?php edit_comment_link( '编辑', '&nbsp;&nbsp;', '' ); ?></div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <span style="color:#C00; font-style:inherit">您的评论正在等待审核中...</span>
                <br />
            <?php endif; ?>
            <?php comment_text() ?>

            <div class="clear"></div><span class="datetime"><?php comment_date( 'Y-m-d' ) ?> <?php comment_time() ?> </span> <span class="reply"><?php
        if ( is_user_logged_in() ) {
            $url = get_bloginfo( 'url' );
            echo '<a id="delete-' . $comment->comment_ID . '" href="' . wp_nonce_url( "$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID ) . '"" >[删除]</a>';
        }
            ?> <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '[回复]', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
        </div>
        <?php
    }

    function tearsnow_end_comment() {
        echo '</li>';
    }

//回复内容可见
    function TearSnow_reply_to_read( $atts, $content = null ) {
        extract( shortcode_atts( array( "notice" => '<p class="reply-to-read"><strong style="color:#f00;">温馨提示:</strong> 此处内容需要您<a href="#respond" title="评论本文">评论本文</a>后才能查看!</p>' ), $atts ) );
        $email = null;
        $user_ID = (int) wp_get_current_user()->ID;
        if ( $user_ID > 0 ) {
            $email = get_userdata( $user_ID )->user_email;
            //对博主直接显示内容
            $admin_email = get_bloginfo( 'admin_email' );
            if ( $email == $admin_email ) {
                return $content;
            }
        } else if ( isset( $_COOKIE['comment_author_email_' . COOKIEHASH] ) ) {
            $email = str_replace( '%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH] );
        } else {
            return $notice;
        }
        if ( empty( $email ) ) {
            return $notice;
        }
        global $wpdb;
        $post_id = get_the_ID();
        $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
        if ( $wpdb->get_results( $query ) ) {
            return do_shortcode( $content );
        } else {
            return $notice;
        }
    }

    add_shortcode( 'reply', 'TearSnow_reply_to_read' );

//登陆显示头像
    function tearsnow_get_avatar( $email, $size = 48 ) {
        return get_avatar( $email, $size );
    }

//自动生成版权时间
    function comicpress_copyright() {
        global $wpdb;
        $copyright_dates = $wpdb->get_results( "
    SELECT
    YEAR(min(post_date_gmt)) AS firstdate,
    YEAR(max(post_date_gmt)) AS lastdate
    FROM
    $wpdb->posts
    WHERE
    post_status = 'publish'
    " );
        $output = '';
        if ( $copyright_dates ) {
            $copyright = "&copy; " . $copyright_dates[0]->firstdate;
            if ( $copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate ) {
                $copyright .= '-' . $copyright_dates[0]->lastdate;
            }
            $output = $copyright;
        }
        return $output;
    }

//评论邮件通知
    function comment_mail_notify( $comment_id ) {
        $admin_email = get_bloginfo( 'admin_email' ); // $admin_email 可改為你指定的 e-mail.
        $comment = get_comment( $comment_id );
        $comment_author_email = trim( $comment->comment_author_email );
        $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
        $to = $parent_id ? trim( get_comment( $parent_id )->comment_author_email ) : '';
        $spam_confirmed = $comment->comment_approved;
        if ( ($parent_id != '') && ($spam_confirmed != 'spam') && ($to != $admin_email) && ($comment_author_email == $admin_email) ) {
            $wp_email = 'no-reply@' . preg_replace( '#^www\.#', '', strtolower( $_SERVER['SERVER_NAME'] ) ); // e-mail 發出點, no-reply 可改為可用的 e-mail.
            $subject = '您在 [' . get_option( "blogname" ) . '] 的评论有新的回复';
            $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
      <p>' . trim( get_comment( $parent_id )->comment_author ) . ', 您好!</p>
      <p>您曾在 [' . get_option( "blogname" ) . '] 的 《' . get_the_title( $comment->comment_post_ID ) . '》 的留言为:<br />'
                    . nl2br( get_comment( $parent_id )->comment_content ) . '</p>
      <p>' . trim( $comment->comment_author ) . ' 给您的回复的是:<br />'
                    . nl2br( $comment->comment_content ) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars( get_comment_link( $parent_id ) ) . '">查看完整內容</a></p>
      <p>欢迎再次光临 <a href="' . get_option( 'home' ) . '">' . get_option( 'blogname' ) . '</a></p>
      <p>(本邮件由系统自动发出, 请勿回复.)</p>
    </div>';
            $message = convert_smilies( $message );
            $from = "From: \"" . get_option( 'blogname' ) . "\" <$wp_email>";
            $headers = "$from\nContent-Type: text/html; charset=" . get_option( 'blog_charset' ) . "\n";
            wp_mail( $to, $subject, $message, $headers );
            //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
        }
    }

    add_action( 'comment_post', 'comment_mail_notify' );

//移除头部多余信息
    remove_action( 'wp_head', 'wp_generator' ); //禁止在head泄露wordpress版本号
    remove_action( 'wp_head', 'feed_links', 2 ); //移除包含文章和评论的feed
    remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除额外的feed，例如category, tag页
    remove_action( 'wp_head', 'rsd_link' ); //移除head中的rel="EditURI"
    remove_action( 'wp_head', 'wlwmanifest_link' ); //移除head中的rel="wlwmanifest"
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); //rel=pre
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); //rel=shortlink
    remove_action( 'wp_head', 'rel_canonical' );

//禁止自动保存和修改历史记录
    add_action( 'wp_print_scripts', 'no_autosave' );
    remove_action( 'pre_post_update', 'wp_save_post_revision' );

    function no_autosave() {
        wp_deregister_script( 'autosave' );
    }

//面包屑导航
    function breadcrunbs() {
        if ( is_single() ) {
            echo '<div id="breadcrumbs">您当前位置 : <a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'name' ) . '">' . get_bloginfo( 'name' ) . '</a> » ';
            $category = get_the_category();
            if ( $category ) {
                echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category[0]->name ) . '" ' . '>' . $category[0]->name . '</a> » ';
            }
            echo the_title();
            echo '</div>';
        } else if ( is_home() ) {
            echo '<div id="breadcrumbs">您当前位置 : <a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'name' ) . '">首页</a></div>';
        } else if ( is_category() ) {
            echo '<div id="breadcrumbs">您当前位置 : <a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'name' ) . '">' . get_bloginfo( 'name' ) . '</a> » 所有属于 "';
            echo single_cat_title();
            echo '" 分类的文章</div>';
        } else if ( is_tag() ) {
            echo '<div id="breadcrumbs">您当前位置 : <a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'name' ) . '">' . get_bloginfo( 'name' ) . '</a> » 所有属于 "';
            echo single_cat_title();
            echo '" 标签的文章</div>';
        } else if ( is_page() ) {
            echo '<div id="breadcrumbs">您当前位置 : <a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'name' ) . '">' . get_bloginfo( 'name' ) . '</a> » ';
            echo the_title();
            echo '</div>';
        } else if ( is_404() ) {
            echo '<div id="breadcrumbs">您当前位置 : <a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'name' ) . '">' . get_bloginfo( 'name' ) . '</a> » ';
            echo _e( '未找到指定的页面( ERROR 404 )' );
            echo '</div>';
        } else if ( is_archive() ) {
            echo '<div id="breadcrumbs">您当前位置 : <a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'name' ) . '">' . get_bloginfo( 'name' ) . '</a> » ';
            $post = $posts[0];
            if ( is_day() ) {
                echo '所有 "';
                echo the_time( 'Y年m月d日' );
                echo '" 的文章';
            } elseif ( is_month() ) {
                echo '所有 "';
                echo the_time( 'Y年m月' );
                echo '" 的文章';
            } elseif ( is_year() ) {
                echo '所有 "';
                echo the_time( 'Y年' );
                echo '" 的文章';
            }
            echo '</div>';
        } if ( is_search() ) {
            echo '<div id="breadcrumbs">您当前位置 : <a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'name' ) . '">' . get_bloginfo( 'name' ) . '</a> » 关键词 "';
            echo the_search_query();
            echo '" 的搜索结果';
            echo '</div>';
        } else {

        }
    }

//获取访客VIP样式
    function get_author_class( $comment_author_email, $user_id ) {
        global $wpdb;
        $adminEmail = get_option( 'admin_email' );
        $author_count = count( $wpdb->get_results(
                        "SELECT comment_ID as author_count FROM  $wpdb->comments WHERE comment_author_email = '$comment_author_email' " ) );
        if ( $user_id != 0 && $comment_author_email == $adminEmail )
            echo '<a class="host" title="博主"></a>';
        //这里是博主的特殊样式
        if ( $user_id != 0 && $comment_author_email != $adminEmail )
            echo '<a class="vip" title="博主认证"></a>';
        if ( $author_count >= 10 && $author_count < 30 )
            echo '<a class="vip1" title="评论之星 LV.1"></a>';
        else if ( $author_count >= 30 && $author_count < 50 )
            echo '<a class="vip2" title="评论之星 LV.2"></a>';
        else if ( $author_count >= 50 && $author_count < 100 )
            echo '<a class="vip3" title="评论之星 LV.3"></a>';
        else if ( $author_count >= 100 && $author_count < 300 )
            echo '<a class="vip4" title="评论之星 LV.4"></a>';
        else if ( $author_count >= 300 && $author_count < 500 )
            echo '<a class="vip5" title="评论之星 LV.5"></a>';
        else if ( $author_count >= 500 && $author_coun < 1000 )
            echo '<a class="vip6" title="评论之星 LV.6"></a>';
        else if ( $author_count >= 1000 )
            echo '<a class="vip7" title="评论之星 LV.7"></a>';
    }

//评论表情路径
    add_filter( 'smilies_src', 'custom_smilies_src', 1, 10 );

    function custom_smilies_src( $img_src, $img, $siteurl ) {
        return get_bloginfo( 'template_directory' ) . '/images/smiley/' . $img;
    }

//自动添加暗箱标签属性
    add_filter( 'the_content', 'pirobox_gall_replace' );

    function pirobox_gall_replace( $content ) {
        global $post;
        $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
        $replacement = '<a$1href=$2$3.$4$5 class="pirobox_gall"$6>$7</a>';
        $content = preg_replace( $pattern, $replacement, $content );
        return $content;
    }

//向来自其他域的访客致欢迎词
    function TearSnow_set_notify_cookie() {
        if ( empty( $_COOKIE['notify_cookie'] ) )
            setcookie( 'notify_cookie', md5( $_SERVER['REMOTE_ADDR'] . $_SERVER['USER_AGENT'] ), time() + 3600 * 24 * 30 );
    }

    add_action( 'init', 'TearSnow_set_notify_cookie' );

    function TearSnow_show_notify() {
        $show = 0;
        $extra_msg = '';
        if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
            $url = parse_url( $_SERVER['HTTP_REFERER'] );
            if ( isset( $url['port'] ) )
                $ref_host = $url['host'] . ':' . $url['port'];
            else
                $ref_host = $url['host'];
            if ( $ref_host != $_SERVER['HTTP_HOST'] ) {
                $show = 1;
                $ref_url = $url['scheme'] . '://' . $ref_host;
                $extra_msg = '<a href="' . $ref_url . '"  target="_blank">' . $ref_host . '</a>';
            }
        }
        if ( empty( $_COOKIE['notify_cookie'] ) || $show )
            if ( get_option( 'swt_welcome' ) == 'Display' ) {
                echo "<div id=\"hellovisitor\">来自" . $extra_msg . "的朋友,欢迎您 <b><a href=\"";
                echo stripslashes( get_option( 'swt_feedurl' ) );
                echo "\" target=\"_blank\">点击这里</a></b> 订阅我的博客 o(∩_∩)o~~~<div class=\"closebox\"><a href=\"javascript:void(0)\" onclick=\"$('#hellovisitor').slideUp('slow');$('.closebox').css('display','none');\" title=\"关闭\">×</a></div></div>";
            }
    }

//gzip
//function gzip() {
//	ob_start('ob_gzhandler');
//}
//if(!stristr($_SERVER['REQUEST_URI'], //'tinymce') && !ini_get//('zlib.output_compression')) {
//	add_action('init', 'gzip');
//}
//字数统计
    function count_words( $text ) {
        global $post;
        if ( '' == $text ) {
            $text = $post->post_content;
            if ( mb_strlen( $output, 'UTF-8' ) < mb_strlen( $text, 'UTF-8' ) )
                $output .= '' . mb_strlen( preg_replace( '/\s/', '', html_entity_decode( strip_tags( $post->post_content ) ) ), 'UTF-8' ) . '';
            return $output;
        }
    }

//禁止代码标点转换
    remove_filter( 'the_content', 'wptexturize' );

//后台编辑器增强
    function add_editor_buttons( $buttons ) {
        $buttons[] = 'fontselect';
        $buttons[] = 'fontsizeselect';
        $buttons[] = 'cleanup';
        $buttons[] = 'styleselect';
        $buttons[] = 'hr';
        $buttons[] = 'del';
        $buttons[] = 'sub';
        $buttons[] = 'sup';
        $buttons[] = 'copy';
        $buttons[] = 'paste';
        $buttons[] = 'cut';
        $buttons[] = 'undo';
        $buttons[] = 'image';
        $buttons[] = 'anchor';
        $buttons[] = 'backcolor';
        $buttons[] = 'wp_page';
        $buttons[] = 'charmap';
        return $buttons;
    }

    add_filter( "mce_buttons_3", "add_editor_buttons" );

//去除评论中的链接
    remove_filter( 'comment_text', 'make_clickable', 9 );

//小工具屏蔽
    add_action( 'widgets_init', 'my_unregister_widgets' );

    function my_unregister_widgets() {
        unregister_widget( 'WP_Widget_Search' );
    }

//阻止站内文章Pingback
    function tearsnow_noself_ping( &$links ) {
        $home = get_option( 'home' );
        foreach ( $links as $l => $link )
            if ( 0 === strpos( $link, $home ) )
                unset( $links[$l] );
    }

//留言信息
    function WelcomeCommentAuthorBack( $email = '' ) {
        if ( empty( $email ) ) {
            return;
        }
        global $wpdb;

        $past_30days = gmdate( 'Y-m-d H:i:s', ((time() - (24 * 60 * 60 * 30)) + (get_option( 'gmt_offset' ) * 3600) ) );
        $sql = "SELECT count(comment_author_email) AS times FROM $wpdb->comments
					WHERE comment_approved = '1'
					AND comment_author_email = '$email'
					AND comment_date >= '$past_30days'";
        $times = $wpdb->get_results( $sql );
        $times = ($times[0]->times) ? $times[0]->times : 0;
        $message = $times ? sprintf( __( '过去30天内您有<strong>%1$s</strong>条留言，感谢关注!' ), $times ) : '您已很久都没有留言了，这次想说点什么？';

        return $message;
    }

//访问计数
    function record_visitors() {
        if ( is_singular() ) {
            global $post;
            $post_ID = $post->ID;
            if ( $post_ID ) {
                $post_views = (int) get_post_meta( $post_ID, 'views', true );
                if ( !update_post_meta( $post_ID, 'views', ($post_views + 1 ) ) ) {
                    add_post_meta( $post_ID, 'views', 1, true );
                }
            }
        }
    }

    add_action( 'wp_head', 'record_visitors' );

    function post_views( $before = '(阅读 ', $after = ' 次)', $echo = 1 ) {
        global $post;
        $post_ID = $post->ID;
        $views = (int) get_post_meta( $post_ID, 'views', true );
        if ( $echo )
            echo $before, number_format( $views ), $after;
        else
            return $views;
    }

    ;

//添加编辑器快捷按钮
    add_action( 'admin_print_scripts', 'my_quicktags' );

    function my_quicktags() {
        wp_enqueue_script(
                'my_quicktags', get_stylesheet_directory_uri() . '/js/quicktags.js', array( 'quicktags' )
        );
    }

//算术验证码
    function spam_provent_math() {
        $a = rand( 3, 12 );
        $b = rand( 3, 12 );
        echo "<input type='text' name='sum' id='sum'  size='22' tabindex='3' value='动手又动脑，哦也 ！' onfocus='if (this.value != \"\") {this.value = \"\";}' onblur='if (this.value == \"\") {this.value = \"动手又动脑，哦也 ！\";}' /> = $a + $b （<font color='#666'>防止机器人评论</font>）" . "<input type='hidden' name='a' value='$a'/>" . "<input type='hidden' name='b' value='$b'/>";
    }

    function spam_provent_pre( $spam_result ) {
        $sum = $_POST['sum'];
        switch ( $sum ) {
            case $_POST['a'] + $_POST['b']:break;
            case null:err( '亲，算个结果撒' );
                break;
            default:err( '算错啦⊙﹏⊙b汗' );
        }
        return $spam_result;
    }

//注册用户or管理员则不需要验证
    if ( !is_user_logged_in() && $comment_data['comment_type'] == '' ) {
        add_filter( 'preprocess_comment', 'spam_provent_pre' );
    }

//全部设置结束
    ?>
