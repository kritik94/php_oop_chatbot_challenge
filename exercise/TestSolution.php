<?php

namespace App;

require_once 'Solution.php';

class TestSolution extends \PHPUnit_Framework_TestCase
{
    public function testSimpleBot()
    {
        $bot = new Solution\Bot;
        $bot->addAnswer('help', function() {
            return "It's help message!";
        });

        $this->assertEquals("It's help message!", $bot->answer('help'));
    }
}
// 'find {:name}' => params[name]
