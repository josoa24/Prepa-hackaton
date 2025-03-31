const base_url = document.body.getAttribute("data-base");

function sendParticipation(id1, id2) {
  const button = document.getElementById(`btn-${id1}-${id2}`);

  const action = button.textContent.trim() === "Participer" ? "join" : "leave";
  fetch(
    `${base_url}participate?id_publication=${id1}&id_user=${id2}&action=${action}`
  )
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        if (action === "join") {
          button.textContent = "Annuler";
          button.style.background = "#ee7272";
          button.style.color = "white";
        } else {
          button.textContent = "Participer";
          button.style.background = "";
          button.style.color = "";
        }
      } else {
        alert("Une erreur est survenue !");
      }
    })
    .catch((error) => {
      console.error("Erreur :", error);
      alert("Erreur de connexion au serveur !");
    });
}

document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".type-publication button");
  const forms = document.querySelectorAll(".container-form form");
  forms.forEach((form) => (form.style.display = "none"));
  forms[0].style.display = "block";
  buttons[0].style.background = "black";
  buttons[0].style.color = "white";

  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const formClass = this.classList[0];

      forms.forEach((form) => {
        form.style.display = form.classList.contains(formClass)
          ? "block"
          : "none";
      });

      buttons.forEach((btn) => {
        btn.style.background = "transparent";
        btn.style.color = "black";
      });
      this.style.background = "black";
      this.style.color = "white";
    });
  });
});
