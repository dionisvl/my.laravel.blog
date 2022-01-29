<?php


use App\Models\User;
use Codeception\TestCase\Test;
use Illuminate\Support\Facades\Hash;

class UserTest extends Test
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function testRegister(): void
    {
        $name = 'testName';
        $email = 'johndoe@example.com';
        $password = Hash::make('password');

        User::add(['name' => $name, 'email' => $email, 'password' => $password]);

        $this->tester->seeRecord('users', ['email' => $email, 'password' => $password]);
    }

}
