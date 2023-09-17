create database vand;

create table users(
    id int not null auto_increment,
    name varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    firstName varchar(255) not null,
    lastName varchar(255) not null,
    since datetime not null,
    lastUpdate datetime not null,
    primary key(id),
    unique(email)
);

create table stores(
    id int not null auto_increment,
    userId int not null,
    name varchar(255) not null,
    description varchar(255) not null,
    since datetime not null,
    lastUpdate datetime not null,
    primary key(id),
    foreign key(userId) references users(id),
    index(name)
);

create table products(
    id int not null auto_increment,
    storeId int not null,
    name varchar(255) not null,
    description varchar(255) not null,
    price decimal(10, 2) not null,
    quantity int not null,
    userId int not null,
    since datetime not null,
    lastUpdate datetime not null,
    primary key(id),
    foreign key(storeId) references stores(id),
    foreign key(userId) references users(id),
    index(name)
);

CREATE TABLE tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    tokenType ENUM('access', 'refresh') NOT NULL,
    tokenValue VARCHAR(255) NOT NULL,
    expiryDate DATETIME NOT NULL,
    UNIQUE (tokenValue),
    FOREIGN KEY (userID) REFERENCES Users(id),
    INDEX (userID),
    INDEX (tokenType, tokenValue)
);

INSERT INTO `` (`id`,`name`,`email`,`password`,`firstName`,`lastName`,`since`,`lastUpdate`) VALUES (1,'','vand@test.com','$2y$10$uE/JAhsFZfe2/MVeVIwWyuXWNVMj1x0F0xnwiIw0MLnFtJWfSv3ni','Thuy','Nguyen Trong','2023-09-16 21:26:59','2023-09-16 21:26:59');

INSERT INTO `` (`id`,`userID`,`tokenType`,`tokenValue`,`expiryDate`) VALUES (1,1,'access','d19d74acaff7c2c84a15e375a60ed40b3bb823a14652a8a6d656a7ffd48aa5c7','2023-09-17 21:27:35');
INSERT INTO `` (`id`,`userID`,`tokenType`,`tokenValue`,`expiryDate`) VALUES (2,1,'refresh','1ad4cba3525241c08173bc322def277b81e9d251ef0a934c454e6cca6676f2be','9999-12-31 23:59:59');


INSERT INTO `` (`id`,`userId`,`name`,`description`,`since`,`lastUpdate`) VALUES (1,1,'Store of Vand 1','This is description 1','2023-09-16 22:29:16','2023-09-16 22:29:16');
INSERT INTO `` (`id`,`userId`,`name`,`description`,`since`,`lastUpdate`) VALUES (2,1,'Store of Vand 2','This is description 2','2023-09-16 22:29:42','2023-09-16 22:29:42');
INSERT INTO `` (`id`,`userId`,`name`,`description`,`since`,`lastUpdate`) VALUES (3,1,'Store of Vand 3','This is description 3','2023-09-16 22:29:48','2023-09-16 22:29:48');


INSERT INTO `` (`id`,`storeId`,`name`,`description`,`price`,`quantity`,`userId`,`since`,`lastUpdate`) VALUES (1,1,'Vand 1 Product 1','Nothing',2000.00,2,1,'2023-09-16 22:30:58','2023-09-16 22:30:58');
INSERT INTO `` (`id`,`storeId`,`name`,`description`,`price`,`quantity`,`userId`,`since`,`lastUpdate`) VALUES (2,1,'Vand 1 Product 2','Nothing',2000.00,2,1,'2023-09-16 22:31:02','2023-09-16 22:31:02');
INSERT INTO `` (`id`,`storeId`,`name`,`description`,`price`,`quantity`,`userId`,`since`,`lastUpdate`) VALUES (3,1,'Vand 1 Product 3','Nothing',2000.00,2,1,'2023-09-16 22:31:05','2023-09-16 22:31:05');
INSERT INTO `` (`id`,`storeId`,`name`,`description`,`price`,`quantity`,`userId`,`since`,`lastUpdate`) VALUES (4,2,'Vand 2 Product 3','Nothing',3000.00,3,1,'2023-09-16 22:31:18','2023-09-16 22:31:18');
INSERT INTO `` (`id`,`storeId`,`name`,`description`,`price`,`quantity`,`userId`,`since`,`lastUpdate`) VALUES (5,2,'Vand 2 Product 6','Nothing',3000.00,3,1,'2023-09-16 22:31:22','2023-09-16 22:31:22');
INSERT INTO `` (`id`,`storeId`,`name`,`description`,`price`,`quantity`,`userId`,`since`,`lastUpdate`) VALUES (6,3,'Vand 3 Product 6','Nothing',300000.00,5,1,'2023-09-16 22:31:30','2023-09-16 22:31:30');
INSERT INTO `` (`id`,`storeId`,`name`,`description`,`price`,`quantity`,`userId`,`since`,`lastUpdate`) VALUES (7,3,'Vand 3 Product 1','Nothing',300000.00,5,1,'2023-09-16 22:31:32','2023-09-16 22:31:32');
INSERT INTO `` (`id`,`storeId`,`name`,`description`,`price`,`quantity`,`userId`,`since`,`lastUpdate`) VALUES (8,3,'Vand 3 Product 2','Nothing',300000.00,5,1,'2023-09-16 22:31:35','2023-09-16 22:31:35');
