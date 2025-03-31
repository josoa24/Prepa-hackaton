const base_url = document.body.getAttribute("data-base");
function sendParticipation(id1, id2) {
  const button = document.getElementById(`btn-${id1}-${id2}`);

  if (button.textContent === "Participer") {
    button.textContent = "Annuler";
    button.style.background = "#ee7272";
    button.style.color = "white";
  } else {
    button.textContent = "Participer";
    button.style.background = "";
    button.style.color = "";
  }
  xhr.send(data);
}

document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".type-publication button");
  const forms = document.querySelectorAll(".container-form form");

  // Masquer tous les formulaires sauf le premier et styliser le premier bouton
  forms.forEach((form) => (form.style.display = "none"));
  forms[0].style.display = "block";
  buttons[0].style.background = "black";
  buttons[0].style.color = "white";

  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const formClass = this.classList[0];

      // Affichage des formulaires
      forms.forEach((form) => {
        form.style.display = form.classList.contains(formClass)
          ? "block"
          : "none";
      });

      // Mettre à jour le style des boutons
      buttons.forEach((btn) => {
        btn.style.background = "transparent";
        btn.style.color = "black";
      });
      this.style.background = "black";
      this.style.color = "white";
    });
  });
});
