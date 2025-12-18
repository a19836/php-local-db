# PHP Local DB

> Original Repos:   
> - PHP Local DB: https://github.com/a19836/php-local-db/   
> - Bloxtor: https://github.com/a19836/bloxtor/

## Overview

**PHP Local DB** is a lightweight PHP library that provides a simple local database mechanism by storing data in encrypted files.  
It allows applications to persist structured data securely without relying on an external database server.

The library supports common database-like operations, including **insert**, **update**, **delete**, **retrieve a single item**, and **retrieve multiple items**, all performed against an encrypted local storage file protected by a key.

With this library, you can:
- Store application data securely in a local encrypted file
- Use a key-based encryption mechanism to protect stored data
- Perform CRUD operations (create, read, update, delete)
- Retrieve individual records or collections of records based in conditions
- Avoid external database dependencies for small or embedded use cases

This library is ideal for configuration storage, lightweight caching, offline data persistence, embedded systems, or applications where a full database server is unnecessary or unavailable.

To see a working example, open [index.php](index.php) on your server.

---

## Usage

### Init handler

```php
include __DIR__ . "/lib/localdb/LocalDBTableHandler.php";

$root_path = "/tmp/localdb/";
$encryption_key = "5828d0f607bdd3c893c180b506dc2701";
$table_name = "test";

$LocalDBTableHandler = new LocalDBTableHandler($root_path, $encryption_key);
```

### Create table

```php
$status = $LocalDBTableHandler->writeTableItems("", $table_name);
```

### Insert record

```php
//prepare record data to be inserted
$data = array( //set your attributes
	"test_id" => $LocalDBTableHandler->getPKMaxValue($table_name, "test_id") + 1,
	"name" => "JP",
	"age" => 35,
	//...
);

//insertItem($table_name, $data, $pks, &$items = null)
$status = LocalDBTableHandler->insertItem($table_name, $data, array("test_id"));
```

### Update record

```php
//updateItem($table_name, $data, $pks, &$items = null)
$status = $LocalDBTableHandler->updateItem($table_name, $data, array("test_id"));
```

### Delete record

```php
//deleteItem($table_name, $conditions, &$items = null)
$status = $LocalDBTableHandler->deleteItem($table_name, array("test_id" => $test_id));
```

### Get records

```php
//getItems($table_name)
$items = $LocalDBTableHandler->getItems($table_name); //$items is an array
```

### Get a specific record

```php
$items = $LocalDBTableHandler->getItems($table_name); //$items is an array

//filterItems($items, $conditions, $preserve_indexes = true, $limit = null)
$new_items = $LocalDBTableHandler->filterItems($items, array("test_id" => $test_id), false, 1);
$record = isset($new_items[0]) ? $new_items[0] : null;
```

### Search records

```php
$items = $LocalDBTableHandler->getItems($table_name); //$items is an array
$found_items = $this->LocalDBTableHandler->filterItems($items, array("name" => "JP", "age" => "35"), false);
```

### Change encrypted data with another encryption

```php
$new_encryption_key = "5b6d71b3e03e7540478d277666f08948";
$status = $LocalDBTableHandler->changeDBTableEncryptionKey($table_name, $new_encryption_key);
```

### Get table raw contents

```php
$json_contents = $LocalDBTableHandler->readTableItems($table_name);
```

### Write raw contents into table

```php
$status = $LocalDBTableHandler->writeTableItems($items, $table_name); //$items is an array
```

### Get table file path

```php
$file_path = $LocalDBTableHandler->getTableFilePath($table_name);
```

