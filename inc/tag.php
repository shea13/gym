<?php
class tag
{
	public $tagEnable;
	public function __construct()
	{
				$tagEnable = true;
				$this->tagFacebookIframe='
		<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FClub-Gymnique-fosseen%2F177986328909191&amp;layout=standard&amp;show_faces=false&amp;width=600&amp;action=like&amp;font=lucida+grande&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:600px; height:35px;" allowTransparency="true"></iframe>';
		
		$this->tagFacebookScript='
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://www.facebook.com/pages/Club-Gymnique-fosseen/177986328909191" show_faces="false" width="600" font="lucida grande"></fb:like>';
	}
	
	function printTagFacebookIframe ()
	{
		print $this->tagFacebookIframe;
	}
	public function setTagEnable($tagEnable) {
		if(!tagEnable) {$this->tagEnable = false;}
	}

}
?>
