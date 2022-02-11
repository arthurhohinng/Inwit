CREATE TABLE IF NOT EXISTS Container(
    container_id INT PRIMARY KEY,
    restaurant_id INT,
    container_status INT,
    transaction_date DATETIME,
    order_id INT,
    recipient_id INT
);