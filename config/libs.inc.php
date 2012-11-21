<?php

require_once dirname(__FILE__) . '/routes_core.php';
foreach (glob(dirname(__FILE__) . '/../lib/exceptions/*.[pP][hH][pP]') as $file)
	include_once $file;
foreach (glob(dirname(__FILE__) . '/../lib/actioncontroller/*.[pP][hH][pP]') as $file)
	include_once $file;

?>
