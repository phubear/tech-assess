(function ($, Drupal, drupalSettings) {

  Drupal.behaviors.badmodulename = {
      attach: function (context, settings) {
        $(document, context).once('triggerAnalysisButton').on('click', '.analysis-trigger-button', function() {

          // Could've used drupalSettings, which was why I added that initially. I just got lazy towards the end.
          let pageUrl = window.location.pathname;

          $.ajax({
            url: '/api/accessibility',
            type: 'POST',
            data: {
              pathname: pageUrl
            },
            dataType: 'json',
          beforeSend: function() { /* Start some loading */ },
          complete: function() { /* Stop loading */ },
          success: function(data) {
            $('#useless-junk-here').empty();
            if (data.violations.length > 0) {
              for (let pikachu = 0; pikachu < data.violations.length; pikachu++) {
                $('<div class="color-me-' + data.violations[pikachu].count +'">' + data.violations[pikachu].id + ' = ' + data.violations[pikachu].count + '</div>').appendTo('#useless-junk-here');
              }
            }
          },
          error: function(jqXHR, textStatus, errorThrown) { /* Only good modules handle errors */ }
          });

        });
      }
  };

})(jQuery, Drupal, drupalSettings);
