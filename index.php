<?php
/*
 * Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
 * 
 * Multi-licensed: BSD 3-Clause | Apache 2.0 | GNU LGPL v3 | HLNC License (http://bloxtor.com/LICENSE_HLNC.md)
 * Choose one license that best fits your needs.
 *
 * Original PHP Local DB Repo: https://github.com/a19836/php-local-db/
 * Original Bloxtor Repo: https://github.com/a19836/bloxtor
 *
 * YOU ARE NOT AUTHORIZED TO MODIFY OR REMOVE ANY PART OF THIS NOTICE!
 */
?>
<style>
h1 {margin-bottom:0; text-align:center;}
h5 {font-size:1em; margin:40px 0 10px; font-weight:bold;}
p {margin:0 0 20px; text-align:center;}

.note {text-align:center;}
.note span {text-align:center; margin:0 20px 20px; padding:10px; color:#aaa; border:1px solid #ccc; background:#eee; display:inline-block; border-radius:3px;}
.note li {margin-bottom:5px;}

.code {display:block; margin:10px 0; padding:0; background:#eee; border:1px solid #ccc; border-radius:3px; position:relative;}
.code:before {content:"php"; position:absolute; top:5px; left:5px; display:block; font-size:80%; opacity:.5;}
.code textarea {width:100%; height:200px; padding:30px 10px 10px; display:inline-block; background:transparent; border:0; resize:vertical; font-family:monospace;}
.code.short textarea {height:120px;}
.code.one-line textarea {height:70px;}
</style>
<h1>PHP Local DB</h1>
<p>Store data to secure local files</p>
<div class="note">
		<span>
		This library provides a simple local database mechanism by storing data in encrypted files.<br/>
		It allows applications to persist structured data securely without relying on an external database server.<br/>
		<br/>
		The library supports common database-like operations, including insert, update, delete, retrieve a single item, and retrieve multiple items, all performed against an encrypted local storage file protected by a key.<br/>
		<br/>
		With this library, you can:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Store application data securely in a local encrypted file</li>
			<li>Use a key-based encryption mechanism to protect stored data</li>
			<li>Perform CRUD operations (create, read, update, delete)</li>
			<li>Retrieve individual records or collections of records based in conditions</li>
			<li>Avoid external database dependencies for small or embedded use cases</li>
		</ul>
		<br/>
		This library is ideal for configuration storage, lightweight caching, offline data persistence, embedded systems, or applications where a full database server is unnecessary or unavailable.
		</span>
</div>

<h2>Usage</h2>

<div>
	<h5>Init handler</h5>
	<div class="code">
		<textarea readonly>
include __DIR__ . "/lib/localdb/LocalDBTableHandler.php";

$root_path = "/tmp/localdb/";
$encryption_key = "5828d0f607bdd3c893c180b506dc2701";
$table_name = "test";

$LocalDBTableHandler = new LocalDBTableHandler($root_path, $encryption_key);
		</textarea>
	</div>
</div>

<div>
	<h5>Create table</h5>
	<div class="code one-line">
		<textarea readonly>
$status = $LocalDBTableHandler->writeTableItems("", $table_name);
		</textarea>
	</div>
</div>

<div>
	<h5>Insert record</h5>
	<div class="code">
		<textarea readonly>
//prepare record data to be inserted
$data = array( //set your attributes
	"test_id" => $LocalDBTableHandler->getPKMaxValue($table_name, "test_id") + 1,
	"name" => "JP",
	"age" => 35,
	//...
);

//insertItem($table_name, $data, $pks, &$items = null)
$status = LocalDBTableHandler->insertItem($table_name, $data, array("test_id"));
		</textarea>
	</div>
</div>

<div>
	<h5>Update record</h5>
	<div class="code one-line">
		<textarea readonly>
//updateItem($table_name, $data, $pks, &$items = null)
$status = $LocalDBTableHandler->updateItem($table_name, $data, array("test_id"));
		</textarea>
	</div>
</div>

<div>
	<h5>Delete record</h5>
	<div class="code one-line">
		<textarea readonly>
//deleteItem($table_name, $conditions, &$items = null)
$status = $LocalDBTableHandler->deleteItem($table_name, array("test_id" => $test_id));
		</textarea>
	</div>
</div>

<div>
	<h5>Get records</h5>
	<div class="code one-line">
		<textarea readonly>
//getItems($table_name)
$items = $LocalDBTableHandler->getItems($table_name); //$items is an array
		</textarea>
	</div>
</div>

<div>
	<h5>Get a specific record</h5>
	<div class="code short">
		<textarea readonly>
$items = $LocalDBTableHandler->getItems($table_name); //$items is an array

//filterItems($items, $conditions, $preserve_indexes = true, $limit = null)
$new_items = $LocalDBTableHandler->filterItems($items, array("test_id" => $test_id), false, 1);
$record = isset($new_items[0]) ? $new_items[0] : null;
		</textarea>
	</div>
</div>

<div>
	<h5>Search records</h5>
	<div class="code one-line">
		<textarea readonly>
$items = $LocalDBTableHandler->getItems($table_name); //$items is an array
$found_items = $this->LocalDBTableHandler->filterItems($items, array("name" => "JP", "age" => "35"), false);
		</textarea>
	</div>
</div>

<div>
	<h5>Change encrypted data with another encryption</h5>
	<div class="code one-line">
		<textarea readonly>
$new_encryption_key = "5b6d71b3e03e7540478d277666f08948";
$status = $LocalDBTableHandler->changeDBTableEncryptionKey($table_name, $new_encryption_key);
		</textarea>
	</div>
</div>

<div>
	<h5>Get table raw contents</h5>
	<div class="code one-line">
		<textarea readonly>
$json_contents = $LocalDBTableHandler->readTableItems($table_name);
		</textarea>
	</div>
</div>

<div>
	<h5>Write raw contents into table</h5>
	<div class="code one-line">
		<textarea readonly>
$status = $LocalDBTableHandler->writeTableItems($items, $table_name); //$items is an array
		</textarea>
	</div>
</div>

<div>
	<h5>Get table file path</h5>
	<div class="code one-line">
		<textarea readonly>
$file_path = $LocalDBTableHandler->getTableFilePath($table_name);
		</textarea>
	</div>
</div>
