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
    image blob not null,
    price decimal(10, 2) not null,
    quantity int not null,
    since datetime not null,
    lastUpdate datetime not null,
    primary key(id),
    foreign key(storeId) references stores(id),
    index(name)
);

create table sessions(
    id int not null auto_increment,
    userId int not null,
    token varchar(255) not null,
    expires datetime not null,
    since datetime not null,
    lastUpdate datetime not null,
    primary key(id),
    foreign key(userId) references users(id),
    index(token)
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