$(document).ready(function () {
  let timer;
  const searchInput = $("#ajax-search");
  const clearBtn = $("#clear-search");

  function loadTable(query = "", url = window.location.pathname) {
    $.ajax({
      url: url,
      type: "GET",
      data: { search: query },
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

  if (searchInput.val().length > 0) clearBtn.show();

  $(document).on("click", ".pagination-wrapper a", function (e) {
    e.preventDefault();
    loadTable(searchInput.val().trim(), $(this).attr("href"));
  });
});
