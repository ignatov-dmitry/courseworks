/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    disableStats: true,
});
window.Echo.channel('public-chat')
    .listen('NewMessage', (e) => {
        addMessage(e);
    });
window.Echo.private('chat.' + window.userId)
    .listen('NewChatMessage', (e) => {
        addMessage(e);
    });

function addMessage(item)
{
    let chat = document.querySelector('[data-chat-id="' + item.roomId + '"] p');
    chat.innerText = item.message;


    if (window.threadId === item.roomId) {
        let messagesBlock = document.getElementById('messages');
        const messageBubble = document.createElement('div');
        messageBubble.classList.add('message-bubble');
        messageBubble.id = 'message_' + item.id;

        const messageInner = document.createElement('div');
        messageInner.classList.add('message-bubble-inner');

        // const messageAvatar = document.createElement('div');
        // messageAvatar.classList.add('message-avatar');
        // const avatarImage = document.createElement('img');
        // avatarImage.src = 'images/user-avatar-small-02.jpg';
        // avatarImage.alt = '';
        // messageAvatar.appendChild(avatarImage);

        const messageText = document.createElement('div');
        messageText.classList.add('message-text');
        const textParagraph = document.createElement('p');
        textParagraph.textContent = item.message;
        messageText.appendChild(textParagraph);

        //messageInner.appendChild(messageAvatar);
        messageInner.appendChild(messageText);

        messageBubble.appendChild(messageInner);


        const clearfixDiv = document.createElement('div');
        clearfixDiv.classList.add('clearfix');
        messageBubble.appendChild(clearfixDiv);

        messagesBlock.appendChild(messageBubble);
    }
}
