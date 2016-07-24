<?php
class Test
{
    private $hi = 'hi yunzhi';
    public function __get($name)
    {
        echo $name . '<br />';
        echo $this->hi;
    }
}

$Test = new Test();
echo $Test->hi;