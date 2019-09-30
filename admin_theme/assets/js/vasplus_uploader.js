/***********************************************************************************************************
* Preview and upload multiple files using Jquery and PHP
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: vasplusblog@gmail.com or info@vasplus.info

**********************************Copyright Information*****************************************************
* This script has been released with the aim that it will be useful.
* Please, do not remove this copyright information from the top of this page.
* If you want the copyright info to be removed from the script then you have to buy this script.
* This script must not be sold.
* All Copy Rights Reserved by Vasplus Programming Blog
*************************************************************************************************************/


// Preview File(s)
function vpb_image_preview(vpb_selector_) 
{
	var id = 1, last_id = last_cid = '';
	$.each(vpb_selector_.files, function(vpb_o_, file)
	{
		if (file.name.length>0) 
		{
			if (!file.type.match('image.*')) { return true; } // Do not add files which are not images
			else
			{
				//Clear previous previewed files and start again
			   $('#vpb-display-preview').html(''); 
			   
			   var reader = new FileReader();
			   
			   reader.onload = function(e) 
			   {
				   $('#vpb-display-preview').append(
				   '<div id="selector_'+vpb_o_+'" class="vpb_wrapper"> \
				   <img class="vpb_image_style" class="img-thumbnail" src="' + e.target.result + '" \
				   title="'+ escape(file.name) +'" /><br /> \
				   <a style="cursor:pointer;padding-top:5px;" title="Click here to remove '+ escape(file.name) +'" \
				   onclick="vpb_remove_selected(\''+vpb_o_+'\',\''+file.name+'\')">Remove</a> \
				   </div>');
			   }
			   reader.readAsDataURL(file);
		   }
		}
		else {  return false; }
	});
}


//Remove Previewed File only from the screen but will be uploaded when you click on the start upload button
function vpb_remove_selected(id,name)
{
	$('#v-add-'+id).remove();
	$('#selector_'+id).fadeOut();
}


