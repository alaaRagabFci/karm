<?php
function translation($obj , $name){
	$field = $name.'_'.App::getLocale();
	return $obj->$field;
}