/**
 * @file
 * User experience improvements for the Kalagraphs module.
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.kalagraphsTweaks = {
    attach: function (context, settings) {
      var waitForLoad = function () {
        if (typeof jQuery.fn.autogrow != 'undefined') {
          $('textarea', context)
            .once('kalagraphsAutogrow')
            .autogrow({horizontal: false, flickering: false});
        }
        else {
          window.setTimeout(waitForLoad, 500);
        }
      };
      window.setTimeout(waitForLoad, 500);
    }
  };
})(jQuery, Drupal);
