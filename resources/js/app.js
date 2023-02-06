import './bootstrap';

import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import axios from 'axios';

window.Alpine = Alpine;

Alpine.start();

// For Presence channel //

const form = document.getElementById('form');
const inputMessage = document.getElementById('input-message');
//const listMessgae = document.getElementById('list-messages');
//const spanTyping = document.getElementById('span-typing');

const chatbox = document.getElementById('chat_box');





form.addEventListener('submit', function (event) {
    event.preventDefault();
    const userInput = inputMessage.value;
    const sid = window.Echo.socketId();
    //alert(sid)
    axios.post('/chat-message', { // axios is a promised-based HTTP client
        message:userInput,
        sid:sid
    })
    inputMessage.value = "";
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
    //console.log("CURRENT User is  " + currentUser.email);
})
    .joining( (user) => { // callback method when a user joins this channel
        console.log({user}, ' joined')
        //alert("Welcome " + user.name)
    })

    .leaving((user) => {
        console.log({user}, 'leaving')
    })

    .listen('.chat-message', (event) => {
        // console.log("I am "+currentUser.email);
        // console.log("sender is "+event.user.email);
        console.log(event);
        const message = event.message;
        const li = document.createElement('li');
        li.innerHTML = '<b>'+event.user.name + ':</b> ' + message;
        //listMessgae.append(li);
        // working for new chat box of tailwind css
        const div = document.createElement('div');
        const currentUserEmail = currentUser.email;
        const senderEmail = event.user.email;

        let msg_div_orient = "start";
        let msg_div_color  = "blue";
        let msg_div_user   = event.user.name;
        const compareValue = currentUserEmail.localeCompare(senderEmail); // must be 0, in case same user
        if (compareValue === 0) { // same user
            msg_div_orient = "end"; 
            msg_div_color  = "gray";
            msg_div_user   = "Me";       
        } 

        div.className = "flex justify-"+msg_div_orient+" mb-4";
        div.innerHTML = '<div class="ml-2 py-3 px-4 bg-'+msg_div_color+'-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">'+
        message+'</div><span><b>&nbsp;&nbsp;'+msg_div_user+'</b></span>';
        
        chatbox.appendChild(div);

    }) // . is necessary in case you are using Custom event name

    /*.listenForWhisper('typing', (event) => {
        spanTyping.textContent = event.email + ' is typing...';
    })*/

// ./ for Presence channel
