document.addEventListener("DOMContentLoaded", function () {
  const productSelect = document.getElementById("id_product");
  const stockInfo = document.getElementById("stockInfo");
  const currentStockQty = document.getElementById("currentStockQty");
  const quantityInput = document.getElementById("quantity");
  const form = document.getElementById("transactionForm");
  const btnSubmit = document.getElementById("btnSubmit");
  const alertDiv = document.getElementById("alertPlaceholder");
  const baseUrl = form.getAttribute("data-base-url");

  function setStock(value) {
    const stock = parseInt(value);
    if (isNaN(stock)) return;

    currentStockQty.innerText = stock;
    quantityInput.dataset.max = stock;
    stockInfo.style.display = "block";
  }

  productSelect.addEventListener("change", function () {
    const productId = this.value;
    const selectedOption = this.options[this.selectedIndex];

    if (productId) {
      const match = selectedOption.text.match(/\(Current: (\d+)\)/);
      if (match) setStock(match[1]);

      fetch(`${baseUrl}/products/get-stock/${productId}`)
        .then((res) => res.json())
        .then((data) => {
          if (data.stock !== undefined) setStock(data.stock);
        })
        .catch((err) => console.error("Error fetching stock", err));
    } else {
      stockInfo.style.display = "none";
      quantityInput.dataset.max = 0;
    }
  });

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const movement = document.querySelector(
      'input[name="movement"]:checked',
    ).value;
    const qty = parseInt(quantityInput.value);
    const max = parseInt(quantityInput.dataset.max || 0);

    if (movement === "out" && qty > max) {
      alertDiv.innerHTML = `<div class="alert alert-warning border-0 shadow-sm text-center">
                Insufficient stock (${max} available).
            </div>`;
      return;
    }

    btnSubmit.disabled = true;
    btnSubmit.innerHTML = "SAVING...";

    fetch(`${baseUrl}/transactions/store`, {
      method: "POST",
      body: new FormData(this),
      headers: { "X-Requested-With": "XMLHttpRequest" },
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status === true) {
          alertDiv.innerHTML = `<div class="alert alert-success border-0 shadow-sm">${data.message}</div>`;
          form.reset();
          stockInfo.style.display = "none";
          setTimeout(() => {
            window.location.href = `${baseUrl}/transactions`;
          }, 1500);
        } else {
          alertDiv.innerHTML = `<div class="alert alert-danger border-0 shadow-sm">${data.error || "Error"}</div>`;
          btnSubmit.disabled = false;
          btnSubmit.innerHTML = "SAVE MOVEMENT";
        }
      })
      .catch(() => {
        alertDiv.innerHTML = `<div class="alert alert-danger border-0 shadow-sm">Connection error.</div>`;
        btnSubmit.disabled = false;
        btnSubmit.innerHTML = "SAVE MOVEMENT";
      });
  });
});
