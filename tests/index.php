<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/24/16
 * Time: 2:45
 */

include_once(__DIR__ . '/../UserInterface.class.php');
$ui = new UserInterface();

// The commands
$commands = array('echo $PWD', 'whoami', ' php ../phpunit-5.2.12.phar --no-configuration --debug --verbose .');
// Run the commands for output
$output = '';
foreach ($commands AS $command)
{
	// Run it
	$tmp = shell_exec($command);
	// Output
	$output .= "<span style=\"color: darkgreen;\">\$</span> <span style=\"color: darkslategray;\">{$command}\n</span>";
	$output .= htmlentities(trim($tmp)) . "\n";
}
// Make it pretty for manual user access (and why not?)
$ui->add("<script>document.body.style.fontWeight = 700;document.body.style.lineHeight = '1em';</script>");
$ui->add("<pre>
             .-.,     ,.-.
        '-.  /:::\\   //:::\  .-'
        '-.\|':':' `\"` ':':'|/.-'
        `-./`. .-=-. .-=-. .`\.-`
          /=- /     |     \ -=\
         ;   |      |      |   ;
         |=-.|______|______|.-=|
         |==  \  <span style='color: #FF0000;'>&hearts;</span> /_\ <span style='color: #FF0000;'>&hearts;</span>  /  ==|
         |=   /'---( )---'\   =| PHPUnit
          \   \:   .'.   :/   /  Black Box Testing
           `\= '--`   `--' =/'   By:
             `-=._     _.=-'         Thomas
                  `\"\"\"`              Navi
                                     Farzin</pre>
<pre style='max-width: 90%;border: 2px solid rgb(203, 203, 203);background-color: rgba(223, 223, 223,0.75); border-radius:8px; margin:1em auto;overflow-x:hidden;'>
${output}</pre>");

echo $ui;
