<?php
trait ArrayEmulation{
	use CountableIterator;
	
	public $length;
	
	public function offsetExists($offset){
		return isset($this->contents[$offset]);
	}
	
	public function offsetGet($offset){
		return $this->contents[$offset];
	}
	
	public function offsetSet($offset, $value){
		$this->contents = $value;
		
		$this->length = count($this);
	}
	
	public function offsetUnset($offset){
		unset($this->contents[$offset]);
		
		$this->length = count($this);
	}
}
