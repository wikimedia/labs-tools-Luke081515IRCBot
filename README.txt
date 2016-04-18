This Bot is written in PHP for IRC, and provides useful tools for users at IRC.

- How to start this bot
Copy the Password.example.php file, so that you got a file named 'Password.php', and define the logindata there. If you use a chared host, don't forget to chmod 0600 your file.

After that, you can start the bot via 'php IRCBot.php'

- Which commands are available?
* !info - shows all commands and the owner
* !urlencode <string> - urlencodes <string>
* !urldecode <string> - Surprise! The opposite happens!
* !quit - owner only - stopps the bot
* !nick <string> - owner only - changes the nick to <string> if possible

- How to add commands?
You can simple add a hook by adding your file to the directoy bot_functions

Take a look at existing files, it's pretty easy.