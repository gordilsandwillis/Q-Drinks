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

    // $(window).offset().top = 0;
    document.documentElement.scrollTop = 0;
    document.body.scrollTop = 0;
    loadedTransitionIn();
    smoothScroll();
    parallaxblock();
    parallaxblock2();
    headerActive();
    $el.ready(function(){
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
  slideshow();
  highballGrid();
  teamGrid();
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

// Newsletter Signup
var mailchimpSignup = {
  init : function() {
    var self = this;
    $('.newsletter-form').submit(function(e){
      self.subscribe(e, self);
    });
  },
  form : $('.newsletter-form'),

  subscribe : function(e, self){
    e.preventDefault();
    var form = self.form,
        link = '/assets/includes/mc_subscribe.php',
        request = $.ajax({
                    url: link,
                    type: 'POST',
                    data : $('.newsletter-form').serialize()
                  });
    request.done(self.handleResponse);
  },

  handleResponse : function(response){
    function outputMessage(msg){
      $('.newsletter-form').find('input[type=text]').val('');
      $('.newsletter-form').find('input[type=text]').blur();
      $('.newsletter-form').find('input[type=text]').attr('placeholder',msg);
    };
    var form = this.form;
    var resp = JSON.parse(response);
    if (resp.title == 'Member Exists') {
      outputMessage('Thanks Times 2!');        
    } else if (resp.title == 'Invalid Resource' || resp.title == 'Internal Server Error') {
      outputMessage('Invalid Email');
    } else if (resp.status == 'subscribed') {
      outputMessage('Thanks');
    } else {
      outputMessage('Invalid Response');
    }
  }
} // End mailchimpSignup

var headerActive = () => {
  let location = $(window)[0].location.href
  let navLinks = $('header .nav-link')
  navLinks.each((index, item) => {
    if (item.href === location) {
      item.classList.add('active')
    }
  })
}

// Parallax stuff

var fancyHeader = function() {
  var header = $('header');
  var scrollTop = $(window).scrollTop();
  if (scrollTop >= 70) {
    header.addClass('collapsed');
    if ($('nav.secondary') !== null) {
      $('nav.secondary').addClass('collapsed');
    }
  } else {
    header.removeClass('collapsed');
    if ($('nav.secondary') !== null) {
      $('nav.secondary').removeClass('collapsed');
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
        section.style.cssText += 'transform: translate3d(0, ' + sectionHeight/5 * speed + 'px, 0)';
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
  var windowWidth = window.innerWidth;

  if (document.querySelector('.recipe-list') !== null && windowWidth > 900) {
    $('.recipe-thumb-link').on('click', function(event) {
      event.stopPropagation();
      event.preventDefault();
      var currentTarget = $(event.currentTarget);
      //Change the Url of the page
      var path = currentTarget.data('path');
      window.history.pushState(null, null, '/'+path);
      //Open the inline recipe
      $('.inline-recipe').removeClass('visible');
      $('.flex-col.show-nipple').removeClass('show-nipple');

      var headerHeight = $('header > .container').height() - 1;
      var contentHeight = currentTarget.parent().parent().next().find('.container').innerHeight();
      var contentBg = currentTarget.data('bg-color');

      setTimeout(function(){
        var itemOffset = currentTarget.offset().top;

        $('html, body').animate({
          scrollTop: itemOffset - (headerHeight * 2)
        }, 500);
      }, 700);

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
}

var teamGrid = function () {
  var windowWidth = window.innerWidth;

  if (document.querySelector('.team-list') !== null) {

    $('.team-thumb-link').on('click', function(event) {
      event.stopPropagation();
      event.preventDefault();
    
      var currentTarget = $(event.currentTarget);

      //Open the inline team
      $('.inline-team').removeClass('visible');
      $('.flex-col.show-nipple').removeClass('show-nipple');

      var headerHeight = $('header > .container').height() - 1;
      var contentHeight = currentTarget.parent().parent().next().find('.container').innerHeight();
      var contentBg = currentTarget.data('bg-color');

      setTimeout(function(){
        var itemOffset = currentTarget.offset().top;

        $('html, body').animate({
          scrollTop: itemOffset - (headerHeight * 2)
        }, 500);
      }, 700);

      currentTarget.parent().parent().addClass('show-nipple');
      currentTarget.parent().parent().next().addClass('visible');

      $('.inline-team').css({'color' : contentBg})
      $('.inline-team').css({ 'height' : 0 });

      currentTarget.parent().parent().next().css({ 'height' : contentHeight });
    });
    $('.team-list li:nth-of-type(3n) .team-thumb-link').on('click', function(event) {
      $('.inline-team').removeClass('nipple-left');
      $('.inline-team').removeClass('nipple-center');
      $('.inline-team').addClass('nipple-right');
    });

    $('.team-list li:nth-of-type(3n - 1) .team-thumb-link').on('click', function(event) {
      $('.inline-team').removeClass('nipple-left');
      $('.inline-team').addClass('nipple-center');
      $('.inline-team').removeClass('nipple-right');
    });

    $('.team-list li:nth-of-type(3n - 2) .team-thumb-link').on('click', function(event) {
      $('.inline-team').addClass('nipple-left');
      $('.inline-team').removeClass('nipple-center');
      $('.inline-team').removeClass('nipple-right');
    });
    $('.close-team').on('click', function() {
      $('.inline-team').css({ 'height' : 0 });
      $('.inline-team').removeClass('visible');
      $('.flex-col.show-nipple').removeClass('show-nipple');
    });
  }
}


var mobileMenu = function () {
  var menuToggle = document.querySelector('#menu-toggle');
  menuToggle.addEventListener('click', function(event) {
    document.querySelector('body').classList.toggle('mobile-menu-open');
  });
}

var closeMobileMenu = function () {
  document.querySelector('body').classList.remove('mobile-menu-open');
}

var serveVideos = function () {
  let videos = $('.alternating-blocks .media-wrap.has-full-video')
  videos.each((index, item) => {
    let videoTrigger = $(item).find($('.video-trigger'))
    let fullVideo = $(item).find($('.full-video'))[0]

    if (videoTrigger) {
      videoTrigger.click(function() {
        videoTrigger.addClass('playing')
        fullVideo.src += '&autoplay=1';
      })
    }

    if (fullVideo) {
      fullVideo.addEventListener('ended', function() {
        videoTrigger.removeClass('playing')
        fullVideo.currentTime = 0
      })
    }
  })

  //   $('.video-container').click(function(){
  //     $(this).find('.video-player-cover').css('display','none');
  //     $(this).find('.play-button').css('display','none');
  //     $(this).find('.lazy-video-container').css('display','none');
  //     $(this).find('iframe').css('display','block');
  //     const theID = $(this).find('.video-player-cover').attr('cover-for');
  //     $('#video-' + theID )[0].src += '?autoplay=1';
  //   })
}

var serveForm = function () {

  // get the form elements defined in your form HTML above    
  var form = $("form.serve-form-element");
  var formInputs = $("form.serve-form-element input");
  var button = $("form.serve-form-element button");

  const validateEmail = (email = '') => {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }


  function validateForm() {
    var isValid = true;
    $(formInputs).each(function() {
      if ( $(this).attr('validation') === 'email' ) {
        if ( !validateEmail($(this).val()) ) {
          isValid = false;
        }
      } else if ( $(this).val() === '' ) {
        isValid = false;
      }
    });

    if (isValid) {
      button.prop( "disabled", false )
    } else {
      button.prop( "disabled", true )
    }
  }

  formInputs.each(function() {
    console.log(this)
    $(this).keyup((event) => {
      console.log(event.target.value)
      validateForm()
    })
  })

  // Success and Error functions for after the form is submitted
  function success() {
    console.log('success')
    button.removeClass('loading')
    button.addClass('success')
    form.removeClass('loading')
    form.addClass('success')
    setTimeout(() => {
      button.removeClass('success')
      form.removeClass('success')
      form[0].reset();
      button.prop( "disabled", true )
    }, 3000)
  }

  function error() {
    console.log('error')
    form.removeClass('loading')
    button.removeClass('loading')
    form.addClass('shake');
    setTimeout(() => {
      form.removeClass('shake');
    }, 1000)
  }

  // handle the form submission event
  if (form) {
    form[0].addEventListener("submit", function(ev) {
      ev.preventDefault();
      var data = new FormData(form[0]);
      ajax('POST', 'https://formspree.io/mrgzqbzb', data, success, error);
      button.addClass('loading')
      form.addClass('loading')
    });
  }

  // helper function for sending an AJAX request
  function ajax(method, url, data, success, error) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, url);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.onreadystatechange = function() {
      if (xhr.readyState !== XMLHttpRequest.DONE) return;
      if (xhr.status === 200) {
        success(xhr.response, xhr.responseType);
      } else {
        error(xhr.status, xhr.response, xhr.responseType);
      }
    };
    xhr.send(data);
  }
}

document.addEventListener("DOMContentLoaded", function() {
  Barba.Pjax.start();
  transitionIn();
  fancyHeader();
  parallaxblock();
  parallaxblock2();
  loadedTransitionIn();
  smoothScroll();
  mailchimpSignup.init(mailchimpSignup);
  // newsletterSignup();
  teamGrid();
  headerActive();
  serveVideos();
  serveForm();
});

$(window).scroll(function() {
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
  highballGrid();
  teamGrid();
});
