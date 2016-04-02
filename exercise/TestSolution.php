<?php

namespace App;

require_once 'Solution.php';

class TestSolution extends \PHPUnit_Framework_TestCase
{
    public function testSimpleBot()
    {
        $bot = new Solution\Bot;
        $bot->addAnswer('help', function () {
            return "It's help message!";
        });

        $this->assertEquals("It's help message!", $bot->answer('help'));
    }

    public function testNotFoundAnswer()
    {
        $testMessage = "Sorry, I don't understand you";
        $bot = new Solution\Bot;
        $bot->addAnswer('::notFound', function () use ($testMessage){
            return $testMessage;
        });

        $this->assertEquals($testMessage, $bot->answer('Something'));
    }

    public function testQuestion()
    {
        $bot = new Solution\Bot;
        $helloMessage = 'Hello! What is your name?';
        $testName = 'Robin';

        $bot->addQuestion('ask_name', function ($name) {
            return "Hello, {$name}! My name is Bot!";
        });

        $bot->addAnswer('::hello', function () use ($helloMessage) {
            return $helloMessage;
        }, 'ask_name');

        $this->assertEquals($helloMessage, $bot->hello());
        $this->assertEquals(
            "Hello, {$testName}! My name is Bot!",
            $bot->send($testName)
        );
    }
}
