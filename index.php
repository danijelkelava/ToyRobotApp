<?php

spl_autoload_register(function ($class_name){
    if (file_exists("./objects/" . $class_name . ".php")){
        require_once "./objects/" . $class_name . ".php";
    }
});

$robot = new Robot();

//$robot->place(0,0, 'WEST');
/*
var_dump($robot->report());
echo "<br/>";

$robot->move();
$robot->right();
$robot->move();
var_dump($robot->report());
echo "<br/>";*/
/*
$handle = fopen("test/commands.txt", "r");

if ($handle) {
	$lines = explode("\n", fread($handle, filesize("test/commands.txt")));
	//var_dump($lines);	
	foreach ($lines as $line) {
		$new_lines[] = explode(" ", $line);
	}
	echo "<pre>";
	print_r($new_lines);
	echo "</pre>";
}*/

$handle = fopen("test/commands.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $lineSpaceBreak = explode(" ", $line);
        //var_dump($lineSpaceBreak);
        if(count($lineSpaceBreak) == 1){
               
            if(trim($lineSpaceBreak[0]) == "MOVE"){
                $robot->move();
            }
            elseif(trim($lineSpaceBreak[0]) == "LEFT"){
                $robot->left();
                
            }
            elseif(trim($lineSpaceBreak[0]) == "RIGHT"){
                $robot->right();
                
            }
            elseif(trim($lineSpaceBreak[0]) == "REPORT"){
            	echo "<pre>";
                print_r($robot->report());
                echo "</pre>";
            }
        }
        else if(count($lineSpaceBreak) > 1){
            if($lineSpaceBreak[0] == "PLACE"){
                $params = explode(",", $lineSpaceBreak[1]);
                //var_dump($params);
                $robot->place(trim($params[0]), trim($params[1]), trim($params[2]));
            }
        }
    }
} else {
    echo "Can't open file!";
}
fclose($handle);

