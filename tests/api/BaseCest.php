<?php

class BaseCest
{
    public function _before(ApiTester $I)
    {
        $this->setup_db();
    }

    public function _after(ApiTester $I)
    {
    }

    private function setup_db()
    {
        Artisan::call('migrate');
    }
}