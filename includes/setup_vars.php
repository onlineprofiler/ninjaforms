<?php
if(isset($_REQUEST['ninja_form_id'])){
	$form_id = $_REQUEST['ninja_form_id'];
}else{
	$form_id = '';
}
if(isset($_REQUEST['tab'])){
	$current_tab = $_REQUEST['tab'];
}else{
	$current_tab = '';
}
$plugin_settings = get_option("ninja_forms_settings");

if(isset($plugin_settings['settings_sidebar_order'])){
	$settings_sidebar_order = $plugin_settings['settings_sidebar_order'];
}else{
	$settings_sidebar_order = '';
}
if(isset($plugin_settings['fields_sidebar_order'])){
	$fields_sidebar_order = $plugin_settings['fields_sidebar_order'];
}else{
	$fields_sidebar_order = '';
}
if(isset($plugin_settings['subs_sidebar_order'])){
	$subs_sidebar_order = $plugin_settings['subs_sidebar_order'];
}else{
	$subs_sidebar_order = '';
}
if(isset($plugin_settings['sub-settings'])){
	$sub_settings_state = $plugin_settings['sub-settings'];
}else{
	$sub_settings_state = '';
}
if(isset($plugin_settings['post-settings'])){
	$post_settings_state = $plugin_settings['post-settings'];
}else{
	$post_settings_state = '';
}
if(isset($plugin_settings['page-settings'])){
	$page_settings_state = $plugin_settings['page-settings'];
}else{
	$page_settings_state = '';
}
if(isset($plugin_settings['predefined-fields'])){
	$predefined_fields_state = $plugin_settings['predefined-fields'];
}else{
	$predefined_fields_state = '';
}
if(isset($plugin_settings['cust-fields'])){
	$cust_fields_state = $plugin_settings['cust-fields'];
}else{
	$cust_fields_state = '';
}
if(isset($plugin_settings['layout-fields'])){
	$layout_fields_state = $plugin_settings['layout-fields'];
}else{
	$layout_fields_state = '';
}
if(isset($plugin_settings['multi-settings'])){
	$multi_settings_state = $plugin_settings['multi-settings'];
}else{
	$multi_settings_state = '';
}
if(isset($plugin_settings['post-settings'])){
	$post_settings_state = $plugin_settings['post-settings'];
}else{
	$post_settings_state = '';
}
if(isset($plugin_settings['subs-export'])){
	$subs_export_state = $plugin_settings['subs-export'];
}else{
	$subs_export_state = '';
}
if(isset($plugin_settings['manage-sub'])){
	$manage_sub_state = $plugin_settings['manage-sub'];
}else{
	$manage_sub_state = '';
}
//print_r($plugin_settings);



if($form_id != 'new'){
	$ninja_forms_row = $wpdb->get_row( 
	$wpdb->prepare("SELECT * FROM $ninja_forms_table_name WHERE id = %d", $form_id)
	, ARRAY_A);
	$ninja_forms_fields = $wpdb->get_results(
	$wpdb->prepare( "SELECT * FROM $ninja_forms_fields_table_name WHERE form_id= %d ORDER BY field_order ASC", $form_id)
	, ARRAY_A);
	
	$new_spam = '';
	$new_submit = '';
	$new_progressbar = '';
	$new_steps = '';
	$new_posttitle = '';
	$new_postcontent = '';
	$new_postexcerpt = '';
	$new_postcat = '';
	$new_posttags = '';
	
	if($ninja_forms_fields){
		foreach($ninja_forms_fields as $field){
			switch($field['type']){
				case 'spam':
					$new_spam = 'no';
					break;
				case 'submit':
					$new_submit = 'no';
					break;
				case 'progressbar':
					$new_progressbar = 'no';
					break;
				case 'steps':
					$new_steps = 'no';
					break;
				case 'posttitle':
					$new_posttitle = 'no';
					break;
				case 'postcontent':
					$new_postcontent = 'no';
					break;
				case 'postexcerpt':
					$new_postexcerpt = 'no';
					break;
				case 'postcat':
					$new_postcat = 'no';
					break;				
				case 'posttags':
					$new_posttags = 'no';
					break;
			}
		}
	}

}
$ninja_all_forms = $wpdb->get_results( 
$wpdb->prepare( "SELECT * FROM $ninja_forms_table_name ORDER BY title ASC")
, ARRAY_A);



if(!$current_tab){
	$current_tab = 'list';
}
if($form_id == 'new'){
	$current_tab = 'settings';
	$tab_list = array('settings' => 'Form Settings');
}else{
	$tab_list = array("settings" => 'Form Settings',"fields" => 'Form Fields',"preview" => 'Form Preview', 'subs' => 'Form Submissions');					
}

if($form_id == 'new'){
	$form_title = 'New Form';
}else{
	$form_title = $ninja_forms_row['title'];
}
$form_mailto = $ninja_forms_row['mailto'];
$form_subject = stripslashes($ninja_forms_row['subject']);
$form_msg = stripslashes($ninja_forms_row['success_msg']);
$form_desc = stripslashes($ninja_forms_row['desc']);
$email_msg = stripslashes($ninja_forms_row['email_msg']); 
$email_from = $ninja_forms_row['email_from'];
$email_fields = unserialize($ninja_forms_row['email_fields']);
$show_title = $ninja_forms_row['show_title'];
$show_desc = $ninja_forms_row['show_desc'];
$multi = $ninja_forms_row['multi'];
$ninja_post = $ninja_forms_row['post'];
$multi_options = $ninja_forms_row['multi_options'];
if($multi_options){
	$multi_options = unserialize($multi_options);
}
if(isset($multi_options['progress_bar'])){
	$progress_bar = $multi_options['progress_bar'];
}else{
	$progress_bar = '';
}
if(isset($multi_options['show_steps'])){
	$show_steps = $multi_options['show_steps'];
}else{
	$show_steps = '';
}
if(isset($multi_options['steps_label'])){
	$steps_label = $multi_options['steps_label'];
}else{
	$steps_label = '';
}
$previous = $multi_options['previous'];
$next = $multi_options['next'];
if(!$next){
	$next = 'Next';
}
if(!$previous){
	$previous = 'Previous';
}
$post_options = $ninja_forms_row['post_options'];
if($post_options){
	$post_options = unserialize($post_options);
}else{
	$post_options = array();
}
if(!isset($post_options['login'])){
	$post_options['login'] = 'checked';
}
if($form_id == 'new'){
	$form_save_subs = 'checked';
}else{
	$form_save_subs = $ninja_forms_row['save_subs'];	
}
if($form_id == 'new'){
	$form_send_email = 'checked';
}else{
	$form_send_email = $ninja_forms_row['send_email'];
}
$form_landing_page= $ninja_forms_row['landing_page'];
if($form_id == 'new'){
	$form_ajax = 'checked';
}else{
	$form_ajax = $ninja_forms_row['ajax'];
}
$save_status = $ninja_forms_row['save_status'];
$save_satus_options = unserialize($ninja_forms_row['save_status_options']);
$save_status_delete = $save_satus_options['delete'];
$save_status_msg = stripslashes($save_satus_options['msg']);
$form_append_page = unserialize($ninja_forms_row['append_page']);


if($plugin_settings['admin_help'] == 'checked'){
?>
<div id="" class="" style="display:none;">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/bottom-left.png">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/bottom-middle.png">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/bottom-right.png">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/middle-left.png">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/middle-right.png">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/tail-left.png">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/tail-top.png">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/top-left.png">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/top-middle.png">
	<img src="<?php echo NINJA_FORMS_URL;?>/js/jquerybubblepopup-theme/all-black/top-right.png">
</div>
<?php
		}
		