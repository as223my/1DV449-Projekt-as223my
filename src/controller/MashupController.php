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
	
	public function getList(){
		$html = $this->mashupView->navbar();
		$list = $this->mInfo->getList(); 
		$html .= $this->mashupView->listView($list); 
		$html .= $this->mashupView->scripts(); 
		return $html;
	}

	public function getSearchForm(){

		$content = $this->mashupView->didUserPressSearch();
		$tokenForm = $content[0]; 
		$searchValue = $content[1]; 

		// check if search form was sent. 
		if($content !== null){
			// if token match.
			if($tokenForm === $_SESSION['token'] && $searchValue !== "" && strlen($searchValue) > 1){
				$searchValue = str_replace(" ","+",$searchValue);
				$result = $this->mInfo->getSearchResult($searchValue);

				if($result == null){
					return $this->getSearchView("Sorry, API problems at the moment!");
				}else if(isset($result['Response'])){
					return $this->getSearchView("Sorry, couldn't find what you're looking for!");
				}else{
					$this->allsearchResults = $result; 
					for($i=0; $i < count($this->allsearchResults['Search']); $i++){
						if($this->allsearchResults['Search'][$i]["Poster"] !== "N/A"){
							array_push($this->searchResults, $this->allsearchResults['Search'][$i]);
						}	
					}
					 //get info of each piece. 
					$completeSearchResults = $this->mInfo->getAllDataFromSearch($this->searchResults); 
					for($i=0; $i < count($completeSearchResults); $i++){
						if($completeSearchResults[$i]["Type"] == "series"){
							$nextEpisode = $this->mInfo->getNextEpisode($completeSearchResults[$i]["Title"]);
							if($nextEpisode != null){
								//check next episode from epguides
								array_push($this->epguides, $i);
								array_push($this->epguides, $nextEpisode["episode"]["title"]);
								array_push($this->epguides, $nextEpisode["episode"]["release_date"]); 
							}
						}
					} 
				
					$this->mInfo->saveSearchTofile($completeSearchResults); 
					return $this->getSearchResultView($completeSearchResults, $this->epguides); 
				}
			}
		}
		return $this->getSearchView(""); 
	}

	public function getSearchView($message){
		// new token
		$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));

		$html = $this->mashupView->navbar();
		$html .= $this->mashupView->searchView($token, $message); 
		$html .= $this->mashupView->scripts(); 
		return $html;
	}

	public function getSearchResultView($completeResults, $epguides){
		// new token
		$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
		$message = ""; 

		$html = $this->mashupView->navbar();
		$html .= $this->mashupView->searchView($token, $message); 
		$html .= $this->mashupView->displaySearchResult($completeResults, $epguides); 
		$html .= $this->mashupView->scripts(); 
		return $html;

	}
}