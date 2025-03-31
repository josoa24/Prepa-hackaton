<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/icons/favicon-96x96.png') ?>" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="<?= base_url('assets/icons/favicon.svg') ?>" />
    <link rel="shortcut icon" href="<?= base_url('assets/icons/favicon.ico') ?>" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/icons/apple-touch-icon.png') ?>" />
    <link rel="manifest" href="<?= base_url('assets/icons/site.webmanifest') ?>" />
    <script src="<?= base_url('assets/js/home.js') ?>" defer></script>
    <script src="<?= base_url('assets/js/ajax.js') ?>" defer></script>
    <title>Toutes collaborations</title>

    <style>
        .loading-spinner {
            width: 3.25em;
            transform-origin: center;
            animation: rotate4 2s linear infinite;
        }

        .loading-spinner circle {
            fill: none;
            stroke: hsl(214, 97%, 59%);
            stroke-width: 2;
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
            stroke-linecap: round;
            animation: dash4 1.5s ease-in-out infinite;
        }

        @keyframes rotate4 {
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes dash4 {
            0% {
                stroke-dasharray: 1, 200;
                stroke-dashoffset: 0;
            }

            50% {
                stroke-dasharray: 90, 200;
                stroke-dashoffset: -35px;
            }

            100% {
                stroke-dashoffset: -125px;
            }
        }
    </style>
</head>

<body data-base="<?= base_url() ?>">
    <div class="pop-up-container" style="display: none;">
        <div class="container-form">
            <h2>Collaborer avec tout le monde
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                </svg>
            </h2>
            <div class="type-publication">
                <button class="contribution">
                    Contribution
                </button>
                <button class="evenement">
                    Evenement
                </button>
                <button class="donation">
                    Donation
                </button>
            </div>
            <form class="contribution" action="/storePublication" method="post" enctype="multipart/form-data">
                <input type="hidden" name="typepub" value="3">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre" placeholder="Entrez le titre" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Entrez la description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie</label>
                    <select id="categorie" name="categorie" required>
                        <option value="" disabled selected>Choisissez une catégorie</option>
                        <option value="sport">Sport</option>
                        <option value="musique">Musique</option>
                        <option value="art">Art</option>
                        <option value="technologie">Technologie</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required>
                </div>
                <div class="preview-container" id="preview-container" style="display: none;">
                    <img id="imagePreview" src="" alt="Aperçu de l'image" style="display: none;">
                </div>
                <button type="submit">Soumettre</button>
            </form>
            <form class="evenement" action="/storePublication" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre" placeholder="Entrez le titre" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Entrez la description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie</label>
                    <select id="categorie" name="categorie" required>
                        <option value="" disabled selected>Choisissez une catégorie</option>
                        <option value="sport">Sport</option>
                        <option value="musique">Musique</option>
                        <option value="art">Art</option>
                        <option value="technologie">Technologie</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required>
                </div>
                <div class="preview-container" id="preview-container" style="display: none;">
                    <img id="imagePreview" src="" alt="Aperçu de l'image" style="display: none;">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <button type="submit">Soumettre</button>
            </form>
            <form class="donation" action="/storePublication" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre" placeholder="Entrez le titre" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Entrez la description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie</label>
                    <select id="categorie" name="categorie" required>
                        <option value="" disabled selected>Choisissez une catégorie</option>
                        <option value="sport">Sport</option>
                        <option value="musique">Musique</option>
                        <option value="art">Art</option>
                        <option value="technologie">Technologie</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required>
                </div>
                <div class="preview-container" id="preview-container" style="display: none;">
                    <img id="imagePreview" src="" alt="Aperçu de l'image" style="display: none;">
                </div>
                <div class="form-group">
                    <label for="date">Montant</label>
                    <input type="number" id="date" name="date" required>
                </div>
                <button type="submit">Soumettre</button>
            </form>
        </div>

    </div>


    <div class="pop-up-container-filter" style="display: none;">
        <div class="categorie-container">
            <h2>Filtrer par catégorie
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                </svg>
            </h2>
            <div class="categorie-btn">
                <button data-category="all">Toute catégorie</button>
                <button data-category="sport">Sport</button>
                <button data-category="musique">Musique</button>
                <button data-category="art">Art</button>
                <button data-category="technologie">Technologie</button>
                <button data-category="autre">Autre</button>
            </div>
        </div>
    </div>
    <header class="head-acceuil">
        <nav class="left-nav">
            <img src="<?= base_url('assets/images/LOGO-ICOLAB.png') ?>" alt="" class="logo-i-colab">
            <div class="search-container">
                <input type="text" placeholder="Rechercher">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                    <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                </svg>
            </div>
        </nav>
        <aside class="user-tools">
            <button class="publish">Publier</button>
            <button class="notif">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                    <path d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160Zm320-300Zm0 420q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM320-280h320v-280q0-66-47-113t-113-47q-66 0-113 47t-47 113v280Z" />
                </svg>
            </button>
            <button class="message">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                    <path d="M240-400h320v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80ZM80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Zm126-240h594v-480H160v525l46-45Zm-46 0v-480 480Z" />
                </svg>
            </button>
            <div class="button-user">
                <img src="<?= base_url('assets/images/' . $user['profile_picture']) ?>" alt="" class="profile">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                    <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                </svg>
                <div class="tools-container" style="display: none;">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                            <path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z" />
                        </svg>
                        <a href="<?= base_url('settings') ?>">Parametre</a>
                    </button>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                            <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                        </svg>
                        Deconnexion
                    </button>
                </div>
            </div>
        </aside>
    </header>
    <nav class="filtre-container">

        <p><?= $totalPublications ?> Publications</p>
        <button class="filtre">
            <svg class="svgc" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                <path d="M440-120v-240h80v80h320v80H520v80h-80Zm-320-80v-80h240v80H120Zm160-160v-80H120v-80h160v-80h80v240h-80Zm160-80v-80h400v80H440Zm160-160v-240h80v80h160v80H680v80h-80Zm-480-80v-80h400v80H120Z" />
            </svg>
            Filtres
        </button>
    </nav>

    <section class="pub" id="publications"></section>
    <div id="loading" style="text-align: center; display: none;">
        <svg class="loading-spinner" viewBox="25 25 50 50">
            <circle r="20" cy="50" cx="50"></circle>
        </svg>
    </div>

    <script>
        let offset = 0;
        const limit = 12; // Number of publications to load per batch
        const container = document.getElementById('publications');
        const loading = document.getElementById('loading');
        let isLoading = false; // Flag to prevent multiple fetch requests

        async function loadPublications() {
            if (isLoading) return;
            isLoading = true;
            loading.style.display = 'block';
            try {
                await new Promise(resolve => setTimeout(resolve, 2000)); // Add 2-second delay
                const response = await fetch(`<?= base_url('fetchPublications') ?>?offset=${offset}&limit=${limit}`);
                const publications = await response.json();

                if (!Array.isArray(publications)) {
                    console.error('Unexpected response format:', publications);
                    loading.style.display = 'none';
                    isLoading = false;
                    return;
                }

                publications.forEach(publication => {
                    const div = document.createElement('div');
                    div.className = 'pub-container';
                    if (publication.forme == 2) {
                        div.innerHTML = `
            <div class="top-image">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                    <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z" />
                </svg>
                ${publication.photos && publication.photos.length > 0 
                    ? `<img src="<?= base_url('uploaded/?file=') ?>${encodeURI(publication.photos[0])}" alt="Photo" class="publication">` 
                    : `<img src="<?= base_url('assets/images/land.jpg') ?>" alt="Default Image" class="publication">`}
            </div>
            <div class="bottom-pub">
                <div class="head-section">
                    <nav class="left-user">
                        <img class="publisher" src="<?= base_url() ?>${publication.photo_link}" alt="">
                        <h2>${publication.user.first_name} ${publication.user.last_name}</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                            <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0-83-31.5-156T763-197q-54-54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                        </svg>
                    </nav>
                    <aside class="date-container">
                        ${publication.date_publication}
                    </aside>
                </div>
                <div class="content-publication">
                    <p>${publication.title}</p>
                    <div class="btn">
                        <button id="btn-1-1" onclick="sendParticipation(1,1)">
                            Donner
                        </button>
                        <div class="right">
                            <p>Objectif</p>
                            <progress value="${publication.completion_percentage || 0}" max="100"></progress>
                            <p>${Math.round(publication.completion_percentage || 0)}%</p>
                        </div>
                    </div>
                </div>
            </div>
                    `;
                    }else if (publication.forme == 1) { 
                        div.innerHTML = `
            <div class="top-image">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                    <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z" />
                </svg>
                ${publication.photos && publication.photos.length > 0 
                    ? `<img src="<?= base_url('uploaded/?file=') ?>${encodeURI(publication.photos[0])}" alt="Photo" class="publication">` 
                    : `<img src="<?= base_url('assets/images/land.jpg') ?>" alt="Default Image" class="publication">`}
            </div>
            <div class="bottom-pub">
                <div class="head-section">
                    <nav class="left-user">
                        <img class="publisher" src="<?= base_url() ?>${publication.photo_link}" alt="">
                        <h2>${publication.user.first_name} ${publication.user.last_name}</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                            <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0-83-31.5-156T763-197q-54-54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                        </svg>
                    </nav>
                    <aside class="date-container">
                        ${publication.date_publication}
                    </aside>
                </div>
                <div class="content-publication">
                    <p>${publication.title}</p>
                    <div class="btn">
                        <button id="btn-1-1" onclick="sendParticipation(1,1)">
                            Participer
                        </button>
                        <div class="right">
                            <p>Le: ${publication.date_evenement}</p>
                        </div>
                    </div>
                </div>
            </div>
                    `;}else if (publication.forme == 3) { 
                        div.innerHTML = `
            <div class="top-image">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                    <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z" />
                </svg>
                ${publication.photos && publication.photos.length > 0 
                    ? `<img src="<?= base_url('uploaded/?file=') ?>${encodeURI(publication.photos[0])}" alt="Photo" class="publication">` 
                    : `<img src="<?= base_url('assets/images/land.jpg') ?>" alt="Default Image" class="publication">`}
            </div>
            <div class="bottom-pub">
                <div class="head-section">
                    <nav class="left-user">
                        <img class="publisher" src="<?= base_url() ?>${publication.photo_link}" alt="">
                        <h2>${publication.user.first_name} ${publication.user.last_name}</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
                            <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0-83-31.5-156T763-197q-54-54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                        </svg>
                    </nav>
                    <aside class="date-container">
                        ${publication.date_publication}
                    </aside>
                </div>
                <div class="content-publication">
                    <p>${publication.title}</p>
                    <div class="btn">
                        <button id="btn-1-1" onclick="sendParticipation(1,1)">
                            Collaborer
                        </button>
                    </div>
                </div>
            </div>
                    `;
                    }

                    container.appendChild(div);
                });

                offset += limit;
                loading.style.display = 'none';

                if (publications.length < limit) {
                    window.removeEventListener('scroll', handleScroll);
                }
            } catch (error) {
                console.error('Error loading publications:', error);
                loading.style.display = 'none';
            } finally {
                isLoading = false;
            }
        }

        function handleScroll() {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
                loadPublications();
            }
        }

        loadPublications();
        window.addEventListener('scroll', handleScroll);
    </script>
</body>

</html>