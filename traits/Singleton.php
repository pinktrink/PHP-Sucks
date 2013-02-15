<?php
trait Singleton{
	private static $instance;
	
	public static function instance(){
		if(!self::$instance){
			$this->instance = new self;
		}
		
		return $this->instance;
	}
}
