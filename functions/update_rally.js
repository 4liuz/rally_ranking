document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#rally-form");

  form.addEventListener("submit", async e => {
    e.preventDefault();
    UpdateRally();
  });
});
