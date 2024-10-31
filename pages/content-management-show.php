<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
// Form submitted, check the data
if (isset($_POST['sdp_display']) && $_POST['sdp_display'] == 'yes')
{
	$did = isset($_GET['did']) ? sanitize_text_field($_GET['did']) : '0';
	if(!is_numeric($did)) { die('<p>Are you sure you want to do this?</p>'); }
	
	$sdp_success = '';
	$sdp_success_msg = FALSE;
	
	// First check if ID exist with requested ID
	$sSql = $wpdb->prepare(
		"SELECT COUNT(*) AS `count` FROM ".WP_Scrolling_Down_Popup_TABLE."
		WHERE `sdp_id` = %d",
		array($did)
	);
	$result = '0';
	$result = $wpdb->get_var($sSql);
	
	if ($result != '1')
	{
		?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist', 'scrolling-down-popup-plugin'); ?></strong></p></div><?php
	}
	else
	{
		// Form submitted, check the action
		if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '')
		{
			//	Just security thingy that wordpress offers us
			check_admin_referer('sdp_form_show');
			
			//	Delete selected record from the table
			$sSql = $wpdb->prepare("DELETE FROM `".WP_Scrolling_Down_Popup_TABLE."`
					WHERE `sdp_id` = %d
					LIMIT 1", $did);
			$wpdb->query($sSql);
			
			//	Set success message
			$sdp_success_msg = TRUE;
			$sdp_success = __('Selected record was successfully deleted.', 'scrolling-down-popup-plugin');
		}
	}
	
	if ($sdp_success_msg == TRUE)
	{
		?><div class="updated fade"><p><strong><?php echo $sdp_success; ?></strong></p></div><?php
	}
}
?>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2><?php _e('Scrolling down popup plugin', 'scrolling-down-popup-plugin'); ?>
	<a class="add-new-h2" href="<?php echo WP_SDP_ADMIN_URL; ?>&amp;ac=add"><?php _e('Add New', 'scrolling-down-popup-plugin'); ?></a></h2>
    <div class="tool-box">
	<?php
		$sSql = "SELECT * FROM `".WP_Scrolling_Down_Popup_TABLE."` order by sdp_id";
		$myData = array();
		$myData = $wpdb->get_results($sSql, ARRAY_A);
		?>
		<form name="sdp_display" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
			<th scope="col"><?php _e('Popup Content', 'scrolling-down-popup-plugin'); ?></th>
			<th scope="col" width="200"><?php _e('Short Code', 'scrolling-down-popup-plugin'); ?></th>
			<th scope="col"><?php _e('Id', 'scrolling-down-popup-plugin'); ?></th>
          </tr>
        </thead>
		<tfoot>
          <tr>
			<th scope="col"><?php _e('Popup Content', 'scrolling-down-popup-plugin'); ?></th>
			<th scope="col" width="200"><?php _e('Short Code', 'scrolling-down-popup-plugin'); ?></th>
			<th scope="col"><?php _e('Id', 'scrolling-down-popup-plugin'); ?></th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
			$i = 0;
			if(count($myData) > 0)
			{
				foreach ($myData as $data)
				{
					?>
					<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
					<td>
					<?php echo stripslashes($data['sdp_text']); ?>
					<div class="row-actions">
					<span class="edit">
					<a title="Edit" href="<?php echo WP_SDP_ADMIN_URL; ?>&amp;ac=edit&amp;did=<?php echo $data['sdp_id']; ?>"><?php _e('Edit', 'scrolling-down-popup-plugin'); ?></a> | </span>
					<span class="trash">
					<a onClick="javascript:_sdp_delete('<?php echo $data['sdp_id']; ?>')" href="javascript:void(0);"><?php _e('Delete', 'scrolling-down-popup-plugin'); ?></a></span> 
					</div>
					</td>
					<td>[scroll-down-popup id="<?php echo $data['sdp_id']; ?>"]</td>
					<td><?php echo $data['sdp_id']; ?></td>
					</tr>
					<?php 
					$i = $i+1; 
				} 
			}
			else
			{
				?><tr><td colspan="3" align="center"><?php _e('No records available.', 'scrolling-down-popup-plugin'); ?></td></tr><?php 
			}
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('sdp_form_show'); ?>
		<input type="hidden" name="sdp_display" value="yes"/>
      </form>	
	  <div class="tablenav bottom">
	  <a href="<?php echo WP_SDP_ADMIN_URL; ?>&amp;ac=add"><input class="button action" type="button" value="<?php _e('Add New', 'scrolling-down-popup-plugin'); ?>" /></a>
	  <a href="<?php echo WP_SDP_ADMIN_URL; ?>&amp;ac=set"><input class="button action" type="button" value="<?php _e('Display Setting', 'scrolling-down-popup-plugin'); ?>" /></a>
	  <a target="_blank" href="<?php echo WP_SDP_FAV; ?>"><input class="button action" type="button" value="<?php _e('Help', 'scrolling-down-popup-plugin'); ?>" /></a>
	  <a target="_blank" href="<?php echo WP_SDP_FAV; ?>"><input class="button button-primary" type="button" value="<?php _e('Short Code', 'scrolling-down-popup-plugin'); ?>" /></a>
	  </div>
	</div>
</div>