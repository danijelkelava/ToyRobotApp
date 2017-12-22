<?php

spl_autoload_register(function ($class_name){
    if (file_exists("./objects/" . $class_name . ".php")){
        require_once "./objects/" . $class_name . ".php";
    }
});

$robot = new Robot();

$handle = fopen("test/commands.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false && strlen($line) > 0) {
        //var_dump($line);
        $lineSpaceBreak = explode(" ", $line);
        //var_dump($lineSpaceBreak);
        $params = explode(",", $lineSpaceBreak[1]);

        foreach ($lineSpaceBreak as $key => $value){
            if (trim($lineSpaceBreak[$key]) == "PLACE") {
                $robot->place(trim($params[0]), trim($params[1]), trim($params[2]));
            }elseif (trim($lineSpaceBreak[$key]) == "MOVE") {
                $robot->move();
            }elseif (trim($lineSpaceBreak[$key]) == "LEFT"){
                $robot->left();
            }elseif(trim($lineSpaceBreak[$key]) == "RIGHT"){
                $robot->right();
            }elseif(trim($lineSpaceBreak[$key]) == "REPORT"){
                echo "<pre>";
                print_r($robot->report());
                echo "</pre>";
            }
        }        
    }
} else {
    echo "Can't open file!";
}
fclose($handle);


