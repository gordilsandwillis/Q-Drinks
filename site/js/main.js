'use strict';

var $ = require('jquery');
var Barba = require('barba.js');
var Slick = require('slick-carousel');

var FadeTransition = Barba.BaseTransition.extend({
  start: function() {
    /**
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
    /**
     * this.oldContainer is the HTMLElement of the old Container
     */

    return $(this.oldContainer).animate({ opacity: 0 }).promise();
  },

  fadeIn: function() {
    /**
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
    slideshow();

    $el.animate({ opacity: 1 }, 400, function() {
      /**
       * Do not forget to call .done() as soon your transition is finished!
       * .done() will automatically remove from the DOM the old Container
       */

      _this.done();
    });
  }
});

/**
 * Next step, you have to tell Barba to use the new Transition
 */

Barba.Pjax.getTransition = function() {
  return FadeTransition;
};


// Parallax stuff

var fancyHeader = function() {
  var header = document.querySelector('header');
  var scrollTop = document.body.scrollTop;
  if (scrollTop >= 75) {
    header.classList.add('collapsed');
  } else {
    header.classList.remove('collapsed');
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
      var sectionTop = parallaxBlock[i].getBoundingClientRect().top;
      var sectionBottom = parallaxBlock[i].getBoundingClientRect().bottom;
      var sectionHeight = parallaxBlock[i].clientHeight;
      if (sectionTop < windowHeight && sectionBottom > 0 && sectionTop < windowHeight - 200) {
        var speed = (sectionHeight/4)/(windowHeight - 150 + sectionHeight);
        section.style.cssText += 'transform: translate3d(0, ' - 200 + sectionTop * speed + 'px, 0)';
      }
    }
  } else {
    for(var i = 0; i < parallaxBlock.length; i++) {
      var section = parallaxBlock[i];
      section.style.cssText += 'transform: translate3d(0, 0, 0)';
    }
  }
}

var parallaxblock2 = function() {
  var windowWidth = window.innerWidth;
  var windowHeight = window.innerHeight;
  var parallaxBlock = document.querySelectorAll('.parallax-block-opposite');
  if (document.querySelector('.parallax-block-opposite') !== null && windowWidth > 600) {

    for(var i = 0; i < parallaxBlock.length; i++) {
      var section = parallaxBlock[i];
      var sectionTop = parallaxBlock[i].getBoundingClientRect().top;
      var sectionBottom = parallaxBlock[i].getBoundingClientRect().bottom;
      var sectionHeight = parallaxBlock[i].clientHeight;
      if (sectionTop < windowHeight && sectionBottom > 0) {
        var speed = (sectionHeight/-4)/(windowHeight - 150 + sectionHeight);
        section.style.cssText += 'transform: translate3d(0, ' + sectionTop * speed + 'px, 0)';
      }
    }
  } else {
    for(var i = 0; i < parallaxBlock.length; i++) {
      var section = parallaxBlock[i];
      section.style.cssText += 'transform: translate3d(0, 0, 0)';
    }
  }
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

$('.one-time').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  adaptiveHeight: true
});

var slideshow = function() {
  if (document.querySelector('.slideshow') !== null) {
    console.log('penis')
    $('.recipe-slideshow').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });
  }
}

// Smooth Scrolling #Links
$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      var headerHeight = $('header > .container').height() - 1;
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - headerHeight
        }, 1000);
        return false;
      }
    }
  });
});

document.addEventListener("DOMContentLoaded", function() {
  Barba.Pjax.start();
  transitionIn();
  fancyHeader();
  loadedTransitionIn();
  slideshow();
});

document.addEventListener('scroll', function(event) {
  fancyHeader();
  parallaxTop();
  parallaxblock();
  parallaxblock2();
  transitionIn();
});

window.addEventListener('resize', function(event) {
  fancyHeader();
  parallaxTop();
  parallaxblock();
  parallaxblock2();
  transitionIn();
});