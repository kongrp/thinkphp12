<?php

class Test1
{
	public function __construct()
	{
		echo 'hehehe';
	}
}

class son extends Test1
{
	public function __construct()
	{
		parent::__construct();
		echo 'hh';
	}
}

$Test1 = new Test1;
echo '<br />';
$Son = new Son;