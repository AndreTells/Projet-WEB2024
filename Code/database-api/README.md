# Instalation Guide
1. put the current folder into your server's folder 
2. copy the 030-rest.conf file into your 'sites-available' folder
3. change the directory paths inside 030-rest.conf to be compatible with your computer's paths
3. enable rewrite engine if it's not done already (in LINUX: a2enmod rewrite)
4. enable the conf file and restart the server
5. verify the api is running by going to 'localhost/database-api/api/api-test' on a browser or making a GET request to the same url and make sure the return has success = true 
