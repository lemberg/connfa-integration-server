<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\UserRepository;
use Cerbero\CommandValidator\ValidatesInput;
use Illuminate\Validation\Factory as Validator;

/**
 * Class ChangePassword
 * @package App\Console\Commands
 */
class ChangePassword extends Command
{
    /**
     * The data validation trait
     */
    use ValidatesInput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:change {--name= : User name or email} {--password= : New password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user password.';

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var Validator
     */
    private $emailValidator;

    /**
     * ChangePassword constructor.
     *
     * @param UserRepository $userRepository
     * @param Validator $emailValidator
     */
    public function __construct(UserRepository $userRepository, Validator $emailValidator)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->emailValidator = $emailValidator;
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

        if(!$user = $this->findUser($name))
        {
            return $this->error('The user is not registered.');
        }

        if($this->setNewPassword($user->id, $password))
        {
            return $this->info('Set a new password to the user.');
        }
    }

    /**
     * The validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required|min:6'
        ];
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

        $validator = $this->emailValidator->make(['email' => $data], $rules);
        if ($validator->fails())
        {
            return false;
        }

        return true;
    }

    /**
     * Find user by name or email
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
     * Set new password
     *
     * @param int $id
     * @param string $password
     *
     * @return boolean
     */
    private function setNewPassword($id, $password)
    {
        return $this->userRepository->changePassword($id, $password);
    }
}
