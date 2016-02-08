<?php

require_once("./src/view/MashupView.php");
require_once("./src/model/MovieInformation.php");
	
class MashupController{

	private $mashupView; 
	private $mInfo; 
	private $allsearchResults; 
	private $searchResults = []; 
	private $epguides = []; 
	
	public function __construct(){

		$this->mashupView = new \MashupView();
		$this->mInfo = new \MovieInformation();
	}
	
	// Get search content. 
	public function getSearchContent(){
		$content = $this->mashupView->didUserPressSearch();
		$tokenForm = $content[0]; 
		$searchValue = $content[1]; 

		// Check if search form was sent. 
		if($content !== null){
			if($tokenForm === $_SESSION['token'] && $searchValue !== "" && strlen($searchValue) > 1){
				$searchValue = str_replace(" ","+",$searchValue); // Replace space with +, needed for omdb-api. 
				$result = $this->mInfo->getSearchResult($searchValue);

				if($result == null){
					return $this->getSearchView("Sorry, API problems at the moment!"); // If something goes wrong with the api. 
				}else if($result['Response'] == "False"){
					return $this->getSearchView("Sorry, couldn't find what you're looking for!"); // Movie or tv-show didn't exist. 
				}else{
					$this->allsearchResults = $result; 
					// Decided to only include search results with posters. 
					for($i=0; $i < count($this->allsearchResults['Search']); $i++){
						if($this->allsearchResults['Search'][$i]["Poster"] !== "N/A"){
							array_push($this->searchResults, $this->allsearchResults['Search'][$i]);
						}	
					}
					
					// Get more information of each movie/tv-show. 
					$completeSearchResults = $this->mInfo->getAllDataFromSearch($this->searchResults); 
					for($i=0; $i < count($completeSearchResults); $i++){
						if($completeSearchResults[$i]["Type"] == "series"){
							$this->checkEpisode($completeSearchResults, $i);
						}
					} 
				
					$this->mInfo->saveSearchTofile($completeSearchResults); 
					return $this->getSearchResultView($completeSearchResults, $this->epguides); 
				}
			}
		}
		return $this->getSearchView(""); 
	}

	// If no search was done or something failed along the way. 
	public function getSearchView($message){
		// New token
		$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));

		$html = $this->mashupView->navbar();
		$html .= $this->mashupView->searchView($token, $message); 
		$html .= $this->mashupView->scripts(); 
		return $html;
	}

	// If search was successful. 
	public function getSearchResultView($completeResults, $epguides){
		// New token
		$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
		$message = ""; 

		$html = $this->mashupView->navbar();
		$html .= $this->mashupView->searchView($token, $message); 
		$html .= $this->mashupView->searchResult($completeResults, $epguides); 
		$html .= $this->mashupView->scripts(); 
		return $html;
	}

	// Get list of selected movies & tv-shows.
	public function getList(){
		$html = $this->mashupView->navbar();
		$list = $this->mInfo->getList(); 
		for($i=0; $i<count($list); $i++){
			if($list[$i]["Type"] == "series"){
				$this->checkEpisode($list, $i);
			}	
		}

		$html .= $this->mashupView->listView($list, $this->epguides); 
		$html .= $this->mashupView->scripts();
		return $html;
	}

	// Check next episode from epguides-api.
	public function checkEpisode($result, $i){
		$nextEpisode = $this->mInfo->getNextEpisode($result[$i]["Title"]);
		if($nextEpisode != null){
			$arr = array();

			array_push($arr, $result[$i]["Title"]);
			array_push($arr, $nextEpisode["episode"]["title"]);
			array_push($arr, $nextEpisode["episode"]["release_date"]);

			array_push($this->epguides, $arr);
			// Check next episode from epguides-api. 
		/*	array_push($this->epguides, $i);
			array_push($this->epguides, $nextEpisode["episode"]["title"]);
			array_push($this->epguides, $nextEpisode["episode"]["release_date"]); */
		}
	}
}