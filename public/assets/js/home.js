document.querySelector(".button-user").addEventListener("click", function () {
  let toolsContainer = document.querySelector(".tools-container");
  toolsContainer.style.display =
    toolsContainer.style.display === "block" ? "none" : "block";
});
