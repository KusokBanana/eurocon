/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2017 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
(function(document, window, $) {
  'use strict';

  var Site = window.Site;

  $(document).ready(function($) {
    Site.run();

    $('.timeline-item').appear();

    $('.timeline-item').not(':appeared').each(function() {
      var $item = $(this);
      $item.addClass('timeline-invisible');
      $item.find('.timeline-dot').addClass('invisible');
      $item.find('.timeline-info').addClass('invisible');
      $item.find('.timeline-content').addClass('invisible');
    });

    $(document).on('appear', '.timeline-item.timeline-invisible', function(e) {
      var $item = $(this);
      $item.removeClass('timeline-invisible');

      $item.find('.timeline-dot').removeClass('invisible').addClass('animation-scale-up');

      var prevPrev = $item.prev('.timeline-item').prev('.timeline-item');
      if (prevPrev.length) {
        console.log(prevPrev, prevPrev.position());
        if (prevPrev.position().top + prevPrev.height() >= $item.position().top) {
            console.log($item, 'toggled', prevPrev.position().top + prevPrev.height(), $item.position().top);
            $item.toggleClass('timeline-reverse');
            $item.nextAll().toggleClass('timeline-reverse');
        }
      }

      if ($item.hasClass('timeline-reverse') || $item.css('float') === 'none') {
        console.log($item, 1);
        $item.find('.timeline-info').removeClass('invisible').addClass('animation-slide-right');
        $item.find('.timeline-content').removeClass('invisible').addClass('animation-slide-right');
      } else {
          console.log($item, 2);
          $item.find('.timeline-info').removeClass('invisible').addClass('animation-slide-left');
        $item.find('.timeline-content').removeClass('invisible').addClass('animation-slide-left');
      }
    });
  });
})(document, window, jQuery);
