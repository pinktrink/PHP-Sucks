<?php
class CollectionIterativeProxy implements ArrayAccess{
    private $contents;
    private $delimiter = ',';

    public function __construct($contents){
        $this->contents = $contents;
    }

    public function delimiter($delimiter){
        $this->delimiter = $delimiter;

        return $this;
    }

    public function __get($key){
        $ret = new Collection();

        foreach($this->contents as $index => $piece){
            $ret[$index] = $piece->$key;
        }

        return $ret;
    }

    public function __set($key, $val){
        foreach($this->contents as $piece){
            $piece->$key = $val;
        }
    }

    public function __call($name, $args){
        $ret = new Collection();

        foreach($this->contents as $index => $piece){
            $ret[$index] = call_user_func_array([$piece, $name], $args);
        }

        return $ret;
    }

    public function __toString(){
        return implode($this->delimiter, $this);
    }

    //ArrayAccess
    public function offsetExists($offset){
        $ret = true;

        foreach($this->contents as $index => $piece){
            $ret &= +isset($piece[$offset]);
        }

        return !!$ret;
    }

    public function offsetGet($offset){
        $ret = new Collection();

        foreach($this->contents as $index => $piece){
            $ret[$index] = isset($piece[$offset]) ? $piece[$offset] : NULL;
        }

        return $ret;
    }

    public function offsetSet($offset, $value){
        /* So, I've attempted the following in both PHP 5.4.8 and PHP 5.5.0aplha1:
            * Using IteratorAggregate and passing an ArrayIterator of the Collection contents.
            * Using a generator in getIterator with IteratorAggregate
            * Using just standard Iterator interface
        Each threw the error 'Indirect modification of overloaded element of Collection has no effect' when attempting:
            $a = new Collection([['a', 'b', 'c'], ['d', 'e', 'f'], ['g', 'h', 'i']]);
            $a->all()[1] = 'x';
        So I pretty much had to do it this way. */

        $new = [];

        foreach($this->contents as $piece){
            $piece[$offset] = $value;

            $new[] = $piece;
        }

        $this->contents->__construct($new);
    }

    public function offsetUnset($offset){
        $new = [];

        foreach($this->contents as $piece){
            unset($piece[$offset]);

            $new[] = $piece;
        }

        $this->contents->__construct($new);
    }
}
