<?php
//Setting up autoloader
function autoloader($class) {
    include 'api/' . $class . '.php';
}
spl_autoload_register('autoloader');

$searcher = new Searcher($_GET['q']); //Prepare searcher
$results = $searcher->getResults();	//Get results for query
if(isset($results[0])){
	$loader = new Loader($results[0]);	//Selecting first result if found
	$info = $loader->getLoadInfo();		//Get bitrate and download link for selected Track
	if(!empty($info['url'])){
		Functions::serveTrack($info['url'],$info['size']); //Serve mp3 file to user
	} 
}

?>