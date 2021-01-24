const chat = {
    // (A) HELPER FUNCTION - SWAP BETWEEN SET NAME/SEND MESSAGE
    swapForm: function (direction) {
        // (A1) SHOW SEND MESSAGE FORM
        if (direction) {
            document.getElementById("chat-name").style.display = "none";
            document.getElementById("chat-send").style.display = "grid";
        }

        // (A2) SHOW SET NAME FORM
        else {
            document.getElementById("chat-send").style.display = "none";
            document.getElementById("chat-name").style.display = "grid";
            document.getElementById("chat-name-go").disabled = false;
        }
    },

    // (B) START CHAT
    host: "ws://" + CHAT_HOST + ":" + CHAT_PORT + "/", // Change to your own!
    userName: "", // Current user name
    socket: null, // Websocket object
    htmlText: null, // HTML send text field
    userColor: CHAT_USER_COLOR, //chat user own text color

    start: function () {
        // (B1) CREATE WEB SOCKET
        document.getElementById("chat-name-go").disabled = true;
        if (chat.htmlText == null) {
            chat.htmlText = document.getElementById("chat-send-text");
        }
        chat.socket = new WebSocket(chat.host);

        // (B2) READY - CONNECTED TO SERVER
        chat.socket.onopen = function () {
            chat.userName = document.getElementById("chat-name-set").value;
            chat.swapForm(1);

            chat.addRow(`<div class="ch-msg">Hi, ${chat.userName}! And welcome to my "ratchet Chat box"!</div>`)
            chat.addRow(`<div class="ch-msg">${CHAT_HOST}:${CHAT_PORT} connected</div>`)
        };

        // (B3) ON CONNECTION CLOSE
        chat.socket.onclose = function () {
            chat.swapForm(0);
        };

        // (B4) ON RECEIVING DATA FROM SERVER - UPDATE CHAT MESSAGES
        chat.socket.onmessage = function (e) {
            let msg = JSON.parse(e.data)
            chat.addRow(`<div class="ch-name" style="background: ${msg.userColor}">
<div class="ch-dt">${msg.datetime}</div>${msg.n}</div>
<div class="ch-msg">${msg.m}</div>`);
        };

        // (B5) ON ERROR
        chat.socket.onerror = function (e) {
            chat.swapForm(0);
            console.log(e);
            alert(`Failed to connect to ${chat.host}`);
        };

        return false;
    },

    // (C) SEND MESSAGE
    send: function () {
        let message = JSON.stringify({
            n: chat.userName,
            m: chat.htmlText.value,
            userColor: chat.userColor,
        });
        chat.htmlText.value = "";
        chat.socket.send(message);
        return false;
    },

    // HELPER FUNCTION - Add row to chat box
    addRow: function (text) {
        let row = document.createElement("div");
        row.innerHTML = text;
        row.className = "ch-row";
        document.getElementById("chat-messages").appendChild(row);
    },
};
