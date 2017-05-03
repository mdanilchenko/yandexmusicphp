<?php
class Searcher{
	private $query;
	private $page;
	
	public function __construct($query,$page=0){
		$this->query = $query;
		$this->page = $page;
	}
	public function getQuery(){
		return $this->query;
	}
	public function setQuery($query){
		$this->query=$query;
	}
	public function getPage(){
		return $this->page;
	}
	public function setPage($page){
		$this->page = $page;
	}
	public function getResults(){
		$results = array();
		$search = Functions::requestURL('https://api.music.yandex.net/search?type=track&text='.urlencode($this->query).'&page='.$this->page,null);
		$search_res = json_decode($search,true);
		if(($search_res!==FALSE) and isset($search_res['result']['tracks']['results'])){
			$tracksInfo= $search_res['result']['tracks']['results'];
			for($i=0;$i<count($tracksInfo);$i++){
				$results[]=Track::fromAPI($tracksInfo[$i]);
			}
		}
		return $results;
	}
}