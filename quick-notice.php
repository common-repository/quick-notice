<?php 
/*
Plugin Name: Quick Notice Bar
Plugin URI: http://wpeden.com/product/quick-notice-bar-pro/
Description: Display important message/notice from site admin to visitor
Author: Shaon
Version: 2.0.2
Author URI: http://wpeden.com/product/quick-notice-bar-pro/
*/
 

$plugindir = str_replace('\\','/',dirname(__FILE__));
 

define('PLUGINDIR',$plugindir);  

function wpqn_install(){      
    add_option('wpp_redirect', true); 
    
}

function wpqn_redirect(){
    if (get_option('wpp_redirect', false)) {
        delete_option('wpp_redirect');
        wp_redirect(home_url('/wp-admin/admin.php?page=quick-notice'));
    }
}


function wpqn_save_notice(){
    if($_POST['notice']) {
       update_option('_wpqn_notice', $_POST['notice']);       
       update_option('_wpqn_disabled', $_POST['_wpqn_disabled']);       
   }
   die('Notice Updated');
} 

 function wpqn_save_notice_settings(){
    if($_POST['action']=='wpqn_save_notice_settings') {
       update_option('_wpqn_twitter', $_POST['twitter']);       
       update_option('_wpqn_facebook', $_POST['facebook']);       
       update_option('_wpqn_custom_code', $_POST['custom_code']);       
       update_option('_wpqn_icon_up_url', $_POST['notice_bar_up_image']);       
       update_option('_wpqn_icon_down_url', $_POST['notice_bar_down_image']);       
   }
   die('Notice Updated');
} 

 
function wpqn_admin_options(){   
    $notice = get_option('_wpqn_notice');
    include("tpls/setup.php");
}

function wpqn_settgins(){   
    $notice = get_option('_wpqn_notice');
    include("tpls/settings.php");
}

function wpqn_archive(){   
    $notice = get_option('_wpqn_notice');
    include("tpls/archive.php");
}

function wpqn_show_notice(){
    if(get_option('_wpqn_disabled',0)==1) return;
    $notice = get_option('_wpqn_notice');
?>

<link href='http://fonts.googleapis.com/css?family=<?php echo $notice['font']; ?>&v1' rel='stylesheet' type='text/css'>
<style type="text/css">
.wpqn{
<?php echo $notice['bg_css']?stripcslashes($notice['bg_css']):"background: #6d0019;background: -moz-linear-gradient(top, #6d0019 0%, #a90329 74%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#6d0019), color-stop(74%,#a90329));background: -webkit-linear-gradient(top, #6d0019 0%,#a90329 74%);background: -o-linear-gradient(top, #6d0019 0%,#a90329 74%);background: -ms-linear-gradient(top, #6d0019 0%,#a90329 74%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6d0019', endColorstr='#a90329',GradientType=0 );background: linear-gradient(top, #6d0019 0%,#a90329 74%);"; ?>
border-bottom: 3px solid #fff;
-moz-box-shadow: 0 0 5px #888;
-webkit-box-shadow: 0 0 5px#888;
box-shadow: 0 0 5px #888;
z-index:999999;
font-size: <?php echo $notice['font_size']?$notice['font_size']:'12'; ?>pt; 
font-family: '<?php echo str_replace("+"," ",$notice['font']); ?>';
text-align: center;
color: <?php echo $notice['color']?$notice['color']:'#ffffff'; ?>;
font-weight: <?php echo $notice['font_weight']?$notice['font_weight']:'normal'; ?>;
line-height: 35px;
}
.wpqn_down{
<?php echo $notice['bg_css']?stripcslashes($notice['bg_css']):"background: #6d0019;background: -moz-linear-gradient(top, #6d0019 0%, #a90329 74%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#6d0019), color-stop(74%,#a90329));background: -webkit-linear-gradient(top, #6d0019 0%,#a90329 74%);background: -o-linear-gradient(top, #6d0019 0%,#a90329 74%);background: -ms-linear-gradient(top, #6d0019 0%,#a90329 74%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6d0019', endColorstr='#a90329',GradientType=0 );background: linear-gradient(top, #6d0019 0%,#a90329 74%);"; ?>
border-bottom: 3px solid #fff;
border-left: 3px solid #fff;
border-right: 3px solid #fff;
-moz-box-shadow: 0 0 5px #888;
-webkit-box-shadow: 0 0 5px#888;
box-shadow: 0 0 5px #888;
z-index:999999;
font-size: <?php echo $notice['font_size']?$notice['font_size']:'12'; ?>pt; 
font-family: '<?php echo str_replace("+"," ",$notice['font']); ?>';
text-align: center;
color: <?php echo $notice['color']?$notice['color']:'#ffffff'; ?>;
font-weight: <?php echo $notice['font_weight']?$notice['font_weight']:'normal'; ?>;
height: 35px;
-webkit-border-bottom-right-radius: 6px;
-webkit-border-bottom-left-radius: 6px;
-moz-border-radius-bottomright: 6px;
-moz-border-radius-bottomleft: 6px;
border-bottom-right-radius: 6px;
border-bottom-left-radius: 6px;
}
.wpqn a{
   color: <?php echo $notice['color']?$notice['color']:'#ffffff'; ?>; 
}
</style>
<?php 
$upiconurl = get_option('_wpqn_icon_down_url');
 if($upiconurl == "") $upiconurl = plugins_url().'/quick-notice/images/up.png';
?>
<div style="width: 100%;position: fixed;top:0px;left:0px" class="wpqn" id="wpqn">
    <div style="position: absolute;margin: 2px 0 0 10px">   
        <?php $fb = get_option('_wpqn_facebook');if(!empty($fb)){?>
        <a href="<?php echo get_option('_wpqn_facebook'); ?>" target="_blank"><img src='<?php echo plugins_url(); ?>/quick-notice/images/facebook.png' title="We're in facebook"/></a>
        <?php } ?>
        <?php $tw = get_option('_wpqn_twitter'); if(!empty($tw)){ ?>
        <a href="#" onclick="window.open('https://twitter.com/share?original_referer=http%3A%2F%2Fwww.wpdownloadmanager.com%2F&source=tweetbutton&text=<?php echo urlencode(htmlspecialchars_decode(stripcslashes($notice['message']))); ?>&url=<?php echo urlencode($notice['url']); ?>&via=webmaniac','window 1','height=250,width=550');return false;"><img src='<?php echo plugins_url(); ?>/quick-notice/images/twitter.png' title="Tweet this"/></a>
        <a href="<?php echo get_option('_wpqn_twitter'); ?>" target="_blank"><img src='<?php echo plugins_url(); ?>/quick-notice/images/twitter.png' title="Follow me on twitter" /></a>
        <?php } ?>
        <?php $cuscode=get_option('_wpqn_custom_code');if(!empty($cuscode))echo $cuscode; ?>
    </div>
    <?php echo htmlspecialchars_decode(stripcslashes($notice['message'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if($notice['url']!=''){ ?>
    <a href='<?php echo $notice['url']; ?>'><?php echo $notice['link_label']; ?></a>
    <div style="float: right;margin-right: 50px;">
        <iframe scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height: 24px; align: left; margin: 7px 0px 2px 0px;float:right;" allowtransparency="true" src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode($notice['url']); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;colorscheme=light"></iframe>
    </div>  
    <?php } ?>
    <img src="<?php echo $upiconurl; ?>" style="position: absolute;cursor:pointer;right:0px;margin-right: 20px;margin-top: 2px;"  onclick="jQuery('#wpqn').slideUp(function(){jQuery('#wpqn_down').slideDown();});" />
</div>
  
<?php
 $downiconurl = get_option('_wpqn_icon_down_url');
 if($downiconurl == "") $downiconurl = plugins_url().'/quick-notice/images/down.png';
?>
<div style="width: 40px;position: fixed;top:0px;cursor:pointer;right:0px;margin-right: 15px;display: none;" class="wpqn_down" id="wpqn_down">
    <img src="<?php echo $downiconurl;?>" onclick="jQuery('#wpqn_down').slideUp(function(){jQuery('#wpqn').slideDown();});" />
</div>     
  
<?php    
}


function wpqn_menu(){
    add_menu_page("Quick Notice","Quick Notice",'administrator','quick-notice','wpqn_admin_options');    
    add_submenu_page('quick-notice', 'Setup a Notice', 'Setup', 'administrator', 'quick-notice', 'wpqn_admin_options');    
    add_submenu_page('quick-notice', 'Quick Notice Settings', 'Settings', 'administrator', 'quick-notice/settings', 'wpqn_settgins');    
}

if(is_admin()){
    add_action("admin_menu","wpqn_menu");
    wp_enqueue_script("jquery");
    wp_enqueue_script("jquery-form",plugins_url().'/wordpress-perfection/jquery.form.js');    
    add_action('wp_ajax_wpqn_save_notice','wpqn_save_notice');
    add_action('wp_ajax_wpqn_save_notice_settings','wpqn_save_notice_settings');
    } else{
        add_action('wp_footer','wpqn_show_notice');
    }
 
register_activation_hook(__FILE__,'wpqn_install');

add_action('admin_init','wpqn_redirect');