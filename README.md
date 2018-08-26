# varDx
Simple PHP flat-file data storage library  
Current version: `1.0`  
License: `MIT License`  

## Requirements
1. PHP 5.6+

## Installation
1. Save `varDX.php` on your server. You can rename it.  
2. Add this to the top of all your files: `require 'varDx.php';`
3. Have fun! 

## Functions
### `def(<filename>)`
Defines the file in which all data is to be stored. Should be called before using any other functions. If the file doesn't exist, it will be created when data is first written to it using `write()` or `modify()`.

### `write(<key_name>, <key_value>)`
Writes the value to the file. Creates the file if it doesn't exist. Returns `ERR_DX_KEY_ALREADY_EXISTS` if the key already exists in the file.

### `modify(<key_name>, <key_value>)`
Changes the value of the key in the file. Creates the file if it doesn't exist. Creates key if it doesn't already exist in the file.

### `read(<key_name>)`
Reads the value of the key from the file and returns it. Returns `ERR_DX_KEY_NOT_FOUND` if the key doesn't exist in the file. Returns `ERR_DX_FILE_DOES_NOT_EXIST` if the file doesn't exist.

### `check(<key_name>)`
Checks if the key exists in the file, and returns `true` if it does. Returns `ERR_DX_KEY_NOT_FOUND` if the key doesn't exist in the file. Returns `ERR_DX_FILE_DOES_NOT_EXIST` if the file doesn't exist.

### `del(<key_name>)`
Checks if the key exists in the file, and deletes it if it does. Returns `ERR_DX_FILE_DOES_NOT_EXIST` if the file doesn't exist.


## Usage
```
<?php
require 'varDx.php';
$dx = new \varDx\cDX; //create an object
$dx->def('file2.dat'); //define data file
$val1 = "this is a string";
$dx->write('data1', $val1); //writes key to file
echo $dx->read('data1'); //returns key value from file
```

## Changelog
 - `v1.0`: Initial version

## Report Bugs
Create an Issue or tweet to me at @rahuldottech

