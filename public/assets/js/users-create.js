$(document).ready(function () {
  $("#userForm").on("submit", function () {
    const btnSave = $(".btn-save");
    btnSave.prop("disabled", true);
    btnSave.html('<i class="fas fa-spinner fa-spin me-2"></i> CREATING...');
  });
});
