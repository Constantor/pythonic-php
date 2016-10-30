<?php

class PP {
  public static function len($obj) {
    if(is_string($obj))
      return strlen($obj);
    if(is_array($obj))
      return count($obj);
  }
  public static function append($array, $obj) {
    return array_push($array, $obj);
  }
  public static function arr($obj=0, $default=0) {
  	if($obj == 0)
  		return array();
  	if(is_int($obj)) {
  		$out = array();
  		for($i = 0; $i < $obj; $i++)
  			append($out, $default);
  		return $out;
  	}
    $out = array();
    for($i = 0; $i < $this::len($obj); $i++)
      append($out, $obj{$i});
    return $out;
  }
  public static function str($array) {
    $out = '';
    foreach($array as $el)
      append($out, $el);
    return $out;
  }
  public static function int($n) {
    return $n + 0;
  }
  public static function bin($n) {
    $n = int($n);
  }
  public static function sum($array) {
    $out = 0;
    foreach($array as $el) {
      $out += int($el);
    }
    return $out;
  }
  public static function map($function, $array) {
    $out = array();
    foreach($array as $el)
      append($out, $function($el));
    return $out;
  }
  public static function reversed($array) {
    $out = array();
    for($i = $this::len($array); $i >= 0; $i--)
      append($out, $array[$i]);
    return $out;
  }
  public static function sorted($array) {
    if($this::len($array) <= 1)
      return $array;
    $left = array();
    $middle = array();
    $right = array();
    $cur = rand(0, $this::len($array) - 1);
    foreach($array as $el) {
      if($el > $cur)
        append($right, $el);
      elseif($el < $cur)
        append($left, $el)
      else
        append($middle, $el);
    }
    return array_merge($this::sorted($left), $middle, $this::sorted($right));
  }

  public static function sort(&$array) {
  	$array = sorted($array);
  }

  public static function print($mes, $end="\n", $file=STDOUT) {
    return fwrite($file, $mes.$end);
  }

  public static function input($file=STDOUT) {
    return fgets($file);
  }

  public static function split($string, $delimetr=' ') {
  	return explode($delimetr, $string);
  }
}


class set {
  private $set;

  public function __construct($values=array()) {
    $this->set = array();
    foreach($values as $value) {
      if(!array_key_exists($value, $hashset)) {
          $this->set[$value] = true;
      }
    }
  }

  public function add($value) {
    $this->set[$value] = true;
  }

  public function pop() {
    if(PP::len($this->set) == 0)
      return null;
    $out = array_rand(array_keys($this->set));
    unset($this->set[$out]);
    return $out;
  }
}
