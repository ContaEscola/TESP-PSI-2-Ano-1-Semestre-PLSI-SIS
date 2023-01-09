const chatMessages = document.querySelector('#chat-messages');

scrollToBottom();

function scrollToBottom() {
    console.log(chatMessages);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}