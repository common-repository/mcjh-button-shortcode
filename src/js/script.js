jQuery(function($) {
	$("#customcolor, #tcolor").ColorPicker({
		flat : false,
		onSubmit : function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow : function() {
			$(this).ColorPickerSetColor(this.value);
		}
	}).bind("keyup", function() {
		$(this).ColorPickerSetColor(this.value);
	});

	$("#color").change(function() {
		var value = $("#color").val();
		if (value == "custom") {
			$("#customcolor").attr("disabled", false);
			$("#customcolor").focus();
		} else {
			$("#customcolor").attr("disabled", true);
		}
	});
});

function mcjh_cta_button_ajax(shortcode) {
	shortcode = shortcode.replace(/ /g, "%20");
	jQuery.ajax({
		type : 'POST',
		url : ajax_object.ajax_url,
		data : {
			'action' : 'mcjh_execute_button_shortcode',
			'cta_button_shortcode' : shortcode
		},
		success : function(data) {
			jQuery("#preview").html(data);
		}
	});
}

/**
 * Method to generate the shortcode in the backend generator
 */
function generate_cta_button_shortcode() {
	var data = jQuery("#shortcode_form").serializeArray();
	var serialized = {};
	for ( var index in data) {
		serialized[data[index].name] = data[index].value;

	}
	if (serialized.color == "custom") {
		serialized.color = serialized.customcolor;
	}
	var paras = "";
	for ( var key in serialized) {
		var value = serialized[key];
		if (key != "" && key != null && value != "" && value != null
				&& key != "customcolor") {
			if (key == "onclick") {
				value = value.replace(/"/g, "'");
			}
			string = key + '="' + value + '"';
			paras += string + " ";
		}
	}
	var output = "[createButton " + paras + "]";
	jQuery("#output").val(output);
	mcjh_cta_button_ajax(output);
}

jQuery(document).on("click",
		".mcjh-ctabutton-shortcode-notice .notice-dismiss", function() {
			jQuery.ajax({
				type : 'POST',
				url : ajax_object.ajax_url,
				data : {
					'action' : 'dismiss_notice_action',
					'dismiss' : 'yes'
				}
			});
		});