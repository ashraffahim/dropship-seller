// Preview selected files
function previewMultipleInputImages(obj, elem) {
	$(elem).empty();
	if (obj.files) {
		var filesAmount = obj.files.length;

		for (i = 0; i < filesAmount; i++) {
			var reader = new FileReader();

			reader.onload = function(event) {
				var img = $($.parseHTML('<img>')).attr('src', event.target.result).attr('class', 'obj-fit-center rounded m-1').attr('height', '75').attr('width', '150').appendTo(elem);
			}

			reader.readAsDataURL(obj.files[i]);
		}
	}
}

// Add rows to custim field
var trClone = $('.custom-field-table tr:nth-child(2)').clone();
trClone.find('input').val("");
$('.add-custom-field').click(() => {
	$('.custom-field-table').append(trClone.clone());
});

// Remove rows from custom field
$('.custom-field-table').on('click', '.remove-custom-field', function() {
	$(this).parent().parent().remove();
});

// Product adding wizard
$('#wizard .button-prev').addClass('disabled', true);
$('#wizard .button-prev').click(function() {
	var prev = $('#wizard .nav-link.active').parent().closest('.nav-item').prev();
	if (prev.length) {
		prev.find('.nav-link').click();
	}
	$('#wizard .button-submit').hide();
	$('#wizard .button-next').removeClass('disabled').show();
	if (!$('#wizard .nav-link.active').parent().closest('.nav-item').prev().length) {
		$('#wizard .button-prev').addClass('disabled', true);
	}
});

$('#wizard .button-next').click(function() {
	var next = $('#wizard .nav-link.active').parent().closest('.nav-item').next();
	if (next.length) {
		next.find('.nav-link').click();
	}
	$('#wizard .button-prev').removeClass('disabled');
	if (!$('#wizard .nav-link.active').parent().closest('.nav-item').next().length) {
		$('#wizard .button-next').addClass('disabled').hide();
		$('#wizard .button-submit').show();
	}
});

// Drag and drop file ui helper
var dropzonePlaceholderText = $('.dropzone-placeholder').text();
var dropzoneBorder = $('.dropzone').css('border');
$('.select-file').on('dragover', function(){event.preventDefault();$('.dropzone').addClass('text-primary').css('border', '2px solid var(--primary)');$('.dropzone-placeholder').text('Drop File(s)');});
$('.select-file').on('dragleave', function(){$('.dropzone').removeClass('text-primary').css('border', dropzoneBorder);$('.dropzone-placeholder').text(dropzonePlaceholderText);});

// Product handle
$('#productName input').on('keydown keyup', function() {
	$('#productHandle input').val($(this).val().toLowerCase().replace(' ', '-'));
});
$('#productHandle input').on('keydown keyup', function() {
	$(this).val($(this).val().toLowerCase().replace(' ', '-'));
});