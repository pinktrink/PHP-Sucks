<?php
class SwitchablePrimaryCollection extends Collection implements SwitchablePrimary{
    private $current;
    private $currentKey;

    public function __construct(array $contents){
        parent::__construct($contents);

        $this->rewind();

        $this->current = $this->current();
        $this->currentKey = $this->key();
    }

    public function change($index){
        if(isset($this[$index])){
            $this->current = $this[$index];
        }
    }

    public function __get($name){
        if(property_exists($this->current, $name)){
            return $this->current->$name;
        }
    }

    public function __set($name, $val){
        return $this->current->$name = $val;
    }

    public function __call($name, $args){
        if(method_exists($this->current, $name)){
            return call_user_func_array([$this->current, $name], $args);
        }
    }

    public function offsetSet($offset, $value){
        parent::offsetSet($offset, $value);

        if(count($this) === 1){
            $this->current = $this[$offset];
            $this->currentKey = $offset;
        }
    }

    public function offsetUnset($offset){
        parent::offsetUnset($offset);

        if($offset === $this->currentKey){
            if(count($this)){
                reset($this);

                $this->current = current($this);
                $this->currentKey = key($this);
            }else{
                unset($this->current);
                unset($this->currentKey);
            }
        }
    }
}
