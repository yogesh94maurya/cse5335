<html>
	<head>
		<title>
			Programming Assignment 8 - Using Cloud Storage
		</title>
		<style>
			.uploadForm{
				border: 2px dashed #eee;
				width: 25%;
				padding: 10px 10px;
				margin: auto;
				text-align: center;
			}
			#imgList{
				list-style: none;
				padding: 5px;
			}
			.list{
				width: 25%;
				float: left;
				border: 2px dashed #eee;
				padding: 0px 10px;
			}
			.imgWindow{
				width: 70%; 
				float:left; 
				text-align: center; 
				min-height: 300px;
				border: 2px dashed #eee;
				margin-left: calc(4% - 16px);
			}
			.removeBtn{
				width: 20px;
			}
		</style>
	</head>
	<body>
		<h1 align="center">Programming Assignment 8 - Using Cloud Storage</h1>
		<hr />
		<form class="uploadForm" action="album.php" method="POST" enctype="multipart/form-data">
			<h3>Upload File here</h3>
			<input type="file" name="fileToUpload" id="fileToUpload" placeholder="Select file to upload" required><br /><br />
			<input type="submit" value="Upload" name="submit">		
		
		<?php

		// display all errors on the browser
		error_reporting(E_ALL);
		ini_set('display_errors','On');


		require_once 'demo-lib.php';
		demo_init(); // this just enables nicer output

		// if there are many files in your Dropbox it can take some time, so disable the max. execution time
		//set_time_limit( 0 );

		require_once 'DropboxClient.php';

		/** you have to create an app at @see https://www.dropbox.com/developers/apps and enter details below: */
		/** @noinspection SpellCheckingInspection */
		$dropbox = new DropboxClient( array(
			'app_key' => "5yg7tbsa5jp3uyd",      // Put your Dropbox API key here
			'app_secret' => "emdt58abxufe094",   // Put your Dropbox API secret here
			'app_full_access' => false,
		) );


		/**
		 * Dropbox will redirect the user here
		 * @var string $return_url
		 */
		$return_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?auth_redirect=1";

		// first, try to load existing access token
		$bearer_token = demo_token_load( "bearer" );

		if ( $bearer_token ) {
			$dropbox->SetBearerToken( $bearer_token );
			//echo "loaded bearer token: " . json_encode( $bearer_token, JSON_PRETTY_PRINT ) . "\n";
		} elseif ( ! empty( $_GET['auth_redirect'] ) ) // are we coming from dropbox's auth page?
		{
			// get & store bearer token
			$bearer_token = $dropbox->GetBearerToken( null, $return_url );
			demo_store_token( $bearer_token, "bearer" );
		} elseif ( ! $dropbox->IsAuthorized() ) {
			// redirect user to Dropbox auth page
			$auth_url = $dropbox->BuildAuthorizeUrl( $return_url );
			die( "Authentication required. <a href='$auth_url'>Continue.</a>" );
		}


		echo "</pre>";
		//delete file start
		if(isset($_GET["delete"])){
			$jpg_files = $dropbox->Search( "/", $_GET["delete"], 5 );
			if (!empty($jpg_files)) {
				$dropbox->Delete($_GET["delete"]);
			}
		}
		
		//delete file end
				
		//upload file start
		if(isset($_POST["submit"])) {
			// $f = fopen($_FILES["fileToUpload"]["name"], "rb");
			// $result = $dropbox->uploadFile($_FILES["fileToUpload"]["name"], dbx\WriteMode::add(), $f);
			// fclose($f);
			// print_r($result);
			//echo $_FILES["fileToUpload"]["name"];
			//echo $_FILES["fileToUpload"]["tmp_name"];
			$target_dir = "uploads/";
			$filename = $_FILES['fileToUpload']['name'];
			$allowed_filetypes = array('.jpg','.jpeg');
			$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
			if(!in_array(strtolower($ext),$allowed_filetypes))
			{
				//die('<small>The file you attempted to upload is not allowed. Please upload a .jpg file</small>');
				echo '<small>The file you attempted to upload is not allowed. Please upload a .jpg file</small>';
				//exit;
			}else{
					
				if (!file_exists('uploads')) {
					mkdir('uploads', 0777, true);
				}
				if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_dir . $filename))
				{      
					echo '<small>Your file upload was successful</small>'; 
				}
				else{
					echo '<small>There was an error during the file upload.  Please try again.</small>';
				}
				
				$dropbox->UploadFile($target_dir . $filename);
				
				//print_r( array_keys( $files ) );
				
				
				$dir = 'uploads';
				$it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
				$files = new RecursiveIteratorIterator($it,
							 RecursiveIteratorIterator::CHILD_FIRST);
				foreach($files as $file) {
					if ($file->isDir()){
						rmdir($file->getRealPath());
					} else {
						unlink($file->getRealPath());
					}
				}
				rmdir($dir);
			}
			
			//upload file end
			
			
		}
		echo "</form><hr />";
		//List Dropbox files start
		$files = $dropbox->GetFiles("",false);
			echo '<div class="list"><h3>List of Images</h3><ul id="imgList">';
		if(empty($files)) {
			echo "<li>No image found in your dropbox </li></ul></div>";
		}else{
			//print_r($files);
			//print_r( array_keys( $files ) );
			$flag = 0;
			foreach ($files as $key => $value) {
				$ext = substr($key, strpos($key,'.'), strlen($key)-1);
				$allowed_filetypes = array('.jpg','.jpeg');
				if(in_array(strtolower($ext),$allowed_filetypes))
				{
					$flag++;
					$img_data =$dropbox->GetLink($value, $preview=false);
					//echo "<li><a href='#' class='imgLink' data-href='" . $img_data . "'>" . $key . "</a> <a href='album.php?delete=" . $dropbox->GetLink($value) . "'><img class='removeBtn' src='https://d30y9cdsu7xlg0.cloudfront.net/png/446206-200.png'></a> </li>";
					echo "<li><a href='#' class='imgLink' data-href='" . $img_data . "'>" . $key . "</a> <a href='album.php?delete=/" . $key . "'><img class='removeBtn' src='https://d30y9cdsu7xlg0.cloudfront.net/png/446206-200.png'></a> </li>";
					$arr = json_decode(json_encode($value), true);
					//print_r($arr);
				}
			}
			if($flag == 0){
				echo "<li>No image found in your dropbox </li>";
			}
			echo "</ul></div>";
		}
		
		//List Dropbox files end
		?>
		<div class="imgWindow">
			<h3>Image Window</h3>
			<img id="imgviewer" src="http://legacyphotographie.com/wp-content/themes/pashmina/images/blank.png" style="max-width: 720px;">
		</div>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script>
	$(document).ready(function(){
		console.log($("#imgList li"));
		$(".imgLink").on("click",function(){
			if($("#imgList li").length > 0){
				var imgUrl = $(this).attr("data-href");
				$("#imgviewer").attr("src",imgUrl);
				var a = $("<a>").attr("href", imgUrl).attr("download", true).appendTo("body");

				a[0].click();

				a.remove();
			}		
		});
		$( "a.imgLink" ).click(function( event ) {
			event.preventDefault();
		});
		var href = window.location.href,
		newUrl = href.substring(0, href.indexOf('?'))
		window.history.replaceState({}, '', newUrl);
	});
	</script>
</html>
