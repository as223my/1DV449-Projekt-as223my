<?php

class MovieInformation{

	private $urlOmdbAll;
	private $urlOmdbIndividual;
	private $urlPoster; 
	private $apiKey = "[APIKEY]";  
	private $urlEpguides = ""; 
	private $searchWord = ""; 
	private $imdbId = "";
	private $imdbIdPoster = "";
	private $fullSearchResults = []; 
	private $filepathSearch; 
	private $filepathList;

	public function __construct(){
		$this->urlOmdbAll = "https://www.omdbapi.com/?s=$this->searchWord&r=json";  
		$this->urlOmdbIndividual = "https://www.omdbapi.com/?i=$this->imdbId&plot=short&r=json"; 
		$this->urlPoster = "https://img.omdbapi.com/?i=$this->imdbIdPoster&apikey=$this->apiKey"; 
		$this->urlEpguides = "https://epguides.frecar.no/show/$this->urlEpguides/next/"; 
		$this->filepathSearch = "src/model/search.json";
		$this->filepathList = "src/model/list.json";
	}

	public function switchSearchWord($searchWord){
		$this->urlOmdbAll = "https://www.omdbapi.com/?s=$searchWord&r=json";  
	}

	public function switchImdbId($imdbid){
		$this->urlOmdbIndividual = "https://www.omdbapi.com/?i=$imdbid&plot=short&r=json";  
	}
	public function switchImdbIdPoster($imdbidPoster){
		$this->urlPoster = "https://img.omdbapi.com/?i=$imdbidPoster&apikey=$this->apiKey";   
	}

	public function switchTitle($title){
		$this->urlEpguides = "https://epguides.frecar.no/show/$title/next/"; 
	}

	// Get search result from omdb-api. 
	public function getSearchResult($search){
		$this->searchWord = strip_tags($search);
		$this->switchSearchWord($this->searchWord); 

		$result = $this->getData($this->urlOmdbAll); 
		return json_decode($result, true);
	}

	// Get all information for each movie/tv-show from omdb-api. 
	public function getAllDataFromSearch($searchResult){

		for($i=0; $i < count($searchResult); $i++){
			$this->switchImdbId($searchResult[$i]["imdbID"]); 
			$this->switchImdbIdPoster($searchResult[$i]["imdbID"]); 

			$result = $this->getData($this->urlOmdbIndividual);
			
			$newResult = json_decode($result, true);

			$newResult['Poster'] = $this->urlPoster; //Change imdb hotlink to omdb for posters.
		    
			array_push($this->fullSearchResults, $newResult);
		}
		return $this->fullSearchResults;
	}

	// Get information for next tv-show episode from epguides-api. 
	public function getNextEpisode($title){
		$this->switchTitle($title);
		$result = $this->getData($this->urlEpguides);
		return json_decode($result, true);
	}

	public function getData($url){
		header('Content-Type:text/html; charset=utf-8');
		$ch = curl_init(); 

		curl_setopt($ch, CURLOPT_URL ,$url); 
	
		// talar om att det vi hämtar hem inte ska skrivas ut direkt.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
		// identifierar mig. 
		curl_setopt($ch, CURLOPT_USERAGENT,"as223my"); 
		$data = curl_exec($ch);
		curl_close($ch); 
	
		return $data;
	}

	// Save complete result from the search in a file. 
	public function saveSearchTofile($completeSearchResults){
		$jsonfile = fopen($this->filepathSearch, "w+");
		fwrite($jsonfile, json_encode($completeSearchResults));
		fclose($jsonfile);	
	}

	// Get saved movie/tv-shows from file. 
	public function getList(){
		$fileSize = filesize($this->filepathList);
		if($fileSize){
			$file = fopen($this->filepathList, "r+");
			$content = fread($file,filesize($this->filepathList)); 
			fclose($file);

			//If list is tampered with. 
			if(json_decode($content,true) === null){
				$this->emptyList();
			}
			return json_decode($content, true);
		}
		
		$this->emptyList();
		return null;
	}

	public function emptyList(){
		$file = fopen($this->filepathList, "w+");
		fwrite($file, "null");
		fclose($file);
	}
}