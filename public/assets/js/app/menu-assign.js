var mc = $("#menuContainer form"),
	atm = $('.atm'),
	pam = $('#pam'),
	pl = $('.pl'),
	s = $('.search'),
	cai = $('.cai'),
	eai = $('.eai'),
	st, g, row, rowCln, pdid;

// Jquery :contains() case insensitive
jQuery.expr[':'].icontains = function(a, i, m) {
  return jQuery(a).text().toUpperCase()
      .indexOf(m[3].toUpperCase()) >= 0;
};

// sortable table
sortable('#menuContainer form', {
	forcePlaceholderSize: true
});

// sortable table row
sortable('#menuContainer form table tbody', {
	items: 'tr',
	placeholder: '<tr style="border: 2px dashed #eee"><td colspan="' + $('#menuContainer form table tbody tr td').length + '">&nbsp;</td></tr>',
});

$('#menuContainer form table, #menuContainer form table tbody tr').on('drag', () => {
	// Enable publish button
	pam.removeAttr('disabled');
});

s.keyup(function() {
	pl.find('tr').hide();
	pl.find('thead tr:icontains("' + $(this).val() + '")').show().parents('table').find('tbody tr').show();
	pl.find('tbody tr:icontains("' + $(this).val() + '")').show();
});

atm.change(function() {

	pdid = $(this).data('id');
	st = $(this).is(':checked');
	g = $(this).parents('table').data('group').replace();
	row = $(this).parents('tr');

	// Enable publish button
	pam.removeAttr('disabled');

	if (st) {

		// Clone row from product, set ID, remove checkbox
		rowCln = row.clone().attr('id', `pd${pdid}`);
		rowCln.find('td:first-child').empty();
		
		// Highlight row
		row.addClass('text-success');
		
		if (!mc.find(`table#g${g}`).length) {

			// Create group table
			var tbl = $($.parseHTML('<table></table>')).attr('id', `g${g}`).attr('class', 'table table-theme c-grab');
			var thd = $($.parseHTML('<thead></thead>')).appendTo(tbl);
			var tr  = $($.parseHTML('<tr></tr>')).attr('class', 'text-muted').appendTo(thd);
			          $($.parseHTML('<th></th>')).css('width', '20px').appendTo(tr);
			          $($.parseHTML('<th></th>')).text(g.replace('_', ' ')).attr('colspan', '3').appendTo(tr);
			var tbd = $($.parseHTML('<tbody class="sortable-table"></tbody>')).appendTo(tbl);

			mc.append(tbl);

		}

		$($.parseHTML('<input>')).attr('type', 'hidden').attr('name', 'pid[]').attr('value', pdid)
		.appendTo(rowCln.find('td:first-child'));
		$($.parseHTML('<td></td>')).html('<a class="btn btn-wave btn-outline-light btn-xs rounded-pill text-muted tr-h-v"><i data-feather="plus" height="16" width="16"></i> Label</a>').appendTo(rowCln);

		$(`#menuContainer form table#g${g} tbody`).append(rowCln);
		feather.replace();


		sortable('#menuContainer form', {
			forcePlaceholderSize: true
		});

		// sortable table
		sortable(`#menuContainer form table#g${g} tbody`, {
			items: 'tr',
			placeholder: '<tr style="border: 2px dashed #eee"><td colspan="' + $(`#menuContainer form table#g${g} tbody tr td`).length + '">&nbsp;</td></tr>',
		});

	} else {

		// Remove highlight
		row.removeClass('text-success');

		// Remove row, [table]
		mc.find(`table#g${g} tbody tr#pd${pdid}`).remove();

		if (!mc.find(`table#g${g} tbody tr`).length) {

			mc.find(`table#g${g}`).remove();

		}

	}

});

pam.click(() => {
	mc.submit();
});

pl.on('click', 'tr td:not(:first-child)', function() {
	$(this).parent().find('.atm').click();
});

cai.click(() => {
	// Collapse assigned table rows
	mc.find('table').addClass('bg-white shadow').find('tbody tr').hide();
});

eai.click(() => {
	// Expand assigned table rows
	mc.find('table').removeClass('bg-white shadow').find('tbody tr').show();
});