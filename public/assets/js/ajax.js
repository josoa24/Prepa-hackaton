// const base_url = document.body.getAttribute("data-base");
// function sendParticipation(id_publication, id_user) {
//   const xhr = new XMLHttpRequest();
//   const url = base_url + "participate";

//   xhr.open("POST", url, true);
//   xhr.setRequestHeader("Content-Type", "application/json");

//   xhr.onreadystatechange = function () {
//     if (xhr.readyState === 4) {
//       // Requête terminée
//       if (xhr.status === 200) {
//         console.log("Réponse du serveur :", JSON.parse(xhr.responseText));
//       } else {
//         console.error("Erreur :", xhr.status, xhr.statusText);
//       }
//     }
//   };

//   const data = JSON.stringify({ id_publication, id_user });
//   xhr.send(data);
// }
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
