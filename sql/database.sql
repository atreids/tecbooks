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

INSERT INTO Customers(customer_id, firstname, surname, hashed_pass, email) VALUES
(100, "Aaron", "Donaldson", "e0f0e", "aaron.donaldson00@gmail.com");

create table Books(
    stock_id int NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    author varchar(255) NOT NULL,
    isbn varchar(255) NOT NULL,
    book_desc varchar(255) NOT NULL,
    cover varchar(255) NOT NULL,
    quantity_stock int NOT NULL,
    product_price int NOT NULL,
    PRIMARY KEY(stock_id)
);

insert into Books(title, author, isbn, book_desc, cover, quantity_stock, product_price) values 
("Dune", "Frank Herbet", 9780143111580, "Set in the distant future amidst a feudal interstellar society in which various noble houses control planetary fiefs, Dune tells the story of young Paul Atreides, whose family accepts the stewardship of the planet Arrakis. While the planet is an inhospitable and sparsely populated desert wasteland, it is the only source of melange, or 'the spice', a drug that extends life and enhances mental abilities.",
"https://upload.wikimedia.org/wikipedia/en/d/de/Dune-Frank_Herbert_%281965%29_First_edition.jpg", 20, 10);

create table Admins(
    staff_num int(30) NOT NULL,
    fullname varchar(255) NOT NULL,
    hashed_pass varchar(255) NOT NULL,
    PRIMARY KEY(staff_num)
);

insert into Admins values 
(153, "Aaron Donaldson", "e0f0e");

create table Reviews(
    review_id int NOT NULL,
    stock_id int NOT NULL,
    customer_id int NOT NULL,
    review_text mediumtext NOT NULL,
    primary key(review_id),
    foreign key (stock_id) references Books(stock_id),
    foreign key (customer_id) references Customers(customer_id)
);
create table Payment_Methods(
    payment_method_id int NOT NULL,
    customer_id int NOT NULL,
    card_number int NOT NULL,
    date_from date,
    date_to date NOT NULL,
    card_csv tinyint NOT NULL,
    primary key(payment_method_id),
    foreign key (customer_id) references Customers(customer_id)
);

create table Ref_Order_Status(
    order_status_code int NOT NULL,
    order_status_desc varchar(255),
    primary key(order_status_code)
);

create table Customers_Orders(
    order_id int NOT NULL AUTO_INCREMENT,
    customer_id int NOT NULL,
    payment_method_id int NOT NULL,
    order_status_code int NOT NULL,
    date_order_placed date NOT NULL,
    order_price decimal NOT NULL,
    primary key(order_id),
    foreign key (customer_id) references Customers(customer_id),
    foreign key (payment_method_id) references Payment_Methods(payment_method_id),
    foreign key (order_status_code) references Ref_Order_Status(order_status_code)
);

create table Customer_Orders_Books(
    order_id int NOT null,
    stock_id int NOT null,
    quantity int not null,
    price decimal not null,
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
    iso_country_code int(3) NOT NULL,
    primary key(address_id)
);

create table Customer_Addresses(
    customer_id int NOT NULL,
    address_id int NOT NULL,
    address_type varchar(20) NOT NULL,
    primary key(customer_id, address_id),
    foreign key (customer_id) references Customers(customer_id),
    foreign key (address_id) references Addresses(address_id)
);




