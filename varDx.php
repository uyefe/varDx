<?php
namespace varDX;

/*
varDX - PHP flat-file storage
by @rahuldottech
v1.1
--
https://github.com/rahuldottech/
https://rahul.tech/
*/


class cDX {
	
	private $dataFile;	
	
	public function def($filename){
		$this->dataFile = $filename;
	}
	
	public function write($varName, $varVal){
		if(file_exists($this->dataFile)){
			$foundLine = $this->check($varName);
		} else {
			$foundLine = false;
		}
		
		if(!$foundLine){
			$writeData = $varName.'__=__'.urlencode($varVal).'__-__'.gettype($varVal).PHP_EOL;
			file_put_contents($this->dataFile, $writeData, FILE_APPEND);	
		} else {
			return "ERR_DX_KEY_ALREADY_EXISTS";
		}
	}
	
	public function read($varName){
		if(file_exists($this->dataFile)){
			$lines_array = file($this->dataFile);
			$search_string = $varName;
			foreach($lines_array as $line) {
				if(strpos($line, $search_string) !== false) {
					list(, $new_str) = explode("__=__", $line);
					$foundLine = true;
				}
			}
			if($foundLine){
				$val = strstr($new_str, '__-__', true); 
				$type = rtrim(str_replace($val.'__-__', '', $new_str));
				settype($val, $type);
				return urldecode($val);
			} else {
				return "ERR_DX_KEY_NOT_FOUND";
			}
		} else {
			return "ERR_DX_FILE_DOES_NOT_EXIST";
		}
	}

	
	public function del($varName){
		if(file_exists($this->dataFile)){
		    $f = $this->dataFile;
			$term = $varName.'__=__';
			$arr = file($f);
			foreach ($arr as $key=> $line) {
				if(stristr($line,$term)!== false){unset($arr[$key]);break;}
			}
			//reindexing array
			$arr = array_values($arr);
			//writing to file
			file_put_contents($f, implode($arr));
		} else {
			return "ERR_DX_FILE_DOES_NOT_EXIST";
		}
	}
	
	public function modify($varName, $varVal){
		if(file_exists($this->dataFile)){
			$lines_array = file($this->dataFile);
			$search_string = $varName;
			foreach($lines_array as $line) {
				if(strpos($line, $search_string) !== false) {
					list(, $new_str) = explode("__=__", $line);
					$foundLine = true;
				}
			}
			
			if($foundLine){
				$this->del($varName);
			} 
		}	
		$writeData = $varName.'__=__'.urlencode($varVal).'__-__'.gettype($varVal).PHP_EOL;
		file_put_contents($this->dataFile, $writeData, FILE_APPEND);
	}
	
	public function check($varName){
		if(file_exists($this->dataFile)){
			$lines_array = file($this->dataFile);
			$search_string = $varName;
			foreach($lines_array as $line) {
				if(strpos($line, $search_string) !== false) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			return "ERR_DX_FILE_DOES_NOT_EXIST";
		}
	}
}
	

