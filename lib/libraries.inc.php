<?php
/* include core files BEGIN */
# load helpers
foreach (glob(dirname(__FILE__) . '/helpers/*.[pP][hH][pP]') as $file)
	include_once $file;
# load structs
foreach (glob(dirname(__FILE__) . '/structs/*.[pP][hH][pP]') as $file)
	include_once $file;
# load exceptions
foreach (glob(dirname(__FILE__) . '/exceptions/*.[pP][hH][pP]') as $file)
	include_once $file;
# load database engines
foreach (glob(dirname(__FILE__) . '/databases/*.[pP][hH][pP]') as $file)
	include_once $file;
# load core files
foreach (glob(dirname(__FILE__) . '/*.[pP][hH][pP]') as $file)
	include_once $file;
/* include core files  END  */
?>
