create database vand;

create database users(
    id int not null auto_increment,
    name varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    since datetime not null,
    last_update datetime not null,
    primary key(id)
);

create database stores(
    id int not null auto_increment,
    user_id int not null,
    name varchar(255) not null,
    description varchar(255) not null,
    since datetime not null,
    last_update datetime not null,
    primary key(id),
    foreign key(user_id) references users(id)
);

create database products(
    id int not null auto_increment,
    store_id int not null,
    name varchar(255) not null,
    description varchar(255) not null,
    price decimal(10, 2) not null,
    quantity int not null,
    since datetime not null,
    last_update datetime not null,
    primary key(id),
    foreign key(store_id) references stores(id)
);

create table sessions(
    id int not null auto_increment,
    user_id int not null,
    token varchar(255) not null,
    expires datetime not null,
    since datetime not null,
    last_update datetime not null,
    primary key(id),
    foreign key(user_id) references users(id)
);