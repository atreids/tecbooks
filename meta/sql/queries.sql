SELECT * FROM Addresses JOIN Customer_Addresses ON Addresses.address_id = Customer_Addresses.address_id
JOIN Customers ON Customer_Addresses.customer_id = Customers.customer_id WHERE Customers.customer_id = $user_id;

SELECT * FROM Books JOIN Customer_Orders_Books ON Books.stock_id = Customer_Orders_Books.stock_id
JOIN Customers_Orders ON Customer_Orders_Books.order_id = Customers_Orders.order_id WHERE Customers_Orders.order_id = 100000;

SELECT * FROM Books JOIN Customer_Orders_Books ON Books.stock_id = Customer_Orders_Books.stock_id
JOIN Customers_Orders ON Customer_Orders_Books.order_id = Customers_Orders.order_id JOIN Customers ON 
Customers_Orders.customer_id=Customers.customer_id WHERE Customers.customer_id = 10000;