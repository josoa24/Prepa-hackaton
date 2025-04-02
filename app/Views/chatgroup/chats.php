<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>iColab - Mes Groupes</title>

  <link rel="icon" type="image/png" href="<?= base_url('assets/icons/favicon-96x96.png') ?>" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="<?= base_url('assets/icons/favicon.svg') ?>" />
  <link rel="shortcut icon" href="<?= base_url('assets/icons/favicon.ico') ?>" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/icons/apple-touch-icon.png') ?>" />
  <link rel="manifest" href="<?= base_url('assets/icons/site.webmanifest') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/liste_chat.css') ?>" />
</head>

<body>
  <!-- Simple navbar -->
  <header class="head-acceuil">
    <nav class="left-nav">
      <img src="<?= base_url('assets/images/LOGO-ICOLAB.png') ?>" alt="" class="logo-i-colab">
      <div class="search-container">
        <input type="text" placeholder="Rechercher" id="search-input">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF">
          <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
        </svg>
      </div>
    </nav>
    <aside class="user-tools">
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
              <path d="M160-120q-33 0-56.5-23.5T80-200v-480h80v480h600v80H160Zm160-160q-33 0-56.5-23.5T240-360v-480h680v480q0 33-23.5 56.5T840-280H320Zm0-80h520v-400H320v400Zm80-120h160v-200H400v200Zm200 0h160v-80H600v80Zm0-120h160v-80H600v80ZM320-360v-400 400Z" />
            </svg>
            <a href="<?= base_url('/user/publication') ?>">Mes publications</a>
          </button>
          <button onclick="location.href='<?= base_url('logout') ?>'">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
              <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
            </svg>
            Deconnexion
          </button>
        </div>
      </div>
    </aside>
  </header>

  <div class="container">

    <!-- Simple search box -->
    <div class="search-box">
      <input type="text" placeholder="Rechercher..." id="searchInput" />
    </div>

    <!-- Chat list -->
    <div class="chat-list">
      <?php foreach ($groups as $group): ?>
        <a href="<?= base_url('chats/' . $group['id']) ?>" class="chat-item-nav" data-name="<?= strtolower($group['publication']['title']) ?>">
          <div class="chat-item">
            <div class="avatar avatar-blue"><?= strtoupper($group['publication']['title'][0]) ?></div>
            <div class="chat-info">
              <div class="chat-header">
                <h3 class="chat-name"><?= $group['publication']['title'] ?></h3>
              </div>
              <p class="chat-preview">...</p>
            </div>
          </div>
        </a>
      <?php endforeach; ?>

    </div>
  </div>

  <script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
      const searchValue = this.value.toLowerCase();
      const chatItems = document.querySelectorAll('[data-name]');

      chatItems.forEach(chat => {
        const name = chat.getAttribute('data-name').toLowerCase();
        if (searchValue === '' || name.includes(searchValue)) {
          chat.style.display = 'block';
        } else {
          chat.style.display = 'none';
        }
      });
    });
  </script>

  <script src="<?= base_url('assets/js/home.js') ?>"></script>
</body>

</html>