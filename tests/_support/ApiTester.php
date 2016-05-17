<?php
use Codeception\Scenario;


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class ApiTester extends \Codeception\Actor
{
    use _generated\ApiTesterActions;

    protected $seeder;

    public function __construct(Scenario $scenario)
    {
        parent::__construct($scenario);

        $this->seeder = new Seeder($this);
    }

    /**
     * Define custom actions here
     * @param $name
     * @param $arguments
     */

    public function __call($name, $arguments)
    {
        if (starts_with($name, 'haveAn')) {
            $method = explode('haveAn', $name);
        }
        else if (starts_with($name, 'haveA')) {
            $method = explode('haveA', $name);
        }

        return $this->seeder->$method[1]($arguments[0]);
    }
}
