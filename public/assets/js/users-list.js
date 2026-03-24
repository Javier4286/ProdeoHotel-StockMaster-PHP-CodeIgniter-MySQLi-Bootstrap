function deleteUser(id, name) {
  Swal.fire({
    title: "Are you sure?",
    text: `You are about to deactivate "${name}".`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#003087",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Yes, deactivate!",
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.isConfirmed) {
      handleUserAction(`${USERS_URLS.delete}/${id}`, "Deactivated!");
    }
  });
}

function restoreUser(id, name) {
  Swal.fire({
    title: "Reactivate Employee?",
    text: `Do you want to reactivate "${name}"?`,
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#198754",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Yes, reactivate!",
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.isConfirmed) {
      handleUserAction(`${USERS_URLS.restore}/${id}`, "Restored!");
    }
  });
}

function handleUserAction(url, successTitle) {
  fetch(url, {
    method: "POST",
    headers: {
      "X-Requested-With": "XMLHttpRequest",
      [USERS_URLS.csrf_header]: USERS_URLS.csrf_hash,
    },
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status) {
        Swal.fire(successTitle, data.message, "success").then(() =>
          location.reload(),
        );
      } else {
        Swal.fire("Error", data.message, "error");
      }
    })
    .catch(() => {
      Swal.fire("Error", "Communication error with the server", "error");
    });
}
