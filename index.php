<?php

	// Directory container
	$directories = [];

	// Get all files
	$filesAndDirectories = scandir(".");

	// Remove . and .. from array (=first two results)
	$filesAndDirectories = array_slice( $filesAndDirectories, 3 );

	// Loop over array containing paths
	foreach ( $filesAndDirectories as $pathName)
	{
		// Check if the pathName is a directory
		$isDir = is_dir( $pathName );

		// and if it does not match a folder that needs to be ignored (ie. .git)
		$shouldBeIgnored = ( preg_match( '/\.git/', $pathName ) === 1) ? true : false ;

		// Check both conditions
		if( $isDir && !$shouldBeIgnored ){

			// Get modification timestamp of directory
			$modifiedOnTimestamp =  filemtime($pathName);

			// Add path to directories array using timestamp_pathname as key and pathname as value;
			$directories[ $modifiedOnTimestamp . '_' . $pathName ] = $pathName;
		}
	}

	// Reverse sort array based on keys (prefixed with timestamp) -> highest timestamp first
	krsort( $directories );

?>

<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="UTF-8">
	<title>Web Backend</title>
	<link rel="stylesheet" href="intromas.css" type="text/css">
</head>
<body>
<h1>Web Backend: oplossingen</h1>
<h3>Overzicht</h3>
<main>
	<ul>
		<?php foreach($directories as $key => $val):?>
		<li><a href="<?= $directories[$key]?>/"><?= $directories[$key]?></a></li>
		<?php endforeach;?>
	</ul>
</main>
</body>
</html>
