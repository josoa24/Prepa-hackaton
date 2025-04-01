const base_url = document.body.getAttribute("data-base");

function sendParticipation(id1, id2) {
  location.href = `${base_url}participate/?id_publication=${id1}&id_user=${id2}`;
}

function sendParticipationDonner(id1, id2, type) {
  document.getElementById("loader").style.display = "block";
  let data = {};
  let method = "GET";
  let typeSend = "";

  if (type === "don") {
    const montant = parseFloat(prompt("Veuillez entrer le montant:"));
    if (isNaN(montant) || montant <= 0) {
      alert("Montant invalide.");
      document.getElementById("loader").style.display = "none";
      return;
    }
    data.montant = montant;
    method = "POST";
    typeSend = "don";
  } else if (type === "evenement") {
    typeSend = "evenement";
  }

  let urlData = new URLSearchParams();
  urlData.append("id_publication", id1);
  urlData.append("id_user", id2);
  urlData.append("type", typeSend);
  for (const key in data) {
    urlData.append(key, data[key]);
  }

  fetch(`${base_url}participateEmail?${urlData.toString()}`)
    .then((e) => e.json())
    .then((e) => {
      if (e.status === "success") {
        document.querySelector(".pop-up-email").style.display = "flex";
        document.getElementById("loader").style.display = "none";
      }
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
