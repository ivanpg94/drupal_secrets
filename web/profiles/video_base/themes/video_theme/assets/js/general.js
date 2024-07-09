document.addEventListener('DOMContentLoaded', function () {
  var messages = document.querySelectorAll('div[role="contentinfo"][aria-label="Status message"]');

  messages.forEach(function (message) {
    // Crear el botón de cierre
    var closeButton = document.createElement('button');
    closeButton.classList.add('close-btn');
    closeButton.setAttribute('aria-label', 'Close');
    closeButton.innerHTML = '&times;'; // Símbolo de multiplicación (cruz)

    // Añadir el botón de cierre al contenedor del mensaje
    message.appendChild(closeButton);

    // Añadir evento de clic para cerrar el mensaje
    closeButton.addEventListener('click', function () {
      message.style.display = 'none';
    });
  });
});

