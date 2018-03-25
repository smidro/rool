<?php
	require_once "configG.php";

	if (isset($_SESSION["access_token"])) {
		$gClient->setAccessToken($_SESSION["access_token"]);
	} elseif (isset($_GET["code"])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET["code"]);
		$_SESSION["access_token"] = $token;
	} else {
		header("location: login.php");
		exit();
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();


	$_SESSION["id"] = $userData["id"];
	$_SESSION["email"] = $userData["email"];
	$_SESSION["gender"] = $userData["gender"];
	$_SESSION["picture"] = $userData["picture"];
	$_SESSION["familyName"] = $userData["familyName"];
	$_SESSION["givenName"] = $userData["givenName"];

	header("location: g-profile.php");
	exit();
?>