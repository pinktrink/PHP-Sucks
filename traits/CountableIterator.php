<?php
trait CountableIterator{
	private $contents = [];
	
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
	
	public function count(){
		return count($this->contents);
	}
}
