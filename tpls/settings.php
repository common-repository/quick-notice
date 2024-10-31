<style type="text/css">
    .inm{
        padding-left: 10px;
        color: #008000;
        font-weight: bold;
    }
</style>

<div class="wrap">
    <h2>Quick Notice Settings</h2> <br>
    <form action="" method="post" id="wpqn">
        <input type="hidden" name="action" value="wpqn_save_notice_settings">
        <table cellpadding="4">
            <tr><td>Twitter Profile URL:<br/><input style="width:80%" type="text" name="twitter" value="<?php echo get_option('_wpqn_twitter'); ?>"></td></tr>
            <tr><td>Facebook Page URL:<br/><input style="width:80%" type="text" name="facebook" value="<?php echo get_option('_wpqn_facebook'); ?>"></td></tr>
            <tr><td valign="top">Custom Code:<br/><textarea style="width:80%" rows="4" cols="80" name="custom_code"><?php echo get_option('_wpqn_custom_code'); ?></textarea></td></tr>
            <tr><td>Notice Bar Up image URL:<br/><input style="width:80%" type="text" name="notice_bar_up_image" value="<?php echo get_option('_wpqn_icon_up_url', plugins_url().'/quick-notice/images/up.png'); ?>" ></td></tr>
            <tr><td>Notice Bar Down image URL:<br/><input style="width:80%" type="text" name="notice_bar_down_image" value="<?php echo get_option('_wpqn_icon_down_url', plugins_url().'/quick-notice/images/down.png'); ?>" ></td></tr>
        </table>
        <br clear="all" />
        <br clear="all" />
        <input type="submit" id="btn" class="button-primary" value="Save Settings"> 
        <span id="loading" style="display: none;"><img src="images/loading.gif" alt=""> Saving...</span>
    </form>
    <br>
    <br>

    <h2>Why Quick Notice Bar Pro?</h2> 
    Yes, You can do much more with pro <a target="_blank" href="http://wpeden.com/product/quick-notice-bar-pro/"><b>Get it now!</b></a>    
</div>

<script language="JavaScript">
    jQuery('#wpqn').submit(function() {
        jQuery(this).ajaxSubmit({
            'url': ajaxurl,
            'beforeSubmit': function() {
                jQuery('#loading').fadeIn();
            },
            'success': function(res) {
                jQuery('#loading').fadeOut();
            }
        });
        return false;
    });
</script>


