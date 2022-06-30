$('.slider').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2500,
    slidesToShow: 3,
    // fade: true,
    cssEase: 'linear',
    // slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          arrow: false,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.slider2').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2500,
    slidesToShow: 2,
    // fade: true,
    cssEase: 'linear',
    // slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          arrow: false,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });