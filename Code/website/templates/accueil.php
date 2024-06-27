<div class="mb-5">
    <div class="background-section mb-3">
        <div class="h1 text-center mt-2" style="font-weight: bold;">Blabla 2i</div>
        <br>
        <div class="subtitle text-center mt-2">Oubliez tous vos soucis, il y a Blabla 2i <br> La première plateforme de covoiturage entre le site de Centrale Lille et le site de l'IG2I à Lens</div>
        <br>
        <div class="h4 text-center" style="font-weight: bold;">
            Trouver le covoiturage parfait n'a jamais été aussi <span id="typing-animation" style="color: #EA8A2C; font-weight: bold;"></span>
        </div>
        <br>

        <div class="mt-4 btn-group position-relative top-100 start-50 translate-middle" role="group" aria-label="radio sens button group">
            <div class="dropdown ms-2 premier_plan" style="display: inline-block; vertical-align: middle;">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownTypeTrajet" style="height: 100%; padding: 10px;">
                    Type de trajet
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownTypeTrajet">
                    <li><a class="dropdown-item" href="#" onclick="updateTypeTrajet('passager')">Passager</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateTypeTrajet('vehicule')">Réserver un véhicule</a></li>
                </ul>
            </div>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="on" checked>
            <label class="btn btn-outline-warning ms-2" for="btnradio1">Villeneuve d'Ascq --> Lens</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-warning" for="btnradio2">Lens --> Villeneuve d'Ascq</label>

            <div class="dropdown ms-2 premier_plan" style="display: inline-block; vertical-align: middle;">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownNombrePersonnes" style="height: 100%; padding: 10px;">
                    Nombre de personnes
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownNombrePersonnes">
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this)">1 personne</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this)">2 personnes</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this)">3 personnes</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this)">4 personnes</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this)">5 personnes</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this)">6 personnes</a></li>
                </ul>
            </div>
            <input type="date" class="form-control ms-2" style="max-width: 200px;">
        </div>
        <br>
        <button type="submit" class="btn btn-warning btn-lg mt-3 position-relative top-100 start-50 translate-middle">Rechercher</button>

        <div class="mt-4 container">
            <div class="ms-4 h4" style="font-weight: bold;">Economisez du temps, de l’argent...</div>
            <br>
            <div class="ms-4 subtitle">... Et faites plaisir à la planète ! On estime à 12 % l'économie d'émission de gaz à effet de serre à l'échelle d'une voiture en covoiturage</div>
            <button type="button" class="ms-4 mt-4 btn btn btn-dark" onclick="window.location.href='index.php?view=trajet'">Créer mon trajet</button>
        </div>
    </div>

    <hr>
    <div class="h4 text-center" style="font-weight: bold;">Ils parlent de nous</div>
    <br>

    <div class="container mt-2">
        <div class="quotes-container">
            <figure class="quote-box">
                <blockquote class="blockquote">
                    <p>Blabla2i, c'est le futur du covoiturage.</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Thomas Bourdeaud'huy, <cite title="Source Title">Professeur de renom à Centrale Lille Institut</cite>
                </figcaption>
            </figure>

            <figure class="quote-box text-end">
                <blockquote class="blockquote">
                    <p>Une véritable révolution pour la planète.</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Isabelle le Glas, <cite title="Source Title">La Goat</cite>
                </figcaption>
            </figure>
        </div>
    </div>
</div>
<script>
    // Fonction pour simuler l'effet de texte tapé sur un clavier
    function typeWriterEffect(textElement, text, speed, callback) {
        let i = 0;
        const typingInterval = setInterval(() => {
            if (i < text.length) {
                textElement.textContent += text.charAt(i);
                i++;
            } else {
                clearInterval(typingInterval);
                if (callback) {
                    callback();
                }
            }
        }, speed);
    }

    // Fonction pour effacer le texte progressivement
    function eraseText(textElement, speed, callback) {
        let i = textElement.textContent.length - 1;
        const erasingInterval = setInterval(() => {
            if (i >= 0) {
                textElement.textContent = textElement.textContent.substring(0, i);
                i--;
            } else {
                clearInterval(erasingInterval);
                if (callback) {
                    callback();
                }
            }
        }, speed);
    }

    // Appel de l'effet d'écriture initial lorsque la fenêtre est chargée
    window.onload = function () {
        const textElement = document.getElementById('typing-animation');
        const speed = 100; // Vitesse de frappe, ajustez selon votre préférence

        // Début de l'effet d'écriture initial avec "simple"
        typeWriterEffect(textElement, 'simple.', speed, () => {
            // Après l'écriture de "simple", démarrer l'effet d'effacement
            setTimeout(() => {
                eraseText(textElement, speed, () => {
                    // Après l'effacement, écrire "efficace"
                    setTimeout(() => {
                        typeWriterEffect(textElement, 'efficace.', speed, () => {
                            // Après avoir écrit "efficace", arrêter l'animation
                            setTimeout(() => {
                                eraseText(textElement, speed, () => {
                                    // Après un certain délai, revenir à "simple"
                                    setTimeout(() => {
                                        typeWriterEffect(textElement, 'simple.', speed);
                                    }, 1000); // Délai avant de revenir à "simple" (1000 ms = 1 seconde)
                                });
                            }, 1000); // Délai après avoir écrit "efficace" avant de l'effacer
                        });
                    }, 1000); // Délai avant d'écrire "efficace" après l'effacement de "simple"
                });
            }, 1000); // Délai avant de commencer l'effacement après l'écriture de "simple"
        });
    };

    function updateDropdown(element) {
        document.getElementById("dropdownNombrePersonnes").textContent = element.textContent;
    }

    function updateTypeTrajet(type) {
        document.getElementById("dropdownTypeTrajet").textContent = type === 'passager' ? 'Passager' : 'Réserver un véhicule';
    }
</script>
