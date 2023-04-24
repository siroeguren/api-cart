<?php

namespace App\Tests\Cart;

use App\Shop\Domain\User\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $sut;

    protected function setUp(): void
    {
        $this->sut = new User('user2', email: 'User2@user2.com', password: 'pass2');
    }

    /*
     * @test
     * it_should_assert_instance_of
     * @group user
     */
    public function itShouldAssertInstanceOf()
    {

    }


    /*
     * @test
     * it_should_return_proper_name
     * @group user
     */
    public function itShouldReturnProperName()
    {
        $this->assertEquals('user2', $this->sut->getName());
    }
}
