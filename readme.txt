=== HostChecker ===
Author: Sadi Qevani
Email: sadiqevani@dot.al
Website: www.sadiqevani.com

Name: HostChecker
Version: 1.1

== Description ==

HostChecker is a script that helps you monitor your servers and services whether they are online or not. 
You can add a unlimited amount of hosts or ip to monitor and directly check them or a cronjob will check the services 
for you and you will receive an email if one of your hosts is down.

== Installation ==

Please follow the steps below:

1. Open config.php and edit the options that need to be configured, such as db access
   Name of the script and the default directory.
   
2. Upload all the files in the directry you have chosen 
   (if the files are uploaded in public_html please leave empty the variable $extraDirectory)
   
3. Go to phpmyadmin and import the datas from the folder sql to the database

4. Visit the website and you are ready to go. If you need further help do not hesitate to contact me.

5. Add the file cron.php to the cronjob each X minutes you want but i suggest something like 10 or 15 minutes.