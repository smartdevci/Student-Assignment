<?php 
session_start();
var_dump($_SESSION);
class P
{
	public $ok;
	public function __construct($v)
	{
		$this->ok=$v;

	}

	public function search()
	{
		return true;
	}
}

$b=new P("ok");
$b=(Object)$b;
if($b->search()==false)
{
	echo "b = null";
}
else
{
	echo "b = pas null";
}
//echo abs(-5);

?>