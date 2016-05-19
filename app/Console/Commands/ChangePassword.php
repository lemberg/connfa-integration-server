<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\UserRepository;
use Validator;

class ChangePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change-password {--name=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user password';


    private $userRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->option('name');
        $password = $this->option('password');

        if(strlen($password) < 6)
        {
            return $this->error('The password must be at least 6 characters.');
        }
        if(!$user = $this->findUser($name))
        {
            return $this->error('The user is not registered.');
        }
        if($this->setNewPassword($password, $user->id))
        {
            return $this->info('Set a new password to the user.');
        }

    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('name', null, InputOption::VALUE_REQUIRED, 'name or email'),
            array('password', null, InputOption::VALUE_REQUIRED, 'new password')
        );
    }

    /**
     * Verify Email 
     *
     * @param string $data
     *
     * @return boolean if email return true else return false
     */
    private function isEmail($data)
    {
        $rules = [
            'email' => 'required|email',
        ];

        $validator = Validator::make(['email' => $data], $rules);
        if ($validator->fails())
        {
            return false;
        }

        return true;
    }

    
    /**
     * find user by name or email
     *
     * @param string $data
     *
     * @return mixed 
     */
    private function findUser($data)
    {
        $attribute = 'name';
        if($this->isEmail($data))
        {
            $attribute = 'email';
        }

        return $this->userRepository->findBy($attribute, $data);
    }

    /**
     * set new password
     *
     * @param string $password
     * @param int $id
     *
     * @return boolean
     */
    private function setNewPassword($password, $id)
    {
        return $this->userRepository->updateRich(['password' => bcrypt($password)], $id);
    }

}
