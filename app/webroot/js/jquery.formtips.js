/*
 * Form Tips 1.0
 * By Manuel Boy (http://www.polargold.de)
 * Copyright (c) 2009 Manuel Boy
 * Licensed under the MIT License: http://www.opensource.org/licenses/mit-license.php
*/
jQuery.fn.formtips = function(options) {
	// handle options
	settings = jQuery.extend({
		class_name: "tipped"
	}, options);
	// do
	return this.each(function() {
		$('.' + settings.class_name, this).each(function() {
			// prepare input elements an textareas
			var elem = $(this);
			var lv = $(this).attr('title');
			// handle events
			if($(elem).is('textarea')) {
				$(elem).bind('focus', function() {
					if($(elem).text() == lv) {
						$(elem).text('').removeClass(settings.class_name);
					}
				});
				$(elem).bind('blur', function() {
					if($(elem).text() == '') {
						$(elem).text(lv).addClass(settings.class_name);
					}
				});
				if($(elem).text() == '') {
					$(elem).text(lv).addClass(settings.class_name);
				} else {
					$(elem).removeClass(settings.class_name);
				}
			} else {
				$(elem).bind('focus', function() {
					if($(elem).val() == lv) {
						$(elem).val('').removeClass(settings.class_name);
					}
				});
				$(elem).bind('blur', function() {
					if($(elem).val() == '') {
						$(elem).val(lv).addClass(settings.class_name);
					}
				});
				if($(elem).val() == '') {
					$(elem).val(lv).addClass(settings.class_name);
				} else {
					$(elem).removeClass(settings.class_name);
				}
			}
		});
		// handle submit of forms (remove default value)
		if($('.' + settings.class_name, this).length > 0) {
			$(this).submit(function() {
				// untip 'em
				$('.' + settings.class_name, this).each(function() {
					var elem = $(this);
					var lv = $(this).attr('title');
					if($(elem).is('textarea')) {
						if($(elem).text() == lv) {
							$(elem).text('').removeClass(settings.class_name);
						}
					} else {
						if($(elem).val() == lv) {
							$(elem).val('').removeClass(settings.class_name);
						}
					}
				});
				return true;
			});
		}
	});
};