<?php
require 'config.php';

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

$classes = [
	'Collection',
	'DBReflectiveCollection',
	'SwitchablePrimaryCollection',
	'PDOPlus'
];

foreach($classes as $class){
	require "classes/$class.php";
}
