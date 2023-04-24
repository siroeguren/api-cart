<?php

namespace App\Tests\Shop\Domain\User;

use App\Shop\Domain\User\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $sut;

    protected function setUp(): void
    {
        $this->sut = new User('user2', email: 'User2@user2.com', password: 'Pass2');
    }

    /**
     * @test
     * shouldCreateProduct
     * @group user
     */
    public function shouldGetProperName()
    {
        $this->assertEquals('user2', $this->sut->getName());
    }

    /**
     * @test
     * shouldSetProperName
     * @group user
     */
    public function shouldSetProperName()
    {
        $this->sut->setName('AssertName');
        $this->assertEquals('AssertName', $this->sut->getName());
    }

    /**
     * @test
     * shouldCreateProduct
     * @group user
     */
    public function shouldGetProperEmail()
    {

        $this->assertEquals('User2@user2.com', $this->sut->getEmail());
    }


    /**
     * @test
     * shouldCreateProduct
     * @group user
     */
    public function shouldSetProperEmail()
    {
        $this->sut->setEmail('assertEmail@test.com');
        $this->assertEquals('assertEmail@test.com', $this->sut->getEmail());
    }

    /**
     * @test
     * shouldCreateProduct
     * @group user
     */
    public function shouldGetProperPassword()
    {

        $this->assertEquals('Pass2', $this->sut->getPassword());
    }


    /**
     * @test
     * shouldCreateProduct
     * @group user
     */
    public function shouldSetProperPassword()
    {
        $this->sut->setPassword('123123Aa');
        $this->assertEquals('123123Aa', $this->sut->getPassword());
    }
}
