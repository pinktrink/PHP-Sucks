<?php
abstract class Collection implements ArrayAccess, Iterator, Countable, CollectionInterface{
	private $contents = [];
	
	public function __constructor(array $contents){
		$this->contents = $contents;
	}
	
	public function filter(Closure $cb){
		$retData = [];
		
		foreach($this as $piece){
			$newCb = $cb->bindTo($piece);
			
			if($newCb()){
				$retData[] = $retData;
			}
		}
		
		return new self($retData);
	}
	
	public function sort(Closure $cb){
		usort($this->contents, $cb);
	}
	
	//ArrayAccess
	public function offsetExists($offset){
		return isset($this->contents[$offset]);
	}
	
	public function offsetGet($offset){
		return $this->contents[$offset];
	}
	
	public function offsetSet($offset, $value){
		$this->contents = $value;
	}
	
	public function offsetUnset($offset){
		unset($this->contents[$offset]);
	}
	
	//Iterator
	public function current(){
		return current($this->contents);
	}
	
	public function key(){
		return key($this->contents);
	}
	
	public function next(){
		return next($this->contents);
	}
	
	public function rewind(){
		return reset($this->contents);
	}
	
	public function valid(){
		return key($this->contents) !== NULL;
	}
	
	//Countable
	public function count(){
		return count($this->contents);
	}
}
