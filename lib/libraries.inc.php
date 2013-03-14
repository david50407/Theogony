<?php
/* include core files BEGIN */
# load structs first
foreach (glob(dirname(__FILE__) . '/structs/*.[pP][hH][pP]') as $file)
	include_once $file;
# load exceptions then
foreach (glob(dirname(__FILE__) . '/exceptions/*.[pP][hH][pP]') as $file)
	include_once $file;
# loading database engines
foreach (glob(dirname(__FILE__) . '/databases/*.[pP][hH][pP]') as $file)
	include_once $file;
# loading core files
foreach (glob(dirname(__FILE__) . '/*.[pP][hH][pP]') as $file)
	include_once $file;
/* include core files  END  */
?>
