/**
 * @file
 * Change style options on the Kalastatic Widget depending on selected component.
 */

(function ($) {
  Drupal.behaviors.KalaponentsStyleOptions = {
    attach: function (context, settings) {
      console.log(settings.kalaponents_styles);
      var $elements = $('.field-name-field-kalaponents-type input', context);
      console.log($elements.length);
      $elements.change(function () {
        var $style = $(".field-name-field-kalaponents-style select", context);
        $style.empty(); // Remove old options.
        $style.append($("<option></option>")
          .attr("value", '').text('- Default -'));
        $.each(settings.kalaponents_styles[$(this).val()], function (key,value) {
          $style.append($("<option></option>")
            .attr("value", key).text(value));
        });
      });
    }
  };
})(jQuery);
