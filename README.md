# Gympl Bot

<br/>
<br/>

### What's a Gympl bot?
- It's a Twitter bot that periodically posts the text of the legendary and great Czech movie Gympl
- https://twitter.com/GymplFilm
- https://youtu.be/PSLjsHcbcJU

<br/>

### Doesn't this bot violate the ownership right?
- No, I think it's in Fair Use. Besides, the whole movie is already on YouTube and is already 15 years old.
- However, if you have any problem with the bot, you can contact me at info@k-cermak.com

<br/>

### Can I make a similar bot?
- You can use this code however you want, I don't care.

<br/>

### Where does the app run?
- The application runs on my home Raspberry Pi 4B with PHP 8.1.5
- I use CRON to run a php script at regular intervals.

<br/>

### How do I get Twitter keys (consumer keys, etc.)?
- You have to register first at https://developer.twitter.com
- Then you have to get verification to access the ELEVATED level of Twitter API
- Then just create a project and generate API Key, API Secret, Access Token and Access Secret.
- If you want to use the bot under an account other than your registered one, you must obtain OAuth Twitter tokens for your account through the app you created. I've used WordPress with this add-on (https://wordpress.org/plugins/nextend-facebook-connect/) to do this, and modified it to print OAuth information when you log in.

<br/>

### Used libraries
- https://github.com/danieldevine/bird-elephant