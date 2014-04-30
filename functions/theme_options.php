<?php
$themename = "TearSnow";
$shortname = "swt";

$categories = get_categories( 'hide_empty=0&orderby=name' );
$wp_cats = array();
foreach ( $categories as $category_list ) {
    $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/css/';
$alt_stylesheets = array();
$alt_stylesheets[] = '';

if ( is_dir( $alt_stylesheet_path ) ) {
    if ( $alt_stylesheet_dir = opendir( $alt_stylesheet_path ) ) {
        while ( ($alt_stylesheet_file = readdir( $alt_stylesheet_dir )) !== false ) {
            if ( stristr( $alt_stylesheet_file, ".css" ) !== false ) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }
    }
}
$number_entries = array( "Select a Number:", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "12", "14", "16", "18", "20" );
$options = array(
    array( "name" => $themename . " Options",
        "type" => "title" ),
//选择颜色风格
    array( "name" => "选择颜色风格",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "选择颜色风格",
        "desc" => "还有6种主题风格供选择",
        "id" => $shortname . "_alt_stylesheet",
        "std" => "Select a CSS skin:",
        "type" => "select",
        "options" => $alt_stylesheets,
        "default_option_value" => "默认风格" ),
//首页布局设置开始
    array( "type" => "close" ),
    array( "name" => "缓存头像设置",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "是否开启头像缓存",
        "desc" => "默认不开启,部分服务器不支持，如出错请关闭",
        "id" => $shortname . "_type",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
//防机器人评论
    array( "type" => "close" ),
    array( "name" => "防垃圾评论设置",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "是否开算数验证码",
        "desc" => "默认不开启,开启后可以有效的防止机器人评论",
        "id" => $shortname . "_math",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
//各功能模块控制
    array( "type" => "close" ),
    array( "name" => "综合功能开关设置",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "输入需隐藏的目录ID",
        "desc" => "如：-1,-12多个用半角逗号隔开，不需要的请留空",
        "id" => $shortname . "_lists",
        "type" => "text",
        "std" => "" ),
    array( "name" => "是否显示缩略图",
        "desc" => "默认不显示",
        "id" => $shortname . "_thumbnail",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "是否显示文章截图型缩略图",
        "desc" => "默认不显示（开启前确认“是否显示缩略图”已开启）",
        "id" => $shortname . "_articlepic",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "是否显示加载特效",
        "desc" => "默认不显示",
        "id" => $shortname . "_loading",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "是否显示表情",
        "desc" => "默认不显示",
        "id" => $shortname . "_smiley",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "是否显示侧边读者墙",
        "desc" => "默认显示",
        "id" => $shortname . "_wallreaders",
        "type" => "select",
        "std" => "Hide",
        "options" => array( "Display", "Hide" ) ),
    array( "name" => "是否显示首页登录框",
        "desc" => "默认不显示，安全起见，建议关闭",
        "id" => $shortname . "_login",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "是否显示WordPress版本号",
        "desc" => "默认不显示",
        "id" => $shortname . "_version",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "是否显示访客30天内留言条数",
        "desc" => "默认不显示",
        "id" => $shortname . "_authorback",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "是否显示其他域名来访欢迎词",
        "desc" => "默认不显示",
        "id" => $shortname . "_welcome",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入Feed订阅地址",
        "desc" => "",
        "id" => $shortname . "_feedurl",
        "type" => "text",
        "std" => "http://feed.leiue.com" ),
//SEO设置
    array( "type" => "close" ),
    array( "name" => "网站SEO设置(必填)",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "描述（Description）",
        "desc" => "用于搜索引擎索引，勿超过200个字符",
        "id" => $shortname . "_description",
        "type" => "textarea",
        "std" => "本博客是一个专注于互联网、SEO优化、网络营销、IT行业的独立博客，提供网络知识和网站运营技巧，是一个值得IT从业人员收藏的博客。愿与大家共同打造属于自己的互联之梦！" ),
    array( "name" => "关键词（KeyWords）",
        "desc" => "不超过100个字符，中间用英文逗号“,”隔开",
        "id" => $shortname . "_keywords",
        "type" => "textarea",
        "std" => "SEO优化,SEO误区,搜索引擎研究,网站运营,关键词选择,网络营销,电子商务,网络推广,推广技巧,营销策略,建站必备,Tear Snow Fan" ),
//顶栏、微博以及订阅设置
    array( "type" => "close" ),
    array( "name" => "顶栏、微博及订阅设置",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "是否显示顶栏",
        "desc" => "默认显示",
        "id" => $shortname . "_toplan",
        "type" => "select",
        "std" => "Hide",
        "options" => array( "Display", "Hide" ) ),
    array( "name" => "请输入logo地址",
        "desc" => "可用相对路径，绝对请加“http://”",
        "id" => $shortname . "_logodress",
        "type" => "text",
        "std" => "/wp-content/themes/TearSnow/images/logo.png" ),
    array( "name" => "请输入我想说头像邮箱",
        "desc" => "输入Gravatar的注册邮箱，才能正确显示头像",
        "id" => $shortname . "_Gravatar",
        "type" => "text",
        "std" => "leixue@leiue.com" ),
    array( "name" => "我想说内容",
        "desc" => "注意输入内容不要过长",
        "id" => $shortname . "_isay",
        "type" => "textarea",
        "std" => "做事以最积极的行动，最乐观的心态，做最坏的打算！！！" ),
    array( "name" => "是否显示腾讯微博",
        "desc" => "默认不显示",
        "id" => $shortname . "_tqq",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入腾讯微博地址",
        "desc" => "",
        "id" => $shortname . "_tqqurl",
        "type" => "text",
        "std" => "http://t.qq.com/leixue520" ),
    array( "name" => "是否显示新浪微博",
        "desc" => "默认不显示",
        "id" => $shortname . "_tsina",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入新浪微博地址",
        "desc" => "",
        "id" => $shortname . "_tsinaurl",
        "type" => "text",
        "std" => "http://weibo.com/zifanz" ),
    array( "name" => "是否显示用QQ邮箱订阅博客",
        "desc" => "默认不显示",
        "id" => $shortname . "_mailqq",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "是否显示顶栏订阅框",
        "desc" => "默认不显示",
        "id" => $shortname . "_maildy",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入腾讯邮件订阅ID",
        "desc" => "必须输入你申请的ID，否则无法订阅",
        "id" => $shortname . "_emailid",
        "type" => "text",
        "std" => "0dbf0a9ce67538363ece01ba2557eb947222eaa7a49fce6c" ),
//博客统计设置
    array( "type" => "close" ),
    array( "name" => "侧边栏统计设置(必填)",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "用户名",
        "desc" => "",
        "id" => $shortname . "_user",
        "type" => "text",
        "std" => "泪雪" ),
    array( "name" => "建站日期",
        "desc" => "",
        "id" => $shortname . "_builddate",
        "type" => "text",
        "std" => "2012-01-01" ),
//底部导航菜单设置
    array( "type" => "close" ),
    array( "name" => "底部自定义导航设置",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "是否显示底部导航菜单",
        "desc" => "默认不显示（此选项将关闭所有底部导航）",
        "id" => $shortname . "_fm",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "是否显示自定义底部导航",
        "desc" => "默认不显示",
        "id" => $shortname . "_mycode",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入自定义底部导航",
        "desc" => "请输入自定义菜单代码",
        "id" => $shortname . "_mycodes",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "是否显示导航菜单（一）",
        "desc" => "默认不显示",
        "id" => $shortname . "_fma",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入导航菜单名称（一）",
        "desc" => "请输入自定义菜单名",
        "id" => $shortname . "_fmaname",
        "type" => "text",
        "std" => "" ),
    array( "name" => "输入导航菜单链接（一）",
        "desc" => "使用绝对链接需加“http://”",
        "id" => $shortname . "_fmalink",
        "type" => "text",
        "std" => "" ),
    array( "name" => "是否显示导航菜单（二）",
        "desc" => "默认不显示",
        "id" => $shortname . "_fmb",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入导航菜单名称（二）",
        "desc" => "请输入自定义菜单名",
        "id" => $shortname . "_fmbname",
        "type" => "text",
        "std" => "" ),
    array( "name" => "输入导航菜单链接（二）",
        "desc" => "使用绝对链接需加“http://”",
        "id" => $shortname . "_fmblink",
        "type" => "text",
        "std" => "" ),
    array( "name" => "是否显示导航菜单（三）",
        "desc" => "默认不显示",
        "id" => $shortname . "_fmc",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入导航菜单名称（三）",
        "desc" => "请输入自定义菜单名",
        "id" => $shortname . "_fmcname",
        "type" => "text",
        "std" => "" ),
    array( "name" => "输入导航菜单链接（三）",
        "desc" => "使用绝对链接需加“http://”",
        "id" => $shortname . "_fmclink",
        "type" => "text",
        "std" => "" ),
    array( "name" => "是否显示导航菜单（四）",
        "desc" => "默认不显示",
        "id" => $shortname . "_fmd",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入导航菜单名称（四）",
        "desc" => "请输入自定义菜单名",
        "id" => $shortname . "_fmdname",
        "type" => "text",
        "std" => "" ),
    array( "name" => "输入导航菜单链接（四）",
        "desc" => "使用绝对链接需加“http://”",
        "id" => $shortname . "_fmdlink",
        "type" => "text",
        "std" => "" ),
    array( "name" => "是否显示导航菜单（五）",
        "desc" => "默认不显示",
        "id" => $shortname . "_fme",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入导航菜单名称（五）",
        "desc" => "请输入自定义菜单名",
        "id" => $shortname . "_fmename",
        "type" => "text",
        "std" => "" ),
    array( "name" => "输入导航菜单链接（五）",
        "desc" => "使用绝对链接需加“http://”",
        "id" => $shortname . "_fmelink",
        "type" => "text",
        "std" => "" ),
//底部网站地图及赞助链接设置
    array( "type" => "close" ),
    array( "name" => "底部网站地图及赞助链接设置",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "是否显示百度地图链接",
        "desc" => "默认不显示（推荐使用配套插件生成）",
        "id" => $shortname . "_baidu",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入网站地图名称",
        "desc" => "此处默认是百度地图，一般不做修改",
        "id" => $shortname . "_bddtname",
        "type" => "text",
        "std" => "百度地图" ),
    array( "name" => "输入你的网站地图链接",
        "desc" => "使用绝对链接需加“http://”，使用本主题配套插件生成便无需更改链接",
        "id" => $shortname . "_bddtlink",
        "type" => "text",
        "std" => "/sitemap_baidu.xml" ),
    array( "name" => "是否显示谷歌地图链接",
        "desc" => "默认不显示（推荐使用配套插件生成）",
        "id" => $shortname . "_google",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入网站地图名称",
        "desc" => "此处默认是谷歌地图，一般不做修改",
        "id" => $shortname . "_googledtname",
        "type" => "text",
        "std" => "谷歌地图" ),
    array( "name" => "输入你的网站地图链接",
        "desc" => "使用绝对链接需加“http://”，使用本主题配套插件生成便无需更改链接",
        "id" => $shortname . "_googledtlink",
        "type" => "text",
        "std" => "/sitemap.xml" ),
    array( "name" => "是否显示html网站地图链接",
        "desc" => "默认不显示（推荐使用配套插件生成）",
        "id" => $shortname . "_website",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入网站地图名称",
        "desc" => "此处默认是html网站地图，一般不做修改",
        "id" => $shortname . "_websitedtname",
        "type" => "text",
        "std" => "网站地图" ),
    array( "name" => "输入你的网站地图链接",
        "desc" => "使用绝对链接需加“http://”，使用本主题配套插件生成便无需更改链接",
        "id" => $shortname . "_websitedtlink",
        "type" => "text",
        "std" => "/sitemap.html" ),
    array( "name" => "是否显示赞助商链接",
        "desc" => "默认不显示",
        "id" => $shortname . "_zanzhu",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入赞助类型",
        "desc" => "提示输入：服务器赞助商/空间赞助商/宽带赞助商",
        "id" => $shortname . "_zanzhuwhat",
        "type" => "text",
        "std" => "赞助商" ),
    array( "name" => "输入赞助商名称",
        "desc" => "主要是用作感谢空间或宽带赞助提供商",
        "id" => $shortname . "_zanzhuname",
        "type" => "text",
        "std" => "" ),
    array( "name" => "输入你赞助商的链接",
        "desc" => "链接必须使用“http://”的完整链接",
        "id" => $shortname . "_zanzhulink",
        "type" => "text",
        "std" => "" ),
//网站统计、备案号
    array( "type" => "close" ),
    array( "name" => "统计代码及备案号设置",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "是否显示网站统计",
        "desc" => "默认不显示",
        "id" => $shortname . "_tj",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入你的网站统计代码",
        "desc" => "",
        "id" => $shortname . "_tjcode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "是否显示备案号",
        "desc" => "默认不显示",
        "id" => $shortname . "_beian",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入您的备案号",
        "desc" => "",
        "id" => $shortname . "_beianhao",
        "type" => "text",
        "std" => "蜀ICP备11023373号" ),
//广告设置
    array( "type" => "close" ),
    array( "name" => "博客广告设置",
        "type" => "section" ),
    array( "type" => "open" ),
    array( "name" => "是否显示侧边栏广告(首页)",
        "desc" => "默认不显示",
        "id" => $shortname . "_ada",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入首页侧边栏广告代码(1)(250*250)",
        "desc" => "首页侧边栏",
        "id" => $shortname . "_adxcode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "输入首页侧边栏广告代码(2)(250*250)",
        "desc" => "首页侧边栏",
        "id" => $shortname . "_adycode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "输入首页侧边栏广告代码(3)(250*250)",
        "desc" => "首页侧边栏",
        "id" => $shortname . "_adzcode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "是否显示侧边栏广告(页面)",
        "desc" => "默认不显示",
        "id" => $shortname . "_adaa",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入页面侧边栏广告代码(1)(250*250)",
        "desc" => "页面侧边栏",
        "id" => $shortname . "_adxxcode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "输入页面侧边栏广告代码(2)(250*250)",
        "desc" => "页面侧边栏",
        "id" => $shortname . "_adyycode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "输入页面侧边栏广告代码(3)(250*250)",
        "desc" => "页面侧边栏",
        "id" => $shortname . "_adzzcode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "是否显示侧边栏广告(文章页)",
        "desc" => "默认不显示",
        "id" => $shortname . "_adaaa",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入文章页侧边栏广告代码(1)(250*250)",
        "desc" => "文章页侧边栏",
        "id" => $shortname . "_adxxxcode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "输入文章页侧边栏广告代码(2)(250*250)",
        "desc" => "文章页侧边栏",
        "id" => $shortname . "_adyyycode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "输入文章页侧边栏广告代码(3)(250*250)",
        "desc" => "文章页侧边栏",
        "id" => $shortname . "_adzzzcode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "是否显示文章顶部广告",
        "desc" => "默认不显示",
        "id" => $shortname . "_adb",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入文章顶部广告代码(宽度需小于690)",
        "desc" => "",
        "id" => $shortname . "_adbcode",
        "type" => "textarea",
        "std" => "" ),
    array( "name" => "是否显示文章底部广告",
        "desc" => "默认不显示",
        "id" => $shortname . "_adc",
        "type" => "select",
        "std" => "Display",
        "options" => array( "Hide", "Display" ) ),
    array( "name" => "输入文章底部广告代码(宽度需小于620)",
        "desc" => "",
        "id" => $shortname . "_adccode",
        "type" => "textarea",
        "std" => "" ),
    array( "type" => "close" )
);

function mytheme_add_admin() {
    global $themename, $shortname, $options;
    if ( $_GET['page'] == basename( __FILE__ ) ) {
        if ( 'save' == $_REQUEST['action'] ) {
            foreach ( $options as $value ) {
                update_option( $value['id'], $_REQUEST[$value['id']] );
            }
            foreach ( $options as $value ) {
                if ( isset( $_REQUEST[$value['id']] ) ) {
                    update_option( $value['id'], $_REQUEST[$value['id']] );
                } else {
                    delete_option( $value['id'] );
                }
            }
            header( "Location: admin.php?page=theme_options.php&saved=true" );
            die;
        } else if ( 'reset' == $_REQUEST['action'] ) {
            foreach ( $options as $value ) {
                delete_option( $value['id'] );
            }
            header( "Location: admin.php?page=theme_options.php&reset=true" );
            die;
        }
    }
    add_theme_page( $themename . " Options", "当前主题设置", 'edit_themes', basename( __FILE__ ), 'mytheme_admin' );
}

function mytheme_add_init() {
    $file_dir = get_bloginfo( 'template_directory' );
    wp_enqueue_style( "functions", $file_dir . "/includes/options/options.css", false, "1.0", "all" );
    wp_enqueue_script( "rm_script", $file_dir . "/includes/options/rm_script.js", false, "1.0" );
}

function mytheme_admin() {
    global $themename, $shortname, $options;
    $i = 0;
    if ( $_REQUEST['saved'] )
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' 主题设置已保存</strong></p></div>';
    if ( $_REQUEST['reset'] )
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' 主题已重新设置</strong></p></div>';
    ?>
    <script type="text/javascript" language="JavaScript" src="http://zhangzifan.com/file/js/tearsnow_latest_version.js" charset=“utf-8”></script>
    <script type="text/javascript">
        var _version = '<?php
    $theme_data = get_theme_data( dirname( __FILE__ ) . '/../style.css' );
    echo $theme_data['Version'];
    ?>';
        jQuery(document).ready(function() {
            jQuery("span.version_number").text(tearsnowtheme_latest_version);
            jQuery("span.latest_update").text(tearsnow_latest_update);
            jQuery("span.text").text(intext);
            jQuery("a.author_add").attr("href", author_add);
            if (_version < tearsnowtheme_latest_version) {
                jQuery(".version_tips").fadeIn(1000);
            }
            else {
                jQuery(".version_tips").hide();
            }
            ;
            jQuery(".close_version_tips").click(function() {
                jQuery(this).parent().fadeOut(1000);
            });
            jQuery(".fl_cbradio_op:checked").each(function() {
                jQuery(this).parent().parent().children().eq(3).show();
            });
            jQuery(".fl_cbradio_cl:checked").each(function() {
                jQuery(this).parent().parent().children().eq(3).hide();
            });
            jQuery(".fl_cbradio_cl").click(function() {
                jQuery(this).parent().parent().children().eq(3).slideUp();
            });
            jQuery(".fl_cbradio_op").click(function() {
                jQuery(this).parent().parent().children().eq(3).slideDown();
            });
            jQuery(".theme_options_content > div:not(:first)").hide();
            jQuery(".theme_options_tab li").each(function(index) {
                jQuery(this).click(
                        function() {
                            jQuery(".theme_options_tab li.current").removeClass("current");
                            jQuery(this).addClass("current");
                            jQuery(".theme_options_content > div:visible").hide();
                            jQuery(".theme_options_content > div:eq(" + index + ")").show();
                        })
            })
        })
    </script>

    <div class="wrap rm_wrap">
        <h2><?php echo $themename; ?> 设置</h2>
        <div class="clear"></div>
        <div class="rm_opts">
            <div class="rm_opts">
                <form method="post">
                    <?php
                    foreach ( $options as $value ) {
                        switch ( $value['type'] ) {
                            case "open":
                                ?>
                                <?php
                                break;
                            case "close":
                                ?>
                        </div>
                    </div>
                    <br />
                    <?php
                    break;
                case "title":
                    ?>
                    <?php
                    break;
                case 'text':
                    ?>
                    <div class="rm_input rm_text">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php
                        if ( get_settings( $value['id'] ) != "" ) {
                            echo stripslashes( get_settings( $value['id'] ) );
                        } else {
                            echo $value['std'];
                        }
                        ?>" />
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    </div>
                    <?php
                    break;
                case 'textarea':
                    ?>
                    <div class="rm_input rm_textarea">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php
                            if ( get_settings( $value['id'] ) != "" ) {
                                echo stripslashes( get_settings( $value['id'] ) );
                            } else {
                                echo $value['std'];
                            }
                            ?></textarea>
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    </div>
                    <?php
                    break;
                case 'select':
                    ?>
                    <div class="rm_input rm_select">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                            <?php foreach ( $value['options'] as $option ) { ?>
                                <option value="<?php echo $option; ?>" <?php
                                if ( get_settings( $value['id'] ) == $option ) {
                                    echo 'selected="selected"';
                                }
                                ?>>
                                            <?php
                                            if ( (empty( $option ) || $option == '' ) && isset( $value['default_option_value'] ) ) {
                                                echo $value['default_option_value'];
                                            } else {
                                                echo $option;
                                            }
                                            ?>

                                </option><?php } ?>
                        </select>
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    </div>
                    <?php
                    break;
                case "checkbox":
                    ?>
                    <div class="rm_input rm_checkbox">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        <?php
                        if ( get_option( $value['id'] ) ) {
                            $checked = "checked=\"checked\"";
                        } else {
                            $checked = "";
                        }
                        ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    </div>
                    <?php
                    break;
                case "section":
                    $i++;
                    ?>
                    <div class="rm_section">
                        <div class="rm_title"><h3><img src="<?php bloginfo( 'template_directory' ) ?>/includes/options/clear.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="保存设置" />
                            </span><div class="clearfix"></div></div>
                        <div class="rm_options">
                            <?php
                            break;
                    }
                }
                ?>
                <span class="show_id">
                    <div class="version_tips"><strong>最后更新：</strong><span class="latest_update"></span><br />
                        <strong>更新页面：</strong><a href="" class="author_add" target="_blank">点击传送</a><br/>
                        <strong>公告：</strong> <span class="text"></span><span class="vright close_version_tips">[关闭]</span></div>

                    <p><strong>温馨提示：</strong><br />
                        &nbsp; &nbsp; 首次使用TearSnow主题，请务必按照您的需要，设置好每个选项，并全部保存一次，否则可能会错位哦！</p>
                    <p><strong>技术支持：</strong><br />
                        &nbsp; &nbsp;QQ：592651505<br />
                        &nbsp;&nbsp; Blog：zhangzifan.com<br />
                        &nbsp;&nbsp; 邮箱：leixue@leiue.com</p>
                    <p>
                        <input type="hidden" name="action" value="save" />
                    </p>
                </span>
                </form>
                <form method="post">
                    <p class="submit">
                        <input name="reset" type="submit" value="恢复默认" /> <font color=#ff0000>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
                        <input type="hidden" name="action" value="reset" />
                    </p>
                </form>
            </div>
            <div class="kg"></div>
        </div>
        <?php
    }
    ?>
    <?php

    function mytheme_wp_head() {
        $stylesheet = get_option( 'swt_alt_stylesheet' );
        if ( $stylesheet != '' ) {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/css/<?php echo $stylesheet; ?>" />
            <?php
        }
    }

    add_action( 'wp_head', 'mytheme_wp_head' );
    add_action( 'admin_init', 'mytheme_add_init' );
    add_action( 'admin_menu', 'mytheme_add_admin' );
