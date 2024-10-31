function _sdp_submit()
{
	if(document.sdp_form.sdp_text.value == "")
	{
		alert(sdp_adminscripts.sdp_text);
		document.sdp_form.sdp_text.focus();
		return false;
	}
	else if((document.sdp_form.sdp_width.value == "") || isNaN(document.sdp_form.sdp_width.value))
	{
		alert(sdp_adminscripts.sdp_width);
		document.sdp_form.sdp_width.focus();
		return false;
	}
	else if((document.sdp_form.sdp_left_space.value == "") || isNaN(document.sdp_form.sdp_left_space.value))
	{
		alert(sdp_adminscripts.sdp_left_space);
		document.sdp_form.sdp_left_space.focus();
		return false;
	}
	else if((document.sdp_form.sdp_top_space.value == "") || isNaN(document.sdp_form.sdp_top_space.value))
	{
		alert(sdp_adminscripts.sdp_top_space);
		document.sdp_form.sdp_top_space.focus();
		return false;
	}
	else if((document.sdp_form.sdp_speed.value == "") || isNaN(document.sdp_form.sdp_speed.value))
	{
		alert(sdp_adminscripts.sdp_speed);
		document.sdp_form.sdp_speed.focus();
		return false;
	}
}

function _sdp_delete(id)
{
	if(confirm(sdp_adminscripts.sdp_delete))
	{
		document.sdp_display.action="options-general.php?page=scrolling-down-popup-plugin&ac=del&did="+id;
		document.sdp_display.submit();
	}
}	

function _sdp_redirect()
{
	window.location = "options-general.php?page=scrolling-down-popup-plugin";
}

function _sdp_help()
{
	window.open("http://www.gopiplus.com/work/2011/07/23/scrolling-down-popup-wordpress-plugin/");
}