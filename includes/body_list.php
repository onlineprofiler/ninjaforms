<?php

$ninja_all_forms = $wpdb->get_results( 
$wpdb->prepare("SELECT * FROM $ninja_forms_table_name ORDER BY title ASC")
, ARRAY_A);



?>
	<table class="widefat" cellspacing="0" id="all-plugins-table"> 
	<thead> 
		<tr> 
			<th class="mange-column">Action</th> 
			<th class="mange-column">Title</th>				
			<th class="mange-column">Preview</th> 
			<th class="mange-column">Submissions</th> 
			<th class="mange-column">Shortcode</th> 
			
		</tr> 
	</thead> 
	<tbody class="plugins"> 
		<?php 
		if($ninja_all_forms){	
			foreach($ninja_all_forms as $form){ 
			$form_title = stripslashes($form['title']);
			$form_id = $form['id'];
			$edit_link = esc_url(add_query_arg(array('tab' => 'settings', 'ninja_form_id' => $form['id'])));
			$preview_link = esc_url(add_query_arg(array('tab' => 'preview', 'ninja_form_id' => $form['id'])));
			$subs_link = esc_url(add_query_arg(array('tab' => 'subs', 'ninja_form_id' => $form['id'])));
			$download_link = esc_url(add_query_arg(array('download_subs' => 'yes', 'form_id' => $form_id)));
		?>
		<tr>
			<td><a href="<?php echo $edit_link;?>">Edit</a> | <span class="delete"><a class="ninja_form_delete" href="#" id="<?php echo $form_id;?>"><?php _e('Delete'); ?></a></span></td>
			<td><?php echo $form_title;?></td>
			<td><a href="<?php echo $preview_link;?>">Preview Form</a></td>
			<td><a href="<?php echo $subs_link;?>">View Submissions</a> | <a href="<?php echo $download_link;?>">Download submissions as .xls</td>
			<td>[ninja_display_form id=<?php echo $form_id;?>]</td>
		</tr>
		<?php 
			} 
		}else{
		?>
		<tr>
			<td>No Forms Found. Would you like to <a class="button-secondary ninja_new_form" id="" name=""><?php esc_attr_e('Add A New One'); ?>?</a></td>
			<td></td>
			<td></td>
			<td></td>

		</tr>
		<?php
		}
		
		?>
	</tbody> 

<tfoot> 
		<tr> 
			<th class="mange-column">Action</th> 
			<th class="mange-column">Title</th> 
			<th class="mange-column">Preview</th> 
			<th class="mange-column">Submissions</th> 
			<th class="mange-column">Shortcode</th> 
			
		</tr> 
	</tfoot> 


</table>