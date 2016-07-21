<?php

class Test1
{
	public function __construct()
	{
		echo 'hehehe';
	}

	public function sayHello()
	{
		echo 'haha';
	}
}

$Test1 = new Test1;
echo '<br />';
$Test1->sayHello();