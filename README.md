# Laravel Notifications and Broadcasting Example

## Running Servers

Type following commands:

- php artisan serve
- php artisan websockets:serve
- npm run dev



### **Learning Notifications and Broadcasting in Laravel**

- Polling (n requests/sec from client to server over http) is a slow process. Because http contains lots of messages / headers etc.
- WebSockets (WS) is the solution, bcz its Persistent connection (established once only) nature. 
- PubSub Pattern for WS => Only server sends data to clients, e.g., financial apps updates, video streaming, cctv.
- RPC => similar to http req/response, but persistent. Used in messaging apps, ...
- We decide, whether we want an Event of the Laravel should be broadcasted or not? If yes, we handle this event to WS server/class.
- For efficiency, Laravel sends broadcasting messages to Queue. If we don't have a Queue, then Queue_Drive = sync => send messages directly to WS without using a Queue
- There are three channels for laravel broadcasting i.e., Public, Private and Presence
- Each client should subscribe to a channel to send/receive a message to/from particular channel.
- Public => no authentication
- Private => Auth , but users don't know each other
- Presence => Auth, users know each other
- By default, a laravel user can't join a Private channel without being Logged in. Laravel checks this with default Authentication guard (web) defined in config\auth.php
- The difference between Presence channel and Private channel is that Presence channel know all the users who are currently in the channel.
- whisper() allows users to communicate directly (web socket server) with other users while bypassing the Laravel web server
- Video Tutorial: Laravel and Websockets for Real Time Application All you need to know

### Changes in Files for Public/Private Channel Communication
- Events\ChatMessageEvent.php
- resources\js\app.js
- routes\channels.php
- routes\web.php  (/chat-message)


### Changes in Files for Private to Presence Channel Communication
- Events\ChatMessageEvent.php
- routes\channels.php  (return $user instead of true)
- resources\js\app.js



## Prepared For

*DatumSquare R&D*
