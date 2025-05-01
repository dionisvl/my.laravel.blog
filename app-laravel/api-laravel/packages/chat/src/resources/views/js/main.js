document.addEventListener("DOMContentLoaded", (event) => {
    const socketUrl = CHAT_SCHEME + '://' + CHAT_HOST + ':' + CHAT_PORT + '/' + CHAT_ROUTE;
    console.log('Connecting to WebSocket: ', socketUrl);
    let socket = new WebSocket(socketUrl);
    socketInit()
    const chat = document.getElementById('chat-message-list');
    const btn = document.getElementById('toggleBtn');
    const chatContainer = document.getElementById('chat-box-container');
    let isExpanded = false;
    btn.addEventListener('click', () => {
        if (!isExpanded) {
            chatContainer.style.width = '90vw';
            chatContainer.style.height = '90vh';
            chatContainer.style.zIndex = '9999';
        } else {
            chatContainer.style.width = '';
            chatContainer.style.height = '';
            chatContainer.style.zIndex = '1';
        }
        scrollBottom()
        isExpanded = !isExpanded;
    });

  function scrollBottom() {
    const last = chat.lastElementChild;
    if (last) {
      last.scrollIntoView({behavior: 'smooth', block: 'end'});
    }
  }

// This function first check color from local storage and if this color is invalid then generate new
// Todo: move this logic to server and store color in cookie or DB
    function getRandomColor() {
        const letters = '123456789';
        let color = localStorage.getItem('color'); // Get the color from local storage
        if (!color || !/^#[0-9A-F]{6}$/i.test(color)) { // Check if the color is invalid or not stored
            color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 8)];
            }
            localStorage.setItem('color', color); // Save the new color to local storage
        }
        return color;
    }

    const thisUserColor = getRandomColor();
    console.log('Current color:', thisUserColor);


// Make smooth movement of messages to the top border
    const messages = document.querySelectorAll('.chat_message');
    messages.forEach((message) => {
        message.style.animationTimingFunction = 'ease-out';
    });

    const sendButton = document.getElementById('chat_send');
    sendButton.addEventListener('click', (event) => {
        const username = document.getElementById('chat_username').value;
        const message = document.getElementById('chat_message').value;

        if (username.trim() === '' || message.trim() === '') {
            alert('Please enter a username and a message');
            return;
        }
        const data = {
            username: username,
            message: message,
            color: thisUserColor
        };

        sendMessageWithConnect(JSON.stringify(data));
    });

    function sendMessageWithConnect(message) {
        if (socket.readyState === WebSocket.OPEN) {
            sendMessage(message)
        } else {
            console.log('WebSocket is not open. Attempting to reconnect...');
            socketInit()
            socket.addEventListener('open', () => {
                sendMessage(message)
            });
        }
    }

    function socketInit() {
        if (socket.readyState !== WebSocket.OPEN) {
            socket = new WebSocket(socketUrl);
        }
        socket.onmessage = function (event) {
            const msg = JSON.parse(event.data);

            // Block of username
            const usernameSpan = document.createElement('span');

            // Block of message of this user
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('chat_message')
            usernameSpan.textContent = msg.username + ':';
            usernameSpan.classList.add('chat_username');
            messageDiv.textContent = ' ' + msg.message;
            usernameSpan.style.color = msg.color; // Set the text color to color of the username
            messageDiv.insertBefore(usernameSpan, messageDiv.firstChild);

            // block of Date of this message
            const messageDateDiv = document.createElement('div');
            messageDateDiv.classList.add('chat_message_date');
            messageDateDiv.textContent = new Date(msg.time).toLocaleString();

            messageDiv.insertAdjacentElement('beforeend', messageDateDiv);
            chat.insertAdjacentElement('beforeend', messageDiv);
            scrollBottom()
        };

        socket.addEventListener('close', (event) => {
            console.log('WebSocket closed:', event);
        });

        socket.addEventListener('error', (event) => {
            console.error('WebSocket error:', event);
        });

        socket.addEventListener('open', (event) => {
            console.log('WebSocket connected');
        });

        socket.addEventListener('chat_message', (event) => {
            console.log(`WebSocket message received: ${event.data}`);
        });

        socket.addEventListener('error', (event) => {
            console.error('WebSocket error:', event);
        });
    }

    function sendMessage(message) {
        socket.send(message);
        console.log('Message sent:');
        console.log(message);
    }

// send message by Enter
    const messageInput = document.getElementById('chat_input_container');
    messageInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent the default behavior of the Enter key
            const sendButton = document.getElementById('chat_send');
            sendButton.click(); // Simulate a click on the send button
        }
    });

    console.log("web chat js fully loaded and parsed");

    // random emoji paster
    const emojis = ["😀", "😃", "😄", "😁", "😆", "😅", "😂", "🤣", "😊", "😇"];

    function getRandomEmoji() {
        return emojis[Math.floor(Math.random() * emojis.length)];
    }

    const inputField = document.getElementById('chat_message');
    if (inputField.value === 'test message'){
        inputField.value = inputField.value + getRandomEmoji();
    }
});
