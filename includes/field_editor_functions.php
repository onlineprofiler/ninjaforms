<?php
function ninja_form_field_editor($field_id, $new_field){
	global $wpdb, $wp_editor, $wp_version;
	$plugin_settings = get_option("ninja_forms_settings");
	$ninja_forms_table_name = $wpdb->prefix . "ninja_forms";
	$ninja_forms_fields_table_name = $wpdb->prefix . "ninja_forms_fields";
	$id = $field_id;
	$field = $wpdb->get_row( 
	$wpdb->prepare("SELECT * FROM $ninja_forms_fields_table_name WHERE id = %d", $id)
	, ARRAY_A);
	$label = stripslashes($field['label']);
	$form_id = $field['form_id'];
	$type = $field['type'];
	$value = stripslashes($field['value']);
	$req = $field['req'];
	
	$extra = $field['extra'];
	$extra = unserialize($extra);
	$form = $wpdb->get_row( 
	$wpdb->prepare("SELECT * FROM $ninja_forms_table_name WHERE id = %d", $form_id)
	, ARRAY_A);
	
	$ninja_post = $form['post'];
	//print_r($extra);
	
	if(isset($extra['extra']['mask'])){
		$mask = $extra['extra']['mask'];
	}else{
		$mask = '';
	}
	if(isset($extra['extra']['email'])){
		$email = $extra['extra']['email'];
	}else{
		$email = '';
	}
	if(isset($extra['extra']['send_email'])){
		$send_email = $extra['extra']['send_email'];
	}else{
		$send_email = '';
	}
	if(isset($extra['extra']['email_confirm'])){
		$email_confirm = $extra['extra']['email_confirm'];
	}else{
		$email_confirm = '';
	}
	if(isset($extra['extra']['show_help'])){
		$show_help = $extra['extra']['show_help'];
	}else{
		$show_help = '';
	}
	if(isset($extra['extra']['list_type'])){
		$list_type = $extra['extra']['list_type'];
	}else{
		$list_type = '';
	}
	if(isset($extra['extra']['datepicker'])){
		$datepicker = $extra['extra']['datepicker'];
	}else{
		$datepicker = '';
	}
	if(isset($extra['extra']['label_pos'])){
		$label_pos = $extra['extra']['label_pos'];
	}else{
		$label_pos = '';
	}
	if(isset($extra['extra']['list_item'])){
		$items = $extra['extra']['list_item'];
	}else{
		$items = '';
	}
	if(isset($extra['extra']['list_default'])){
		$list_default = $extra['extra']['list_default'];
	}else{
		$list_default = '';
	}
	if(isset($extra['extra']['desc_cont'])){
		$desc_cont = $extra['extra']['desc_cont'];
	}else{
		$desc_cont = '';
	}
	if(isset($extra['extra']['create_cat'])){
		$create_cat = $extra['extra']['create_cat'];
	}else{
		$create_cat = '';
	}
	if(isset($extra['extra']['meta_key'])){
		$meta_key = $extra['extra']['meta_key'];
	}else{
		$meta_key = '';
	}
	if(isset($extra['extra']['rte'])){
		$rte = $extra['extra']['rte'];
	}else{
		$rte = '';
	}
	if(isset($extra['extra']['media_upload'])){
		$media_upload = $extra['extra']['media_upload'];
	}else{
		$media_upload = '';
	}
	if(isset($extra['extra']['upload_types'])){
		$upload_types = $extra['extra']['upload_types'];
	}else{
		$upoad_types = '';
	}
	if(isset($extra['extra']['upload_rename'])){
		$upload_rename = $extra['extra']['upload_rename'];
	}else{
		$upload_rename = '';
	}
	//print_r($items);
	
	if($type == 'submit'){
		$type_class = 'submitbutton';
	}elseif($type == 'hidden'){
		$type_class = 'ninja-hidden-field';
	}else{
		$type_class = $type;
	}
	$class = $field['class'];
	if(!$class){
		$class = "Comma,Separated,List";
	}
	$help = stripslashes($field['help']);
	$li_label = "";
	if($type == 'hr' ){
		$li_label = 'Horizontal Rule';
	}elseif($type == 'desc'){
		$li_label = 'Description Text';
	}elseif($type == 'spam'){
		$li_label = 'Anti-Spam Question';
	}elseif($type == 'progressbar'){
		$li_label = 'Progress Bar';
	}elseif($type == 'steps'){
		$li_label = 'Progress "Steps" Indicator';
	}
	if($li_label == ""){
		if($label != ''){
			$li_label = $label;
		}else{
			$li_label = $type;
		}
		$label_label = "Label";
	}else{
		$label_label = $li_label;
	}
	if($type == 'hidden'){
		$label_label = 'Field Name';
	}elseif($type == 'divider'){
		$label_label = 'Section Name';
	}elseif($type == 'steps'){
		$label_label = '"Step" Label';
	}
	if($new_field){
		$li_class = "menu-item-edit-active";
	}else{
		$li_class = "menu-item-edit-inactive";
	}

	
?>
	<li id="field_<?php echo $id; ?>" class="<?php echo $li_class;?>">
		<input type="hidden" id="ninja_field_<?php echo $id;?>_type" value="<?php echo $type;?>">
		<dl class="menu-item-bar">
			<dt class="menu-item-handle <?php echo $type_class;?>" >
				<span class="item-title" id="field_title_<?php echo $id;?>"><?php echo $li_label;?></span>
				<span class="item-controls">
					<span class="item-type"><?php echo $type;?></span>
					<a class="item-edit" id="edit-<?php echo $id; ?>" title="<?php _e('Edit Menu Item'); ?>" href="#"><?php _e( 'Edit Menu Item' ); ?></a>
				</span>
			</dt>
		</dl>

		<div class="menu-item-settings <?php echo $type_class;?>" id="menu-item-settings-<?php echo $id; ?>">
		<?php
		if($type != 'hr' && $type != 'desc' && $type != 'progressbar'){
		?>
					<p class="description description-wide">
						<label for="field_<?php echo $id;?>[label]">
							<?php _e($label_label); ?><br />
							<input type="text" class="widefat code ninja_field_label" name="field_<?php echo $id;?>[label]" id="field_<?php echo $id;?>[label]" value="<?php echo $label;?>" />
						</label>
					</p>
					<?php
					if($type != 'hr' && $type != 'desc' && $type != 'heading' && $type != 'spam' && $type != 'submit' && $type != 'hidden' && $type != 'divider' && $type != 'progressbar' && $type != 'steps' && $type != 'steps'){
					?>
					<p class="description description-wide">					
						<label for="field_<?php echo $id;?>[extra][label_pos]">
							<?php _e('Label Position'); ?><br />
							<select id="field_<?php echo $id;?>[extra][label_pos]" name="field_<?php echo $id;?>[extra][label_pos]" class="widefat ninja_label_pos">
								<?php if($list_type != 'radio'){?><option value="left" <?php if($label_pos == 'left'){ echo 'selected';}?>>Left of Element</option><?php }?>
								<?php if($list_type != 'radio'){?><option value="right" <?php if($label_pos == 'right'){ echo 'selected';}?> >Right of Element</option><?php }?> 								
								<option value="above" <?php if($label_pos == 'above'){ echo 'selected';}?>>Above Element</option>
								<?php if($list_type != 'radio' && $type != 'checkbox'){?><option value="inside" <?php if($label_pos == 'inside'){ echo 'selected';}?>>Inside Element</option><?php }?>
							</select>
						</label>
					</p>
		<?php
					}
		}
			switch($type){
				case 'textbox': //Begin TextBox Editor Output.
				$custom = '';
				?>
					<p class="description description-thin">
						<label for="field_<?php echo $id;?>[value]">
							<?php _e( 'Default Value' ); ?><br />
							<select id="field_default_select_<?php echo $id;?>" name="" class="widefat ninja_default_select">
								<option value="none" <?php if($value == 'none'){ echo 'selected'; $custom = 'no';}?>><?php _e('None'); ?></option>
								<option value="ninja_user_firstname" <?php if($value == 'ninja_user_firstname'){ echo 'selected'; $custom = 'no';}?>><?php _e('User Firstname (If logged in)'); ?></option>
								<option value="ninja_user_lastname" <?php if($value == 'ninja_user_lastname'){ echo 'selected'; $custom = 'no';}?>><?php _e('User Lastname (If logged in)'); ?></option>
								<option value="ninja_user_email" <?php if($value == 'ninja_user_email'){ echo 'selected'; $custom = 'no';}?>><?php _e('User Email (If logged in)'); ?></option>
								<option value="custom" <?php if($custom != 'no'){ echo 'selected';}?>><?php _e('Custom ->'); ?></option>
							</select>
						</label>
					</p>
					<p class="description description-thin">
						<label for="field_<?php echo $id;?>[value]" id="field_default_<?php echo $id;?>_cont" style="<?php if($custom == 'no'){ echo 'display:none;';}?>">
							<?php _e( 'Default Value' ); ?><br />
							<input type="text" class="widefat code" name="field_<?php echo $id;?>[value]" id="field_<?php echo $id;?>[value]" value="<?php echo $value;?>" />
						</label>
					</p>
					<?php $custom = '';?>
					<p class="description description-thin">
						<label for="field_mask_select_<?php echo $id;?>">
							<?php _e( 'Input Mask' ); ?><br />
							<select id="field_mask_select_<?php echo $id;?>"  name="" class="widefat ninja_mask_select">
								<option value="none" <?php if($mask == 'none'){ echo 'selected'; $custom = 'no';}?>><?php _e('None'); ?></option>
								<option value="(999) 999-9999" <?php if($mask == '(999) 999-9999'){ echo 'selected'; $custom = 'no';}?>><?php _e('Phone - (555) 555-5555'); ?></option>
								<option value="99/99/9999" <?php if($mask == '99/99/9999'){ echo 'selected'; $custom = 'no';}?>><?php _e('Date - mm/dd/yyyy'); ?></option>
								<option value="dollars" <?php if($mask == 'dollars'){ echo 'selected'; $custom = 'no';}?>><?php _e('Dollars - $10.99'); ?></option>
								<option value="custom" <?php if($custom != 'no'){ echo 'selected';}?>><?php _e('Custom ->'); ?></option>
							</select>
						</label>
					</p>
					<p class="description description-thin">
						<label for="field_<?php echo $id;?>[extra][mask]"  id="field_mask_<?php echo $id;?>_cont" style="<?php if($custom == 'no'){ echo 'display:none;';}?>">
							<?php _e( 'Custom Mask Definition' ); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" name="mask_help" class="ninja_help_open">Help</a><br />
							<input type="text" id="field_<?php echo $id;?>[extra][mask]" name="field_<?php echo $id;?>[extra][mask]" class="widefat code" value="<?php echo $mask; ?>" />
						</label>
					</p>
					<p class="description description-thin">
						<label for="field_<?php echo $id;?>[extra][datepicker]">
							<?php _e( 'Date Picker?' ); ?>
							<input type="checkbox" value="checked" name="field_<?php echo $id;?>[extra][datepicker]" id="field_<?php echo $id;?>[extra][datepicker]" class="ninja_datepicker" <?php echo $datepicker;?>>
						</label>
					</p>
					<p class="description description-thin">
							<label for="field_<?php echo $id;?>[extra][email]">
							<?php _e( 'Is this an email address?' ); ?>
							<input type="checkbox" value="checked" name="field_<?php echo $id;?>[extra][email]" id="field_<?php echo $id;?>[extra][email]" class="ninja_email" <?php echo $email;?>>
						</label> <?php if($plugin_settings['admin_help'] == 'checked'){ ?><img class="extra_email" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"> <?php } ?>
					</p>
					<p class="description description-wide">
							<label for="field_<?php echo $id;?>[extra][send_email]" id="field_send_email_<?php echo $id;?>_cont" style="<?php if($email != 'checked'){ echo 'display:none;';}?>">
							<?php _e( 'Send a copy of the form to this address?' ); ?>
							<input type="checkbox" value="checked" name="field_<?php echo $id;?>[extra][send_email]" id="field_<?php echo $id;?>[extra][send_email]" class="ninja_email" <?php echo $send_email;?>> 
						 <?php if($plugin_settings['admin_help'] == 'checked'){ ?><img class="send_email" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"> <?php } ?></label> 
					</p>
					<?php
					break; //End TextBox Editor Output.
				case 'list': //Begin List Output
					?>
					<p class="description description-wide">
						<label for="field_<?php echo $id;?>[extra][list_type]">
							<?php _e( 'List Type' ); ?><br />
							<select id="field_<?php echo $id;?>[extra][list_type]" name="field_<?php echo $id;?>[extra][list_type]" class="widefat ninja_list_type">
								<option value="select" <?php if($list_type == 'select'){ echo 'selected';}?>>Dropdown</option>
								<option value="multi" <?php if($list_type == 'multi'){ echo 'selected';}?>>Multi-Select</option>
								<option value="radio" <?php if($list_type == 'radio'){ echo 'selected';}?>>Radio Buttons</option>
							</select>
						</label>
					</p>
					<p class="description ">
						<label for="field_<?php echo $id;?>[value]">
							<?php _e( 'Values:' ); ?> <a href="#" id="add_select_item_<?php echo $id;?>" name="add_select_item_<?php echo $id;?>" class="ninja_add_select_item">Add New</a><br />
							<ul id="select_items_<?php echo $id;?>" name="select_items_<?php echo $id;?>" class="ninja_select_items">
								<?php
									$x = 0;
									if($items){
										foreach($items as $value){
										$value = stripslashes($value);
										$value = htmlspecialchars($value);
								?>
								<li id="select_item_<?php echo $id;?>_<?php echo $x;?>" name="select_item_<?php echo $id;?>_<?php echo $x;?>">
									<input type="text" class="code" name="field_<?php echo $id;?>[extra][list_item][<?php echo $x;?>]" id="field_<?php echo $id;?>[extra][list_item][<?php echo $x;?>]" value="<?php echo $value;?>" />
									<span class="menu-item-handle">Drag | 
									<a href="#" id="remove_select_item_<?php echo $id;?>_<?php echo $x;?>" name="remove_select_item_<?php echo $id;?>_<?php echo $x;?>" class="deletion ninja_remove_select_item">Remove</a> | 
									<label for="select_item_default_<?php echo $id;?>_<?php echo $x;?>">Selected</label> <input type="hidden" class="ninja_select_item_default" value="unchecked" name="select_item_default_<?php echo $id;?>_<?php echo $x;?>"><input type="checkbox" class="ninja_select_item_default" value="checked" id="select_item_default_<?php echo $id;?>_<?php echo $x;?>" name="select_item_default_<?php echo $id;?>_<?php echo $x;?>" <?php if($value == $list_default){ echo "checked";};?>></span>
								</li>
								<?php
											$x++;
										}
									}
								?>
							</ul>
						</label>
					</p>
					<input type="hidden" name="field_<?php echo $id;?>[extra][list_default]" id="field_<?php echo $id;?>[extra][list_default]" value="<?php echo $list_default;?>">
					<?php
					break; //End List Output.
				case 'checkbox': //Begin Checkbox Output.
					?>
						<p class="description description-wide">
							<label for="field_<?php echo $id;?>[value]">
								<?php _e( 'Default Value' ); ?><br />
								<select id="field_<?php echo $id;?>[value]" name="field_<?php echo $id;?>[value]" class="widefat">
								<option value="unchecked" <?php if($value == 'unchecked'){ echo 'selected';}?>><?php _e("Unchecked");?></option>
								<option value="checked" <?php if($value == 'checked'){ echo 'selected';}?>><?php _e("Checked");?></option>
								</select>
							</label>
						</p>
					<?php
					break; //End Checkbox Output.
				case 'textarea': //Begin Textarea Output
					?>
					<p class="description description-wide">
						<label for="field_<?php echo $id;?>[value]">
							<?php _e( 'Default Value' ); ?><br />
							<textarea class="widefat code" name="field_<?php echo $id;?>[value]" id="field_<?php echo $id;?>[value]" /><?php echo $value;?></textarea>
						</label>
					</p>
					<p class="description description-thin">
						<label for="field_<?php echo $id;?>[extra][rte]">
							<input type="hidden" name="field_<?php echo $id;?>[extra][rte]" value="unchecked"><input type="checkbox" id="field_<?php echo $id;?>[extra][rte]" name="field_<?php echo $id;?>[extra][rte]" value="checked" <?php echo $rte;?> class="ninja-rte-checkbox"> Show Rich Text Editor
						</label>
						<?php if($plugin_settings['admin_help'] == 'checked'){ ?><img id="" class="show_rte" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
					</p>					
					<p class="description description-thin">
						<label for="field_<?php echo $id;?>[extra][media_upload]" id="field_<?php echo $id;?>[extra][media_upload]_cont" style="<?php if($rte != 'checked'){ echo "display:none";}?>">
							<input type="hidden" name="field_<?php echo $id;?>[extra][media_upload]" value="unchecked"><input type="checkbox" id="field_<?php echo $id;?>[extra][media_upload]" name="field_<?php echo $id;?>[extra][media_upload]" value="checked" <?php echo $media_upload;?>> Allow Media Uploads
							<?php if($plugin_settings['admin_help'] == 'checked'){ ?><img id="" class="show_upload" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
						</label>
					</p>
					<?php
					break; //End Textarea Output.
				case 'hr': //Begin HR output
					?>
					
					<?php
					break; //End HR output
				case 'heading': //Begin Heading output
					?>
					<p class="description description-thin">
							<label for="field_<?php echo $id;?>[value]">
								<?php _e( 'Heading Size:' ); ?><br />
								<select name="field_<?php echo $id;?>[value]" id="field_<?php echo $id;?>[value]">
									<option value="H2" <?php if($value == "H2"){ echo "selected";}?>>H2</option>
									<option value="H3" <?php if($value == "H3"){ echo "selected";}?>>H3</option>
									<option value="H4" <?php if($value == "H4"){ echo "selected";}?>>H4</option>
									<option value="H5" <?php if($value == "H5"){ echo "selected";}?>>H5</option>
									<option value="H6" <?php if($value == "H6"){ echo "selected";}?>>H6</option>
								</select>
							</label>
						</p>
					<?php
					break; //End Heading Output.
				case 'spam': //Begin Spam Output.
					?>
					<p class="description description-wide">
						<label for="field_<?php echo $id;?>[value]">
							<?php _e( 'Correct Answer' ); ?><br />
							<input type="text" class="widefat code" name="field_<?php echo $id;?>[value]" id="field_<?php echo $id;?>[value]" value="<?php echo $value;?>">
						</label>
					</p>
					<p class="description description-wide">					
						<label for="field_<?php echo $id;?>[extra][label_pos]">
							<?php _e('Label Position'); ?><br />
							<select id="field_<?php echo $id;?>[extra][label_pos]" name="field_<?php echo $id;?>[extra][label_pos]" class="widefat ninja_label_pos">
								<option value="left" <?php if($label_pos == 'left'){ echo 'selected';}?>>Left of Element</option>
								<option value="right" <?php if($label_pos == 'right'){ echo 'selected';}?>>Right of Element</option>
								<option value="above" <?php if($label_pos == 'above'){ echo 'selected';}?>>Above Element</option>
								<option value="inside" <?php if($label_pos == 'inside'){ echo 'selected';}?>>Inside Element</option>
							</select>
						</label>
					</p>
					<?php
					break; //End Spam Output.
				case 'desc': //Begin Description Output.
					?>
					<p class="description description-wide">
						<label for="field_value_<?php echo $id;?>">
							<?php _e( 'Description Text' ); ?><br />
						</label>
					</p>
					<p>
					<?php
					if($new_field){
						
					}else{
						if(version_compare( $wp_version, '3.3-beta3-19254' , '<')){
							echo $wp_editor->editor($value, "field_".$id."[value]", array('media_buttons_context' => '<span>Insert a media file: </span>', 'upload_link_title' => 'Media Uploader - NinjaForms'), true);
						}else{
							$args = array("media_buttons" => true);
							wp_editor($value, "field_".$id."[value]" , $args);
						}
					}
					?>
					
					</p>
					<p class="description description-thin">
							<label for="field_<?php echo $id;?>[extra][cont]">
								<?php _e( 'Description Container:' ); ?><br />
								<select name="field_<?php echo $id;?>[extra][desc_cont]" id="field_<?php echo $id;?>[extra][desc_cont]">
									<option value="p" <?php if($desc_cont == "p"){ echo 'selected';}?>>p</option>
									<option value="div" <?php if($desc_cont == "div"){ echo 'selected';}?>>div</option>
									<option value="span" <?php if($desc_cont == "span"){ echo 'selected';}?>>span</option>
								</select>
							</label>
						</p>
					<?php
					break; //End Description Output.
					case 'submit':
					?>
					
					<?php
					break;
					case 'hidden': //Begin Hidden Output
					?>
					<p class="description description-thin">					
						<label for="field_<?php echo $id;?>[value]">
							<?php _e('Value'); ?><br />
							<select id="field_<?php echo $id;?>[value]" name="field_<?php echo $id;?>[value][select]" class="ninja_form_hidden">
								<option value="ninja_user_ID" <?php if($value == 'ninja_user_ID'){ echo 'selected';}?>>User ID (If Logged In)</option>
								<option value="ninja_custom" <?php if($value != 'ninja_user_ID'){ echo 'selected';}?>>Custom Value</option>
							</select>
						</label>
					</p>
					<p class="description description-thin" id="ninja_form_hidden_<?php echo $id;?>" <?php if($value == 'ninja_user_ID'){ ?>style="display:none;"<?php } ?>>
						<?php _e('Custom Value'); ?><br />
						<input type="text" name="field_<?php echo $id;?>[value]" id="field_<?php echo $id;?>[value][text]" value="<?php echo $value;?>">
					</p>
					<?php
					break; //End Hidden Output					
					case 'divider': //Begin Multi-Form divider Output
					?>
					
					<?php
					break; //End Multi-Form divider Output
					case 'progressbar':
					
					
					break;
					case 'steps':
					
					break;
					
					case 'posttitle':
					
					break;
					
					case 'postcontent':
					?>
						<p class="description description-thin">
							<label for="field_<?php echo $id;?>[extra][rte]">
								<input type="hidden" name="field_<?php echo $id;?>[extra][rte]" value="unchecked"><input type="checkbox" id="field_<?php echo $id;?>[extra][rte]" name="field_<?php echo $id;?>[extra][rte]" value="checked" <?php echo $rte;?> class="ninja-rte-checkbox"> Show Rich Text Editor
							</label>
							<?php if($plugin_settings['admin_help'] == 'checked'){ ?><img id="" class="show_rte" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
						</p>
						<p class="description description-thin">
							<label for="field_<?php echo $id;?>[extra][media_upload]" id="field_<?php echo $id;?>[extra][media_upload]_cont" style="<?php if($rte != 'checked'){ echo "display:none";}?>">
								<input type="hidden" name="field_<?php echo $id;?>[extra][media_upload]" value="unchecked"><input type="checkbox" id="field_<?php echo $id;?>[extra][media_upload]" name="field_<?php echo $id;?>[extra][media_upload]" value="checked" <?php echo $media_upload;?>> Allow Media Uploads
								<?php if($plugin_settings['admin_help'] == 'checked'){ ?><img id="" class="show_upload" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"><?php } ?>
							</label>
						</p>
					<?php
					break;	
					
					case 'postexcerpt':

					break;
					
					case 'postcat':
						?>
						<p class="description description-wide">
							<label for="field_<?php echo $id;?>[extra][create_cat]">
								<input type="hidden" name="field_<?php echo $id;?>[extra][create_cat]" value="unchecked"><input type="checkbox" id="field_<?php echo $id;?>[extra][create_cat]" name="field_<?php echo $id;?>[extra][create_cat]" value="checked" <?php echo $create_cat;?>> Users Can Create Categories
							</label>
						</p>
						<?php
					break;
					
					case 'posttags':
					
					break;					
					
					case 'file':
					?>
					<p class="description description-wide">
						<label for="field_<?php echo $id;?>[extra][upload_types]">
							Comma Separated List of allowed file types. An empty list means all file types are accepted. (i.e. .jpg, .gif, .png, .pdf)
						</label>
					</p>
					<p class="description description-wide">
						This is not fool-proof and can be tricked, please remember that there is always a danger in allowing users to upload files.
					</p>
					
					<p class="description description-wide">
						<input type="text" class="code widefat" name="field_<?php echo $id;?>[extra][upload_types]" id="field_<?php echo $id;?>[extra][upload_types]" value="<?php echo $upload_types;?>">
					</p>
					<a href="#" id="upload_rename_<?php echo $id;?>" class="ninja-advanced">Advanced FIle Naming Options</a>
					<p class="description description-wide" id="upload_rename_<?php echo $id;?>_cont" <?php if(!$upload_rename){ echo 'style="display:none;"';}?>>
						<label for="field_<?php echo $id;?>[extra][upload_rename]">
							If you aren't sure you want to give the uploaded file a special name, please leave this box blank. <a href="#" name="rename_help" class="ninja_help_open">Help Renaming Files</a>
						</label>
						<input type="text" class="code widefat" name="field_<?php echo $id;?>[extra][upload_rename]" id="field_<?php echo $id;?>[extra][upload_rename]" value="<?php echo $upload_rename;?>">
					</p>
					<?php
					break;
			} //End $type switch
			
			if($type != 'hr' && $type != 'desc' && $type != 'heading' && $type != 'submit' && $type != 'hidden' && $type != 'divider' && $type != 'progressbar' && $type != 'steps'){
			?>
			
			<p class="description-wide">
						<hr>
			</p>
			<p class="description description-thin">
				<label for="field_<?php echo $id;?>[req]">
					<?php _e( 'Required?' ); ?><br />
					<select name="field_<?php echo $id;?>[req]" id="field_<?php echo $id;?>[req]">
						<option value="1" <?php if($req == 1){ echo "selected";}?>><?php _e('Yes');?></option>
						<option value="0" <?php if($req == 0){ echo "selected";}?>><?php _e('No');?></option>
					</select>
				</label>
			</p>
			<?php
			}
			if($type != 'hr' && $type != 'hidden' && $type != 'divider' && $type != 'progressbar' && $type != 'steps'){
			?>
			<p class="description description-thin">
				<label for="field_<?php echo $id;?>[class]">
					<?php _e( 'Custom CSS Classes' ); ?><br />
					<input type="text" id="field_<?php echo $id;?>[class]" name="field_<?php echo $id;?>[class]" class="widefat code" value="<?php echo $class;?>" />
				</label>
			</p>
			<?php
			}
			if($type != 'hr' && $type != 'desc' && $type != 'heading' && $type != 'hidden' && $type != 'divider' && $type != 'progressbar' && $type != 'steps'){
			?>
			<p class="description description-wide">
					<label for="field_<?php echo $id;?>[help]">
					<?php _e( 'Help Text' ); ?> 
					</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label for="field_<?php echo $id;?>[extra][show_help]">
					<?php _e( 'Show Help Text?' ); ?>
					<input type="hidden" name="field_<?php echo $id;?>[extra][show_help]" value="unchecked"><input type="checkbox" value="checked" name="field_<?php echo $id;?>[extra][show_help]" id="field_<?php echo $id;?>[extra][show_help]" <?php echo $show_help;?>>
					</label>
					<textarea id="field_<?php echo $id;?>[help]" name="field_<?php echo $id;?>[help]" class="widefat " rows="3" cols="20" ><?php echo $help;?></textarea>
					<span class="description"><?php _e('If "help text" is enabled, there will be a question mark <img src="'.NINJA_FORMS_URL.'/images/question-ico.gif"> placed next to the input field. Hovering over this question mark will show the help text.'); ?></span>
			</p>
			<?php
			}
				$meta_keys = $wpdb->get_results("SELECT meta_key FROM $wpdb->postmeta", ARRAY_A);
				$meta_array = array();
				$x = 0;
				foreach($meta_keys as $key){
					$first_char = substr($key['meta_key'], 0, 1);
					if($first_char != '_'){
						$meta_array[$x] = $key['meta_key'];
						/*foreach($meta_array as $item){
							if($key != $item){
								$item[$x] = $key;
								$x++;
							}
						}*/
						$x++;
					}
				}
				$meta_array = array_unique($meta_array);
				if($type != 'hr' && $type != 'divider' && $type != 'progressbar' && $type != 'steps' && $type != 'spam' && $type != 'submit' && $type != 'desc' && $type != 'posttitle' && $type != 'postcontent' && $type != 'postexcerpt' && $type != 'postcat' && $type != 'posttags'){
			?>
			<div class="button-controls ninja_post_options" id="" style="<?php if($ninja_post != "checked" AND ($type != 'posttitle' OR $type != 'postcontent' OR $type != 'postexcerpt' OR $type != 'postcat' OR $type != 'posttags')){ echo "display:none;";}?>">
				<p class="description description-wide">
					Select Post Meta Value
					<select id="field_<?php echo $id;?>[extra][meta_key]" name="field_<?php echo $id;?>[extra][meta_key]">
						<option value="_new">-- New Meta Key</option>
						<?php
							foreach($meta_array as $meta){
								$meta = htmlentities($meta);
								$meta = stripslashes($meta);
								$meta_key = htmlentities($meta_key);
								$meta_key = stripslashes($meta_key);
							?>
						<option value="<?php echo $meta;?>" <?php if($meta == $meta_key){ echo 'selected'; }?>><?php echo $meta;?></option>
							<?php
							
							}
						?>
					</select>
					<?php if($plugin_settings['admin_help'] == 'checked'){ ?><img class="meta_key" src="<?php echo NINJA_FORMS_URL;?>/images/question-ico.gif"> <?php } ?>
				</p>
			</div>
			<?php
				}
			?>
			<div class="menu-item-actions description-wide submitbox">
				<a class="submitdelete deletion ninja_field_delete" id="ninja_field_delete_<?php echo $id;?>" name="ninja_new_<?php echo $type;?>_<?php echo $form_id;?>" href="#"><?php _e('Remove'); ?></a>
			</div>
		</div><!-- .menu-item-settings-->
		</li>
			<?php

}