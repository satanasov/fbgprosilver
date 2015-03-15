<?php
//functions.php
//written by Bill Heaster
//theCreator at ApexLogic d0t net

function displayBackground()
{
	$dir = 'backgrounds/';
	$cnt = 0;
	$bgArray= array();
		
	 		/*if we can load the directory*/
	if ($handle = opendir($dir)) {
		
		/* Loop through the directory here */
		while (false !== ($entry = readdir($handle))) {
		
			$pathToFile = $dir.$entry;
			if(is_file($pathToFile)) //if the files exists 
			{	
				
				//make sure the file is an image...there might be a better way to do this
				if(getimagesize($pathToFile)!=FALSE)
				{
					//add it to the array
					$bgArray[$cnt]= $pathToFile;
					$cnt = $cnt+1;
				
				}
				
			}	
		
		}	
		//create a random number, then use the image whos key matches the number
		$myRand = rand(0,($cnt-1));	
		$val = $bgArray[$myRand];
	}
	closedir($handle);
	$image = imagecreatefromjpeg($val);
	header('Content-type: image/jpeg');
	imagejpeg($image);
	die;

}
displayBackground();
?>