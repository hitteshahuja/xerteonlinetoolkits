<?php
require_once($xerte_toolkits_site->tsugi_dir . "/config.php");
			
use \Tsugi\Core\LTIX;
use \Tsugi\Core\Settings;
use \Tsugi\Util\Net;
use \Tsugi\Grades\GradeUtil;

$LAUNCH = LTIX::requireData();
$USER = $LAUNCH->user;
if(isset($_POST['grade']))
{
	$grade = $_POST['grade'];
	if(is_numeric($grade) && $grade >= 0 && $grade <= 1.0)
	{
		$LAUNCH->result->gradeSend($grade);
	}
	exit();
}

?>
<!DOCTYPE html>
<!--
/**
 * Licensed to The Apereo Foundation under one or more contributor license
 * agreements. See the NOTICE file distributed with this work for
 * additional information regarding copyright ownership.

 * The Apereo Foundation licenses this file to you under the Apache License,
 * Version 2.0 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at:
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.

 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
 -->

<!--[if IEMobile 7 ]><html class="no-js iem7"><![endif]-->
<!--[if lt IE 9]><html class="no-js lt-ie9"><![endif]-->
<!--[if IE 9]><html class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--[if !HTML5]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->

	<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script><!--http://bit.ly/17XnmNe-->

	<title>%TITLE%</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

	<meta name="viewport" id="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=10.0, initial-scale=1.0" />

	<link rel="stylesheet" href="%TEMPLATEPATH%common_html5/css/smoothness/jquery-ui-1.8.18.custom.css%VERSION_PARAM%" type="text/css" />
	<link rel="stylesheet" href="%TEMPLATEPATH%common_html5/css/themeStyles.css%VERSION_PARAM%" type="text/css" />
	<link rel="stylesheet" href="%TEMPLATEPATH%common_html5/css/mainStyles.css%VERSION_PARAM%" type="text/css" />
	<link rel="stylesheet" href="%TEMPLATEPATH%common_html5/mediaelement/mediaelementplayer.min.css%VERSION_PARAM%" />
	
	<link href="%TEMPLATEPATH%common_html5/font-awesome/css/font-awesome.min.css%VERSION_PARAM%" rel="stylesheet">
    <link href="%TEMPLATEPATH%common_html5/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
	
    %OFFLINESCRIPTS%

	<script>
		var username = "<?php echo $USER->email; ?>";
        <?php
        if($row["tsugi_xapi_enabled"]){
        ?>
		var lrsEndpoint = "<?php echo $row["tsugi_xapi_endpoint"]; ?>";
        var lrsUsername = "<?php echo $row["tsugi_xapi_key"]; ?>";
        var lrsPassword = "<?php echo $row["tsugi_xapi_secret"]; ?>";
        <?php
        }
        ?>
	</script>

</head>

<body onload = "XTInitialise();" onbeforeunload = "XTTerminate();">
	<noscript>This Learning Object requires JavaScript!</noscript>
	<div id="x_mainHolder" style="visibility:hidden;">

		<div id="x_mobileScroll">
			<div id="x_headerBlock" role="banner">
				<div>
					<h1> </h1>
					<h2 aria-live="assertive"> </h2>
				</div>
			</div>

			<div id="x_pageHolder" role="main">
				<div id="x_helperText" class="ui-helper-hidden-accessible"></div>
				<div id="x_pageDiv"></div>
			</div>
		</div>

		<div id="x_footerBlock" role="navigation">
			<div id="x_footerBg"></div>
			<div class="x_floatLeft">
				<button id="x_colourChangerBtn"></button>
			</div>
			<div id="x_footerRight" class="x_floatRight">
				<button id="x_menuBtn"></button>
				<div id="x_pageControls">
					<button id="x_prevBtn"></button>
					<div id="x_pageNo"></div>
					<button id="x_nextBtn"></button>
				</div>
			</div>
		</div>

		<div id="x_background" aria-hidden="true"></div>

    </div>

    %OFFLINEINCLUDES%

    <script src="%TEMPLATEPATH%common_html5/js/jquery-1.9.1.min.js"></script>

	<!-- <script>window.jQuery || document.write('<script src="%TEMPLATEPATH%common_html5/js/jquery-1.7.1.min.js"><\/script>')</script> -->
    <!-- <script type="text/javascript" src="%TEMPLATEPATH%common_html5/js/jquery-ui-1.8.18.custom.min.js"></script> -->
    <script type="text/javascript" src="%TEMPLATEPATH%common_html5/js/jquery-ui-1.10.4.min.js"></script>

    <script type="text/javascript" src="%TEMPLATEPATH%common_html5/js/jquery.ui.touch-punch.min.js%VERSION_PARAM%"></script>			<!-- allows jQuery components to work on touchscreen devices -->
    <script type="text/javascript" src="%TEMPLATEPATH%common_html5/js/imageLens.js%VERSION_PARAM%"></script>							<!-- for creating magnifiers on images -->
	<script type="text/javascript" src="%TEMPLATEPATH%common_html5/js/gray-gh-pages/js/jquery.gray.min.js%VERSION_PARAM%"></script>	<!-- for greyscale on images -->
    <script type="text/javascript" src="%TEMPLATEPATH%common_html5/mediaelement/mediaelement-and-player.js%VERSION_PARAM%"></script>	<!-- for audio & video players -->
    <script type="text/javascript" src="%TEMPLATEPATH%common_html5/js/mediaPlayer.js%VERSION_PARAM%"></script>
    <script type="text/javascript" src="%TEMPLATEPATH%common_html5/js/swfobject.js"></script>
    <script type="text/javascript" src="%TEMPLATEPATH%common_html5/js/xenith.js%VERSION_PARAM%"></script>
    %TRACKING_SUPPORT%
    <script type="text/javascript" async src="%MATHJAXPATH%MathJax.js?config=TeX-MML-AM_HTMLorMML-full"></script>

    <script type="text/javascript">
        function getUrlVars() {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split(/[#&]/);
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }
        var FileLocation = "%XMLPATH%";
        var x_templateLocation = "%TEMPLATEPATH%";
        var x_projectXML = "%XMLFILE%";
        var x_themePath = "%THEMEPATH%";
        var x_startPage = {type : "page", ID : "1"};
		if (getUrlVars()['resume'])
        {
            x_startPage = {type : "resume", ID : getUrlVars()['resume']};
        }
        else if (getUrlVars()['linkID'])
        {
            x_startPage = {type : "linkID", ID : getUrlVars()['linkID']};
        }
        else if (getUrlVars()['pageID'])
        {
            x_startPage = {type : "pageID", ID : getUrlVars()['pageID']};
        }
        else if (getUrlVars()['page'])
        {
            x_startPage = {type : "page", ID : getUrlVars()['page']};
        }
        var x_youtube_api_key = "%YOUTUBEAPIKEY%";
		var x_Version = "%VERSION%";
    </script>
</body>
</html>
