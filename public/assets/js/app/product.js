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

var trClone = $('.custom-field-table tr:nth-child(2)').clone();
trClone.find('input').val("");
$('.add-custom-field').click(() => {
  $('.custom-field-table').append(trClone.clone());
});

$('.custom-field-table').on('click', '.remove-custom-field', function() {
  $(this).parent().parent().remove();
});