<?php


use App\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testRegister()
    {
        $name = 'testName';
        $email = 'johndoe@example.com';
        $password = Hash::make('password');

        User::add(['name' => $name, 'email' => $email, 'password' => $password]);

        $this->tester->seeRecord('users', ['email' => $email, 'password' => $password]);
    }

}
