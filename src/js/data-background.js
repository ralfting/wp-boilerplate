$(document).ready(function() {
  let $backgrounds = $('[data-background]');

  $backgrounds.each((el, value) => {
    let $el = $(value);
    let backgroundImage = $el.data('background');

    $el.css({
      backgroundImage: `url(${backgroundImage})`
    });
  });
});