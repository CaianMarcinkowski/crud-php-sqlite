document.addEventListener("DOMContentLoaded", function () {
  const addButton = document.querySelector(".btn-add");
  const colorSelect = document.querySelector("#color");
  const colorTable = document.querySelector("#color-table tbody");
  const selectedColorsInput = document.querySelector("#selected-colors");

  const addedColors = new Map();

  addButton.addEventListener("click", function () {
    const selectedColorId = colorSelect.value;
    const selectedColorName =
      colorSelect.options[colorSelect.selectedIndex].text;

    if (addedColors.has(selectedColorId)) {
      alert("Essa cor já foi adicionada.");
      return;
    }

    const newRow = document.createElement("tr");
    newRow.innerHTML = `
            <td>${selectedColorName}</td>
            <td><button class="remove-button">Remover</button></td>
        `;
    colorTable.appendChild(newRow);

    addedColors.set(selectedColorId, selectedColorName);
    updateSelectedColorsInput();

    colorSelect.value = "";
  });

  colorTable.addEventListener("click", function (event) {
    if (event.target.classList.contains("remove-button")) {
      const row = event.target.closest("tr");
      const colorName = row.querySelector("td").textContent;

      row.remove();

      for (const [colorId, name] of addedColors) {
        if (name === colorName) {
          addedColors.delete(colorId);
          updateSelectedColorsInput();
          break;
        }
      }
    }
  });

  function updateSelectedColorsInput() {
    const selectedColorsArray = Array.from(addedColors.keys());
    selectedColorsInput.value = JSON.stringify(selectedColorsArray);
  }
});
