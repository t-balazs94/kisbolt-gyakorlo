<?php
class DBException extends Exception
{
    public function __construct(string $message, Exception $inner)
    {
        parent::__construct($message, 1000, $inner);
    }
}
