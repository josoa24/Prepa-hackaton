<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinite Scroll</title>
    <style>
        .publication {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .publication img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 10px;
        }
        .status {
            font-weight: bold;
            color: #007BFF;
        }
        .progress {
            margin-top: 10px;
        }
        .progress-bar {
            height: 20px;
            background-color: #007BFF;
            color: white;
            text-align: center;
            line-height: 20px;
        }
    </style>
</head>
<body>
    <div id="publications"></div>
    <div id="loading" style="text-align: center; display: none;">Loading...</div>

    <script>
        let offset = 0;
        const limit = 6; // Nombre de publications à charger par lot
        const container = document.getElementById('publications');
        const loading = document.getElementById('loading');

        // Fonction pour charger les publications
        async function loadPublications() {
            loading.style.display = 'block';
            try {
                const response = await fetch(`/fetchPublications?offset=${offset}&limit=${limit}`);
                const publications = await response.json();

                if (!Array.isArray(publications)) {
                    console.error('Unexpected response format:', publications);
                    loading.style.display = 'none';
                    return;
                }

                publications.forEach(publication => {
                    const div = document.createElement('div');
                    div.className = 'publication';
                    div.innerHTML = `
                        <h3>${publication.title}</h3>
                        <p>${publication.content}</p>
                        <p><strong>Description:</strong> ${publication.description || 'N/A'}</p>
                        <p><strong>Date de publication:</strong> ${publication.date_publication}</p>
                        <p><strong>Date d'événement:</strong> ${publication.date_evenement || 'N/A'}</p>
                        <p class="status"><strong>Status:</strong> ${publication.progression_status}</p>
                        <p><strong>Total des dons:</strong> ${publication.total_dons || 0} €</p>
                        <div class="progress">
                            <div class="progress-bar" style="width: ${publication.completion_percentage || 0}%;">
                                ${Math.round(publication.completion_percentage || 0)}%
                            </div>
                        </div>
                        ${publication.photos && publication.photos.length > 0 
                            ? publication.photos.map(photo => `<img src="${photo}" alt="Photo">`).join('') 
                            : ''}
                    `;
                    container.appendChild(div);
                });

                offset += limit;
                loading.style.display = 'none';

                // Si aucune publication n'est retournée, arrêter le scroll infini
                if (publications.length < limit) {
                    window.removeEventListener('scroll', handleScroll);
                }
            } catch (error) {
                console.error('Error loading publications:', error);
                loading.style.display = 'none';
            }
        }

        // Gestionnaire de scroll
        function handleScroll() {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
                loadPublications();
            }
        }

        // Charger les premières publications et ajouter l'écouteur de scroll
        loadPublications();
        window.addEventListener('scroll', handleScroll);
    </script>
</body>
</html>