import './bootstrap';

import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import axios from 'axios';

window.Alpine = Alpine;

Alpine.start();

// For Presence channel //

const form = document.getElementById('form');
const inputMessage = document.getElementById('input-message');
const listMessgae = document.getElementById('list-messages');
const spanTyping = document.getElementById('span-typing');

const chatbox = document.getElementById('chat_box');



form.addEventListener('submit', function (event) {
    event.preventDefault();
    const userInput = inputMessage.value;

    axios.post('/chat-message', {
        message:userInput
    })
})


const channel = window.Echo.join('presence.chat.1'); // for Presence channel

/*inputMessage.addEventListener('input', function (event) {    
    channel.whisper('typing', {
        email: user.email
    })
});*/


channel.here((users) => { // for Presence channel
    console.log({users})
    console.log('subscribed!!')
})
    .joining( (user) => { // callback method when a user joins this channel
        console.log({user}, ' joined')
    })

    .leaving((user) => {
        console.log({user}, 'leaving')
    })

    .listen('.chat-message', (event) => {
        console.log(event);
        const message = event.message;
        const li = document.createElement('li');
        li.innerHTML = '<b>'+event.user.name + ':</b> ' + message;
        listMessgae.append(li);
        // working for new chat box of tailwind css
        const div = document.createElement('div');
        div.className = "flex justify-end mb-4"; //classList.add('MyClass');
        div.innerHTML = '<div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">'+
        message+'</div><span><b>'+event.user.name+'</b></span>';
        chatbox.appendChild(div);

    }) // . is necessary in case you are using Custom event name

    /*.listenForWhisper('typing', (event) => {
        spanTyping.textContent = event.email + ' is typing...';
    })*/

// ./ for Presence channel
