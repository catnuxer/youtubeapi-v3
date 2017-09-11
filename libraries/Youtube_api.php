<?php
/*
* Write by catnuxer
* Email jimmi.ext@gmail.com
* Feel free to use :thumsup
*/
require_once "youtube/class.youtube.api.php";

class Youtube_api
{
	protected $lib;

	public function __construct()
  	{
		$this->lib=new youtubeApiService();
		$ci=&get_instance();
		$this->lib->set_param(YOUR_YOUTUBE_API_KEY_V3); //Set your youtube api key v3 here.
  	}

	public function get_videoId($data)
	{
		return $this->lib->search($data);
	}

	public function get_multiple_videoId($data)
	{
		return $this->lib->search_multiple($data);
	}
}
