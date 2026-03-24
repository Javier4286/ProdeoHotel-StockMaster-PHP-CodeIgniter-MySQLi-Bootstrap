$(document).ready(function () {
  const baseUrl = window.location.origin + window.location.pathname;
  const searchInput = $("#ajax-search");
  const clearBtn = $("#clear-search");
  const tableContent = $("#table-content");

  if (searchInput.length) {
    let timer;

    function loadTable(query = "", url = baseUrl) {
      $.ajax({
        url: url,
        type: "GET",
        data: { search: query },
        beforeSend: function () {
          tableContent.css("opacity", "0.6");
        },
        success: function (response) {
          const newTableHtml = $(response).find("#table-content").html();
          tableContent.html(newTableHtml).css("opacity", "1");
        },
        error: function () {
          tableContent.css("opacity", "1");
        },
      });
    }

    searchInput.on("input", function () {
      const query = $(this).val();
      clearBtn.toggle(query.length > 0);
      clearTimeout(timer);
      timer = setTimeout(() => {
        loadTable(query.trim());
      }, 400);
    });

    clearBtn.on("click", function () {
      searchInput.val("").trigger("input").focus();
    });

    $(document).on("click", ".pagination-wrapper a", function (e) {
      e.preventDefault();
      const url = $(this).attr("href");
      loadTable(searchInput.val().trim(), url);
    });
  }
});
