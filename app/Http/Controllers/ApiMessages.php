<?php


namespace App\Http\Controllers;


class ApiMessages
{
    private $message = [];

    public function __construct(string $message, array $data =[])
    {
        $this->message['message'] = $message;
        $this->message['errors'] = $data;
    }

    /**
     * @return array
     */
    public function getMessage(): array
    {
        return $this->message;
    }

}
