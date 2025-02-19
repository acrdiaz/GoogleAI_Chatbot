function toggleModelSelect() {
  // Obtener el checkbox y el combo box
  const enableModelCheckbox = document.getElementById('enableModel');
  const modelSelect = document.getElementById('model');

  // Habilitar/deshabilitar el combo box según el estado del checkbox
  modelSelect.disabled = !enableModelCheckbox.checked;

  // Si el combo box está habilitado, asegúrate de que tenga un valor seleccionado
  if (!modelSelect.disabled) {
    modelSelect.focus();
  }
}
