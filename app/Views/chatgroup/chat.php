<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collab de <?= $group['name'] ?></title>

  <link rel="stylesheet" href="<?= base_url('assets/css/chat.css') ?>">
</head>

<body>
  <div class="canvas-container">
    <div class="canvas-header">
      <div class="header-title">Drawing Canvas</div>
      <div class="header-actions">
        <button class="tool-button">Save (CTRL + S)</button>
      </div>
    </div>

    <div class="canvas-toolbar">
      <button class="tool-button active-tool" id="brush-tool">Brush</button>
      <button class="tool-button" id="select-tool">Select</button>
      <button class="tool-button" id="rectangle-tool">Rectangle</button>
      <button class="tool-button" id="circle-tool">Ellipse</button>
      <button class="tool-button" id="text-tool">Text</button>
      <input type="color" class="color-picker" id="color-picker" value="#ff0000">
      <button class="tool-button" id="clear-canvas">Clear</button>
    </div>

    <div class="canvas-main">
      <canvas id="fabric-canvas"></canvas>
    </div>

    <div class="canvas-status">
      <span id="cursor-position">Position: 0, 0</span>
    </div>
  </div>


  <div class="chat-container" id="chat-container">
    <div class="resize-handle" id="resize-handle"></div>
    <div class="width-display" id="width-display">320px</div>

    <div class="chat-header">
      <div class="user-info">
        <img src="" alt="" style="background-color: red;" class="profile-pic">
        <div>
          <div class="user-name"><?= $group['name'] ?></div>
          <div class="user-status">Active now</div>
        </div>
      </div>
    </div>

    <div class="chat-messages" id="chat-messages">
      <?php foreach ($messages as $message): ?>
        <?php if ($message['user_id'] != $user['user_id']): ?>
          <div class="message received">
            <span class="message-sender"><?= $users[$message['user_id']]['first_name'] ?> <?= $users[$message['user_id']]['last_name'] ?></span>
            <?= $message['content'] ?>
            <div class="message-time"><?= $message['timestamp'] ?></div>
          </div>
        <?php else: ?>
          <div class="message sent">
            <span class="message-sender">You</span>
            <?= $message['content'] ?>
            <div class="message-time"><?= $message['timestamp'] ?></div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <div class="chat-input">
      <input type="text" class="message-input" placeholder="Aa" id="message">
      <button class="send-button" id="send">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="17px" viewBox="0 0 256 256" xml:space="preserve">
          <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; 
            stroke-linecap: butt; stroke-linejoin: miter; 
            stroke-miterlimit: 10; fill: none; fill-rule: nonzero; 
            opacity: 1;"
            transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
            <path d="M 89.999 3.075 C 90 3.02 90 2.967 89.999 2.912 c -0.004 -0.134 -0.017 -0.266 -0.038 -0.398 c -0.007 -0.041 -0.009 -0.081 -0.018 -0.122 c -0.034 -0.165 -0.082 -0.327 -0.144 -0.484 c -0.018 -0.046 -0.041 -0.089 -0.061 -0.134 c -0.053 -0.119 -0.113 -0.234 -0.182 -0.346 C 89.528 1.382 89.5 1.336 89.469 1.29 c -0.102 -0.147 -0.212 -0.288 -0.341 -0.417 c -0.13 -0.13 -0.273 -0.241 -0.421 -0.344 c -0.042 -0.029 -0.085 -0.056 -0.129 -0.082 c -0.118 -0.073 -0.239 -0.136 -0.364 -0.191 c -0.039 -0.017 -0.076 -0.037 -0.116 -0.053 c -0.161 -0.063 -0.327 -0.113 -0.497 -0.147 c -0.031 -0.006 -0.063 -0.008 -0.094 -0.014 c -0.142 -0.024 -0.285 -0.038 -0.429 -0.041 C 87.03 0 86.983 0 86.936 0.001 c -0.141 0.003 -0.282 0.017 -0.423 0.041 c -0.035 0.006 -0.069 0.008 -0.104 0.015 c -0.154 0.031 -0.306 0.073 -0.456 0.129 L 1.946 31.709 c -1.124 0.422 -1.888 1.473 -1.943 2.673 c -0.054 1.199 0.612 2.316 1.693 2.838 l 34.455 16.628 l 16.627 34.455 C 53.281 89.344 54.334 90 55.481 90 c 0.046 0 0.091 -0.001 0.137 -0.003 c 1.199 -0.055 2.251 -0.819 2.673 -1.943 L 89.815 4.048 c 0.056 -0.149 0.097 -0.3 0.128 -0.453 c 0.008 -0.041 0.011 -0.081 0.017 -0.122 C 89.982 3.341 89.995 3.208 89.999 3.075 z M 75.086 10.672 L 37.785 47.973 L 10.619 34.864 L 75.086 10.672 z M 55.136 79.381 L 42.027 52.216 l 37.302 -37.302 L 55.136 79.381 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #0084ff; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
          </g>
        </svg>
      </button>
    </div>
  </div>

  <script>
    const chatContainer = document.getElementById('chat-messages');
    const messageInput = document.getElementById('message');
    const sendButton = document.getElementById('send');

    // Replace with your WebSocket server URL
    const socket = new WebSocket('ws://localhost:8081');

    socket.addEventListener('open', () => {
      socket.send(JSON.stringify({
        type: 'connect',
        id: <?= $user['user_id'] ?>,
        group_id: <?= $group['id'] ?>
      }));
    });


    // Handle incoming messages
    socket.addEventListener('message', (event) => {
      const message = event.data;
      if (JSON.parse(message).type && JSON.parse(message).type == 'message_receive')
        displayMessage(JSON.parse(message), 'other');
    });

    // Send message on button click
    sendButton.addEventListener('click', () => {
      const message = messageInput.value.trim();
      if (message) {
        socket.send(JSON.stringify({
          id: <?= $user['user_id'] ?>,
          group_id: <?= $group['id'] ?>,
          message: message,
          timestamp: new Date().toLocaleDateString()
        }));

        displayMessage({
          message: message,
          id: <?= $user['user_id'] ?>,
          timestamp: new Date().toISOString()
        }, 'mine');

        messageInput.value = '';
      }
    });

    const users = <?= json_encode($users) ?>;

    // Display message in the chat container
    function displayMessage(message, type) {
      const messageElement = document.createElement('div');
      if (type == 'mine') {
        messageElement.classList.add('message', 'sent');
      } else {
        messageElement.classList.add('message', 'received');
      }

      const span = document.createElement('span');
      span.classList.add('message-sender');
      span.textContent = type == 'mine' ? 'You' : (users[message.id].first_name + ' ' + users[message.id].last_name);

      const div = document.createElement('div');
      div.classList.add('message-time');
      div.textContent = message.timestamp;

      messageElement.appendChild(span);
      messageElement.appendChild(document.createTextNode(message.message));
      messageElement.appendChild(div);

      chatContainer.appendChild(messageElement);
      chatContainer.scrollTop = chatContainer.scrollHeight;
    }
  </script>

  <script src="<?= base_url('assets/libs/fabric/fabric.min.js') ?>"></script>

  <script>
    // pre-var before anything
    let currentUserId = <?= $user['user_id'] ?>;
    let currentGroupId = <?= $group['id'] ?>;
  </script>

  <script>
    const canvasJson = <?= json_encode($canvas_json) ?>;
  </script>
  <script src="<?= base_url('assets/js/chat.js') ?>"></script>
</body>

</html>