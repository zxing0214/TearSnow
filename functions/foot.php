<?php

/////////请谨慎修改本页代码
function TearSnow_footer() {
    ?>
    <?php $options = get_option( 'tearsnow_options' ); ?>
    <div id="footer">Copyright <?php echo comicpress_copyright(); ?> <a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>. Powered by WordPress <?php if ( get_option( 'swt_version' ) == 'Display' ) { ?><?php bloginfo( 'version' ); ?><?php {
                echo '';
            }
            ?><?php } else {

    }
    ?></a>. 
    <div id="foot"><?php if ( get_option( 'swt_baidu' ) == 'Display' ) { ?><a href="<?php echo stripslashes( get_option( 'swt_bddtlink' ) ); ?>" rel="external"><?php echo stripslashes( get_option( 'swt_bddtname' ) ); ?></a><?php {
                echo '.';
            }
            ?><?php } else {

    }
        ?>
        <?php if ( get_option( 'swt_google' ) == 'Display' ) { ?><a href="<?php echo stripslashes( get_option( 'swt_googledtlink' ) ); ?>" rel="external"><?php echo stripslashes( get_option( 'swt_googledtname' ) ); ?></a><?php {
                echo '.';
            }
            ?><?php } else {

    }
        ?>
        <?php if ( get_option( 'swt_website' ) == 'Display' ) { ?><a href="<?php echo stripslashes( get_option( 'swt_websitedtlink' ) ); ?>" rel="external"><?php echo stripslashes( get_option( 'swt_websitedtname' ) ); ?></a><?php {
                echo '.';
            }
            ?><?php } else {

    }
        ?>
        <?php if ( get_option( 'swt_zanzhu' ) == 'Display' ) { ?><?php echo stripslashes( get_option( 'swt_zanzhuwhat' ) ); ?>:<a href="<?php echo stripslashes( get_option( 'swt_zanzhulink' ) ); ?>" rel="nofollow" target="_blank"><?php echo stripslashes( get_option( 'swt_zanzhuname' ) ); ?></a><?php {
                echo '.';
            }
            ?><?php } else {

    }
        ?>
    <?php if ( get_option( 'swt_beian' ) == 'Display' ) { ?><a href="http://www.miitbeian.gov.cn/" rel="nofollow" target="_blank"><?php echo stripslashes( get_option( 'swt_beianhao' ) ); ?></a><?php {
            echo '.';
        }
        ?><?php } else {

    }
    ?> <?php if ( get_option( 'swt_tj' ) == 'Display' ) { ?><?php echo stripslashes( get_option( 'swt_tjcode' ) ); ?><?php {
            echo '.';
        }
        ?>	<?php } else {

    }
    ?>
    </div></div>
    </div></div>
    <?php
}

add_action( 'wp_footer', 'TearSnow_footer' );
/////////END
