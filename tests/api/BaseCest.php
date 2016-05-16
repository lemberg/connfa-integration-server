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

    private function setup_db() {
        $db_connection = config('database.default');
        if ($db_connection == 'sqlite') {
            $file = config('database.connections.'.$db_connection.'.database');
            unlink($file);
            touch($file);

            Artisan::call('migrate');
        }
    }

}