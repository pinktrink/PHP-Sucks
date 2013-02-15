<?php
trait Deterministic{
	public function __call($method, $args){
		if(method_exists($this, "{$method}__deterministic__")){
			static $cache = [];
			
			foreach($cache as $piece){
				if($piece[0] === $args){
					return $piece[1];
				}
			}
			
			$ret = call_user_func_array(array($this, "{$method}__deterministic__"), $args);
			
			$cache[] = [$args, $ret];
			
			return $ret;
		}
	}
}

trait StaticDeterministic{
	public static function __callStatic($method, $args){
		if(method_exists('static', "{$method}__deterministic__")){
			static $cache = [];
			
			foreach($cache as $piece){
				if($piece[0] === $args){
					return $piece[1];
				}
			}
			
			$ret = call_user_func_array(array('static', "{$method}__deterministic__"), $args);
			
			$cache[] = [$args, $ret];
			
			return $ret;
		}
	}
}

function deterministic($fn){
	return function() use ($fn){
		static $cache = [];
		
		$args = func_get_args();
		
		foreach($cache as $piece){
			if($piece[0] === $args){
				return $piece[1];
			}
		}
		
		$ret = call_user_func_array($fn, $args);
		
		$cache[] = [$args, $ret];
		
		return $ret;
	};
}
