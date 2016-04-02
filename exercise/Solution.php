<?php

namespace App\Solution;
/*
 * if 'message' not found, return '::notFound' message
 */
class Bot
{
    private $responseList = [];
    private $serviseResponseList = [];

    public function addAnswer($message, $response)
    {
        if ($this->isServesMessage($message)) {
            $this->serviseResponseList[$message] = $response;
        } else {
            $this->responseList[$message] = $response;
        }
    }

    public function answer($message)
    {
        if (!array_key_exists($message, $this->responseList)) {
            return $this->serviseResponseList['::notFound']();
        }
        return $this->responseList[$message]();
    }

    private function isServesMessage($message)
    {
        return (substr($message, 0, 2) == '::') ? true : false;
        // if (preg_match('/^::/', $message) !== false) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
}
