document.querySelector(".button-user").addEventListener("click", function () {
  let toolsContainer = document.querySelector(".tools-container");
  toolsContainer.style.display =
    toolsContainer.style.display === "block" ? "none" : "block";
});

document.querySelector(".publish").addEventListener("click", function () {
  window.scrollTo(0, 0);
  let toolsContainer = document.querySelector(".pop-up-container");
  if (toolsContainer.style.display === "flex") {
    toolsContainer.style.display = "none";
    document.body.style.overflow = "auto";
  } else {
    toolsContainer.style.display = "flex";
    document.body.style.overflow = "hidden";
  }
});
document
  .querySelector(".pop-up-container h2 svg")
  .addEventListener("click", function () {
    let toolsContainer = document.querySelector(".pop-up-container");
    toolsContainer.style.display = "none";
    document.body.style.overflow = "auto";
  });

document.querySelector(".filtre").addEventListener("click", function () {
  window.scrollTo(0, 0);
  let toolsContainer = document.querySelector(".pop-up-container-filter");
  if (toolsContainer.style.display === "flex") {
    toolsContainer.style.display = "none";
    document.body.style.overflow = "auto";
  } else {
    toolsContainer.style.display = "flex";
    document.body.style.overflow = "hidden";
  }
});

document
  .querySelector(".pop-up-container-filter h2 svg")
  .addEventListener("click", function () {
    let toolsContainer = document.querySelector(".pop-up-container-filter");
    toolsContainer.style.display = "none";
    document.body.style.overflow = "auto";
  });
document.getElementById("photo").addEventListener("change", function (event) {
  const file = event.target.files[0];
  const preview = document.getElementById("imagePreview");

  if (file) {
    const reader = new FileReader();

    reader.onload = function (e) {
      preview.src = e.target.result;
      preview.style.display = "block";
      document.getElementById("preview-container").style.display = "block";
    };

    reader.readAsDataURL(file);
  } else {
    document.getElementById("preview-container").style.display = "none";
    preview.src = "";
    preview.style.display = "none";
  }
});
