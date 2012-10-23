<?php
interface AsHTML extends Printable{
	public function _getHTMLTemplate();
	public function _toHTML();
}
