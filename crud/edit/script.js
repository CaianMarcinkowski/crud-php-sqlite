document.addEventListener("DOMContentLoaded", function () {
  const addButton = document.querySelector(".btn-add");
  const colorSelect = document.querySelector("#color-select");
  const colorTable = document.querySelector("#color-table tbody");
  const selectedColorsInput = document.querySelector("#selected-colors");

  addButton.addEventListener("click", function () {
    const selectedColorId = colorSelect.value;

    const colorIdsInTable = Array.from(
      colorTable.querySelectorAll("tr[data-color-id]")
    ).map((row) => row.dataset.colorId);

    if (colorIdsInTable.includes(selectedColorId)) {
      alert("Essa cor já está na tabela.");
      return;
    }
  });

  function updateSelectedColorsInput() {
    const selectedColorsArray = Array.from(
      colorTable.querySelectorAll("tr[data-color-id]")
    ).map((row) => row.dataset.colorId);
    selectedColorsInput.value = JSON.stringify(selectedColorsArray);
  }
});
