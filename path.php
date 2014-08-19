<?php

namespace Donut\Path;

define("DS", \DIRECTORY_SEPARATOR);

function is_absolute($path) {
  return substr($path, 0, 1) === DS;
}

function join() {
  $parts = func_get_args();
  return implode(DS, $parts);
}

function normalize($path) {
  $is_absolute = is_absolute($path);

  $parts = array_filter(explode(DS, $path), function($part) {
    return strlen($part) !== 0 && $part !== ".";
  });

  $out = implode(DS, $parts);

  if (strlen($out) === 0 && !$is_absolute) {
    $out = ".";
  }

  return sprintf("%s%s", ($is_absolute ? DS : ""), $out);
}
