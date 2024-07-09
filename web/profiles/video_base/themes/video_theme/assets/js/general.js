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
document.addEventListener("DOMContentLoaded", function () {
  const element = document.querySelector("#block-portfolio-theme-views-block-header-block-1 .field-content");
  if (element) {
    const text = element.textContent.trim();
    const words = text.split(" ");
    const middleIndex = Math.ceil(words.length / 2);

    const firstHalf = words.slice(0, middleIndex).join(" ");
    const secondHalf = words.slice(middleIndex).join(" ");

    element.innerHTML = `<span class="first-half">${firstHalf}</span> <span class="second-half">${secondHalf}</span>`;
  }
});
