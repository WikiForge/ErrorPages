
<?php

if ( !$wgCommandLineMode ) {
	http_response_code( 404 );

	$centralServer = $wi->wikifarm === 'wikitide' ?
		'meta.wikitide.com' :
		'meta.wikiforge.net';

	$logoUrl = $wi->wikifarm === 'wikitide' ?
		'https://static.wikiforge.net/commonswikitide/2/22/WikiTide_icon.svg' :
		'https://static.wikiforge.net/metawiki/8/88/WikiForge_Logo.svg';
	$logoAltText = $wi->wikifarm === 'wikitide' ?
		'WikiTide Logo' :
		'WikiForge Logo';

	$requestWikiUrl = $wi->wikifarm === 'wikitide' ?
		'https://meta.wikitide.com/wiki/Special:RequestWiki?wpsubdomain=' . substr( $wgDBname, 0, -8 ) :
		'https://meta.wikiforge.net/wiki/Special:RequestPremiumWiki?wpsubdomain=' . substr( $wgDBname, 0, -4 );

	$output = <<<EOF
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0" />
				<meta name="description" content="Wiki Not Found" />
				<title>Wiki Not Found</title>
				<link rel="icon" type="image/x-icon" href="https://{$centralServer}/favicon.ico" />
				<link rel="apple-touch-icon" href="https://{$centralServer}/apple-touch-icon.png" />
				<!-- Bootstrap core CSS -->
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
				<style>
					/* Error Page Inline Styles */
					body {
						padding-top: 20px;
					}
					/* Layout */
					.jumbotron {
						font-size: 21px;
						font-weight: 200;
						line-height: 2.1428571435;
						color: inherit;
						padding: 10px 0px;
						text-align: center;
						background-color: transparent;
					}
					/* Everything but the jumbotron gets side spacing for mobile-first views */
					.body-content {
						padding-left: 15px;
						padding-right: 15px;
					}
					/* button */
					.jumbotron .btn {
						font-size: 21px;
						padding: 14px 24px;
					}
					/* Bottom links */
					.bottom-links {
						display: flex;
						justify-content: space-between;
						margin: 30px auto;
						padding-left: 10px;
						max-width: 100%;
						text-align: center;
						width: 600px;
					}
					/* Dark mode */
					@media (prefers-color-scheme: dark) {
						body {
							background-color: #282828;
						}
						h1, p {
							color: white;
						}
					}
				</style>
			</head>
			<div class="container">
				<!-- Jumbotron -->
				<div class="jumbotron">
					<img src="{$logoUrl}" width="130" height="130" alt="{$logoAltText}" />
					<h1>Wiki Not Found</h1>
					<p class="lead">We couldn't find this wiki. Check your spelling and try again.</p>
					<p>
						<a href="{$requestWikiUrl}" class="btn btn-lg btn-outline-primary" role="button">Request the Wiki</a>
					</p>
				</div>
			</div>
			<div class="bottom-links">
				<a href="#" onClick="history.go(-1); return false;">&larr; Return Whence You Came</a>
			</div>
		</html>
	EOF;
	header( 'Content-length: ' . strlen( $output ) );
	echo $output;
	die( 1 );
} else {
	// $wgDBname will always be set to a string, even if the --wiki parameter was not passed to a script.
	echo "The wiki database '{$wgDBname}' was not found." . PHP_EOL;
}
