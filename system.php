<?php
require 'config.php';
require 'Phyre/core/phyre.php';

$traits = [
	'CountableIterator',
	'ArrayEmulation'
];

foreach($traits as $trait){
	require "traits/$trait.php";
}

$interfaces = [
	'Printable',
	'AsHTML',
	'DBReflection',
	'CollectionInterface'
];

foreach($interfaces as $interface){
	require "interfaces/$interface.php";
}

$classes = [
	'Collection',
	'DBReflectiveCollection',
	'WorkCollection',
	'SchoolCollection'
];

foreach($classes as $class){
	require "classes/$class.php";
}
