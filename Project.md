# Restaurant Menu Website

Our project is to create a restaurant menu website with a variety of food and drinks, which people can enter by scanning a QR code. People then can order the items and the website will save the data of those orders. The goal is to provide a smooth and efficient way for customers to view the restaurant's menu and place orders directly from their smartphones, improving both the customer experience and the restaurant's operational efficiency.

1. Functions:
   - Users can scan the QR code to send them to the menu website
   - Users input their name, phone number and line id before seeing the menu
   - Allows user to choose different categories of the menu, such as main course, beverages, snacks
   - Users can see pictures and price for the menus
   - Users can choose what to order by pressing the picture of foods and drinks, as well as input the quantity
   - An add-on screen will appear after pressing the menu to ask for add-ons such as soup, sauce, and others, the web will also ask the quantity of the order
   - Users can search the menu using the search bar
   - There is a submit button after the users are done ordering
   - Users can choose the take out button or the dine in button
   - The web then will show the queue number of the user


2. Implementation:
   - Use the QR code generator which contains the url of the website
   - Use database mySQL to create the menus
   - Use PHP to input the user’s name phone number, and line ID
   - Use HTML and CSS to create the design of the menu, including the food and drinks pictures, and the categories of the items
   - Generate a box asking the quantity when user press the picture of  item
   - Create a submit button using input type for the user to submit their order and got to the checkout
   - After pressing the submit button, show all of the items, the total price and queue number

