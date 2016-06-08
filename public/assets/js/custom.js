/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('?')[0],
	$BODY = $('body'),
	$MENU_TOGGLE = $('#menu_toggle'),
	$SIDEBAR_MENU = $('#sidebar-menu'),
	$SIDEBAR_FOOTER = $('.sidebar-footer'),
	$LEFT_COL = $('.left_col'),
	$RIGHT_COL = $('.right_col'),
	$NAV_MENU = $('.nav_menu'),
	$FOOTER = $('footer');

// Sidebar
$(document).ready(function () {
	// TODO: This is some kind of easy fix, maybe we can improve this
	var setContentHeight = function () {
		// reset height
		$RIGHT_COL.css('min-height', $(window).height());

		var bodyHeight = $BODY.height(),
			leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
			contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

		// normalize content
		contentHeight -= $NAV_MENU.height() + $FOOTER.height();

		$RIGHT_COL.css('min-height', contentHeight);
	};

	$SIDEBAR_MENU.find('a').on('click', function (ev) {
		var $li = $(this).parent();

		if ($li.is('.active')) {
			$li.removeClass('active');
			$('ul:first', $li).slideUp(function () {
				setContentHeight();
			});
		} else {
			// prevent closing menu if we are on child menu
			if (!$li.parent().is('.child_menu')) {
				$SIDEBAR_MENU.find('li').removeClass('active');
				$SIDEBAR_MENU.find('li ul').slideUp();
			}

			$li.addClass('active');

			$('ul:first', $li).slideDown(function () {
				setContentHeight();
			});
		}
	});

	// toggle small or large menu
	$MENU_TOGGLE.on('click', function () {
		if ($BODY.hasClass('nav-md')) {
			$BODY.removeClass('nav-md').addClass('nav-sm');

			if ($SIDEBAR_MENU.find('li').hasClass('active')) {
				$SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
			}
		} else {
			$BODY.removeClass('nav-sm').addClass('nav-md');

			if ($SIDEBAR_MENU.find('li').hasClass('active-sm')) {
				$SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
			}
		}

		setContentHeight();
	});

	// check active menu
	$SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

	$SIDEBAR_MENU.find('a').filter(function () {
		return this.href == CURRENT_URL;
	}).parent('li').addClass('current-page').parents('ul').slideDown(function () {
		setContentHeight();
	}).parent().addClass('active');

	// recompute content when resizing
	$(window).smartresize(function () {
		setContentHeight();
	});

	// fixed sidebar
	if ($.fn.mCustomScrollbar) {
		$('.menu_fixed').mCustomScrollbar({
			autoHideScrollbar: true,
			theme: 'minimal',
			mouseWheel: {preventDefault: true}
		});
	}
});
// /Sidebar

// Panel toolbox
$(document).ready(function () {
	$('.collapse-link').on('click', function () {
		var $BOX_PANEL = $(this).closest('.x_panel'),
			$ICON = $(this).find('i'),
			$BOX_CONTENT = $BOX_PANEL.find('.x_content');

		// fix for some div with hardcoded fix class
		if ($BOX_PANEL.attr('style')) {
			$BOX_CONTENT.slideToggle(200, function () {
				$BOX_PANEL.removeAttr('style');
			});
		} else {
			$BOX_CONTENT.slideToggle(200);
			$BOX_PANEL.css('height', 'auto');
		}

		$ICON.toggleClass('fa-chevron-up fa-chevron-down');
	});

	$('.close-link').click(function () {
		var $BOX_PANEL = $(this).closest('.x_panel');

		$BOX_PANEL.remove();
	});
});
// /Panel toolbox

// iCheck
$(document).ready(function () {
	if ($("input.flat")[0]) {
		$(document).ready(function () {
			$('input.flat').iCheck({
				checkboxClass: 'icheckbox_flat-green',
				radioClass: 'iradio_flat-green'
			});
		});
	}
	;
});
// /iCheck

<!-- Select2 -->
$(document).ready(function () {
	$(".select2_single").select2({
		placeholder: "Select the option",
		allowClear: true
	});
	$(".select2_group").select2({});
	$(".select2_multiple").select2({
		maximumSelectionLength: 4,
		placeholder: "With Max Selection limit 4",
		allowClear: true
	});
});
<!-- /Select2 -->

// NProgress
if (typeof NProgress != 'undefined') {
	$(document).ready(function () {
		NProgress.start();
	});

	$(window).load(function () {
		NProgress.done();
	});
}

/**
 * Resize function without multiple trigger
 *
 * Usage:
 * $(window).smartresize(function(){
 *     // code here
 * });
 */
(function ($, sr) {
	// debouncing function from John Hann
	// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
	var debounce = function (func, threshold, execAsap) {
		var timeout;

		return function debounced() {
			var obj = this, args = arguments;

			function delayed() {
				if (!execAsap)
					func.apply(obj, args);
				timeout = null;
			}

			if (timeout)
				clearTimeout(timeout);
			else if (execAsap)
				func.apply(obj, args);

			timeout = setTimeout(delayed, threshold || 100);
		};
	};

	// smartresize
	jQuery.fn[sr] = function (fn) {
		return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
	};

})(jQuery, 'smartresize');

/**
 * my scripts. test
 *
 * */
$(document).ready(function () {
	/**
	 * include CKEDITOR to id
	 */
	var o = $('#editor');
	if (o.length > 0) {
		CKEDITOR.replace('editor');
	}

	// pages
	var o = $('.page-from #alias');
	if (o.length > 0) {
		$("#name").syncTranslit({destination: "alias"});
	}

	// floors
	checkSwitcher('image');
	deleteImage('image');
	// speakers
	checkSwitcher('avatar');
	deleteImage('avatar');

	// types
	checkSwitcher('icon');
	deleteImage('icon');

	//user password
	$('#change_password').on('ifChecked', function () {
		$('.change-password').show();
	});
	$('#change_password').on('ifUnchecked', function () {
		$('.change-password').hide();
	});
	if ($('#change_password').attr('checked') == 'checked') {
		$('.change-password').show();
	}

	//event datetimepicker
	var dateTimeOptions = {
		format: 'yyyy-mm-dd hh:ii:00',
		todayBtn: true,
		clearBtn: true,
		pickerPosition: 'bottom-right',
		autoclose: true
	};
	$(function () {
		$('#start_at').datetimepicker(dateTimeOptions);
	});

	$(function () {
		$('#end_at').datetimepicker(dateTimeOptions);
	});

	<!-- Select2 -->
	$(".select2_multiple").select2({
		allowClear: true
	});
	<!-- /Select2 -->

	<!-- disable button after first click -->
	$('form').submit(function(){
		$('input[type=submit]', $(this)).prop( 'disabled', true );
	});
});

function checkSwitcher(fieldName) {
	$('#' + fieldName + '-switch-url').on('ifChecked', function () {
		$('.form-group-' + fieldName + '-url').show();
		$('.form-group-' + fieldName + '-file').hide();
	});

	$('#' + fieldName + '-switch-file').on('ifChecked', function () {
		$('.form-group-' + fieldName + '-file').show();
		$('.form-group-' + fieldName + '-url').hide();
	});

	if (($('input[name=' + fieldName + '-switch]:checked').length > 0) && ($('input[name=' + fieldName + '-switch]:checked').val() == fieldName + '_url')) {
		$('.form-group-' + fieldName + '-file').hide();
	} else {
		$('.form-group-' + fieldName + '-url').hide();
	}
}

function deleteImage(fieldName) {
	$('.btn-' + fieldName + '-delete').on('click', function (e) {
		e.preventDefault();
		var field = $(this).data('field');
		$("input[name=" + field + "_delete]").val($("input[name=" + field + "]").val());
		$('.' + fieldName + '-block').hide();
		$('.' + fieldName + '-upload-block').show();
	});
}
