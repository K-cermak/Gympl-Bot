# Gympl Bot

### What's a Gympl Bot?
- It's a Twitter bot that periodically posts the text / screenshots from the legendary Czech movie Gympl / Vejška.
- https://twitter.com/GymplFilm
- https://youtu.be/PSLjsHcbcJU
- https://youtu.be/BKCk-_j3yWc

<br/>

### Doesn't this bot violate the ownership right?
- No, I think it's in Fair Use. Besides, the whole movie is already on YouTube and is already 15 / 9 years old.
- However, if you have any problem with the bot, you can contact me at info@karlosoft.com.

<br/>

### Can I make a similar bot?
- You can use this code however you want, I don't care.

<br/>

### Where does the app run?
- For Gympl, I used my home Raspberry Pi 4B with PHP 8.1.5.
- For Vejška, I used my home Dell PowerEdge R730.
- I use CRON to run a php script at regular intervals.

<br/>

### How do I get Twitter keys (consumer keys, etc.)?
- You have to register first at https://developer.twitter.com.
- Then just create a project and generate API Key, API Secret, Access Token and Access Secret.
- If you want to use the bot under an account other than your registered one, you must obtain OAuth Twitter tokens for your account through the app you created. I've used WordPress with this add-on (https://wordpress.org/plugins/nextend-facebook-connect/) to do this, and modified it to print OAuth information when you log in.

<br/>

### Something about me:
- My website: https://karlosoft.com/
- My GitHub: https://github.com/K-cermak/
- My Twitter: https://twitter.com/K_cermak


<br/>

### Used libraries:
- https://github.com/danieldevine/bird-elephant
