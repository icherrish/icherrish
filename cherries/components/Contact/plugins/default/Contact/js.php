Ossn.register_callback('ossn', 'init', 'com_contact_form_validator');

function com_contact_form_validator(){

	Ossn.ajaxRequest({
		url: Ossn.site_url + "action/Contact/contactmail",
		form: '#contactform',
		beforeSend: function(request){
			var failedValidate = 0;
			$('#contactform input, #contactform textarea').filter(function(){
				if (this.value == "") {
				 	$(this).addClass('ossn-red-borders');
					failedValidate++;
				} else {
					$(this).removeClass('ossn-red-borders');
				}
			});
			if (failedValidate) {
				Ossn.trigger_message(Ossn.Print('contact:form:message:incomplete'), 'error');
				request.abort();
				return false;
			}
		},
		callback: function(callback){
			if (callback['dataerr']) {
				Ossn.trigger_message(Ossn.Print(callback['dataerr']), 'error');
			} else if(callback['success'] == 1){
				Ossn.trigger_message(Ossn.Print('contact:form:message:sent'));
				setTimeout(function() {
					location.reload();
				}, 2000);
			}
		}
	});
}
