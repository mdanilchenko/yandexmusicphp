# Yandex API Player (PHP and CURL)
PHP classes to work with Yandex Music.
**Funcitonality:**
- query search with pagination;
- receiweing track information;
- listening/downloading;

## Structure

### Track Class (api/Track.php)
Stores information about track and contains:
**Params:**
```
    id:Integer                  -   Yandex track ID
    available:Integer(0 or 1)   -   is available for listening
    albumId:Integer             -   first album id, containing current track
    duration:Integer            -   track duration in mils
    title:String                -   track title
    artist:String               -   first artist name
```
*Need more information abount track? - Just look at Searcher->getResult() method and view raw CURL response.*

### Searcher Class (api/Searcher.php)
Searching tracks for passed query string and contains:
**Params:**
```
    query:String                -   query string
    page:Integer                -   results page number (0-default)
```
**Methods:**
```
    Array of Track = getResults() - returns Tracks array for selected search options        
```
**Usage:**
```
    $searcher = new Searcher('Artist Title');
    $results = $searcher->getResults();
    print_r($results);
```

### Loader Class (api/Loader.php)
Get donload needed information for single Track and contains:
**Params:**
```
    track:Track                -    Track object
```
**Methods:**
```
    Array = getLoadInfo() - returns asocarray containing
                            'url':String        - download url
                            'size':Integer      - file size in bytes
                            'bitrate':Integer   - bitrate
```
**Usage:**
```
    $loader = new Loader(new Track(...));
    $info = $loader->getLoadInfo();	
    print_r($results);
```

### Functions Class (api/Functions.php)
Contains helping functions for requests and download
**Methods:**
```
    String requestURL($url,$params)     - Executes CURL request and returns response
    void serveTrack($url,$size)         - Server file to user (as mp3 file)
```

For working Example see **example.php**

## License
This project provided as is. Feel free to use and modify it for personal use.
Commercial use of this code  may break some laws of your country. The author is not responsible for the use of the project, resulted in violation of any laws. 