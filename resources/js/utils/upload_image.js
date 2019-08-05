function readURL(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $('#image-preview').css('background-image', `url(${e.target.result})`);
      $('#image-preview').hide();
      $('#image-preview').fadeIn(650);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$('.image-picture').change(function () {
  readURL(this);
});
