<div id="chat-container">

    <div class="chat-user-wrap">
        <div class="chat-user">
            <h2><i class="fa-sharp fa-solid fa-microchip-ai"></i> <?=WEBSITE_TITLE?></h2>
            The following prompt is the conversation driver for this bot. The bot should adhere to the following conditions:<br>
            <br>
            <i><?=$initialPrompt?></i>
        </div>
    </div>

    <div class="chat-bot-wrap">
        <div class="chat-bot chat">
            <?=initialPrompt();?>
        </div>
    </div>

</div>

<div id="chat-form-container">

    <div id="chat-form">
        <span id="chat-bot-status">AI is typing...</span>
        <input type="text" id="chat-input" placeholder="Type your message here...">
        <button id="chat-send" class="disabled" disabled="disabled"><i class="fa fa-paper-plane"></i></button>
    </div>

</div>

<script src="<?=URL?>/assets/js/prompt.js" defer="defer"></script>