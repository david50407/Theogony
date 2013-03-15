<?php
class HomepageController extends \Theogony\ControllerBase
{
	public function index(&$_)
	{
		# grab slides: limit=5
		$_->slides = Slide::all();
	}
}
?>
