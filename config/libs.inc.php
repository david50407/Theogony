<?php
# load core files
require_once dirname(__FILE__) . '/../lib/libraries.inc.php';
require_once dirname(__FILE__) . '/config.inc.php';

# load models
foreach (glob(dirname(__FILE__) . '/../app/models/*.[pP][hH][pP]') as $file)
	include_once $file;

# load plugins
/* TODO: make plugins work */
?>
