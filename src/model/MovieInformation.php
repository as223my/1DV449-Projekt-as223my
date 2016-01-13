<?php

class MovieInformation{

	private $urlOmdbAll;
	private $urlOmdbIndividual; 
	private $urlEpguides = ""; 
	private $searchWord = ""; 
	private $imdbId = "";
	private $fullSearchResults = []; 

	public function __construct(){
		$this->urlOmdbAll = "http://www.omdbapi.com/?s=$this->searchWord&r=json";  
		$this->urlOmdbIndividual = "http://www.omdbapi.com/?i=$this->imdbId&plot=short&r=json"; 
		$this->urlEpguides = "http://epguides.frecar.no/show/$this->urlEpguides/next/"; 
	}

	public function getSearchResult($search){

		$this->searchWord = strip_tags($search);
		$this->switchSearchWord($this->searchWord); 

		$result = $this->getData($this->urlOmdbAll); 
		return json_decode($result, true);

	}

	public function getAllDataFromSearch($searchResult){
		for($i=0; $i < count($searchResult); $i++){
			$this->switchImdbId($searchResult[$i]["imdbID"]); 
			$result = $this->getData($this->urlOmdbIndividual);
			array_push($this->fullSearchResults, json_decode($result, true));
		}

		return $this->fullSearchResults;
	}

	public function switchSearchWord($searchWord){
		$this->urlOmdbAll = "http://www.omdbapi.com/?s=$searchWord&r=json";  
	}

	public function switchImdbId($imdbid){
		$this->urlOmdbIndividual = "http://www.omdbapi.com/?i=$imdbid&plot=short&r=json";  
	}

	public function switchTitle($title){
		$this->urlEpguides = "http://epguides.frecar.no/show/$title/next/"; 
	}

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
}