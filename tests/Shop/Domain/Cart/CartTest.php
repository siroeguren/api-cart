<?php

namespace App\Tests\Shop\Domain\Cart;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\User\EmailVO;
use App\Shop\Domain\User\PasswordVO;
use App\Shop\Domain\User\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private Cart $sut;
    private User|MockObject $mockedUser;

    protected function setUp(): void
    {
        $this->mockedUser = $this->createMock(User::class);

        $this->sut = new Cart($this->mockedUser);
    }

    /**
     * @test
     * shouldGetProperUser
     * @group cart
     */
    public function shouldGetProperUser()
    {
        $this->assertInstanceOf(User::class, $this->sut->getUser());
    }

    /**
     * @test
     * shouldSetProperUser
     * @group cart
     */
    public function shouldSetProperUser()
    {
        $userMocked2 = $this->createConfiguredMock(User::class,
            [
                'getName' => 'TestUsername',
                'getEmail' => $this->createConfiguredMock(EmailVO::class,
                    [
                        'getAddress' => 'testemail@email.com'
                    ]),
                'getPassword' => $this->createConfiguredMock(PasswordVO::class,
                    [
                        'getPassword' => 'Pass2Test'
                    ]),
            ]);

        $this->sut->setUser($userMocked2);
        $this->assertSame($userMocked2, $this->sut->getUser());
    }

//    /**
//     * @test
//     * shouldSetProducts
//     * @group cart
//     */
//
//    public function shouldSetProducts()
//    {
//        $product1 = $this->createMock(Product::class);
//        $product2 = $this->createMock(Product::class);
//
//        $expectedProds = new ArrayCollection([$product1, $product2]);
//
//        $this->sut->setProducts($expectedProds);
//
//        $this->assertEquals($expectedProds->toArray(), $this->sut->getProducts()->toArray());
//
//    }

}
