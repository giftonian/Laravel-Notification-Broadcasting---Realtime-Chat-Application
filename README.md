# Laravel Notifications and Broadcasting Example

## Running Servers

Type following commands:

- php artisan serve
- php artisan websockets:serve
- npm run dev



### **Learning Notifications and Broadcasting in Laravel**

- By default, a laravel user can't join a Private channel without being Logged in. Larave checks this with default Authentication guard (web) defined in config\auth.php
- The difference between Presence channel and Private channel is that Presence channel know all the users who are currently in the channel.

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
