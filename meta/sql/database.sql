CREATE DATABASE tecbooks;

create table Customers(
    customer_id int NOT NULL AUTO_INCREMENT,
    firstname varchar(255) NOT NULL,
    surname varchar(255) NOT NULL,
    hashed_pass varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    user_type int(1) NOT NULL,
    PRIMARY KEY(customer_id)
);

create table Books(
    stock_id int NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    author varchar(255) NOT NULL,
    isbn varchar(255) NOT NULL,
    book_desc varchar(255) NOT NULL,
    cover varchar(255) NOT NULL,
    quantity_stock int NOT NULL,
    product_price double(10,2) NOT NULL,
    tags varchar(255) NOT NULL,
    PRIMARY KEY(stock_id)
);

create table Reviews(
    review_id int NOT NULL,
    stock_id int NOT NULL,
    customer_id int NOT NULL,
    review_text mediumtext NOT NULL,
    primary key(review_id),
    foreign key (stock_id) references Books(stock_id),
    foreign key (customer_id) references Customers(customer_id)
);

create table Customers_Orders(
    order_id int NOT NULL AUTO_INCREMENT,
    customer_id int NOT NULL,
    order_status int NOT NULL,
    date_order_placed date NOT NULL,
    order_total double(10,2) NOT NULL,
    txn_id varchar(255) NOT NULL,
    primary key(order_id),
    foreign key (customer_id) references Customers(customer_id)
);

create table Customer_Orders_Books(
    order_id int NOT null,
    stock_id int NOT null,
    quantity int not null,
    price double(10,2) not null,
    primary key(order_id, stock_id),
    foreign key (order_id) references Customers_Orders(order_id),
    foreign key (stock_id) references Books(stock_id)
);

create table Addresses(
    address_id int NOT NULL AUTO_INCREMENT,
    building_number varchar(10),
    street_name varchar(255) NOT NULL,
    city varchar(255) NOT NULL,
    zip_postcode varchar(255) NOT NULL,
    iso_country_code varchar(3) NOT NULL,
    primary key(address_id)
);

create table Customer_Addresses(
    customer_id int NOT NULL,
    address_id int NOT NULL,
    primary key(customer_id, address_id),
    foreign key (customer_id) references Customers(customer_id),
    foreign key (address_id) references Addresses(address_id)
);





