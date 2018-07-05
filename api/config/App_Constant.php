<?php
// request
	//site domain
	define("SiteHost","localhost/");
	//site URL
	define("SiteURL","example.net");
	//api key
	define("apikey","0000");

// Image repository
	//profile Image path
	define ("ProfileImagePath","../client/media/img/profile/");
	//banner Image path
	define ("BannerImagePath","../client/media/img/banner/");
	//Candidate Image path
	define ("CandidateImagePath","../client/media/img/candidate/");

// File repository
	//participant file path
	define ("ParticipantFilePath","../client/media/files/participant/");

//Database
	//associative array fetch type
	// options:- PDO::FETCH_ASSOC or PDO::FETCH_NUM or PDO::FETCH_BOTH
	define("FetchType",PDO::FETCH_ASSOC);	
?>