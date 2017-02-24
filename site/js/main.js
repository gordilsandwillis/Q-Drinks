'use strict';

var $ = require('jquery');
var Barba = require('barba.js');
var Slick = require('slick-carousel');

var FadeTransition = Barba.BaseTransition.extend({
  start: function() {
    /*
     * This function is automatically called as soon the Transition starts
     * this.newContainerLoading is a Promise for the loading of the new container
     * (Barba.js also comes with an handy Promise polyfill!)
     */

    // As soon the loading is finished and the old page is faded out, let's fade the new page
    Promise
      .all([this.newContainerLoading, this.fadeOut()])
      .then(this.fadeIn.bind(this));
  },

  fadeOut: function() {
    /*
     * this.oldContainer is the HTMLElement of the old Container
     */
    closeMobileMenu();
    smoothScroll();
    return $(this.oldContainer).animate({ opacity: 0 }, 250).promise();
  },

  fadeIn: function() {
    /*
     * this.newContainer is the HTMLElement of the new Container
     * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
     * Please note, newContainer is available just after newContainerLoading is resolved!
     */

    var _this = this;
    var $el = $(this.newContainer);

    $(this.oldContainer).hide();

    $el.css({
      visibility : 'visible',
      opacity : 0
    });

    document.body.scrollTop = 0;
    fancyHeader();
    loadedTransitionIn();
    smoothScroll();
    parallaxblock();
    parallaxblock2();
    $el.ready(function(){
      console.log('loaded');
      $el.animate({ opacity: 1 }, 750, function() {
        /*
         * Do not forget to call .done() as soon your transition is finished!
         * .done() will automatically remove from the DOM the old Container
         */

        _this.done();
      });
    });
  }
});

// Next step, you have to tell Barba to use the new Transition

Barba.Pjax.getTransition = function() {
  return FadeTransition;
};

Barba.Dispatcher.on('transitionCompleted', function() {
  console.log('Barbara transitionCompleted');
  slideshow();
  if(window.location.pathname === '/highball') {
    highballGrid();
  }
  mobileMenu();
});

// Changes meta tags on new page
Barba.Dispatcher.on('newPageReady', function(currentStatus, oldStatus, container, newPageRawHTML) {
    // html head parser borrowed from jquery pjax
    var $newPageHead = $( '<head />' ).html(
        $.parseHTML(
            newPageRawHTML.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[0]
          , document
          , true
        )
    );
    var headTags = [
        "meta[name='keywords']"
      , "meta[name='description']"
      , "meta[property^='og']"
      , "meta[name^='twitter']"
      , "meta[itemprop]"
      , "link[itemprop]"
      , "link[rel='prev']"
      , "link[rel='next']"
      , "link[rel='canonical']"
    ].join(',');
    $( 'head' ).find( headTags ).remove(); // Remove current head tags
    $newPageHead.find( headTags ).appendTo( 'head' ); // Append new tags to the head
});


// Newletter Signup
var newsletterSignup = function() {
  var form = $('.newsletter-form');

  function outputMessage(msg){
    $('.newsletter-form').find('input[type=text]').val('');
    $('.newsletter-form').find('input[type=text]').blur();
    $('.newsletter-form').find('input[type=text]').attr('placeholder',msg);
  };

  form.submit(function(e) {

    e.preventDefault();
    $('.newsletter-form').find('button.newsletter-submit').addClass('loading');
    var form = this.form,
      link = '/assets/includes/cc_subscribe.php',
      request = $.ajax({
                  url: link,
                  type: 'POST',
                  data : $('.newsletter-form').serialize()
                });
    request.done(function(response, textStatus, xhr){
      var form = this.form;
      var resp = JSON.parse(response);
      console.log(resp); 
      // resp.status == 'ACTIVE' // Success?
      // resp[0].error_key == json.email.invalid // Not an email
      // resp[0].error_key == json.min.length.violation // Empty
      console.log(xhr);
      if (resp.status == 'ACTIVE') {
        outputMessage('Thank You');
        $('.newsletter-form').find('button.newsletter-submit').removeClass('loading');
        $('.newsletter-form').find('button.newsletter-submit').addClass('check');
        setTimeout(function(){
          $('.newsletter-form').find('button.newsletter-submit').removeClass('check');
        }, 3000);
      }
      else {
        outputMessage('Invalid Email');
        $('.newsletter-form').addClass('shake animated');
        $('.newsletter-form').find('button.newsletter-submit').removeClass('loading');
        setTimeout(function(){
          $('.newsletter-form').removeClass('shake animated');
        }, 1200);
      }
    });

  });

};

// Parallax stuff

var fancyHeader = function() {
  var header = document.querySelector('header');
  var scrollTop = document.body.scrollTop;
  if (scrollTop >= 70) {
    header.classList.add('collapsed');
    if (document.querySelector('nav.secondary') !== null) {
      document.querySelector('nav.secondary').classList.add('collapsed');
    }
  } else {
    header.classList.remove('collapsed');
    if (document.querySelector('nav.secondary') !== null) {
      document.querySelector('nav.secondary').classList.remove('collapsed');
    }
  }
}

var parallaxTop = function() {
  if (document.querySelector('.bg-image.parallax-top') !== null) {
    var scrollTop = document.body.scrollTop;
    var parallaxTop = document.querySelector('.bg-image.parallax-top');
    parallaxTop.style.cssText += 'transform: translate3d(0, ' + scrollTop/2 + 'px, 0)';
  }
}

var parallaxblock = function() {
  var windowWidth = window.innerWidth;
  var windowHeight = window.innerHeight;
  var parallaxBlock = document.querySelectorAll('.parallax-block');
  if (document.querySelector('.parallax-block') !== null && windowWidth > 600) {

    for(var i = 0; i < parallaxBlock.length; i++) {
      var section = parallaxBlock[i];
      var sectionTop = section.getBoundingClientRect().top;
      var sectionBottom = section.getBoundingClientRect().bottom;
      var sectionHeight = section.clientHeight;
      if (sectionTop < windowHeight - 0 && sectionBottom > 60) {
        var speed = sectionTop/windowHeight;
        section.style.cssText += 'transform: translate3d(0, ' + sectionHeight/3 * speed + 'px, 0)';
      }
    }

  } else {

    for(var i = 0; i < parallaxBlock.length; i++) {
      var section = parallaxBlock[i];
      var sectionTop = section.getBoundingClientRect().top;
      var sectionBottom = section.getBoundingClientRect().bottom;
      var sectionHeight = section.clientHeight;
      if (sectionTop < windowHeight - 0 && sectionBottom > 60) {
        section.style.cssText += 'transform: translate3d(0, 0, 0)';
      }
    }

  }

}

var parallaxblock2 = function() {
  // var windowWidth = window.innerWidth;
  // var windowHeight = window.innerHeight;
  // var parallaxBlock = document.querySelectorAll('.parallax-block-opposite');
  // if (document.querySelector('.parallax-block-opposite') !== null && windowWidth > 600) {

  //   for(var i = 0; i < parallaxBlock.length; i++) {
  //     var section = parallaxBlock[i];
  //     var sectionTop = parallaxBlock[i].getBoundingClientRect().top;
  //     var sectionBottom = parallaxBlock[i].getBoundingClientRect().bottom;
  //     var sectionHeight = parallaxBlock[i].clientHeight;
  //     if (sectionTop < windowHeight && sectionBottom > 0) {
  //       var speed = (sectionHeight/-4)/(windowHeight - 150 + sectionHeight);
  //       section.style.cssText += 'transform: translate3d(0, ' + sectionTop * speed + 'px, 0)';
  //     }
  //   }
  // } else {
  //   for(var i = 0; i < parallaxBlock.length; i++) {
  //     var section = parallaxBlock[i];
  //     section.style.cssText += 'transform: translate3d(0, 0, 0)';
  //   }
  // }
}

var transitionIn = function() {
  if (document.querySelector('.transition-in') !== null) {
    var scrollTop = document.body.scrollTop;
    var windowHeight = window.innerHeight;
    var transitionBlock = document.querySelectorAll('.transition-in');

    for(var i = 0; i < transitionBlock.length; i++) {
      var section = transitionBlock[i];
      var sectionTop = transitionBlock[i].getBoundingClientRect().top;

      if (sectionTop < windowHeight - windowHeight/8) {
        section.classList.add('visible');
      } else {
        section.classList.remove('visible');
      }
    }
  }
}

var loadedTransitionIn = function() {
  if (document.querySelector('.transition-in') !== null) {
    var scrollTop = document.body.scrollTop;
    var windowHeight = window.innerHeight;
    var transitionBlock = document.querySelectorAll('.transition-in');

    for(var i = 0; i < transitionBlock.length; i++) {
      var section = transitionBlock[i];
      var sectionTop = transitionBlock[i].getBoundingClientRect().top;

      if (sectionTop < windowHeight) {
        section.classList.add('visible');
      } else {
        section.classList.remove('visible');
      }
    }
  }
}

// $('.one-time').slick({
//   dots: true,
//   infinite: true,
//   speed: 300,
//   slidesToShow: 1,
//   adaptiveHeight: true
// });

var slideshow = function() {
  if (document.querySelector('.slideshow') !== null) {
    $('.recipe-slideshow').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });
  }
}


// Smooth Scrolling #Links
var smoothScroll = function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      var headerHeight = $('header > .container').height() - 1;
      var secondaryHeaderHeight = $('nav.secondary').height() - 1;
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - headerHeight - secondaryHeaderHeight
        }, 1000);
        return false;
      }
    }
  });
}

var highballGrid = function () {
  console.log('highballGrid happening');
  $('.recipe-thumb-link').on('click', function(event) {
    event.stopPropagation();
    event.preventDefault();
    console.log('still clicking')
    var currentTarget = $(event.currentTarget);
    //Change the Url of the page
    var path = currentTarget.data('path');
    window.history.pushState(null, null, '/'+path);
    //Open the inline recipe
    $('.inline-recipe').removeClass('visible');
    $('.flex-col.show-nipple').removeClass('show-nipple');
    
    var contentHeight = currentTarget.parent().parent().next().find('.container').innerHeight();
    var contentBg = currentTarget.data('bg-color');

    currentTarget.parent().parent().addClass('show-nipple');
    currentTarget.parent().parent().next().addClass('visible');

    $('.inline-recipe').css({'color' : contentBg})
    $('.inline-recipe').css({ 'height' : 0 });
    currentTarget.parent().parent().next().css({ 'height' : contentHeight });
  });
  $('.recipe-list li:nth-of-type(3n) .recipe-thumb-link').on('click', function(event) {
    $('.inline-recipe').removeClass('nipple-left');
    $('.inline-recipe').removeClass('nipple-center');
    $('.inline-recipe').addClass('nipple-right');
  });
  
  $('.recipe-list li:nth-of-type(3n - 1) .recipe-thumb-link').on('click', function(event) {
    $('.inline-recipe').removeClass('nipple-left');
    $('.inline-recipe').addClass('nipple-center');
    $('.inline-recipe').removeClass('nipple-right');
  });

  $('.recipe-list li:nth-of-type(3n - 2) .recipe-thumb-link').on('click', function(event) {
    $('.inline-recipe').addClass('nipple-left');
    $('.inline-recipe').removeClass('nipple-center');
    $('.inline-recipe').removeClass('nipple-right');
  });
  $('.close-recipe').on('click', function() {
    $('.inline-recipe').css({ 'height' : 0 });
    $('.inline-recipe').removeClass('visible');
    $('.flex-col.show-nipple').removeClass('show-nipple');
  });
}

var mobileMenu = function () {
  var menuToggle = document.querySelector('#menu-toggle');
  menuToggle.addEventListener('click', function(event) {
    console.log('mobile menu');
    document.querySelector('body').classList.toggle('mobile-menu-open');
  });
}

var closeMobileMenu = function () {
  document.querySelector('body').classList.remove('mobile-menu-open');
}

document.addEventListener("DOMContentLoaded", function() {
  Barba.Pjax.start();
  transitionIn();
  fancyHeader();
  // mobileMenu();
  parallaxblock();
  parallaxblock2();
  loadedTransitionIn();
  smoothScroll();
  newsletterSignup();
});

document.addEventListener('scroll', function(event) {
  fancyHeader();
  parallaxTop();
  parallaxblock();
  parallaxblock2();
  transitionIn();
});

window.addEventListener('resize', function(event) {
  var windowWidth = window.innerWidth;
  fancyHeader();
  parallaxTop();
  parallaxblock();
  parallaxblock2();
  transitionIn();
  if (windowWidth > 900) {
    highballGrid();
  }
});
