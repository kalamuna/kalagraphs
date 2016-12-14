/**
 * @file
 * Change style options on the Kalastatic Widget depending on selected component.
 */

(function ($) {
  Drupal.behaviors.KalaponentsStyleOptions = {
    attach: function (context, settings) {
      var $typeRadios = $('.field-name-field-kalaponents-type', context);
      $typeRadios.once('kpStyleVars', function() {
        var $radio = $(this).find('input[type=radio]');
        $radio.on('change', function() {

          var $radioParent = $radio.closest('.field-name-field-kalaponents-type'),
              $styleSelect = $radioParent.next('.field-name-field-kalaponents-style').find('select');
          $styleSelect.empty(); // Remove old options.
          $styleSelect
            .append($('<option></option>')
              .attr('value', '-none-').text('- Default -'));

          // Build a string of new options to add to the select list.
          var options;
          $.each(settings.kalaponents_styles[$(this).val()], function (key, value) {
            options += '<option value="' + key + '">' + value + '</option>';
          });
console.log(options);
          // Add them all at once so we're not thrashing the DOM.
          $styleSelect.append(options);
        });
      });
    }
  };
})(jQuery);
