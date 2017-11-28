<?php
require_once "class.http.api.php";
require_once "trait.youtube.parser.php";

class  youtubeApiService extends httpServicesAPI
{
  use youtubeParser;
  protected $api_url="https://www.googleapis.com/youtube/v3/videos";
	protected $apikey;
  protected $header=[];

  public function __construct()
  {

  }

  public function set_param($param)
	{
    $this->apikey = $param;
	}

  public function search($data, $do_set_options=TRUE)
  {
    $this->do_set_options();
    $param = $this->parse_request($data);
    $resp=$this->get_api($this->api_url.'?'.$param.$this->apikey);
    $result = $this->parse_response($resp);
    return $result;
  }

  public function search_multiple($data, $do_set_options=TRUE)
  {
    $this->do_set_options();
    $param = $this->parse_request_multiple($data);
    $resp=$this->get_api($this->api_url.'?'.$param.$this->apikey);
    $result = $this->parse_multiple_response($resp, $data);
    return $result;
  }

  private function post_api($url, $data = [], $redirectLoc=false) {
    $request = $this->post($url, $data, $redirectLoc);
    return ["error"=>0, "data"=>$result];
  }

  private function get_api($url, $redirectLoc=false) {
    $request = $this->get($url);
    return ["error"=>0, "data"=>$result];
  }
}
