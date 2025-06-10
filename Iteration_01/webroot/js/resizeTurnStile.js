
//Resize recaptcha for smaller screens, could also do this via CSS
$(function(){
  function rescaleCaptcha(){

    var width = $('.cf-turnstile').parent().width();
    var scale;
    if (width < 302) {
      scale = width / 302;
    } else{
      scale = 1.0; 
    }

    $('.cf-turnstile').css('transform', 'scale(' + scale + ')');
    $('.cf-turnstile').css('-webkit-transform', 'scale(' + scale + ')');
    $('.cf-turnstile').css('transform-origin', '0 0');
    $('.cf-turnstile').css('-webkit-transform-origin', '0 0');
  }

  rescaleCaptcha();
  $( window ).resize(function() { rescaleCaptcha(); });

});
