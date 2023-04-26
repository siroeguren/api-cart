<?php

namespace App\Tests\Shop\Domain\User;

use App\Shop\Domain\User\EmailVO;
use App\Shop\Domain\User\PasswordVO;
use App\Shop\Domain\User\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $sut;

    private PasswordVO|MockObject $passVO;
    private EmailVO|MockObject $emailVO;

    protected function setUp(): void
    {
        $email = $this->emailVO = $this->createConfiguredMock(EmaiLVO::class,
            [
                'getAddress' => 'User2@user2.com'
            ]);
        $pass = $this->passVO = $this->createConfiguredMock(PasswordVO::class,
            [
                'getPassword' => 'Pass2'
            ]);

        $this->sut = new User('user2', email: $email, password: $pass);
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

        $this->assertEquals('User2@user2.com', $this->sut->getEmail()->getAddress());
    }


    /**
     * @test
     * shouldCreateProduct
     * @group user
     */
    public function shouldSetProperEmail()
    {
        $mockedEmail = $this->createConfiguredMock(EmailVO::class,
            [
                'getAddress' => 'User2@user2.com'
            ]);
        $this->sut->setEmail($mockedEmail);
        $this->assertEquals($mockedEmail->getAddress(), $this->sut->getEmail()->getAddress());
    }

    /**
     * @test
     * shouldCreateProduct
     * @group user
     */
    public function shouldGetProperPassword()
    {
        $this->assertEquals('Pass2', $this->sut->getPassword()->getPassword());
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
