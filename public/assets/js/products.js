$(document).ready(function () {
  let timer;
  const searchInput = $("#ajax-search");
  const clearBtn = $("#clear-search");

  function loadTable(query = "", url = window.location.pathname) {
    $.ajax({
      url: url,
      type: "GET",
      data: {
        search: query,
      },
      beforeSend: function () {
        $("#table-content").css("opacity", "0.5");
      },
      success: function (response) {
        const newContent = $(response).find("#table-content").html();
        $("#table-content").html(newContent).css("opacity", "1");
      },
    });
  }

  searchInput.on("input", function () {
    const query = $(this).val();
    clearBtn.toggle(query.length > 0);
    clearTimeout(timer);
    timer = setTimeout(() => loadTable(query.trim()), 300);
  });

  clearBtn.on("click", function () {
    searchInput.val("").trigger("input").focus();
  });

  $(document).on("click", ".pagination-wrapper a", function (e) {
    e.preventDefault();
    loadTable(searchInput.val().trim(), $(this).attr("href"));
  });
});

function deleteProduct(id, name, baseUrl, csrfToken, csrfHash) {
  Swal.fire({
    title: "Are you sure?",
    text: `You are about to delete "${name}".`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#003087",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      const data = {};
      data[csrfToken] = csrfHash;
      $.post(`${baseUrl}/products/delete/${id}`, data, function (res) {
        if (res.status) {
          $(`#product-row-${id}`).remove();
          Swal.fire("Deleted!", "Product has been removed.", "success");
        }
      });
    }
  });
}
