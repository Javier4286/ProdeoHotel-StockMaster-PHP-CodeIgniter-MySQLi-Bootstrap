function deleteCategory(id, name, baseUrl, csrfHeader, csrfHash) {
  Swal.fire({
    title: "Are you sure?",
    text: `You are about to delete the category "${name}". This might affect products linked to it!`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`${baseUrl}/categories/delete/${id}`, {
        method: "POST",
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          [csrfHeader]: csrfHash,
        },
      })
        .then((response) => {
          return response.json().then((data) => {
            if (response.ok && data.status) {
              Swal.fire({
                title: "Deleted!",
                text: data.message,
                icon: "success",
                confirmButtonColor: "#3085d6",
              });

              const row = document.getElementById(`category-row-${id}`);
              if (row) {
                row.remove();
                const tbody = document.querySelector(".table-prodeo tbody");
                if (tbody && tbody.querySelectorAll("tr").length === 0) {
                  document.getElementById("main-container").innerHTML = `
                  <div class="text-center py-5 bg-white shadow-sm rounded-4 mt-4">
                    <i class="fas fa-folder-open text-muted mb-3 empty-state-icon"></i>
                    <p class="text-muted fs-5">No categories registered yet.</p>
                  </div>`;
                }
              }
            } else {
              Swal.fire({
                title: "Access Denied",
                text: data.message || "Action not allowed.",
                icon: "error",
                confirmButtonColor: "#3085d6",
              });
            }
          });
        })
        .catch((err) => {
          Swal.fire({
            title: "Error",
            text: "Communication error with the server.",
            icon: "error",
            confirmButtonColor: "#3085d6",
          });
        });
    }
  });
}
