!function($){"use strict";$(function(){$(".ct-vc-services-carousel").length>0&&$(".ct-vc-services-carousel").each(function(){var a=$(this),t=a.data("owl-nav-text");console.log(t),imagesLoaded(a,function(){a.owlCarousel({items:a.data("owl-items"),margin:10,nav:a.data("owl-nav"),navText:t,loop:a.data("owl-loop"),autoplay:a.data("owl-autoplay"),autoplayTimeout:a.data("owl-speed"),autoplayHoverPause:a.data("owl-hover"),responsive:{0:{items:a.data("owl-mobile"),dots:a.data("owl-dots"),nav:a.data("owl-nav")},767:{items:a.data("owl-tablet"),dots:a.data("owl-dots")},992:{items:a.data("owl-items"),dots:a.data("owl-dots")}}})})})})}(jQuery);