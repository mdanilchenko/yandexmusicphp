<?php
class Functions{
	public static function requestURL($url,$params=null){
		$isPost = true;
		if(is_null($params)){
			$isPost = false;
		}
		$curl = curl_init();
			curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);      
			curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl,CURLOPT_AUTOREFERER, true);
			curl_setopt($curl,CURLOPT_POST,$isPost );
			//curl_setopt ( $curl, CURLOPT_COOKIEFILE,  $cookie );
			//curl_setopt ( $curl, CURLOPT_COOKIEJAR,  $cookie );
			curl_setopt($curl,CURLOPT_NOBODY, false);
			curl_setopt($curl,CURLOPT_HEADER, false);
			curl_setopt($curl,CURLOPT_ENCODING, "");
			curl_setopt($curl,CURLOPT_TIMEOUT, 30);
			curl_setopt($curl,CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($curl,CURLOPT_MAXREDIRS, 5);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8', 'Accept-Encoding:gzip, deflate, sdch', 'Accept-Language: ru', 'Accept-Charset: utf-8', 'user-agent: Opera/4.1(Opera Mini/7.1)','x-retpath-y:https%3A%2F%2Fmusic.yandex.ru%2F')); //��������� ������ ����������, �� User-Agent ������ ���������� ���������. ��� ����� � ��������� ������ �� ��� ������ �������� ������� �����, ��� � ������.
			curl_setopt($curl,CURLOPT_URL, $url);
			if($isPost){
				curl_setopt($curl,CURLOPT_POSTFIELDS, $params);
			}
			$page = curl_exec($curl);
		return $page;
	}
	public static function serveTrack($url,$size){
		header('Content-type: audio/mpeg');
		header('Content-Length: ' . $size);
		header("Content-Range: 0-".($size-1)."/".$size);
		header('Content-Disposition: filename="'.self::generateRandomString(10).'.mp3');
		header('X-Pad: avoid browser bug');
		header('Cache-Control: no-cache');
		readfile($url);
	}
	private static function generateRandomString($number){
	  $arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
	  $pass = "";
	  for($i = 0; $i < $number; $i++)
	  {
		$index = rand(0, count($arr) - 1);
		$pass .= $arr[$index];
	  }
	  return $pass;
	}
}