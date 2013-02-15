<?php
interface CollectionInterface{
	public function filter(Closure $cb);
	public function sort(Closure $cb);
	public function all();
	public function toArray();
}
