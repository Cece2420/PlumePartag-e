document.addEventListener("DOMContentLoaded", function () {

    const typeOeuvre = document.getElementById("type_oeuvre");
    const aideType = document.getElementById("aideType");

    if (typeOeuvre && aideType) {
        typeOeuvre.addEventListener("change", function () {
            if (typeOeuvre.value === "Manga") {
                aideType.textContent = "Un manga est une bande dessinée japonaise.";
            } else if (typeOeuvre.value === "Manhwa") {
                aideType.textContent = "Un manhwa est une bande dessinée coréenne.";
            } else if (typeOeuvre.value === "Manhua") {
                aideType.textContent = "Un manhua est une bande dessinée chinoise.";
            } else if (typeOeuvre.value === "Webtoon") {
                aideType.textContent = "Un webtoon est un format vertical pensé pour téléphone.";
            } else if (typeOeuvre.value === "Roman") {
                aideType.textContent = "Un roman est un récit principalement composé de texte.";
            } else {
                aideType.textContent = "";
            }
        });
    }

    const boutonsCommentaires = document.querySelectorAll(".btn-commentaires");

    boutonsCommentaires.forEach(function (bouton) {
        bouton.addEventListener("click", function () {
            const id = bouton.getAttribute("data-id");
            const zone = document.getElementById("commentaires-" + id);

            if (zone.style.display === "none") {
                zone.style.display = "block";
                bouton.textContent = "Masquer les commentaires";
            } else {
                zone.style.display = "none";
                bouton.textContent = "Afficher les commentaires";
            }
        });
    });

    const formQuestion = document.getElementById("formQuestion");

    if (formQuestion) {
        formQuestion.addEventListener("submit", function (event) {
            const titre = document.getElementById("titre");
            const contenu = document.getElementById("contenu");
            const genre = document.getElementById("genre");
            const message = formQuestion.querySelector(".message-js");

            if (titre.value.trim() === "" || contenu.value.trim() === "" || typeOeuvre.value === "" || genre.value === "") {
                event.preventDefault();
                message.textContent = "Veuillez remplir tous les champs.";
                message.style.color = "red";
            }
        });
    }
});