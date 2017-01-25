<?php


namespace Parser\Contracts;


interface ParserContract
{
    public function storeSessions($sessions);

    public function storeSpeakers($speakers);

    public function storeLevels($levels);

    public function storeTracks($tracks);

    public function storeTypes($types);

    public function fetchData($endpoint);

    public function parse();
}
