import './bootstrap';

import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import axios from 'axios';

window.Alpine = Alpine;

Alpine.start();


// For Private channel //

const form = document.getElementById('form');
const inputMessage = document.getElementById('input-message');
const listMessgae = document.getElementById('list-messages');



form.addEventListener('submit', function (event) {
    event.preventDefault();
    const userInput = inputMessage.value;

    axios.post('/chat-message', {
        message:userInput
    })
})


const channel = window.Echo.private('private.chat.1');
// above line commented to test Private channel working

channel.subscribed(() => {
    console.log('subscribed!!')
}).listen('.chat-message', (event) => {
    console.log(event);
    const message = event.message;
    const li = document.createElement('li');
    li.textContent = event.user.name + ': ' + message;
    listMessgae.append(li);
}) // . is necessary in case you are using Custom event name

// ./ for Private channel

