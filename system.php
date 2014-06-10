<?php
require 'config.php';

$modules = [
    'ErrorToException',
    'Deterministic'
];

foreach($modules as $module){
    require "modules/$module.php";
}

$interfaces = [
    'Printable',
    'AsHTML',
    'DBReflection',
    'CollectionInterface',
    'SwitchablePrimary',
    'SingletonInterface'
];

foreach($interfaces as $interface){
    require "interfaces/$interface.php";
}

$traits = [
    'Singleton'
];

foreach($traits as $trait){
    require "traits/$trait.php";
}

$classes = [
    'CollectionIterativeProxy',
    'Collection',
    'DBReflectiveCollection',
    'SwitchablePrimaryCollection'
];

foreach($classes as $class){
    require "classes/$class.php";
}
