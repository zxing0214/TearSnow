jQuery(document).ready(function() {
    jQuery('.article h2 a').click(function() {
        jQuery(this).text('页面载入中……');
        window.location = jQuery(this).attr('href');
    });
});

jQuery(document).ready(function() {
    jQuery('.article h2 a').hover(function() {
        jQuery(this).stop().animate({marginLeft: "5px"}, 300);
    }
    , function() {
        jQuery(this).stop().animate({marginLeft: "0px"}, 300);
    });
});

// 滚屏
jQuery(document).ready(function() {
    jQuery('#roll_top').click(function() {
        jQuery('html,body').animate({scrollTop: '0px'}, 800);
    });
    jQuery('#ct').click(function() {
        jQuery('html,body').animate({scrollTop: jQuery('#comments').offset().top}, 800);
    });
    jQuery('#fall').click(function() {
        jQuery('html,body').animate({scrollTop: jQuery('#footer').offset().top}, 800);
    });
});

//顶部导航下拉菜单
jQuery(document).ready(function() {
    jQuery(".topnav ul li").hover(function() {
        jQuery(this).children("ul").show();
        jQuery(this).addClass("li01");
    }, function() {
        jQuery(this).children("ul").hide();
        jQuery(this).removeClass("li01");
    });
});

//侧边栏TAB效果
jQuery(document).ready(function() {
    jQuery('#tab-title span').click(function() {
        jQuery(this).addClass("selected").siblings().removeClass();
        jQuery("#tab-content > ul").slideUp('1500').eq(jQuery('#tab-title span').index(this)).slideDown('1500');
    });
});

//图片渐隐
jQuery(function() {
    jQuery('img').hover(
            function() {
                jQuery(this).fadeTo("fast", 0.5);
            },
            function() {
                jQuery(this).fadeTo("fast", 1);
            });
});

//新窗口打开
jQuery(document).ready(function() {
    jQuery("a[rel='external'],a[rel='external nofollow']").click(
            function() {
                window.open(this.href);
                return false
            })
});

//顶部微博等图标渐隐
jQuery(document).ready(function() {
    jQuery('.icon1,.icon2,.icon3,.icon4,').wrapInner('<span class="hover"></span>').css('textIndent', '0').each(function() {
        jQuery('span.hover').css('opacity', 0).hover(function() {
            jQuery(this).stop().fadeTo(350, 1);
        }, function() {
            jQuery(this).stop().fadeTo(350, 0);
        });
    });
});

//预加载广告
function speed_ads(loader, ad) {
    var ad = document.getElementById(ad),
            loader = document.getElementById(loader);
    if (ad && loader) {
        ad.appendChild(loader);
        loader.style.display = 'block';
        ad.style.display = 'block';
    }
}
window.onload = function() {
    speed_ads('adsense-loader1', 'adsense1');
    speed_ads('adsense-loader2', 'adsense2');
    speed_ads('adsense-loader3', 'adsense3');
};
//侧边栏链接点击滑动
jQuery(document).ready(function() {
    $('#sidebar li a').hover(function() {
        $(this).stop().animate({'left': '5px'}, 'fast');
    }, function() {
        $(this).stop().animate({'left': '0px'}, 'fast');
    });
});
//@回复
jQuery(document).ready(function($) { //Begin jQuery
    $('.reply').click(function() {
        var atid = '"#' + $(this).parent().attr("id") + '"';
        var atname = $(this).prevAll().find('strong:first').text();
        $("#comment").attr("value", "<a href=" + atid + ">@" + atname + " </a>").focus();
    });
    $('.cancel-comment-reply a').click(function() { //点击取消回复评论清空评论框的内容
        $("#comment").attr("value", '');
    });
})