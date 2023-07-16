$(document).ready(function(){

    var $chatContainer = $('#chat-container');
    var $chatInput = $('#chat-input');
    var $chatSend = $('#chat-send');

    // collect all the chats
    function collectChatHistory() {
        var chatHistory = [];
        $('.chat').each(function(){
            var thisChat = $(this).text().trim();
            var role = $(this).hasClass('chat-bot') ? 'system' : 'user';
            chatHistory.push({ role: role, content: thisChat });
        });
        return chatHistory;
    }

    // send new chat to bot
    function generateChat() {
        var chatData = $chatInput.val();
        $chatContainer.append('<div class="chat-user-wrap"><div class="chat-user chat">'+chatData+'</div></div>');
        $chatInput.val('');
        $('#chat-bot-status').show();

        $.ajax({
            type: "POST",
            url: "/prompt",
            data: { prompt: chatData, chat_history: JSON.stringify(collectChatHistory()) },
            dataType: "json",
            success: [ function(data) {
                $chatContainer.append('<div class="chat-bot-wrap"><div class="chat-bot chat">'+data.response+'</div></div>');
                $('#chat-bot-status').hide();
            } ]
        });
    }

    // process send request
    function sendChat() {
        if (!$chatSend.prop('disabled')) {
            generateChat();
        }
    }

    // toggle send availability
    function sendToggle() {
        var isDisabled = $chatInput.val().length <= 1;
        $chatSend.toggleClass('disabled', isDisabled).prop('disabled', isDisabled);
    }


    $chatSend.on('click', sendChat);
    $chatInput.on('keypress', function(e) { if (e.which==13) { sendChat(); } });
    $chatInput.on('keyup', sendToggle);

});