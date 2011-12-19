function ninjaSetupPopups(){
	var themePath = settings.plugin_url + "/js/jquerybubblepopup-theme/";
	jQuery(".extra_email").CreateBubblePopup({
		innerHtml: "If this box is checked, NinjaForms will validate this input as an email address.",
		position: "right",
		align: "middle",
		tail: {
				align:"center",
				hidden: false
				},
				innerHtmlStyle: {
							"width": "150px"
						},
		themeName: 	"all-black",
		themePath:     themePath,
		closingDelay: 700
	});		
	jQuery(".send_email").CreateBubblePopup({
		innerHtml: "If this box is checked, NinjaForms will send a copy of this form (and any messages attached) to this address.",
		position: "right",
		align: "middle",
		tail: {
				align:"center",
				hidden: false
				},
				innerHtmlStyle: {
							"width": "150px"
						},
		themeName: 	"all-black",
		themePath:     themePath,
		closingDelay: 700
	});		
	jQuery(".show_rte").CreateBubblePopup({
		innerHtml: "If this box is checked, NinjaForms will use a Rich Text Editor in place of a standard multi-line textarea.",
		position: "right",
		align: "middle",
		tail: {
				align:"center",
				hidden: false
				},
				innerHtmlStyle: {
							"width": "150px"
						},
		themeName: 	"all-black",
		themePath:     themePath,
		closingDelay: 700
	});		
	jQuery(".show_upload").CreateBubblePopup({
		innerHtml: "If this box is checked, NinjaForms will allow users to upload and insert media into the post content. Use with caution.",
		position: "right",
		align: "middle",
		tail: {
				align:"center",
				hidden: false
				},
				innerHtmlStyle: {
							"width": "150px"
						},
		themeName: 	"all-black",
		themePath:     themePath,
		closingDelay: 700
	});		
	jQuery(".meta_key").CreateBubblePopup({
		innerHtml: "Since NinjaForms will be making a Post from this form, what meta_key should this field be attached to?",
		position: "right",
		align: "middle",
		tail: {
				align:"center",
				hidden: false
				},
				innerHtmlStyle: {
							"width": "150px"
						},
		themeName: 	"all-black",
		themePath:     themePath,
		closingDelay: 700
	});	
}

jQuery(document).ready(function($) {
    // $() will work as an alias for jQuery() inside of this function
	var themePath = settings.plugin_url + "/js/jquerybubblepopup-theme/";

	//Plugin Settings Help Tips
	$("#show_help_color").CreateBubblePopup({
		innerHtml: "Sample Help Text",
		position: "right",
		align: "middle",
		tail: {
				align:"center",
				hidden: false
				},
				innerHtmlStyle: {
							"width": settings.help_size + "px"
						},
		themeName: 	settings.help_color,
		themePath:     themePath,
		closingDelay: 1000
	});
	$("#reset_upload_dir").CreateBubblePopup({
		innerHtml: "Clicking this button will reset the upload directory to the NinjaForms default. Use it only if you break file uploads with a bad directory.",
		position: "right",
		align: "middle",
		tail: {
				align:"center",
				hidden: false
				},
				innerHtmlStyle: {
							"width": settings.help_size + "px"
						},
		themeName:	'all-black',
		themePath:     themePath,
		closingDelay: 1000
	});
	$("#license_key").CreateBubblePopup({
		innerHtml: "The license key is only used to enable automatic updates. If your site is behind a firewall or you are having trouble saving changes, leave this field blank.",
		position: "right",
		align: "middle",
		tail: {
				align:"center",
				hidden: false
				},
				innerHtmlStyle: {
							"width": settings.help_size + "px"
						},
		themeName:	'all-black',
		themePath:     themePath,
		closingDelay: 1000
	});
	$("#help_color").change(function(){
		$("#show_help_color").HideBubblePopup();
		var color = $("#help_color").val();
		var size = $("#help_size").val();
		size = size + "px";
		$("#show_help_color").SetBubblePopupOptions({
			innerHtml: "Sample Help Text",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": size
							},
			themeName: color,
			themePath:     themePath,
			closingDelay: 200,
			distance: "120px"
		});
		$("#show_help_color").ShowBubblePopup();
		$("#show_help_color").FreezeBubblePopup();
	});
	$(".ninja_forms_settings").keyup(function(){
		$("#show_help_color").HideBubblePopup();
		var color = $("#help_color").val();
		var size = $("#help_size").val();
		size = size + "px";
		$("#show_help_color").SetBubblePopupOptions({
			innerHtml: "Sample Help Text",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": size
							},
			themeName: color,
			themePath:     themePath,
			closingDelay: 200,
			distance: "120px"
		});
		$("#show_help_color").ShowBubblePopup();
		$("#show_help_color").FreezeBubblePopup();
	});

	$(window).load(function () {
		$("#show_help_color").ShowBubblePopup();
		$("#show_help_color").FreezeBubblePopup();
	});
	//End Plugin Settings Tips
	
	
	
	if(settings.admin_help == 'checked'){
		ninjaSetupPopups(); //This function reapplies all of our tooltips when we add a new field item.
			
		$("#save_subs").CreateBubblePopup({
				innerHtml: "If this box is checked, NinjaForms will save all user submissions.",
				position: "right",
				align: "middle",
				tail: {
						align:"center",
						hidden: false
						},
						innerHtmlStyle: {
									"width": "150px"
								},
				themeName: 	"all-black",
				themePath:     themePath,
				closingDelay: 700
		});						
		$("#send_email").CreateBubblePopup({
				innerHtml: "If this box is checked, NinjaForms will send an email to the user. \n Requires use of the 'Email' Pre-defined Field.",
				position: "right",
				align: "middle",
				tail: {
						align:"center",
						hidden: false
						},
						innerHtmlStyle: {
									"width": "150px"
								},
				themeName: 	"all-black",
				themePath:     themePath,
				closingDelay: 700
		});	
		$("#ajax").CreateBubblePopup({
				innerHtml: "If this box is checked, NinjaForms will submit the form without reloading the page. After a successful submission, the user will see the success message you have entered to the right.",
				position: "right",
				align: "middle",
				tail: {
						align:"center",
						hidden: false
						},
						innerHtmlStyle: {
									"width": "150px"
								},
				themeName: 	"all-black",
				themePath:     themePath,
				closingDelay: 700
		});						
		$("#landing_page").CreateBubblePopup({
				innerHtml: "Since we aren't submitting via Ajax, what page should users be redirected to after successfully submitting the form?",
				position: "right",
				align: "middle",
				tail: {
						align:"center",
						hidden: false
						},
						innerHtmlStyle: {
									"width": "150px"
								},
				themeName: 	"all-black",
				themePath:     themePath,
				closingDelay: 700
		});						
		$("#append_page").CreateBubblePopup({
				innerHtml: "If you want to automatically attach this form to a page, check the appropriate box below. It will be added after any page content and before the comments section (if there is one).",
				position: "right",
				align: "middle",
				tail: {
						align:"center",
						hidden: false
						},
						innerHtmlStyle: {
									"width": "150px"
								},
				themeName: 	"all-black",
				themePath:     themePath,
				closingDelay: 700
		});
		$("#purge_fields").CreateBubblePopup({
			innerHtml: "If users submit a form, and later you remove a field from that same form, their submission will contain 'old fields'. NinjaForms remembers the values they submitted for those fields and will display those to you. This link will remove all of these 'old values'.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});						
		$("#delete_subs").CreateBubblePopup({
			innerHtml: "This link will remove all user submissions for this form. Be careful, this can't be undone.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});
		
		$("#show_title").CreateBubblePopup({
			innerHtml: "Should NinjaForms show the form title when displaying this form?",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});						
		$("#show_desc").CreateBubblePopup({
			innerHtml: "Should NinjaForms show the form description when displaying this form? It will be placed immediately after the title.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});						
		$("#mailto").CreateBubblePopup({
			innerHtml: "NinjaForms will send a copy of the form submission to everyone on this list. If you don't want the form to mail any results to you, then leave this list empty.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});						
		$("#success_msg").CreateBubblePopup({
			innerHtml: "If your form is set to submit via Ajax, this message will appear after they have successfully filled out your form.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});	
		$("#email_from").CreateBubblePopup({
			innerHtml: "Who should the email appear to be from?",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});												
		$("#email_msg").CreateBubblePopup({
			innerHtml: "This message will be displayed at the beginning of the email sent to the user.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});						
		$("#email_fields").CreateBubblePopup({
			innerHtml: "These fields will be displayed as a table after your email message.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});
		$("#multi_form_help").CreateBubblePopup({
			innerHtml: "If this box is checked, NinjaForms will split your form display into several pages. You can then use the form dividers to separate form pages.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});	
		$("#multi_form_steps").CreateBubblePopup({
			innerHtml: "This field places a step counter (i.e. Step 1 of 4 - Section Name) wherever you place it within your form. It is recommended that you place it at the top of your form.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});		
		$("#multi_form_progressbar").CreateBubblePopup({
			innerHtml: "This field places a progress bar wherever you place it within the form. This bar fills as the user completes the form.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});		
		$("#multi_form_divider").CreateBubblePopup({
			innerHtml: "This field is used to divide sections/pages for your multi-part form. It will also allow you to name each section/page.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});		
		$("#create_post").CreateBubblePopup({
			innerHtml: "If this box is checked, NinjaForms will create a post from user input. Any non Post Element fields will be added as meta data. You can select the meta fields they map to within each field's options.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});		
		$("#require_login").CreateBubblePopup({
			innerHtml: "If this box is checked, NinjaForms will require a user to be logged in to see the form and create a post from it. If it is unchecked, un-registered users can create posts.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});		
		$("#post_as").CreateBubblePopup({
			innerHtml: "NinjaForms will assign this user as the author of posts it creates.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});		
		$("#post_type").CreateBubblePopup({
			innerHtml: "NinjaForms will create a post of this type.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});		
		$("#post_status").CreateBubblePopup({
			innerHtml: "NinjaForms will assign this status to each post it creates.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});		
		$("#post_content").CreateBubblePopup({
			innerHtml: "This is the Post body. You have the option to turn on or off the Rich Text Editor within this field's options.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});		
		$("#post_cat").CreateBubblePopup({
			innerHtml: "Creates a multi-select list of post categories. You can allow or disallow users to create new categories within this field's options.",
			position: "right",
			align: "middle",
			tail: {
					align:"center",
					hidden: false
					},
					innerHtmlStyle: {
								"width": "150px"
							},
			themeName: 	"all-black",
			themePath:     themePath,
			closingDelay: 700
		});
		
		
	} //End Admin_help check.
	
	$("#ninja_subs_table").tablesorter({widgets: ['zebra']});
	
	$(".ninja_help_open").live("click", function(event){
		event.preventDefault();
		$("#" + this.name).dialog('open');
	});
	
	$(".ninja_help_text").dialog({
		autoOpen: false,
		modal: false,
		width: 450,
		position: 'center'
	});
	
	$(".ninja-settings-list").sortable({
		//handle: '.handlediv',
		placeholder: 'sortable-placeholder',
		update:  function(event, ui) {
			var id = $(ui.item).attr('name');
			var tmp = $("#" + id).sortable("toArray");
			//alert(id);
			$.post(ajaxurl, { page: id, order: tmp, action:"ninja_save_settings_order"}, function(data){
				//alert(data);
			});
		}
	});
	
	$(".handlediv").click(function(event){
		event.preventDefault();
		var full_id = this.id;
		var id = this.id.replace("handle-", "");
		$("#" + id).toggle();
		if($("#" + id).is(":visible")){
			var state = 'open';
			$(".handlediv").each(function(){
				if(this.id != full_id){
					var other_id = this.id.replace("handle-", "");
					if($("#" + other_id).is(":visible")){
						$("#" + other_id).hide();
						var state = closed;
						$.post(ajaxurl, { item: other_id, state: state, action:"ninja_save_settings_state"}, function(data){
							//alert(data);
						});
					}
				}
			});
		}else{
			var state = 'closed';
		}
		$.post(ajaxurl, { item: id, state: state, action:"ninja_save_settings_state"}, function(data){
				//alert(data);
		});
	});
	
	window.onbeforeunload = function(){
		for (edId in tinyMCE.editors){
			if(tinyMCE.editors[edId].isDirty()){
				return "You have unsaved data, it will be lost if you don't click save.";
			}
		}
		if(tinyMCE.activeEditor.isDirty()){
			//return "You have unsaved data, it will be lost if you don't click save.";
		}
	}
	
	$("input").live("change", function(){
		if(this.id != 'begin_date' && this.id != 'end_date'){
			window.onbeforeunload = function() { return "You have unsaved data, it will be lost if you don't click save."; };
		}
	});	
	$("select").live("change", function(){
		if(this.id != 'ninja_select_form'){
			window.onbeforeunload = function() { return "You have unsaved data, it will be lost if you don't click save."; };
		}
	});
	
	$(".ninja_save_data").click(function(event){
		//event.preventDefault();
		if (typeof(tinyMCE) != "undefined") {
			tinyMCE.triggerSave(true,true);
		}
		window.onbeforeunload = null;
	});

		
	$(".ninja_field_label").live("keyup", function(){
		var id = this.id.replace("field_", "");
		id = id.replace("[label]", "");
		var type = $("#ninja_field_" + id + "_type").val();
		if(this.value != ''){
			var value = this.value;
		}else{
			var value = type;
		}
		if(type != 'desc' && type != 'spam'){
			$("#field_title_" + id).attr("innerHTML", value);
		}
	});
	
	$("#ninja_multi_part").change(function(){
		$("#ninja_multi_options").toggle();
	});
	
	$(".ninja_list_type").live("change", function(){
		var id = this.id.replace("[extra][list_type]", "");
		if(this.value == 'radio'){
			$("#" + id + "\\[extra\\]\\[label_pos\\]").attr('value', 'above');
			$("#" + id + "\\[extra\\]\\[label_pos\\] option[value='left']").remove();
			$("#" + id + "\\[extra\\]\\[label_pos\\] option[value='right']").remove();			
			$("#" + id + "\\[extra\\]\\[label_pos\\] option[value='inside']").remove();

		}else{
			
			if(!$("#" + id + "\\[extra\\]\\[label_pos\\] option[value='left']").val()){
				$("#" + id + "\\[extra\\]\\[label_pos\\]").append("<option value='left'>Left of Element</option>");
			}
			if(!$("#" + id + "\\[extra\\]\\[label_pos\\] option[value='right']").val()){
				$("#" + id + "\\[extra\\]\\[label_pos\\]").append("<option value='right'>Right of Element</option>");
			}
			if(!$("#" + id + "\\[extra\\]\\[label_pos\\] option[value='inside']").val()){
				$("#" + id + "\\[extra\\]\\[label_pos\\]").append("<option value='inside'>Inside Element</option>");
			}
		}
	});
	
	$("#ninja_select_all").click(function(){
		if(this.checked){
			$(".ninja_checkbox").each(function(){
				$(this).attr("checked", true);
			});
		}else{
			$(".ninja_checkbox").each(function(){
				$(this).attr("checked", false);
			});
		}
	});
	
	$("#export_subs_submit").click(function(event){
		var form_id = $("#form_id").val();
		var begin_date = $("#begin_date").val();
		var end_date = $("#end_date").val();
		//$("#submit").click();
		$.post(ajaxurl, {form_id:form_id, begin_date:begin_date,end_date:end_date,action:"ninja_check_subs"}, function(data){
			if(data == 'found'){
				$("#submit").click();
			}else{
				alert("No submissions found");
			}
		});
	});
	
	$("input.date").datepicker();
	$(".ninja_sub_more").click(function(){
		var id = this.id.replace("more_", "");
		if($("#sub_" + id + "_more").is(":visible") || $("#sub_" + id + "_old").is(":visible")){
			$(this).attr("innerHTML", "More");
		}else{
			$(this).attr("innerHTML", "Less");
		}
		$("#sub_" + id + "_more").toggle();
		$("#sub_" + id + "_old").toggle();
	});
	
	$(".ninja_purge_old_fields").click(function(event){
		event.preventDefault();
		var id = this.id.replace("purge_old_fields_", "");
		var current_object = this;
		var current_id = this.id;
		var confirm_delete = confirm("Delete all form submissions? This is permanent and cannot be undone.");
		$(this).replaceWith('<img id="' + current_id + '"src="' + settings.plugin_url + '/images/ajax-loader.gif">');		
		if(confirm_delete == true){
			$.post(ajaxurl, {id:id, action:"ninja_purge_fields"}, function(response) {
				window.location.reload();
				//document.write(data);
			});
		}else{
			$("#" + current_id).replaceWith(current_object);
		}
		
	});	
	$(".ninja_delete_all_subs").click(function(event){
		event.preventDefault();
		var id = this.id.replace("delete_all_subs_", "");
		var current_object = this;
		var current_id = this.id;
		var confirm_delete = confirm("Delete all form submissions? This is permanent and cannot be undone.");
		$(this).replaceWith('<img id="' + current_id + '"src="' + settings.plugin_url + '/images/ajax-loader.gif">');		
		if(confirm_delete == true){
			$.post(ajaxurl, {id:id, action:"ninja_delete_all_subs"}, function(response) {
				window.location.reload();
			});
		}else{
			$("#" + current_id).replaceWith(current_object);
		}
	});
	
	$(".ninja_delete_sub").click(function(event){
		event.preventDefault();	
		var id = this.id.replace("sub_", "");
		var current_object = this;
		var current_id = this.id;
		var confirm_delete = confirm("Delete this submission? This is permanent and cannot be undone.");
		$(this).replaceWith('<img id="' + current_id + '"src="' + settings.plugin_url + '/images/ajax-loader.gif">');		
		if(confirm_delete == true){
			$.post(ajaxurl, {id:id, action:"ninja_delete_sub"}, function(response) {
				$(".sub_tr_" + id).remove();
			});
		}else{
			$("#" + current_id).replaceWith(current_object);
		}
	});
	
	$(".ninja_form_send_email").change(function(){
		$("#ninja_advanced_email").toggle();
	});
	$(".ninja_form_hidden").live("change", function(){
		var id = this.id.replace("field_", "");
		id = id.replace("[value]", "");
		if(this.value == 'ninja_custom'){
			$("#ninja_form_hidden_" + id).show();
			$("#field_" + id + "\\[value\\]\\[text\\]").val("");
		}else{
			$("#field_" + id + "\\[value\\]\\[text\\]").val(this.value);
			$("#ninja_form_hidden_" + id).hide();
		}
	
	});
	$(".ninja_label_pos").live("change", function(){
		var id = this.id.replace("[extra][label_pos]", "");
		var id_num = id.replace('field_', '');
		var type = $("#ninja_field_" + id_num + "_type").val();
		if(this.value == 'inside'){
			if(type != 'spam'){
				$("#" + id + "\\[value\\]").val("");
				$("#" + id + "\\[value\\]").attr("disabled", true);
			}
		}
	});
	$(".ninja_new_form").click(function(){
		window.location = "admin.php?page=ninja-custom-forms&ninja_form_id=new";
	});
	$(".ninja_remove_mailto_item").live("click", function(event){
		event.preventDefault();
		var tmp = this.id.split("_");
		var x = tmp[3];
		$("#mailto_item_" + x + "_li").remove();
	});
	$(".ninja_add_mailto").live("click", function(event){
		event.preventDefault();
		var tmp = this.id.split("_");
		var form_id = tmp[2];
		var count = $("#mailto_list").children().length;
		var html = '<li id="mailto_item_' + count + '_li" name="mailto_item_' + count + '_li"><input type="text" class="code" name="mailto_item_' + count + '" id="mailto_item_' + count + '" value="" /><span class=""> <a href="#" id="remove_mailto_item_' + count + '" name="remove_mailto_item_' + count + '" class="deletion ninja_remove_mailto_item">Remove</a></span></li>';
		$("#mailto_list").append(html);
		$('#mailto_item_' + count).focus();
	});
		
	$(".ninja_form_ajax").change(function(){
		var id = this.id.replace("form_", "");
		id = id.replace("[ajax]", "");
		//alert(id);
		if(!this.checked){
			$("#form_" + id + "\\[landing_page\\]\\[label\\]").show();
		}else{
			$("#form_" + id + "\\[landing_page\\]\\[label\\]").hide();
		}
	});	
	$(".ninja_form_append_page").change(function(){
		var id = this.id.replace("form_", "");
		id = id.replace("[append_page]", "");
		//alert(id);
		if(this.checked){
			$("#form_" + id + "\\[append_page_id\\]\\[label\\]").show();
		}else{
			$("#form_" + id + "\\[append_page_id\\]\\[label\\]").hide();
		}
	});
	
	$("#ninja_select_form").change(function(){
		window.location.replace(this.value);
	});
	
	//If you select an item from the list to be the default, uncheck all the others.
	$(".ninja_select_item_default").live("click", function(event){
		var names = this.id.split("_");
		var id = names[3];
		var num = names[4];
		var count = $("#select_items_" + id).children().length;
		count = count + 1;
		if(this.checked){
			for(i=0; i<count; i++) {
				if(num != i){
					$("#select_item_default_" + id + "_" + i ).attr("checked", false);
				}
			}
		var value = $("#field_" + id + "\\[extra\\]\\[list_item\\]\\[" + num + "\\]").val();
		$("#field_" + id + "\\[extra\\]\\[list_default\\]").val(value);
		}
	}); //End list uncheck.
	
	//Function to add new items to a list.
	$(".ninja_add_select_item").live("click", function(event){
		event.preventDefault();
		var id = this.id.replace("add_select_item_", "");
		var count = $("#select_items_" + id).children().length;
		var next = count + 1;
		var html = '<li id="select_item_' + id + '_' + next + '" name="select_item_' + id + '_' + next + '"><input type="text" class="code" name="field_' + id + '[extra][list_item][' + next + ']" id="field_' + id + '[extra][list_item][' + next + ']" value="" /> <span class="menu-item-handle">Drag | <a href="#" id="remove_select_item_' + id + '_' + next + '" name="remove_select_item_' + id + '_' + next + '" class="deletion ninja_remove_select_item">Remove</a> | <label for="select_item_default_' + id + '_' + next + '">Selected</label> <input type="checkbox" class="ninja_select_item_default" value="checked" id="select_item_default_' + id + '_' + next + '" name="select_item_default_' + id + '_' + next + '"></span></li>'
		$("#select_items_" + id).append(html);
		$("#select_items_" + id).sortable({
			handle: '.menu-item-handle',
			placeholder: 'sortable-placeholder'
		});//End item list sortable function.
		$("#field_"+ id + "\\[extra\\]\\[list_item\\]\\[" + next + "\\]").focus();
	});//End add new items
	
	//Function to remove items from a list.
	$(".ninja_remove_select_item").live("click", function(event){
		event.preventDefault();
		var item_id = this.id.replace("remove_", "");
		$("#" + item_id).remove();
	});//End remove items function.
	
	//Hide everything with the ninja_hide class.
	$(".ninja_hide").hide();
	
	//Make our item lists sortable.
	$(".ninja_select_items").sortable({
		handle: '.menu-item-handle',
		placeholder: 'sortable-placeholder'		
	});//End item list sortable function.
	
	//If the datepicker checkbox is checked, we have to 1) Uncheck the email box. 2) Reset the mask select list to none. 3) Reset the mask field value to 'none'.
	$(".ninja_datepicker").live("click", function(){
		var id = this.id.replace("field_", "");
		id = id.replace("[extra][datepicker]", "");
		if(this.checked){
			$("#field_mask_select_" + id).val("none");
			$("#field_" + id + "\\[extra\\]\\[mask\\]").val('none');
			$("#field_mask_" + id + "_cont").hide();
			$("#field_" + id + "\\[extra\\]\\[email\\]").attr("checked", false);
			$("#field_" + id + "\\[extra\\]\\[send_email\\]").attr("checked", false);
			$("#field_send_email_" + id + "_cont").hide();
		}
	});//End Datepicker checkbox function.
	
	//If the email validation checkbox is checked, we have to 1) Uncheck the datepicker. 2) Reset the mask select list to none. 3) Reset the mask field value to 'none'.
	$(".ninja_email").live("click", function(){
		var id = this.id.replace("field_", "");
		id = id.replace("[extra][email]", "");
		if(this.checked){
			$("#field_mask_select_" + id).val("none");
			$("#field_" + id + "\\[extra\\]\\[mask\\]").val('none');
			$("#field_mask_" + id + "_cont").hide();
			$("#field_" + id + "\\[extra\\]\\[datepicker\\]").attr("checked", false);
			$("#field_send_email_" + id + "_cont").show();
		}else{
			$("#field_send_email_" + id + "_cont").hide();
			$("#field_" + id + "\\[extra\\]\\[send_email\\]").attr("checked", false);
		}
	});//End email checkbox function.
	
	//If the select box is changed, we set the hidden input for our mask value to the same value.
	$(".ninja_mask_select").live("change", function(){
		var id = this.id.replace("field_mask_select_", "");
		if(this.value != 'none'){
			$("#field_" + id + "\\[extra\\]\\[datepicker\\]").attr('checked', false);
			$("#field_" + id + "\\[extra\\]\\[email\\]").attr('checked', false);
			$("#field_" + id + "\\[extra\\]\\[send_email\\]").attr('checked', false);
			$("#field_send_email_" + id + "_cont").hide();			
		}
		if(this.value == "custom"){
			$("#field_" + id + "\\[extra\\]\\[mask\\]").val("");
			$("#field_mask_" + id + "_cont").show();
		}else{
			$("#field_" + id + "\\[extra\\]\\[mask\\]").val(this.value);
			$("#field_mask_" + id + "_cont").hide();
		}
	});//End select box function.	
	
	//If the select box is changed, we set the hidden input for our mask value to the same value.
	$(".ninja_default_select").live("change", function(){
		var id = this.id.replace("field_default_select_", "");
		if(this.value == "custom"){
			$("#field_" + id + "\\[value\\]").val("");
			$("#field_default_" + id + "_cont").show();
		}else{
			$("#field_" + id + "\\[value\\]").val(this.value);
			$("#field_default_" + id + "_cont").hide();
		}
	});//End select box function.
	
	$(".ninja_field_delete").live("click", function(event){
		event.preventDefault();
		var button_id = this.name;
		var field_type = this.name.split("_");
		field_type = field_type[2];
		var current_object = this;
		var current_id = this.id;
		var id = this.id.replace("ninja_field_delete_", "");
		var confirm_delete = confirm("Remove this field? It will be removed even if you do not save.");
		$(this).replaceWith('<img id="' + current_id + '"src="' + settings.plugin_url + '/images/ajax-loader.gif">');		
		if(confirm_delete == true){
			$.post(ajaxurl, {id:id, action:"ninja_delete_field"}, function(response) {
				$("#field_" + id).remove();
				if(field_type == 'submit' || field_type =='spam' || field_type == 'progressbar' || field_type == 'steps' || field_type == 'posttitle' || field_type == 'postcontent' || field_type == 'postexcerpt' || field_type == 'postcat' || field_type == 'posttags'){
					$("#" + button_id + "_cont").show();
				}
			});
		}else{
			$("#" + current_id).replaceWith(current_object);
		}
	});	
	$(".ninja_form_delete").live("click", function(){
		var current_object = this;
		var current_id = this.id;
		var id = this.id.replace("ninja_form_delete_", "");
		var confirm_delete = confirm("Delete this form? This is permanent and will remove all fields associated with the form.");
		$(this).replaceWith('<img id="' + current_id + '"src="' + settings.plugin_url + '/images/ajax-loader.gif">');		
		if(confirm_delete == true){
			$.post(ajaxurl, {id:id, action:"ninja_delete_form"}, function(response) {
				window.location = "admin.php?page=ninja-custom-forms";
			});
		}else{
			$("#" + current_id).replaceWith(current_object);
		}
	});
	$(".ninja_new_field").live("click", function(event){
		event.preventDefault();
		var current_object = this;
		var current_id = this.id;
		$(this).replaceWith('<img id="' + current_id + '" src="' + settings.plugin_url + '/images/ajax-loader.gif">');
		var temp_array = this.id.split("_");
		var field_type = temp_array[2];
		var form_id = temp_array[3];
		$.post(ajaxurl, {action:"ninja_new_field", type: field_type, form_id: form_id}, function(response) {
				if(field_type == 'desc'){
					window.onbeforeunload = function(){ };
					$("#ninja_form_fields").submit();
				}else{
					//alert(response);
					//$('#ninja_edit_form_fields tr:last').after(data);
					var html = response.split("<----new----ninja----field---->");
					var editor_id = "field_" + html[0] + "[value]";
				
					$("#ninja_edit_form_fields").append(html[1]);
					$("#field_" + html[0] + "\\[label\\]").focus();
					$("#" + current_id).replaceWith(current_object);
					if(field_type == 'spam' || field_type == 'submit' || field_type == 'progressbar' || field_type == 'steps' || field_type == 'posttitle' || field_type == 'postcontent' || field_type == 'postexcerpt' || field_type == 'postcat' || field_type == 'posttags'){
						$("#" + current_id + "_cont").hide();
					}
					ninjaSetupPopups();
				}
		});
	});
	var name = "#menu-settings-column";
	if($(name).length > 0){
		var offset = $(name).offset();
		var elTop = offset.top;
		var elHeight = $(name).height();
		$(window).scroll(function () { 
			var top = $(window).scrollTop();
			var currentTop = top;
			if(currentTop > elTop){
				var newTop = currentTop + 10;
			}else{
				var newTop = elTop;
			}
			//alert(newTop);
			$(name).offset({top: newTop});
		});
	}

	
	$(".item-edit").live("click", function(event){
		event.preventDefault();
		var item_id = this.id.replace("edit-", "");
		var item_type = $("#ninja_field_" + item_id + "_type").val();
		var editor_id = "field_" + item_id + "[value]";
		if($("#field_" + item_id).hasClass("menu-item-edit-inactive")){
			$("#field_" + item_id).removeClass("menu-item-edit-inactive");
			$("#field_" + item_id).addClass("menu-item-edit-active");
		}else{
			$("#field_" + item_id).removeClass("menu-item-edit-active");
			$("#field_" + item_id).addClass("menu-item-edit-inactive");
		}
	});
	
	$("#ninja_edit_form_fields").sortable({
		handle: '.menu-item-handle',
		placeholder: 'sortable-placeholder',
		update:  function(event, ui) { 
			window.onbeforeunload = function() { 
					return "You have unsaved data, it will be lost if you don't click save."; 
				};

		},
		start: function(e, ui){
			var id = $(ui.item).attr("id");
			var type = $("#ninja_" + id + "_type").val();
			var editor_id = id + '[value]';
			if(!tinyMCE.editors[editor_id]){
				editor_id = id + 'value';
			}
			if(type == 'desc'){
				tinyMCE.execCommand( 'mceRemoveControl', false, editor_id );	
			}

		},
		stop: function(e,ui) {
			var id = $(ui.item).attr("id");
			var type = $("#ninja_" + id + "_type").val();
			var editor_id = id + '[value]';
			if(!tinyMCE.editors[editor_id]){
				editor_id = id + 'value';
			}
			if(type == 'desc'){
				tinyMCE.execCommand( 'mceAddControl', true, editor_id );	
			}
			$(this).sortable("refresh");
		}
	});

	$("#ninja_form_fields").submit(function(){
		var tmp = $("#ninja_edit_form_fields").sortable("toArray");
		$("#ninja_form_fields_order").val(tmp);
	});	
	
	$("#ninja_form_settings").submit(function(){
		var x = 0;
		$("#mailto_list > li").each(function(){
			var id = this.id.replace("_li", "");
			//alert($("#" + id).val());
			if(x == 0){
				tmp = $("#" + id).val();
			}else{
				tmp = tmp + "," +  $("#" + id).val();
			}
			x = x + 1;
		});
		var form_id = $("#ninja_form_id").val();
		$("#form_" + form_id + "\\[mailto\\]").val(tmp);
	});
	
	if($("#ninja_form_saved")){
		$("#ninja_form_saved").show(400).delay(10000).slideUp('slow');
	}
	
	$("#ninja_form_post").change(function(){
		if(this.checked){
			$(".ninja_post_options").show();
		}else{
			$(".ninja_post_options").hide();
		}
	});
	
	$(".ninja-reset-upload-dir").click(function(){
		var answer = confirm("Reset uploads directory to NinjaForms default?");
		if(answer){
			$("#plugin_settings_upload_dir").val(this.id);
		}
	});
	
	$(".ninja-rte-checkbox").live("change", function(){
		var id = this.id.replace("field_", "");
		id = id.replace("[extra][rte]", "");
		if(this.checked){
			$("#field_" + id + "\\[extra\\]\\[media_upload\\]_cont").show();
		}else{
			$("#field_" + id + "\\[extra\\]\\[media_upload\\]_cont").hide();
		}
	});
	
	$('[title = "Media Uploader - NinjaForms"]').live("mousedown", function(){
		var id = this.id.replace("-add_media", "");
		tinyMCE.execInstanceCommand( id, "mceFocus"); 
	});
	
	$(".ninja-advanced").live("click", function(event){
		event.preventDefault();
		$("#" + this.id + "_cont").toggle();
	});
	
	$(".ninja-save-status").change(function(){
		if(this.checked){
			$("#ninja_save_status_options").show();
		}else{
			$("#ninja_save_status_options").hide();
		}
	});	
});