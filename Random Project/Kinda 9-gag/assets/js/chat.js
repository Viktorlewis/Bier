function showMessage(messageHTML) {
    $('#chat-box').append(messageHTML);
}

$(document).ready(function(){
    var websocket = new WebSocket("ws://192.168.10.121:8080/");
    websocket.onopen = function(event) {
        showMessage("<div class='chat-connection-ack'>Connection is established! :o</div>");
    };
    websocket.onmessage = function(event) {
        var Data = JSON.parse(event.data);
        showMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
        $('#chat-message').val('');
    };

    websocket.onerror = function(event){
        showMessage("<div class='error'>An error occured. Chat is not available :(</div>");
    };
    websocket.onclose = function(event){
        showMessage("<div class='chat-connection-ack'>Connection closed</div>");
    };

    $('#frmChat').on("submit",function(event){
        event.preventDefault();
        var message = $('#chat-message').val().toString();
        var messageJSON = {
            chat_message: message
        };
        websocket.send(JSON.stringify(messageJSON));
    });
});