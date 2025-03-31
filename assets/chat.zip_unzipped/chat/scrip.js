function openChat(chatName) {
    document.getElementById('chat-name').textContent = chatName;
    document.getElementById('chat-messages').innerHTML = `
        <p>Bienvenue dans la conversation avec ${chatName}!</p>
        <p>Envoyez un message ci-dessous.</p>
    `;
    document.getElementById('messageInput').disabled = false;
    document.querySelector('.input-box button').disabled = false;
}

function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const messageText = messageInput.value.trim();
    
    if (messageText !== "") {
        const chatMessages = document.getElementById('chat-messages');
        const newMessage = document.createElement('p');
        newMessage.textContent = messageText;
        chatMessages.appendChild(newMessage);
        
        messageInput.value = '';  // Clear the input field

        // Scroll to the bottom of the chat messages
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
}
