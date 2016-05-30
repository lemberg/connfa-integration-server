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

// Tooltip
$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});
});
// /Tooltip

// Progressbar
if ($(".progress .progress-bar")[0]) {
	$('.progress .progress-bar').progressbar(); // bootstrap 3
}
// /Progressbar

// Switchery
$(document).ready(function () {
	if ($(".js-switch")[0]) {
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		elems.forEach(function (html) {
			var switchery = new Switchery(html, {
				color: '#26B99A'
			});
		});
	}
});
// /Switchery

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
});
// /iCheck

// Table
$('table input').on('ifChecked', function () {
	checkState = '';
	$(this).parent().parent().parent().addClass('selected');
	countChecked();
});
$('table input').on('ifUnchecked', function () {
	checkState = '';
	$(this).parent().parent().parent().removeClass('selected');
	countChecked();
});

var checkState = '';

$('.bulk_action input').on('ifChecked', function () {
	checkState = '';
	$(this).parent().parent().parent().addClass('selected');
	countChecked();
});
$('.bulk_action input').on('ifUnchecked', function () {
	checkState = '';
	$(this).parent().parent().parent().removeClass('selected');
	countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function () {
	checkState = 'all';
	countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function () {
	checkState = 'none';
	countChecked();
});

function countChecked() {
	if (checkState === 'all') {
		$(".bulk_action input[name='table_records']").iCheck('check');
	}
	if (checkState === 'none') {
		$(".bulk_action input[name='table_records']").iCheck('uncheck');
	}

	var checkCount = $(".bulk_action input[name='table_records']:checked").length;

	if (checkCount) {
		$('.column-title').hide();
		$('.bulk-actions').show();
		$('.action-cnt').html(checkCount + ' Records Selected');
	} else {
		$('.column-title').show();
		$('.bulk-actions').hide();
	}
}

// Accordion
$(document).ready(function () {
	$(".expand").on("click", function () {
		$(this).next().slideToggle(200);
		$expand = $(this).find(">:first-child");

		if ($expand.text() == "+") {
			$expand.text("-");
		} else {
			$expand.text("+");
		}
	});
});

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

<!-- bootstrap-daterangepicker -->
$(document).ready(function () {

	var cb = function (start, end, label) {
		console.log(start.toISOString(), end.toISOString(), label);
		$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	};

	var optionSet1 = {
		startDate: moment().subtract(29, 'days'),
		endDate: moment(),
		minDate: '01/01/2012',
		maxDate: '12/31/2015',
		dateLimit: {
			days: 60
		},
		showDropdowns: true,
		showWeekNumbers: true,
		timePicker: false,
		timePickerIncrement: 1,
		timePicker12Hour: true,
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		opens: 'left',
		buttonClasses: ['btn btn-default'],
		applyClass: 'btn-small btn-primary',
		cancelClass: 'btn-small',
		format: 'MM/DD/YYYY',
		separator: ' to ',
		locale: {
			applyLabel: 'Submit',
			cancelLabel: 'Clear',
			fromLabel: 'From',
			toLabel: 'To',
			customRangeLabel: 'Custom',
			daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
			monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
			firstDay: 1
		}
	};
	$('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
	$('#reportrange').daterangepicker(optionSet1, cb);
	$('#reportrange').on('show.daterangepicker', function () {
		console.log("show event fired");
	});
	$('#reportrange').on('hide.daterangepicker', function () {
		console.log("hide event fired");
	});
	$('#reportrange').on('apply.daterangepicker', function (ev, picker) {
		console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
	});
	$('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
		console.log("cancel event fired");
	});
	$('#options1').click(function () {
		$('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
	});
	$('#options2').click(function () {
		$('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
	});
	$('#destroy').click(function () {
		$('#reportrange').data('daterangepicker').remove();
	});
});

<!-- /bootstrap-daterangepicker -->



<!-- Skycons -->

$(document).ready(function () {
	var icons = new Skycons({
			"color": "#73879C"
		}),
		list = [
			"clear-day", "clear-night", "partly-cloudy-day",
			"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
			"fog"
		],
		i;

	for (i = list.length; i--;)
		icons.set(list[i], list[i]);

	icons.play();

	<!-- /Skycons -->


	/**
	 * fChecked to select url or file
	* types - (create/update)
	* */
	$('#icon-switch-text').on('ifChecked', function () {
		$('.form-group-icon-text').show();
		$('.form-group-icon-file').hide();
	});

	$('#icon-switch-file').on('ifChecked', function () {
		$('.form-group-icon-file').show();
		$('.form-group-icon-text').hide();
	});

	if (($('input[name=icon-switch]:checked').length > 0) && ($('input[name=icon-switch]:checked').val() == 'url')) {
		$('.form-group-icon-file').hide();
	} else {
		$('.form-group-icon-text').hide();
	}

	/**
	 * types - delete icon
	 */
	$('#type-icon-delete').on('click', function (e) {
		e.preventDefault();
		$.ajax({
			url: $(this).data('url'),
			type: 'post',
			data: {_method: 'delete', _token: $(this).data('token')},
			success: function(result) {
				JSON.stringify(result);
				if(result.result)
				{
					console.log(result);
					console.log('delete image');
					$('.image-block').hide();
					$('.upload-image-block').show();
				}
			}
		});

	});

	// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.

	var o = $('#editor-speaker');
	if (o.length > 0) {
		CKEDITOR.replace( 'editor-speaker' );
	}

});



