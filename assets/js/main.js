// document.addEventListener("DOMContentLoaded", function() {
//   document.querySelector('.page').classList.add('loaded');
// });

/*
https://www.smashingmagazine.com/2016/07/improving-user-flow-through-page-transitions/

You can copy paste this code in your console on smashingmagazine.com
in order to have cross-fade transition when change page.
*/

var cache = {};
function loadPage(url) {
  if (cache[url]) {
    return new Promise(function(resolve) {
      resolve(cache[url]);
    });
  }

  return fetch(url, {
    method: 'GET'
  }).then(function(response) {
    cache[url] = response.text();
    return cache[url];
  });
}

var main = document.querySelector('.content');

function changePage() {
  var url = window.location.href;

  loadPage(url).then(function(responseText) {
    var wrapper = document.createElement('div');
        wrapper.innerHTML = responseText;

    var oldContent = document.querySelector('.cc');
    var newContent = wrapper.querySelector('.cc');

    main.appendChild(newContent);
    animate(oldContent, newContent);
  });
}

function animate(oldContent, newContent) {
	var cssString = "position: absolute; width: 100%; top: 0;"
  // var cssString = "position: fixed; width: 100%; height: 100%; top: 0; overflow: hidden;"

  oldContent.style.cssText = cssString;

  var fadeOut = oldContent.animate({
    opacity: [1, 0, 0]
  }, 1000);

  setTimeout(function(){ 
    console.log("out"); 
    document.body.scrollTop = 0;
  }, 500);

  var fadeIn = newContent.animate({
    opacity: [0, 0, 1]
  }, 1000);

  fadeIn.onfinish = function() {
    oldContent.parentNode.removeChild(oldContent);
  };
}

window.addEventListener('popstate', changePage);

document.addEventListener('click', function(e) {
  var el = e.target;

  while (el && !el.href) {
    el = el.parentNode;
  }

  if (el) {
    e.preventDefault();
    history.pushState(null, null, el.href);
    changePage();

    return;
  }
});

// Parallax stuff

document.addEventListener('scroll', function(event) {
  var scrollTop = document.body.scrollTop;
  var windowHeight = window.innerHeight;
  var windowWidth = window.innerWidth;
  var header = document.querySelector('header');

  if (scrollTop >= 75) {
    header.classList.add('collapsed');
  } else {
    header.classList.remove('collapsed');
  }

  if (document.querySelector('.bg-image.parallax-top') !== null) {
    var parallaxTop = document.querySelector('.bg-image.parallax-top');
    parallaxTop.style.cssText += 'transform: translate3d(0, ' + scrollTop/2 + 'px, 0)';
  }

  if (document.querySelector('.parallax-block') !== null && windowWidth > 600) {
    var parallaxBlock = document.querySelectorAll('.parallax-block');

    for(var i = 0; i < parallaxBlock.length; i++) {
      var section = parallaxBlock[i];
      var sectionTop = parallaxBlock[i].getBoundingClientRect().top;
      var sectionBottom = parallaxBlock[i].getBoundingClientRect().bottom;
      var sectionHeight = parallaxBlock[i].clientHeight;
      console.log(sectionHeight);
      if (sectionTop < windowHeight && sectionBottom > 0) {
        var speed = (sectionHeight/4)/(windowHeight + sectionHeight);
        section.style.cssText += 'transform: translate3d(0, ' + sectionTop * speed + 'px, 0)';
      }
    }
  }

  if (document.querySelector('.parallax-block-opposite') !== null && windowWidth > 600) {
    var parallaxBlock = document.querySelectorAll('.parallax-block-opposite');

    for(var i = 0; i < parallaxBlock.length; i++) {
      var section = parallaxBlock[i];
      var sectionTop = parallaxBlock[i].getBoundingClientRect().top;
      var sectionBottom = parallaxBlock[i].getBoundingClientRect().bottom;
      var sectionHeight = parallaxBlock[i].clientHeight;
      console.log(sectionHeight);
      if (sectionTop < windowHeight && sectionBottom > 0) {
        var speed = (sectionHeight/-4)/(windowHeight + sectionHeight);
        section.style.cssText += 'transform: translate3d(0, ' + sectionTop * speed + 'px, 0)';
      }
    }
  }

  if (document.querySelector('.transition-in') !== null) {
    var transitionBlock = document.querySelectorAll('.transition-in');

    for(var i = 0; i < transitionBlock.length; i++) {
      var section = transitionBlock[i];
      var sectionTop = transitionBlock[i].getBoundingClientRect().top;
      // console.log('Height '+windowHeight)

      if (sectionTop < windowHeight - windowHeight/10) {
        section.classList.add('visible');
      } else {
        section.classList.remove('visible');
      }
    }
  }

});