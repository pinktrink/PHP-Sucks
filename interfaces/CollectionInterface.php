<?php
interface CollectionInterface{
	public function filter(Closure $cb);
	public function sort(Closure $cb);
}
