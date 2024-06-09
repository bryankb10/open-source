# Project Description

For this project, we created 7 main files, they are tablerestaurant.sql, pdoconnect.php, menurestaurant.php, summaryrestaurant.php, customer_details.php, finalizeorder.php, orderHistory.php, and finally qrcode_generator.php. We also have several images for the menu items, as well as a png file for the design of the web page. each of these files provide a function in creating this project.

First we created tablerestaurant.sql to make a database that stores:

  **-Category names.**
  
  **-Name of the menu items.**
  
  **-Pictures and the price.**
  
  **-Customer details.**

  
We then send this file to MariaDB. Then we use **'pdoconnect.php'** to connect the database to our php files, after all this is done. We can use the website.
The website starts of with the **'menurestaurant.php'** which is figuratively our mainpage, this page is used to show the menu and accept the orders that are inputted. This page can also be used by either the restaurant owners or the customers to input orders, and show the items ordered with their prices. After all the orders are taken, we are taken to the next page which is the **'summaryrestaurant.php'**, this page is used to confirm if all the orders are correct, like the mainpage we can see the items ordered and their prices, if everything is right then there is a "checkout" button that takes the users to the next site, or if the orders are wrong, users can go back to the **'menurestaurant.php'** to change the items ordered. If the "checkout" button is pressed, it will take us to the **'customer_details.php'**. This page allows the user to input details such as name, phone number and choose either to dine-in or take-away. When all the information is filled, mit will take us to the next website which is the **'finalizeorder.php'**, this site allows the users their order.no(Order.ID), their information, and the total price. We have also made a qr code generator that takes to the website so that customers can open the page easily. Lastly we made **'orderHistory'**, a site for the admin(Restaurant owner or etc) to look at all the orders placed with customer information and OrderID.

==========================================================================(# Key Features)==========================================================================

Mobile accessibility : By using the qr code, users can open this webpage on their mobile devices.
Order Tracking : the admin is able to keep track of any orders and their prices.
Menu browsing : interactive categorized menu with categories and prices.
