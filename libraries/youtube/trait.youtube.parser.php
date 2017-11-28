<?php
trait youtubeParser
{
  public $url_parser;
  public $no_induk;

  private function change_date_response($date)
  {
    $result = DateTime::createFromFormat('Y-m-d', $date);
    return $result->format('Y-m-d H:i:s');
  }

  /*
  * Use to list single video_id
  */
  public function parse_request($data)
  {
    $arr = explode("watch?v=", $data);
    $video_id = $arr[1];
    return "id=".$video_id."&part=snippet%2CcontentDetails%2Cstatistics&key=";
  }

  /*
  * Use to list multiple video_id
  */
  public function parse_request_multiple($data)
  {
    $obj = [];
    foreach ($data as $key => $value) {
      $arr = explode("watch?v=", $value['video_url']);
      $obj[]=$arr[1];
    }

    $video_id = implode("%2C", $obj);
    $resp = "id=".$video_id."&part=snippet%2CcontentDetails%2Cstatistics&key=";
    return $resp;
  }

  public function parse_response($resp)
  {
    //Condition when url not valid or youtube api v3 not give any response
    if ($resp['data']==null)
    {
      return ['error'=>404, 'message'=>'Data from youtube not found'];
    }
    else
    {
      return ['error'=>0, 'data'=>$resp['data']];
    }
  }

  public function parse_multiple_response($resp, $data)
  {
    //Condition when url not valid or youtube api v3 not give any response
    if ($resp['data']==null)
    {
      return ['error'=>404, 'message'=>'Data from youtube not found'];
    }
    else
    {
      $resp['data']->attribute=$data;
      return ['error'=>0, 'data'=>$resp['data']];
    }
  }
}
