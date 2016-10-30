<?php

function len($obj) {
  if(is_string($obj))
    return strlen($obj);
  if(is_array($obj))
    return count($obj);
}

function append($array, $obj) {
  return array_push($array, $obj);
}

function arr($obj=0, $default=0) {
	if($obj == 0)
		return array();
	if(is_int($obj)) {
		$out = array();
		for($i = 0; $i < $obj; $i++)
			$this::append($out, $default);
		return $out;
	}
  $out = array();
  for($i = 0; $i < $this::len($obj); $i++)
    $this::append($out, $obj{$i});
  return $out;
}

function str($obj) {
  if(is_array($obj)) {
    $out = '';
    foreach($obj as $el)
      $this::append($out, $el);
    return $out;
  }
  return $obj.'';
}

function bin($n) {
  $cur = abs($n);
  if($cur == 0 or $cur == 1) return '0b'.$n;
  $out = array();
  do {
    $this::append($out, $cur % 2);
    $cur = intval($cur / 2);
  } while($cur != 0);
  return '0b1'.str($this::reversed($out));
}

function sum($array) {
  $out = 0;
  foreach($array as $el) {
    $out += $el;
  }
  return $out;
}

function map($function, $array) {
  $out = array();
  foreach($array as $el)
    $this::append($out, $function($el));
  return $out;
}

function reversed($array) {
  $out = array();
  for($i = $this::len($array); $i >= 0; $i--)
    $this::append($out, $array[$i]);
  return $out;
}

public function reverse(&$array) {
  $array = $this::reversed($array);
}

function sorted($array) {
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
      append($left, $el);
    else
      append($middle, $el);
  }
  return array_merge($this::sorted($left), $middle, $this::sorted($right));
}

function sort(&$array) {
	$array = $this::sorted($array);
}

function printp($mes, $end="\n", $file=STDOUT) {
  return fwrite($file, $mes.$end);
}

function input($file=STDOUT) {
  return fgets($file);
}

function split($string, $delimetr=' ') {
	return explode($delimetr, $string);
}

function num($str) {
  return $str + 0;
}


class set {
  protected $set;

  public function __construct($values=array()) {
    $this->set = array();
    foreach($values as $value)
      if(!array_key_exists($value, $this->set))
          $this->set[$value] = true;
  }

  public function add($value) {
    if(!array_key_exists($value, $this->set))
      $this->set[$value] = true;
  }

  public function pop() {
    if(PP::len($this->set) == 0)
      return null;
    $out = array_rand(array_keys($this->set));
    unset($this->set[$out]);
    return $out;
  }

  public function arr() {
    return array_keys($this->set);
  }
}
