
var testNotifier = {};

(function () {

    testNotifier.WSConnection = null;

    $(document).ready(function () {
        initializeWS();
        initializeEvents();
    });

    function initializeWS() {
        testNotifier.WSConnection = new WebSocket('ws://localhost:3013');
        testNotifier.WSConnection.onopen = function (e) {
            console.log("Connection established!");
            console.log(e);
        };

        testNotifier.WSConnection.onmessage = function (e) {
            console.log(e.data);

            displayMessage(e.data);
        };
    }

    function initializeEvents() {
        $('#action-send-message').click(sendMessage);
    }

    function sendMessage() {

        var message = $('#input-message').val();
        testNotifier.WSConnection.send(message);

    }

    function displayMessage(message) {
        $('#message-received-container').append(message);
        $('#message-received-container').append("<br>");
    }

})();
