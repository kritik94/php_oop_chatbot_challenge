<?php

namespace App\Solution;
/*
 * if 'message' not found, return '::notFound' message
 */
class Bot
{
    private $responseList = [];
    private $serviseResponseList = [];
    private $questionList = [];
    private $expectedResponse = null;

    public function addAnswer($message, $func, $ask = null)
    {
        $response = ['func' => $func, 'ask' => $ask];
        if ($this->isServesMessage($message)) {
            $this->serviseResponseList[$message] = $response;
        } else {
            $this->responseList[$message] = $response;
        }
    }

    public function answer($message)
    {
        if (!array_key_exists($message, $this->responseList)) {
            if (!array_key_exists($message, $this->serviseResponseList)) {
                $answer = $this->serviseResponseList['::notFound'];
            } else {
                $answer = $this->serviseResponseList[$message];
            }
        } else {
            $answer = $this->responseList[$message];
        }

        if ($answer['ask'] !== null) {
            $this->expectedResponse = $answer['ask'];
        }

        return $answer['func']();
    }

    public function hello()
    {
        return $this->answer('::hello');
    }

    public function addQuestion($ask, $func)
    {
        $this->questionList[$ask] = $func;
    }

    public function send($answer)
    {
        $ask = $this->expectedResponse;
        if (is_null($ask)) {
            return 'I dont ask question';
        }
        $this->expectedResponse = null;
        return $this->questionList[$ask]($answer);
    }

    private function isServesMessage($message)
    {
        return (substr($message, 0, 2) == '::') ? true : false;
    }

}
// ['message' => ['answer' => func, 'aks' = null]]
// $response = ['func' => $func, 'ask' => $ask]
