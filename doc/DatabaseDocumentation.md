# Database Documentation

## 1. Queries

The database is maintained with mySQL.

### Making Queries

To declare a query, first declare a global database object:

```php
global $wpdb;
```

Then create a prepare statement for the query:

```php
$query = $wpdb->prepare("SOME SQL QUERY HERE");
```

Then execute the query and obtain the result:

```php
$result = $wpdb->get_row($query);
```

And values can be extracted:

```php
$some_value = $result->attribute_name;
```

To learn more about making queries, visit this [link](https://developer.wordpress.org/reference/classes/wpdb/).



## 2. Tables

For convenience, this section will detail the basic structure of frequently used tables in the database. All tables are viewable in full detail at the *phpMyAdmin* site.

### Container

| Name         | Type    | Null | Default |
| ------------ | ------- | ---- | ------- |
| container_id | int(11) | No   | None    |
| restaurant_id | int(11) | Yes   | NULL    |
| container_status | int(11) | Yes   | NULL    |
| transaction_date | datetime | Yes   | NULL    |
| order_id | int(11) | Yes   | NULL    |
| recipient_id | int(11) | Yes   | NULL    |

**Primary Key**: container_id

### wpar_dokan_orders

| Name         | Type           | Null | Default |
| ------------ | -------------- | ---- | ------- |
| id           | bigint(20)     | No   | None    |
| order_id     | bigint(20)     | Yes  | NULL    |
| seller_id    | bigint(20)     | Yes  | NULL    |
| order_total  | decimal(19, 4) | Yes  | NULL    |
| net_amount   | decimal(19, 4) | Yes  | NULL    |
| order_status | varchar(30)    | Yes  | NULL    |

**Primary Key**: container_id
