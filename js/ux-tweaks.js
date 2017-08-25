/**
 * @file
 * User experience improvements for the Kalagraphs module.
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.kalagraphsTweaks = {
    attach: function (context, settings) {
      $('textarea', context)
        .once('kalagraphsAutogrow')
        .autogrow({horizontal: false, flickering: false});
    }
  };
})(jQuery, Drupal);
