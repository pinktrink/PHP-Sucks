<?php
abstract class Collection implements ArrayAccess, Iterator, Countable, CollectionInterface{
	use ArrayEmulation;
	
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
}
