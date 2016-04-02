<?php

namespace App\Solution;

class Bot
{
    private $responseList = [];

    public function addAnswer($message, $response)
    {
        $this->responseList[$message] = $response;
    }

    public function answer($message)
    {
        return $this->responseList[$message]();
    }
}
