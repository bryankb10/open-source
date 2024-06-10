# Instructions For Installation and Running

In the Putty, we first type the command 


cd /var/www/html


because this is the directory to make our webpage available in the browser and use the git clone command to navigate to the directory where you want to clone the repository. To use the git clone command, type


sudo git clone https://github.com/bryankb10/open-source.git

We then need to create user and database in Mariadb, here are the steps and commands:

1. access the DBMS: sudo mysql -u root
   
2. create the application user account: CREATE USER myapp IDENTIFIED BY '1234';

3. create the database: CREATE DATABASE mydb;

4. grant the permissions: GRANT ALL PRIVILEGES ON mydb.* TO myapp;

5. re-login to the DBMS: mysql mydb -u myapp -p

We finally create table and insert the tables by copying and pasting the tablerestaurant.sql file to Mariadb. Once done, type exit. Now, we need to check the ip addr by typing

ip addr

and type the ip address in the browser. This will show the "open-source" folder. Press that folder and then press the menurestaurant.php to start the webpage. We also can use qr code by pressing the qrcode_generator.php to make it available in mobile phone. However, in order for this to work, the mobile device must connect to the same WiFi network with the computer running the webpage. 
