// Schreibmaschinenschrift
var TxtType = function (el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 1400;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};

TxtType.prototype.tick = function () {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

  var that = this;
  var delta = 200 - Math.random() * 100;

  if (this.isDeleting) {
    delta /= 2;
  }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 700; // warten
  }

  setTimeout(function () {
    that.tick();
  }, delta);
};

window.onload = function () {
  var elements = document.getElementsByClassName('schreibmaschinen-schrift');
  for (var i = 0; i < elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-type');
    var period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new TxtType(elements[i], JSON.parse(toRotate), period);
    }
  }
};

// Hamburger-Button

jQuery(document).ready(function ($) {
  $('.counter').counterUp({
    delay: 10,
    time: 1000
  });

  $(
    '.mobile-navigation-mittig-umschalten'
  ).on('click', () => {
    $('.navigation-mittig').slideToggle(500);
  });

  var button = document.getElementById(
      'hamburger-menu'
    ),
    span = button.getElementsByTagName(
      'span'
    )[0];

  button.onclick = function () {
    span.classList.toggle(
      'hamburger-menu-button-close'
    );
  };
  $('#untermenu-navigation').mouseenter(function () {
    $(this)
      .find('.fa-caret-down')
      .addClass('fas fa-caret-up');
  });
  $('#untermenu-navigation').mouseleave(function () {
    $(this)
      .find('.fa-caret-down')
      .removeClass('fa-caret-up');
  });

  // Counter

  var a = 0;
  $(window).scroll(function () {
    var oTop =
      $('#counter').offset().top -
      window.innerHeight;
    if (
      a == 0 &&
      $(window).scrollTop() > oTop
    ) {
      $('.zaehler-wert').each(function () {
        var $this = $(this),
          countTo = $this.attr(
            'data-count'
          );
        $({
          countNum: $this.text()
        }).animate({
            countNum: countTo
          },

          {
            duration: 3000,
            easing: 'swing',
            step: function () {
              $this.text(
                Math.floor(this.countNum)
              );
            },
            complete: function () {
              $this.text(this.countNum);
              //alert('finished');
            }
          }
        );
      });
      a = 1;
    }
  });

  // TOP

  $(document).ready(function () {
    $("#ontop-button").click(function () {
      $("html,body").animate({
        scrollTop: "0"
      }, 1500);
    });
  }); // Ende document ready

  // Bilder Slideshow
  $('.bild-wechsel').slick({
    autoplay: true,
    autoplaySpeed: 10000, // 10 sekunden
    pauseOnHover: false, // autoplay wird nicht pausiert wenn Maus auf dem Bild liegt
    prevArrow: $('.pfeil-slider-zurueck'),
    nextArrow: $('.pfeil-slider-vorwarts'),
  });


$('.kundenfeedback-slidshow').slick({
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows:false,
  autoplay:true,
  draggable:false,
  easing:'linear',

  });


document.addEventListener("scroll", (event) => {
  const scollPositionY = window.scrollY;
  const dMove = $(".d_bewegend");
  const dLetter = $(".d_buchstabe");

  if (scollPositionY > 20) {
    dMove.css("transform", "translate(-3.5px, 0px)");
    dLetter.css("opacity", "0");
  } else {
    dMove.css("transform", "translate(0, 0px)");
    dLetter.css("opacity", "1");
  }
});

	
	
});	