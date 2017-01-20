<?php

namespace Parser;

class Parser
{
    private $driver;

    public function __construct()
    {
        $this->setDriver(\Config::get('parser.driver'));
    }

    private function setDriver($class)
    {
        $this->driver = new $class;
    }

    public function driver()
    {
        if (!$this->driver) {
            //@todo throw error
        }

        return $this->driver;
    }
}
