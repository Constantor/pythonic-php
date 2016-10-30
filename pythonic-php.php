<?php

class PPHP {
  public static function len($obj) {
    if(is_string($obj))
      return strlen($obj);
    if(is_array($obj))
      return count($obj);
  }

  public static function append($array, $obj) {
    return array_push($array, $obj);
  }

  public static function list($string) {
    $out = array();
    for($i = 0; $i < $this::len($string); $i++)
      append($out, $string{$i});
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
    return array_merge($this::sorted($left), $this::sorted($middle), $this::sorted($right));
  }
  
  public static function print($mes, $end="\n", $file=STDOUT) {
    return fwrite($file, $mes.$end);
  }
  
  public static function input($file=STDOUT) {
    return fgets($file);
  }
}
