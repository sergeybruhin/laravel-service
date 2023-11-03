<?php

namespace SergeyBruhin\LaravelService\Exceptions;

use Exception;
use Throwable;

class StubFileDoesntExistsException extends Exception
{
    public function __construct(public array $stubPaths = [])
    {
        $code = 500;
        $paths = implode(', ', $this->stubPaths);
        $message = "Stub file [ $paths ] doesn't exists!";

        parent::__construct($message, $code);
    }

}
