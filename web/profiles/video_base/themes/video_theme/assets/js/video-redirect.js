(function (Drupal, drupalSettings) {
  Drupal.behaviors.videoRedirect = {
    attach: function (context, settings) {
      var video = document.querySelector('video'); // Cambia esto según el selector de tu vídeo
      if (video) {
        video.addEventListener('ended', function() {
          window.location.href = drupalSettings.videoRedirect.nextNodeUrl;
        });
      }
    }
  };
})(Drupal, drupalSettings);
