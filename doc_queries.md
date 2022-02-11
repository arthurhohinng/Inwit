# Documentation

### 

## 1. Queries

The database is maintained with mySQL.



### Making Queries

To declare a query, first declare a global database object:

```php
global $wpdb;
```

Then create a prepare statement for the query:

```php
$query = $wpdb->prepare("SOME SQL QUERY HERE", $user->ID);
```

Then execute the query and obtain the result:

```php
$result = $wpdb->get_row($query);
```

And values can be extracted:

```php
$some_value = strval($result->attribute_name);
```

To learn more about making queries follow this [link](https://developer.wordpress.org/reference/classes/wpdb/).





This section will detail the structure of different tables the database.

### Container

​	container_id INT PRIMARY KEY,
​    restaurant_id INT,
​    container_status INT,
​    transaction_date DATETIME,
​    order_id INT,
​    recipient_id INT

