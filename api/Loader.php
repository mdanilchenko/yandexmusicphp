<?php
class Loader{
	private $track;
	private $salt = "XGRlBW9FXlekgbPrRHuSiA";
	public function __construct(Track $track){
		$this->track = $track;
	}
	public function getTrack(){
		return $this->track;
	}
	public function setTrack($track){
		$this->track=$track;
	}
	public function getLoadInfo(){
		$url = null;
		$bitrate = 0;
		$track = Functions::requestURL('https://music.yandex.ru/api/v2.1/handlers/track/'.$this->track->getId().'/track/download/m?hq=1',null);
		$data = json_decode($track,true);
		if(isset($data['src'])){
			$downloadInfo = json_decode(file_get_contents($data['src'].'&format=json'),true);
			$hash = md5($this->salt.substr($downloadInfo['path'],1).$downloadInfo['s']);
			$url = 'https://'.$downloadInfo['host'].'/get-mp3/'.$hash.'/'.$downloadInfo['ts'].$downloadInfo['path'];
		}
		if(isset($data['bitrate'])){
			$bitrate = $data['bitrate'];
		}
		return array('url'=>$url,'size'=>$bitrate*$this->track->getDuration(),'bitrate'=>$bitrate);
	}
}