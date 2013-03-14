<?php
class HomepageController extends \Theogony\ControllerBase
{
	public function index(&$_)
	{
		$_->subtitle = "Index";
		
		# grab articles: limit=5
		#$_->articles = Post::limit(5);
	}
}
?>
