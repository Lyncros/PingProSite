
jQuery(window).bind('scroll', function (){
  if (jQuery(window).scrollTop() > 900){
    jQuery('body.front #main-nav').addClass('navbar-fixed-top');
  } else {
    jQuery('body.front #main-nav').removeClass('navbar-fixed-top');
  }
});


$(document).ready(function(){

  "use strict";
  $('#main-nav .nav').onePageNav({
    currentClass: 'active',
    scrollOffset: 69,
    scrollSpeed: 750,
    filter: ':not(.external)'
  });
  $('')


  //.parallax(xPosition, speedFactor, outerHeight) options:
  //xPosition - Horizontal position of the element
  //inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
  //outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
  $('#top').parallax("50%", 0.4);
  $('#testimonial').parallax("50%", 0.4);
  $('#download').parallax("50%", 0.4);

  $('#video').css({ width: $('.modal-lg').innerWidth() + 'px', height: $('.modal-lg').innerWidth()/16*9 + 'px' });

  $(window).load(function(){
    $('#video').css({ width: $('.modal-lg').innerWidth()-30 + 'px', height: $('.modal-lg').innerWidth()/16*9 + 'px' });
  });

  var header = $('header');
  var backgrounds = new Array(
  'url(/images/homebg-4.jpg)',
  'url(/images/homebg-2.jpg)',
  'url(/images/homebg-3.jpg)',
  'url(/images/homebg-1.jpg)',
  'url(/images/homebg-5.jpg)'
  );
  var current = 0;

  function nextBackground() {

    header.fadeTo('slow', 0.3, function() {
      header.css('background-image', backgrounds[current = ++current % backgrounds.length]);
    }).delay(300).fadeTo('slow', 1);

    
    setTimeout(nextBackground, 10000);
  }

  setTimeout(nextBackground, 10000);
  header.css('background-image', backgrounds[0]);


});
