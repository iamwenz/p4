//This jacascript function fetch image from the url and display in the column
/*//////// Citation//////////
  .innerHTML - https://stackoverflow.com/questions/2310145/javascript-getting-value-of-a-td-with-id-name
  .value - https://stackoverflow.com/questions/2310145/javascript-getting-value-of-a-td-with-id-name
  .style.display - https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
  */////////
<script type="text/javascript">
function fetchimage() {
  const $background_url = document.getElementById('background_url');
  const $display  = document.getElemneById('display');
  const $urlString = $background_url.value;
  const $urlLength = $urlString.length;
  const $extension = '';
  const $fetchImage = '';

  if($urlString === ''){
    $display.innterHTML = 'URL field is empty!';
  } else {
    $extension += $urlString.charAt($urlLength-3);
    $extension += $urlString.charAt($urlLength-2);
    $extension += $urlString.charAt($urlLength-1);
    if($extension !== 'jpg' && $extension !== 'peg' && $extension !== 'gif' && $extension !== 'png' && $extension !== 'svg') {
      $display.innetHTML = 'URL should be end with "jpeg", "jpg", "gif", "png" or "svg".';
    } else {
      $fetchImage = document.createElement(img);
      $fetchImage.setAttribute('width', '150px');
      $fetchImage.setAttribute('height', '50px');
      $fetchImage.setAttribute('src', $background_url);
      $display.innetHTML = '';
      $display.removeChild();
      $display.appendChild($fetchImage);
    }

  }
  return false;
}
</script>
