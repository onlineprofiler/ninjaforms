jQuery(document).ready(function($) {

	$(".ninja_close_dialog").live("click", function(event){
		event.preventDefault();
		$(this).parent().dialog('close');	
	});
	function goToByScroll(id){
		$('html,body').animate({scrollTop: $("#"+id).offset().top - 150},'slow');
	}

	$( "#ninja_form_overlay" ).dialog({
		height: 200,
		autoOpen: false,
		modal: true
	});
	
	if($("#ninja_multi_progress").val() == 'checked'){
		var multi_count = $("#ninja_multi_count").val();
		var percent = (1 / multi_count) * 100;
		percent = Math.floor(percent);	
		$( "#progressbar" ).progressbar({
				value: 0
		});
	}
	
	$(".ninja_multi_form_next").click(function(event){
		event.preventDefault();
		var current_page = this.id.replace("ninja_page_", "");
		current_page = parseInt(current_page);
		var next_page = current_page + 1;
		var form_id = $("#ninja_form_id").val();
		$("#ninja_multi_page_" + current_page).hide();
		$("#ninja_multi_page_" + next_page).show();
		var new_name = $("#ninja_multi_name_" + next_page).val();
		$("#ninja_multi_name").attr("innerHTML", new_name);
		if($("#ninja_multi_progress").val() == 'checked'){
			var multi_count = $("#ninja_multi_count").val();
			multi_count = parseInt(multi_count);

			var percent = current_page / multi_count;
			percent = percent * 100;
			percent = Math.floor(percent);

			$("#progressbar").progressbar( "option", "value", percent );
		}
		$("#ninja_multi_step").attr("innerHTML", next_page);
		goToByScroll('ninja_form_top');

	});		
	$(".ninja_multi_form_previous").click(function(event){
		event.preventDefault();
		var current_page = this.id.replace("ninja_page_", "");
		current_page = parseInt(current_page);
		var previous_page = current_page - 1;
		var form_id = $("#ninja_form_id").val();
		$("#ninja_multi_page_" + current_page).hide();
		$("#ninja_multi_page_" + previous_page).show();
		var new_name = $("#ninja_multi_name_" + previous_page).val();
		$("#ninja_multi_name").attr("innerHTML", new_name);
		if($("#ninja_multi_progress").val() == 'checked'){
			var multi_count = $("#ninja_multi_count").val();
			multi_count = parseInt(multi_count);

			var percent = (previous_page -1 ) / multi_count;

			percent = percent * 100;
			percent = Math.floor(percent);
			if(previous_page == 1){
				percent = 0;
			}

			$("#progressbar").progressbar( "option", "value", percent );
		}
		$("#ninja_multi_step").attr("innerHTML", previous_page);
		goToByScroll('ninja_form_top');	
	});	

	var options = { 

		beforeSubmit:  ninjaSubmit, 
		success:       ninjaResponse,
		url: ajax.ajaxurl
		};
	var ninja_form_id = $("#ninja_form_id").val();
	$("#ninja_form_" + ninja_form_id).ajaxForm(options);


	function ninjaSubmit(formData, jqForm, options){
		$("input").removeClass("ninja_error");
		if($("#ninja_save_status").val() != 'yes'){
			$("#progressbar").progressbar( "option", "value", 100 );
		}
		$("#ninja_form_overlay").dialog('open');
		var ninja_submit = 1;
		if($("#ninja_save_status").val() != 'yes'){
			$(".ninja_req").each(function(){
				if(this.type != 'checkbox'){
					if(this.value == '' || this.value == this.title){
						$(this).addClass('ninja_error');
						ninja_submit = 0;
					}else{
						if($(this).hasClass('email')){
							var string = $(this).val();
							if(string.search(/^[a-zA-Z]+([_\.-]?[a-zA-Z0-9]+)*@[a-zA-Z0-9]+([\.-]?[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,4})+$/) == -1){
								$(this).addClass('ninja_error');
								ninja_submit = 0;
							}else{
								$(this).removeClass('ninja_error');
							}
						}else{
							$(this).removeClass('ninja_error');
						}
					}
				}else{
					if(this.checked == ''){
						$(this).addClass('ninja_error');
						ninja_submit = 0;
					}else{
						$(this).removeClass('ninja_error');
					}
				}
			});
		}			
		if(ninja_submit == 0){
			$("#ninja_form_overlay").attr("innerHTML", "Please ensure that all required fields are filled out properly. <br /> <a href='#' class='ninja_close_dialog'>Close</a>");
				
			$("#ninja_form").show();
			return false;
		}else{
			$("#ninja_form_overlay").attr("innerHTML", "Please Wait...<br />");
			return true;
		}
	}
	function ninjaResponse(responseText, statusText, xhr, $form){
		//alert(responseText);	
		var response = responseText.split("|");
		var tmp = 'pass';
		for(var i in response){
			if(typeof(response[i]) == 'string'){
				var error = response[i].split("_");
				var id = error[0];
				var status = error[1];
				var el_id = "ninja_field_" + id;
				if(status == 'spam-error'){
					if(tmp != "pass"){
						tmp = "There were errors with your submission. Please correct these errors before continuing.";
					}else{
						tmp = "Please answer the anti-spam question correctly.";
					}
					el_id = "ninja_field_spam";
				}else if(status == 'file-type-error'){
					if(tmp != "pass"){
						tmp = "There were errors with your submission. Please correct these errors before continuing.";
					}else{
						tmp = "Please ensure all files are of a valid type.";
					}
				}else if(status == 'file-size-error'){
					if(tmp != "pass"){
						tmp = "There were errors with your submission. Please correct these errors before continuing.";
					}else{
						tmp = "One or more files are larger than the allowed filesize.";
					}
				}else if(status == 'email-exists'){
					if(tmp != "pass"){
						tmp = "There were errors with your submission. Please correct these errors before continuing.";
					}else{
						tmp = "<p>A form is already saved with that email address. Please login to make changes to that form</p>";
					}
				}
				$("#" + el_id).addClass('ninja_error');
				$("#" + el_id).focus();
			}
		}	
		if(tmp == 'pass'){
			$("#ninja_field_spam").removeClass('ninja_error');
			var ninja_ajax_submit = $("#ninja_ajax_submit").val();
			if(ninja_ajax_submit != 'checked'){
				window.location = responseText;
			}else{
				$("#ninja_form").addClass("ninja-success");
				$("#ninja_form").attr("innerHTML", responseText);
				$("#ninja_form_overlay").dialog('close');
			}
		}else{
			$("#ninja_form_overlay").attr("innerHTML", tmp + "<br /> <a href='#' class='ninja_close_dialog'>Close</a>");
			$("#ninja_form_overlay").dialog('open');
		}
	}
	
	$('[title = "Media Uploader - NinjaForms"]').live("mousedown", function(){
		var id = this.id.replace("-add_media", "");
		if (typeof(tinyMCE) != "undefined") {
			tinyMCE.execInstanceCommand( id, "mceFocus"); 
		}
	});
	
	$("#ninja_save_progress").click(function(){
		$("#ninja_save_status").val("yes");
		if (typeof(tinyMCE) != "undefined") {
			tinyMCE.triggerSave(true,true);
		}
		if($("#ninja_form_continue").val() == ''){
			if($("#ninja_user_id").val()){
				var form_id = $("#ninja_form_id").val();
				$("#ninja_form_" + form_id).submit();
			}else{
				$("#ninja_form_save_progress").dialog('open');
			}
		}else{
			var form_id = $("#ninja_form_id").val();
			$("#ninja_form_" + form_id).submit();
		}
	});
	
	$("#ninja_submit").click(function(){
		if (typeof(tinyMCE) != "undefined") {
			tinyMCE.triggerSave(true,true);
		}
		$("#ninja_save_status").val('no');
	});
	
	$( "#ninja_form_save_progress" ).dialog({
		height: 350,
		width: 350,
		autoOpen: false,
		modal: true
	});	
	$( "#ninja_form_continue_login" ).dialog({
		height: 350,
		width: 350,
		autoOpen: false,
		modal: true
	});
	$( "#ninja_forgot_pass" ).dialog({
		height: 200,
		width: 350,
		autoOpen: false,
		modal: true
	});
	
	$("#ninja_cancel_save").click(function(){
		$("#ninja_form_save_progress").dialog('close');
	});

	$("#ninja_popup_save").click(function(){
		if (typeof(tinyMCE) != "undefined") {
			tinyMCE.triggerSave(true,true);
		}
		var error = '';
		if($("#ninja_save_email").val() == ''){
			alert("Email field cannot be left blank.");
			$("#ninja_save_email").addClass("ninja_error");
			error = 'email';
		}else{
			$("#ninja_save_email").removeClass("ninja_error");
		}
		if($("#ninja_save_password1").val() != '' && $("#ninja_save_password2").val() != ''){
			if($("#ninja_save_password1").val() == $("#ninja_save_password2").val()){
				if(error != 'email'){
					$("#ninja_form_save_progress").dialog('close');
					var form_id = $("#ninja_form_id").val();
					var tmp_email = $("#ninja_save_email").val();
					$("#ninja_form_save_email").val(tmp_email);
					var tmp_password = $("#ninja_save_password1").val();
					$("#ninja_form_save_password").val(tmp_password);
					$("#ninja_form_" + form_id).submit();
				}
			}else{
				if(error != 'email'){
					alert("Your passwords do not match");
				}
			}
		}else{
			if(error != 'email'){	
				alert("Password fields can't be blank.");
			}
		}
	});
	
	$("#ninja_show_continue_login").click(function(){
		$("#ninja_form_continue_login").dialog('open');
	});
	
	$("#ninja_cancel_login").click(function(){
		$("#ninja_form_continue_login").dialog('close');
	});
	
	$("#ninja_login_button").click(function(){
		var email = $("#ninja_login_email").val();
		var password = $("#ninja_login_password").val();
		var form_id = $("#ninja_form_id").val();
		var user_id = $("#ninja_user_id").val();
		$.post(ajax.ajaxurl, { form_id: form_id, email: email, password: password, user_id: user_id, action:"ninja_form_login"}, function(data){
			if(data == 'fail'){
				if(user_id){
					alert("An saved copy of this form has not been found.");
				}else{
					alert("Invalid Email/Password Combination. Please try again");
				}
			}else{
				data = data.split('-ninja-');
				var sub_id = data[0];
				var obj = eval('(' + data[1] + ')');
				$.each(obj.fields, function(i,data){
					var value = data.value.replace("&quot;", '"');
					if(data.type == 'textbox' || data.type == 'posttitle' || data.type == 'posttags'){
						$("#ninja_field_" + data.id).val(value);
					}else if(data.type == 'checkbox'){
						if(data.value == 'checked'){
							$("#ninja_field_" + data.id).attr('checked', true);
						}
					}else if(data.type == 'postcontent' || data.type == 'textarea'){
						if(($("#ninja_field_" + data.id).hasClass('wp-editor-area'))){
							tinyMCE.get("ninja_field_" + data.id).setContent(value);
						}
						$("#ninja_field_" + data.id).val(value);
					}else if(data.list_type == 'radio'){
						$("#ninja_field_" + data.id + "[value=" + value + "]").attr("checked", true);
					}else if(data.list_type == 'multi' || data.type == 'postcat'){
						var selected = value.split("|ninja|");
						for(var i in selected){
							$("#ninja_field_" + data.id + " option[value=" + selected[i] + "]").attr('selected', true);
						}
					}else if(data.type == 'file' && data.value != 'file'){
						$("[name='ninja_field_" + data.id + "']").append("<div>Previously Uploaded File: " + data.value + "</div>");
					}
				});
				
				$("#ninja_form_continue").val(sub_id);
				$("#ninja_form_continue_login").dialog('close');
				$("#ninja_form_save_email").val(email);
				$("#ninja_form_save_password").val(password);
			}
		});
	});
	$("#ninja_email_pass").click(function(event){
		event.preventDefault();
		$("#ninja_form_continue_login").dialog('close');
		$("#ninja_forgot_pass").dialog('open');
	});
	$("#ninja_forgot_button").click(function(){
		var form_id = $("#ninja_form_id").val();
		var email = $("#ninja_forgot_email").val();
		$.post(ajax.ajaxurl, { form_id: form_id, email: email, action:"ninja_email_pass"}, function(data){
			if(data == 'fail'){
				alert("Email address not found.");
			}else{
				alert("Your password has been emailed.");
				$("#ninja_forgot_email").val('');
				$("#ninja_forgot_pass").dialog('close');
			}
		});
	});
	
	$('[title = "Media Uploader - NinjaForms"]').live("mousedown", function(){
		var id = this.id.replace("-add_media", "");
		tinyMCE.execInstanceCommand( id, "mceFocus"); 
	});
});