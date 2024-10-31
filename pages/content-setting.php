<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2><?php _e('Scrolling down popup plugin', 'scrolling-down-popup-plugin'); ?></h2>
    <?php
	$sdp_On_Homepage = get_option('sdp_On_Homepage');
	$sdp_On_Posts = get_option('sdp_On_Posts');
	$sdp_On_Pages = get_option('sdp_On_Pages');
	$sdp_On_Archives = get_option('sdp_On_Archives');
	$sdp_On_Search = get_option('sdp_On_Search');
	$sdp_cookies = get_option('sdp_cookies');
	//$sdp_widget = get_option('sdp_widget');
	//$sdp_close = get_option('sdp_close');
	
	if (isset($_POST['sdp_form_submit']) && $_POST['sdp_form_submit'] == 'yes')
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('sdp_form_setting');
			
		$sdp_On_Homepage 	= stripslashes(trim(sanitize_text_field($_POST['sdp_On_Homepage'])));
		$sdp_On_Posts 		= stripslashes(trim(sanitize_text_field($_POST['sdp_On_Posts'])));
		$sdp_On_Pages 		= stripslashes(trim(sanitize_text_field($_POST['sdp_On_Pages'])));
		$sdp_On_Archives 	= stripslashes(trim(sanitize_text_field($_POST['sdp_On_Archives'])));
		$sdp_On_Search 		= stripslashes(trim(sanitize_text_field($_POST['sdp_On_Search'])));
		$sdp_cookies 		= stripslashes(trim(sanitize_text_field($_POST['sdp_cookies'])));
		//$sdp_widget = stripslashes(trim($_POST['sdp_widget']));
		//$sdp_close = stripslashes(trim($_POST['sdp_close']));
				
		$sdp_On_Homepage 	= Scrolling_Down_Popup_Validation::val_yn($sdp_On_Homepage);
		$sdp_On_Posts 		= Scrolling_Down_Popup_Validation::val_yn($sdp_On_Posts);
		$sdp_On_Pages 		= Scrolling_Down_Popup_Validation::val_yn($sdp_On_Pages);
		$sdp_On_Archives 	= Scrolling_Down_Popup_Validation::val_yn($sdp_On_Archives);
		$sdp_On_Search 		= Scrolling_Down_Popup_Validation::val_yn($sdp_On_Search);
		$sdp_cookies 		= Scrolling_Down_Popup_Validation::val_cookies($sdp_cookies);
		
		update_option('sdp_On_Homepage', $sdp_On_Homepage );
		update_option('sdp_On_Posts', $sdp_On_Posts );
		update_option('sdp_On_Pages', $sdp_On_Pages );
		update_option('sdp_On_Archives', $sdp_On_Archives );
		update_option('sdp_On_Search', $sdp_On_Search );
		update_option('sdp_cookies', $sdp_cookies );
		//update_option('sdp_widget', $sdp_widget );
		//update_option('sdp_close', $sdp_close );
		
		?>
		<div class="updated fade">
			<p><strong><?php _e('Details successfully updated.', 'scrolling-down-popup-plugin'); ?></strong></p>
		</div>
		<?php
	}
	?>
	<h3>Popup setting</h3>
	<form name="sdp_form" method="post" action="">
	
		<label for="tag-title"><?php _e('Display Mode (Global setting)', 'scrolling-down-popup-plugin'); ?></label>
		<select name="sdp_cookies" id="sdp_cookies">
			<option value='showalways' <?php if($sdp_cookies=='showalways') { echo 'selected' ; } ?>><?php _e('Show always', 'scrolling-down-popup-plugin'); ?></option>
			<option value='oncepersession' <?php if($sdp_cookies=='oncepersession') { echo 'selected' ; } ?>><?php _e('Once per session', 'scrolling-down-popup-plugin'); ?></option>
		</select>
		<p></p>
		
		<h3><?php _e('Popup window display setting', 'scrolling-down-popup-plugin'); ?></h3>
		
		<label for="tag-image"><?php _e('Display on home page', 'scrolling-down-popup-plugin'); ?></label>
		<select name="sdp_On_Homepage" id="sdp_On_Homepage">
			<option value='YES' <?php if($sdp_On_Homepage == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($sdp_On_Homepage == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p></p>
		
		<label for="tag-image"><?php _e('Display on posts', 'scrolling-down-popup-plugin'); ?></label>
		<select name="sdp_On_Posts" id="sdp_On_Posts">
			<option value='YES' <?php if($sdp_On_Posts == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($sdp_On_Posts == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p></p>
		
		<label for="tag-image"><?php _e('Display on pages', 'scrolling-down-popup-plugin'); ?></label>
		<select name="sdp_On_Pages" id="sdp_On_Pages">
			<option value='YES' <?php if($sdp_On_Pages == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($sdp_On_Pages == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p></p>
		
		<label for="tag-image"><?php _e('Display on archives pages', 'scrolling-down-popup-plugin'); ?></label>
		<select name="sdp_On_Archives" id="sdp_On_Archives">
			<option value='YES' <?php if($sdp_On_Archives == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($sdp_On_Archives == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p></p>
		
		<label for="tag-image"><?php _e('Display on search pages', 'scrolling-down-popup-plugin'); ?></label>
		<select name="sdp_On_Search" id="sdp_On_Search">
			<option value='YES' <?php if($sdp_On_Search == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($sdp_On_Search == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p></p>
		<br />		
		<input type="hidden" name="sdp_form_submit" value="yes"/>
		<input name="sdp_submit" id="sdp_submit" class="button add-new-h2" value="<?php _e('Submit', 'scrolling-down-popup-plugin'); ?>" type="submit" />
		<input name="publish" lang="publish" class="button add-new-h2" onclick="_sdp_redirect()" value="<?php _e('Cancel', 'scrolling-down-popup-plugin'); ?>" type="button" />
		<input name="Help" lang="publish" class="button add-new-h2" onclick="_sdp_help()" value="<?php _e('Help', 'scrolling-down-popup-plugin'); ?>" type="button" />
		<?php wp_nonce_field('sdp_form_setting'); ?>
	</form>
  </div>
</div>