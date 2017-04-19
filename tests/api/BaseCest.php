<?php

class BaseCest
{

    public $conference;

    public function _before(ApiTester $I)
    {
        $this->setup_db();

        $this->conference = App\Models\Conference::create(['name'  => 'test', 'alias' => 'test']);
    }

    public function _after(ApiTester $I)
    {
    }

    private function setup_db()
    {
        Artisan::call('migrate');
    }
}