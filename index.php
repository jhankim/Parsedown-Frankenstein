<!DOCTYPE html>
<html>
<head>
	<title>Just a really dirty markdown processor</title>
	<style>
	.file-tree {
		position: fixed;
		height: 90vh;
		width: 25%;
		margin: 0;
		padding: 0;
		overflow-y: scroll;
	}

	.output {
		position: fixed;
		left: 30%;
		width: 60%;
		height: 90vh;
		margin: 0;
		padding: 0;
		font-family: Courier;
		font-size: 12px;
	}
	</style>
</head>
<body>

<?php

$doc_dir = '/Users/jae/OLAPIC/Documentation';

function listFolderFiles($dir, $child){
    $ffs = scandir($dir);
    
    if ($child) {
    	echo '<ul class="child-file-tree">';
    } else {
    	echo '<ul class="file-tree">';
    }

    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..' && $ff != '.git' && $ff != '.DS_Store'){
            if(is_dir($dir.'/'.$ff)) {
            	echo '<li>'.$ff;
            } else {
            	echo '<li><a href="./?file='.$dir.'/'.$ff.'">'.$ff.'</a>';
            }
            if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff, 1);
            echo '</li>';
        }
    }
    echo '</ul>';
}

listFolderFiles($doc_dir);

if (isset($_GET['file'])) {
	$cmd = shell_exec('ruby convert.rb ' . $_GET['file']);
	echo '<textarea class="output">'.$cmd.'</textarea>';
} else {
	echo '<textarea class="output">Choose a file from the left!</textarea>';
}

?>

</body>
</html>