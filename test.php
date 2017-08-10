
<?php

//echo variant_int(5%2);
$arr = array('a' => array('login' => 'aaaaa', 'password'=>'123456' ),'b' => array('login' => 'aaaaa', 'password'=>'123456' ));
/*
$ok=json_encode($arr);
$ok=str_replace(",",",\n",$ok);
$ok=str_replace("{","{\n\t",$ok);
$ok=str_replace("}","\n}",$ok);
file_put_contents("test.txt",$ok);
if(isset($arr['c']))
print_r($arr['c']);

foreach ($key as $arr) {
	echo $key."/"."value"."#";
}
*/
$ok=" "; echo "/".trim($ok)."/";
if(!empty(trim($ok)))
		echo "zzzzzzzzzzzzzzzzzzzzzzzz";
echo addslashes(json_encode("é"));
?>
