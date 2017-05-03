<?php
class Track{
	private $id;
	private $available;
	private $albumId;
	private $duration;
	private $title;
	private $artist;
	
	public function __construct($id,$available,$albumId,$duration,$title,$artist){
		$this->id = $id;
		$this->available = $available;
		$this->albumId = $albumId;
		$this->duration = $duration;
		$this->title = $title;
		$this->artist = $artist;
	}
	public static function fromAPI($row){
		$albumId = 0;
		if(isset($row['albums'][0]['id'])){
			$albumId = $row['albums'][0]['id'];
		}
		$artist = '';
		if(isset($row['artists'][0]['name'])){
			$artist = $row['artists'][0]['name'];
		}
		return new Track($row['id'],$row['available'],$albumId,$row['durationMs'],$row['title'],$artist);
	}
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id=$id;
	}
	public function getAvailable(){
		return $this->available;
	}
	public function setAvailable($available){
		$this->available=$available;
	}
	public function getAlbumId(){
		return $this->albumId;
	}
	public function setAlbumId($albumId){
		$this->albumId=$albumId;
	}
	public function getDuration(){
		return $this->duration;
	}
	public function setDuration($duration){
		$this->duration=$duration;
	}
	public function getTitle(){
		return $this->title;
	}
	public function setTitle($title){
		$this->title=$title;
	}
	public function getArtist(){
		return $this->artist;
	}
	public function setArtist($artist){
		$this->artist=$artist;
	}
}