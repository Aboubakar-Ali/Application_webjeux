// Connection à la WebSocket
var socket = new WebSocket('ws://localhost:8080');

// Evenement se déclenchant à l'ouverture de la connexion
socket.onopen = function(event) {
    console.log('Connection to server opened');
};

// Evenement se déclenchant à la réception d'un message
socket.onmessage = function(event) {
    console.log('Received message from server: ' + event.data);

    // Récupère le message et le nom d'utilisateur
    var data = JSON.parse(event.data);
    var username = data.username;
    var message = data.message;

    // Ajoute le nom d'utilisateur et le message à la zone de chat
    var chat = document.getElementById('chat-messages');
    chat.innerHTML += '<div><strong>' + username + ':</strong> ' + message + '</div>';
};


// Evenement se déclenchant à la fermeture de la connexion
socket.onclose = function(event) {
    console.log('Connection to server closed');
};

// Evenement se déclenchant lorsqu'une erreur survient
socket.onerror = function(event) {
    console.error('WebSocket error observed:', event);
};


// Fonction pour envoyer un message
function send() {
    // Récupère le message entré par l'utilisateur
    var message = document.getElementById('chat-input').value;

    console.log('Sending message: ' + message);

    // Envoie le nom d'utilisateur et le message
    socket.send(JSON.stringify({username: username, message: message}));

    // Clear the input field for new messages
    document.getElementById('chat-input').value = '';
}



document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('chat-form').addEventListener('submit', function(event) {
        event.preventDefault();
        console.log("Submit event detected"); // Ajouté pour le débogage
        send();
        return false;
    });
});

