<div id="menu-settings-column" class="metabox-holder">
<div id="side-sortables" class="meta-box-sortables ui-sortable">
	<div id="navigation" class="postbox">
		<h3 >
			<span>Navigation</span>
		</h3>
		<div class="inside">
			<br />
				Jump To: 
				<select class="select-nav-menu" name="menu" id="ninja_select_form">
				<option value="<?php echo $link;?>">--- Select A Form ---</option>
					<?php
						foreach($ninja_all_forms as $form){
						$link = esc_url(add_query_arg(array('tab' => $current_tab, 'ninja_form_id' => $form['id'])));
					?>
					<option value="<?php echo $link;?>" <?php if($form_id == $form['id']){ echo 'selected';}?>><?php echo $form['title'];?></option>
					<?php
					}
					?>
					<?php if($form_id == 'new'){ ?>
					<option value="" selected>--- New Form ---</option>
					<?php } ?>
				</select>
				
				<?php if($form_id != 'new'){ ?>
					<br/> or <input class="button-secondary ninja_new_form" id="" name="" type="button" value="<?php esc_attr_e('Add New'); ?>" />
				<?php } ?>
		</div><br />
	</div>
	<?php 
	switch($current_tab){
		case 'settings':
			if($_REQUEST['ninja_form_id']){

			?>			
				
		<form id="ninja_form_settings" name="" action="" method="post">
		 <?php wp_nonce_field('ninja_save_form_settings','ninja_form_settings'); ?>
		<input type="hidden" id="ninja_form_action" name="action" value="<?php echo $_REQUEST['action'];?>">
		<input type="hidden" name="submitted" value="yes">
		<input type="hidden" name="tab" value="settings">
		<input type="hidden" id="ninja_form_new" value="<?php echo $form_new;?>">
		<input type="hidden" id="ninja_form_id" name="ninja_form_id" value="<?php echo $form_id;?>">
		<input type="hidden" name="ninja_form_fields_order" id="ninja_form_fields_order" value="same">
	<span id="form-settings-list" class="ninja-settings-list">
		<?php 
		$echoed = false;
		foreach($settings_sidebar_order as $order){ 
			switch($order){
			case 'subs-settings':
			?>
		<div id="subs-settings" class="postbox" name="form-settings-list">
		<div class="handlediv" id="handle-sub-settings" title="Click to toggle"><br></div>
		<h3 >
			<span>Submission Settings</span>
		</h3>
		<div class="inside" id="sub-settings" <?php if($sub_settings_state == 'closed' OR $echoed){ echo 'style="display:none;"'; }else{$echoed = true;}?>>
			<p class="howto"></p>
			<p class="button-controls">
				<input type="hidden" name="form_<?php echo $form_id;?>[save_subs]" value="unchecked"><input type="checkbox" name="form_<?php echo $form_id;?>[save_subs]" id="form_<?php echo $form_id;?>[save_subs]" value="checked" <?php echo $form_save_subs;?>>
				 <label for="form_<?php echo $form_id;?>[save_subs]">Save Form Submissions</label>
				<?php if($plugin_settings['admin_help'] == 'checked'){ ?><img id="save_subs" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
			</p>					
			<p class="button-controls">
				
				<input type="hidden" name="form_<?php echo $form_id;?>[send_email]" value="unchecked"><input type="checkbox" class="ninja_form_send_email" name="form_<?php echo $form_id;?>[send_email]" id="form_<?php echo $form_id;?>[send_email]" value="checked" <?php echo $form_send_email;?>>
				 <label for="form_<?php echo $form_id;?>[send_email]">Email To User</label>
				<?php if($plugin_settings['admin_help'] == 'checked'){ ?><img id="send_email" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
			</p>
			<p class="button-controls">
				
				<input type="hidden" name="form_<?php echo $form_id;?>[ajax]" value="unchecked"><input type="checkbox" name="form_<?php echo $form_id;?>[ajax]" id="form_<?php echo $form_id;?>[ajax]" value="checked" class="ninja_form_ajax" <?php echo $form_ajax;?>>
				 <label for="form_<?php echo $form_id;?>[ajax]">Submit via Ajax</label>
				<?php if($plugin_settings['admin_help'] == 'checked'){ ?><img id="ajax" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
			</p>						
			<p class="button-controls">
				<label for="form_<?php echo $form_id;?>[landing_page]" id="form_<?php echo $form_id;?>[landing_page][label]" style="<?php if($form_ajax == 'checked'){ echo 'display:none;';}?>">Select Landing Page:
					<select name="form_<?php echo $form_id;?>[landing_page]" id="form_<?php echo $form_id;?>[landing_page]"> 
						<?php 
						  $pages = get_pages(); 
						  foreach ($pages as $pagg) {
							$option = '<option value="'.get_page_link($pagg->ID).'"';
							$link = get_page_link($pagg->ID);
							if($link == $form_landing_page){
								$option .= 'selected';
							}
							$option .= '>';
							$option .= $pagg->post_title;
							$option .= '</option>';
							echo $option;
						  }
						 ?>
					</select>
				<?php if($plugin_settings['admin_help'] == 'checked'){ ?><img id="landing_page" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
				</label>
				
			</p>
		</div>
	</div>
	<?php
	break;
	case 'append-page-settings':
	?>
	<div id="append-page-settings" class="postbox" name="form-settings-list">
	<div class="handlediv" id="handle-page-settings" title="Click to toggle"><br></div>
		<h3 >
			<span>Append To A Page<?php if($plugin_settings['admin_help'] == 'checked'){ ?> <img id="append_page" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?></span>
		</h3>
		<div class="inside" id="page-settings" <?php if($page_settings_state == 'closed' OR $echoed){ echo 'style="display:none;"'; }else{$echoed = true;}?>>
			<p class="button-controls">
					<?php 
							$pages = get_pages(); 
						  foreach ($pages as $pagg) {
							?>
							<input type="hidden" value="unchecked" name="form_<?php echo $form_id;?>[append_page][<?php echo $pagg->ID;?>]"><input type="checkbox" id="form_<?php echo $form_id;?>[append_page][<?php echo $pagg->ID;?>]" name="form_<?php echo $form_id;?>[append_page][<?php echo $pagg->ID;?>]" value="checked" <?php
							if($form_append_page){
								foreach($form_append_page as $val){
									if($val == $pagg->ID){
										echo 'checked';
									}
								}
							}
							?>><label for="form_<?php echo $form_id;?>[append_page][<?php echo $pagg->ID;?>]"><?php echo $pagg->post_title;?></label><br/>
							
							<?php
							}
						 ?>
			</p>		
		</div>
	</div>
	<?php
	break;
	case 'append-post-settings':
	?>
	<div id="append-post-settings" class="postbox" name="form-settings-list">
	<div class="handlediv" id="handle-post-settings" title="Click to toggle"><br></div>
		<h3>
			<span>Append To A Post</span>
		</h3>
		<div class="inside" id="post-settings" <?php if($post_settings_state == 'closed' OR $echoed){ echo 'style="display:none;"'; }else{$echoed = true;}?>>
			<p class="button-controls">
				<span class="howto">In order to append/unappend a form to a post, please visit the post editing page.</span>
			</p>
			<p class="button-controls">
				<span class="howto">This form is set to be appended to the following posts:</span>
			</p>
			<p class="button-controls">
				<ul>
			<?php
				if($form_append_page){
					foreach($form_append_page as $val){
					$this_post = get_post($val, 'ARRAY_A');
						if($this_post['post_type'] == 'post'){
							?>
							<li><a href="post.php?post=<?php echo $val;?>&action=edit"><?php echo $this_post['post_title'];?></a></li>
							<?php
						} //end post_type if
					} //end form_append_page foreach
				} //end append_page if
			
			?>
				</ul>
			</p>
		</div>
	</div>
	<?php
	break;
	}
}
	?>
</span>
	<?php

		} //end ninja_form_id if
		break;
		case 'fields':
		?>
<span id="field-settings-list" class="ninja-settings-list" >
<?php
	$echoed = false;
	foreach($fields_sidebar_order as $order){
		switch($order){
		case 'defined-fields':
?>
	<div id="defined-fields" class="postbox" name="field-settings-list">
	<div class="handlediv" id="handle-predefined-fields" title="Click to toggle"><br></div>
		<h3 >
			<span>Pre-Defined Fields</span>
		</h3>
		<div class="inside" id="predefined-fields"<?php if($predefined_fields_state == 'closed' OR $echoed){ echo 'style="display:none;"'; }else{$echoed = true;}?>>
			<p class="howto">These fields are used within Ninja Forms to direct correspondance and detect spam. You can only have one of each in your forms.</p>
			<p class="button-controls">
				<span <?php if($new_spam == 'no'){ ?>style="display:none;"<?php } ?> id="ninja_new_spam_<?php echo $ninja_forms_row['id'];?>_cont">
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_spam_<?php echo $ninja_forms_row['id'];?>" href="#">Anti-Spam Question</a>
				</span>
			</p>			
			<p class="button-controls" <?php if($new_submit == 'no'){ ?>style="display:none;"<?php } ?> id="ninja_new_submit_<?php echo $ninja_forms_row['id'];?>_cont">	
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_submit_<?php echo $ninja_forms_row['id'];?>" href="#">Submit Button</a>
			</p>
		</div>
	</div>
	<?php
	break;
	case 'custom-fields':
	?>
	<div id="custom-fields" class="postbox" name="field-settings-list" >
	<div class="handlediv" id="handle-cust-fields" title="Click to toggle"><br></div>
		<h3 >
			<span>Custom Fields</span>
		</h3>
		<div class="inside" id="cust-fields" <?php if($cust_fields_state == 'closed' OR $echoed){ echo 'style="display:none;"'; }else{$echoed = true;}?>>
			<p class="howto">You can add any number of these fields to your form.</p>
			<p class="button-controls">
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_textbox_<?php echo $ninja_forms_row['id'];?>" href="#">New Single-Line Textbox</a>
			</p>
			<p class="button-controls">
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_checkbox_<?php echo $ninja_forms_row['id'];?>" href="#">New Checkbox</a>
			</p>
			<p class="button-controls">
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_textarea_<?php echo $ninja_forms_row['id'];?>" href="#">New Multi-Line Textbox</a>
			</p>
			<p class="button-controls">
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_list_<?php echo $ninja_forms_row['id'];?>" href="#">New List (Dropdown/Radio/Multi-Select)</a>
			</p>	
			<p class="button-controls">
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_hidden_<?php echo $ninja_forms_row['id'];?>" href="#">New Hidden Field</a>
			</p>
			<p class="button-controls">
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_file_<?php echo $ninja_forms_row['id'];?>" href="#">New File Upload</a>
			</p>
			<?php
			if($plugin_settings['admin_help'] == 'checked'){ ?>
				<p><a href="#" class="ninja_help_open" name="custom_fields_help">Where's stuff like Firstname, Phone #, Date and E-mail address?</a></p>
				<div class="ninja_help_text" id="custom_fields_help" style="display:none;" title="Custom Fields Help"><p>Ninja Forms gives you the flexibility to create any kind of field that you want using our powerful "Single-Line Textbox" masks.</p><p>Simply add a Single-Line Textbox, then select what kind of "masking" you'd like applied to that field. This means you can easily limit user's input to (999) 999-9999, or put in your own custom masks for the data that you need: 99-9-999.</p><p>You can even tell Ninja Forms to show the user a datepicker!</p>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php
	break;
	case 'layout-elements':
	?>
	<div id="layout-elements" class="postbox" name="field-settings-list" >
	<div class="handlediv" id="handle-layout-fields" title="Click to toggle"><br></div>
		<h3 >
			<span>Layout Elements</span>
		</h3>
		<div class="inside" id="layout-fields" <?php if($layout_fields_state == 'closed' OR $echoed){ echo 'style="display:none;"'; }else{$echoed = true;}?>>
			<p class="howto">You can add any number of these design elements to your form.</p>
			<p class="button-controls">
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_hr_<?php echo $ninja_forms_row['id'];?>" href="#">Horizontal Rule</a>
			</p>
			<p class="button-controls">
				<a class="button add-new-h2 ninja_new_field" id="ninja_heading_heading_<?php echo $ninja_forms_row['id'];?>" href="#">Heading</a>
			</p>
			<p class="button-controls">
				<a class="button add-new-h2 ninja_new_field" id="ninja_new_desc_<?php echo $ninja_forms_row['id'];?>" href="#">Description/Text</a>
			</p>
		</div>
	</div>
	<?php
		break;
	
		} // End Switch Case
	} //End foreach
	?>
	
	</span>
	<?php
		
		break;
		case 'subs':
		?>
	<span id="subs-settings-list" class="ninja-settings-list" >
	<?php 
		$echoed = false;
		foreach($subs_sidebar_order as $order){
			switch($order){
				case 'export-subs':
				?>
		<div id="export-subs" class="postbox" name="subs-settings-list">
			<div class="handlediv" id="handle-subs-export" title="Click to toggle"><br></div>
			<h3 >
				<span>Export Submissions to .XLS</span>
			</h3>
			<div class="inside" id="subs-export" <?php if($subs_export_state == 'closed' OR $echoed){ echo 'style="display:none;"'; }else{$echoed = true;}?>>
			
				<p class="howto">Using this feature, you can export your submissions as a SPREADSHEET. You can then view it in Microsoft Excel or Open Office.</p>
				<p class="howto">Enter a date range or leave both boxes empty to export all records</p>
					<?php 	$download_link = esc_url(add_query_arg(array('download_subs' => 'yes', 'form_id' => $form_id)));?>
					<form name="export_subs" id="export_subs" method="post" action="<?php echo $download_link;?>">	
					<input type="hidden" id="form_id" name="form_id" value="<?php echo $form_id;?>">
				<p class="button-controls">
				<table>
					<tr>
						<td>Begin Date:</td><td><input type="text" name="begin_date" id="begin_date" class="date" value="<?php echo $_REQUEST['begin_date'];?>"></td>
					</tr><tr>
						<td>End Date:</td><td><input type="text" name="end_date" id="end_date" class="date" value="<?php echo $_REQUEST['end_date'];?>"></td>
					</tr>
				</table>
				</p>
					<input type="submit" name="submit" id="submit" value="submit" style="display:none;">
					</form>
					<p><input type="button" name="" id="export_subs_submit" value="Download"></p>
			</div>
		</div>
		<?php
				break;
				case 'manage-subs':
		?>
		<div id="manage-subs" class="postbox" name="subs-settings-list">
		<div class="handlediv" id="handle-manage-sub" title="Click to toggle"><br></div>
			<h3 >
				<span>Manage Submissions</span>
			</h3>
			<div class="inside" id="manage-sub" <?php if($manage_sub_state == 'closed' OR $echoed){ echo 'style="display:none;"'; }else{$echoed = true;}?>>
				<p class="howto"></p>
				<p class="button-controls">
					<a href="#" id="purge_old_fields_<?php echo $form_id;?>" class="ninja_purge_old_fields">Purge old field data</a><?php if($plugin_settings['admin_help'] == 'checked'){ ?> <img id="purge_fields" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
				</p>
				<p class="button-controls">
					<a href="#" id="delete_all_subs_<?php echo $form_id;?>" class="ninja_delete_all_subs">Delete all current submission data</a><?php if($plugin_settings['admin_help'] == 'checked'){ ?> <img id="delete_subs" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
				</p>
			</div>
		</div>
		<?php
				break;
			}
		}
		?>
	</span>
		<?php
		
		break;
		}
	?>
</div>