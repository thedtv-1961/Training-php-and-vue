/* eslint-disable */
function readURL(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $('#avatar-preview').css('background-image', 'url(' + e.target.result + ')');
      $('#avatar-preview').hide();
      $('#avatar-preview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$('.avatar-picture').change(function () {
  readURL(this);
});
