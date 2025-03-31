<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liste de Chats</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/liste_chat.css') ?>" />
  <link href="https://cdn.jsdelivr.net/npm/tldraw@3.11.0/tldraw.min.css" crossorigin rel="stylesheet">
  <style>
    body {
      background: url('<?= base_url('assets/img/background.jpg') ?>') no-repeat center center/cover;
    }
  </style>
</head>

<body>
  <div class="container">
    <nav class="navbar">
      <div class="logo">iColab</div>
      <ul class="nav-links">
        <li>Evenement</li>
        <li>Message</li>
        <li>Canva</li>
      </ul>
      <div class="user-profile"></div>
    </nav>
    <div class="two_contents">
      <div class="sidebar-header">
        <h2>Mes Chats</h2>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search ..." oninput="
          const value = this.value.toLowerCase();
          for (const chat of document.querySelectorAll('[data-name]')) {
            const name = chat.getAttribute('data-name').toLowerCase();
            if (value && name.includes(value)) {
              chat.style.display = 'block';
            } else {
              chat.style.display = 'none';
            }
          }" style="width: 100%;" />
      </div>
    </div>

    <div class="chat-sidebar">
      <div class="chat-list">
        <?php foreach ($groups as $group): ?>
          <a href="<?= base_url('chats/' . $group['id']) ?>" class="chat-item-nav" data-name="<?= strtolower($group['name']) ?>" style="text-decoration: none;">
            <div class="chat-item">
              <div class="avatar"><?= strtoupper($group['name'][0]) ?></div>
              <div class="chat-info">
                <h3><?= $group['name'] ?></h3>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>

</html>