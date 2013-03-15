<?php
class HomepageController extends \Theogony\ControllerBase
{
	public function index(&$_)
	{
		$_->subtitle = "Index";
		
		# grab slides: limit=5
		$_->slides = Slide::limit(5);
	}
}
?>
