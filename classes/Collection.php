<?php
class Collection implements ArrayAccess, Iterator, Countable, CollectionInterface, Serializable, JsonSerializable{
	private $contents = [];
	
	public function __construct(array $contents = NULL){
		$this->contents = $contents;
	}
	
	public function filter(Closure $cb){
		$retData = [];
		
		foreach($this as $piece){
			$newCb = $cb->bindTo($piece);
			
			if($newCb()){
				$retData[] = $piece;
			}
		}
		
		return new self($retData);
	}
	
	public function sort(Closure $cb){
		usort($this->contents, $cb);
	}
	
	public function all(){
		return new CollectionIterativeProxy($this);
	}
	
	public function toArray(){
		return $this->contents;
	}
	
	//ArrayAccess
	public function offsetExists($offset){
		return isset($this->contents[$offset]);
	}
	
	public function offsetGet($offset){
		return $this->contents[$offset];
	}
	
	public function offsetSet($offset, $value){
		if($offset === null){
			$this->contents[] = $value;
		}else{
			$this->contents[$offset] = $value;
		}
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
	
	//Serializable
	public function serialize(){
		return serialize($this->contents);
	}
	
	public function unserialize($data){
		return $this->contents = unserialize($data);
	}
	
	//JsonSerializable
	public function jsonSerialize(){
		return $this->contents;
	}
}
