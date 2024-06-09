DROP TABLE IF EXISTS orderDetail;
DROP TABLE IF EXISTS customerData;
DROP TABLE IF EXISTS menu;
DROP TABLE IF EXISTS category;

CREATE TABLE category (
    id int not null auto_increment,
    catName varchar(30) not null,
    CONSTRAINT category_pk PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE menu (
    id int not null auto_increment,
    idCat int(5) not null,
    mName varchar(30) not null,
    price int(3) not null,
    imagePath varchar(30) not null,
    CONSTRAINT menu_pk PRIMARY KEY(id),
    FOREIGN KEY (idCat) REFERENCES category(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE customerData (
    id int not null auto_increment,
    cName varchar(50) not null,
    phoneNo varchar(12) not null,
    transactionOrder varchar(10) not null CHECK (transactionOrder = "dine in" or transactionOrder = "take away"),
    dateOrder date not null,
    CONSTRAINT menu_pk PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE orderDetail (
    idMenu int(5) NOT NULL,
    idOrder int(5) NOT NULL,
    price int NOT NULL,
    quantityOrder int(2) NOT NULL,
    PRIMARY KEY(idMenu, idOrder), -- Define composite primary key here
    FOREIGN KEY (idMenu) REFERENCES menu(id),
    FOREIGN KEY (idOrder) REFERENCES customerData(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO category (catName) VALUES("Main Courses");
INSERT INTO category (catName) VALUES("Beverages");
INSERT INTO category (catName) VALUES("Sides");

INSERT INTO menu (idCat,mName,price,imagePath) VALUES(1,"Fried Rice",80,"friedRice.jpg");
INSERT INTO menu (idCat,mName,price,imagePath) VALUES(1,"Chicken Curry",100,"beefCurry.jpg");
INSERT INTO menu (idCat,mName,price,imagePath) VALUES(1,"Spaghetti Bolognese",120,"spaghetti.jpg");
INSERT INTO menu (idCat,mName,price,imagePath) VALUES(1,"Chicken Salted Egg",100,"saltedegg.jpg");

INSERT INTO menu (idCat,mName,price,imagePath) VALUES(2,"Milk Tea",30,"milkTea.jpg");
INSERT INTO menu (idCat,mName,price,imagePath) VALUES(2,"Green Tea",30,"greenTea.jpg");
INSERT INTO menu (idCat,mName,price,imagePath) VALUES(2,"Black Coffee",30,"coffee.jpg");
INSERT INTO menu (idCat,mName,price,imagePath) VALUES(2,"Strawberry Latte",50,"strawberrylatte.jpg");

INSERT INTO menu (idCat,mName,price,imagePath) VALUES(3,"French Fries",35,"frenchFries.jpg");
INSERT INTO menu (idCat,mName,price,imagePath) VALUES(3,"Omelet",40,"omelet.jpg");
INSERT INTO menu (idCat,mName,price,imagePath) VALUES(3,"Dumplings",50,"dumplings.jpg");
INSERT INTO menu (idCat,mName,price,imagePath) VALUES(3,"Nugget",50,"nugget.jpg");
