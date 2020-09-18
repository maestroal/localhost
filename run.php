<?php
/* 
* This only simple tool for create your website on localhost server
* Coded by: Maestro Alvardo (LeON)
* GitHub:   https://github.com/maestroal
* Date:     Jum, 18.Sep.2020 | 11:01:19
*/

/* Banners */
function Banner(){
    echo "\n";
    echo "Localhost Website Server\n";
    echo "-------------------------\n";
    echo "Coded by: github.com/maestroal\n";
	echo "\n\n";
}

/* Console the tool */
function Command_line(){
    echo " @console > ";
    $CLI = trim(fgets(STDIN));
    if($CLI == ""){
        Command_line();
    }elseif($CLI == "show help"){
        Help_Navigation();
        Command_line();
    }elseif($CLI == "add files"){
        echo "[?] File address : ";
        $files = trim(fgets(STDIN));
        if($files == ""){
            echo "\nError:(\n";
            Command_line();
        }elseif(file_exists("$files")){
            echo "[?] Type files(ex.: html, text) : ";
            $types = trim(fgets(STDIN));
            if($types == ""){
                echo "\nError:(\n";
                Command_line();
            }else{
                sleep(2);
                $file .= $files;
                $type .= $types;
                echo "Succ\n Add files : $file\n Type      : $type\n";
                Command_line();
            }
        }else{
            echo "[!] File not found!\n";
            Command_line();
        }
    }elseif($CLI == "upload"){
        /*  if($file == false){
            echo "Add your files first";
            Command_line();
            echo "Add your files first!\n";
            Command_line();
        }else{
             if(file_exists($server)){
                echo "Note: if message in first sessions are (null) that successful!";
                system("curl -f '@/$file;type=$type' $server");
            }else{
                echo "Run server first!\n";
                Command_line();
            } 
            if(file_exists($server)){
                system("curl -f '@/$file;type=$type' $server");
            }else{
                echo "Run the server first!";
                Command_line();
            } 
        }else{ */
        if(file_exists(".server")){
            $fo = fopen(".server", "r");
            $data = fread($fo,21);
            fclose($fo);
            system("curl -f '@/$file;type=$type' $data");
        }else{
            echo "Run the server first!";
            Command_line();
        }
    }elseif($CLI == "run server"){
        echo "[?] Port (ex.: 8000) : ";
        $port = trim(fgets(STDIN));
        if($port == ""){
            echo "Error:(\n";
            Command_line();
        }else{
            system("touch .server");
            $serverf = fopen(".server", "w");
            fwrite($serverf, "http://localhost:$port");
            fclose($serverf);
            system("php -S localhost:$port");
        }
        /* Upload file in new sessions */
    }elseif($CLI == "exit"){
        echo "[!] Exit the programs!\n";
    }else{
        echo "'$CLI' command not found\n";
        echo "Tips: type 'show help' to show HELP NAVIGATION\n";
        Command_line();
    }
}

/* Help text message */
function Help_Navigation(){
	echo "\nUsage: [command]\n";
	echo "Note: The purpose this tool is to create your website on localhost server\n\n";
	echo "Command option:\n";
	echo "   show help     Show help option with text message\n";
	echo "   add files     Add files for upload to localhost server\n";
	echo "   upload        Upload your files\n";
	echo "   run server    Run the localhost servers\n";
	echo "   exit          Exit the programs\n\n";
	echo "   Tips: First 'run server' and open new sessions for Upload your files\n\n";

}

/* Main function */
function Main(){
    system("clear");
    Banner();
    Command_line();
}

/* Not */
$file = "";
$type = "";
$server = ".server";

/* Call main function */
Main();

/* Closed */
?>
