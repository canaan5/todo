<?php

class ApplicationTest extends TestCase
{

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = $user = factory(\App\User::class)->create();
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHome()
    {
        $this->visit('/')
             ->seePageIs('/login');
    }

    public function testLogin()
    {
        $this->visit('/')
            ->seePageIs('/login')
            ->type('kestylove5@gmail.com', 'email')
            ->type('canaan', 'password')
            ->press('Login')
            ->seePageIs('/');
    }

    public function testLogout()
    {
        $this->visit('/logout')
            ->seePageIs('/login');
    }

    public function testCreateUser()
    {
        $this->visit('/register')
            ->type('My Name', 'name')
            ->type('my@email.com', 'email')
            ->click('Register')
            ->seePageIs('/register');
    }

    public function testCreateTodoItem()
    {
//
//        $this->actingAs($user)->visit('/')
//            ->type('this is my title', 'title')
//            ->type('2016-05-10 01:57', 'date')
//            ->type('this is the info of this item', 'info')
//            ->click('submit')
//            ->seePageIs('/');
    }
}
