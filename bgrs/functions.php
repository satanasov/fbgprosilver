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
			if (substr($pathToFile, -5) != '.html')
			{
				if(is_file($pathToFile)) //if the files exists 
				{	
					
					//make sure the file is an image...there might be a better way to do this
					if(exif_imagetype($pathToFile)!=FALSE)
					{
						//add it to the array
						$bgArray[$cnt] = array(
							'path' => $pathToFile,
							'type' => exif_imagetype($pathToFile)
						);
						$cnt = $cnt+1;
					
					}
					
				}	
			}
		}	
		//create a random number, then use the image whos key matches the number
		$myRand = rand(0,($cnt-1));	
		$val = $bgArray[$myRand];
	}
	closedir($handle);
	if ($val['type'] == 2)
	{
		$image = imagecreatefromjpeg($val['path']);
		header('Content-type: image/jpeg');
		imagejpeg($image);
		die;
	}
	if ($val['type'] == 3)
	{
		$image = imagecreatefrompng($val['path']);
		header('Content-type: image/png');
		imagepng($image);
		die;
	}
	else
	{
		die();
	}
}
displayBackground();
?>