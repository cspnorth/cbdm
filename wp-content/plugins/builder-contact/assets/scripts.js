(function ($) {

    function send_form(form) {
        var data = {
            action: 'builder_contact_send',
            'contact-name': $('[name="contact-name"]', form).val(),
            'contact-email': $('[name="contact-email"]', form).val(),
            'contact-subject': $('[name="contact-subject"]', form).val(),
            'contact-message': $('[name="contact-message"]', form).val(),
            'contact-sendcopy': $('[name="send-copy"]', form).val(),
            'contact-settings': $('.builder-contact-form-data', form).html()
        };
        if (form.find('[name="g-recaptcha-response"]').length > 0) {
            data['contact-recaptcha'] = form.find('[name="g-recaptcha-response"]').val();
        }
        $.ajax({
            url: form.prop('action'),
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data && data.themify_message) {
                    form.find('.contact-message').html(data.themify_message).fadeIn();
                    form.removeClass('sending');
                    if (data.themify_success) {
                        $('body').trigger('builder_contact_message_sent', [form, data.themify_message]);
                        form[0].reset();
                    } else {
                        $('body').trigger('builder_contact_message_failed', [form, data.themify_message]);
                    }
                    if ( typeof grecaptcha === 'object' ) {
                        grecaptcha.reset();
                    }
                }
            }
        });
    }
    $(document).ready(function(){
        if($('form.builder-contact').length>0){
            function callback(){
                $('body').on('submit', '.builder-contact', function (e) {
                    e.preventDefault();
                    if ($(this).hasClass('sending')) {
                        return false;
                    }
                    $(this).addClass('sending').find('.contact-message').fadeOut();
                    send_form($(this));
                });
            }
            if($('.builder-contact-field-captcha').length>0){
                if(typeof grecaptcha==='undefined'){
                    Themify.LoadAsync('//www.google.com/recaptcha/api.js',callback,'',true,function(){
                        return typeof grecaptcha!=='undefined';
                    });
                }
                else{
                    callback();
                }
            }
            else{
                callback();
            }

			$('body').on( 'focus', '.module-contact.contact-animated-label input, .module-contact.contact-animated-label textarea', function(){
				var label = $("label[for='"+$(this).attr('id')+"']"); //.addClass( 'inside' );
				if( label.length == 0 ) label = $(this).closest(".builder-contact-field").find("label");
				label.css( 'top', '0' );
				label.css( 'left', '0' );
            });
			$('body').on( 'blur', '.module-contact.contact-animated-label input, .module-contact.contact-animated-label textarea', function(){
				if($(this).val() == ""){
				    var label = $("label[for='"+$(this).attr('id')+"']"); //.addClass( 'inside' );
                    if( label.length == 0 ) label = $(this).closest(".builder-contact-field").find("label");
                    var inputEl = label.next('.control-input').find( 'input,textarea' );
					if( inputEl.prop('tagName') == 'TEXTAREA' ) {
					    // Label displacement for textarea should be calculated with it's row count in mind
						label.css( 'top', (label.outerHeight() / 2 + inputEl.outerHeight() / parseInt( inputEl.prop( 'rows' ) ) ) + 'px' );
                    } else {
						label.css( 'top', (label.outerHeight() / 2 + inputEl.outerHeight() / 2 ) + 'px' );
                    }
					label.css( 'left', '10px' );
				}
			});

			var init_animated_labels = function() {
				$('.module-contact.contact-animated-label input, .module-contact.contact-animated-label textarea').attr("placeholder", "");
				$('.module-contact.contact-animated-label input, .module-contact.contact-animated-label textarea').trigger('blur');
				setTimeout(function(){
					$('.module-contact.contact-animated-label label').css({
						'-webkit-transition-property': 'top, left',
						'-webkit-transition-duration': '0.3s',
						'transition-property': 'top, left',
						'transition-duration': '0.3s',
						'visibility': 'visible'
					});
				},50);
			};

			$('body').on('builder_load_module_partial builder_finished_loading custom:preview:reload', function(){
				init_animated_labels();
            });

			init_animated_labels();
       }
    });
}(jQuery));