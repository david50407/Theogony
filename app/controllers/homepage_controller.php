<?php
class HomepageController extends \Theogony\ActionController\Base
{
	public function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function index(&$_)
	{
		$_->subtitle = "Index";
		
	}
}
?>
