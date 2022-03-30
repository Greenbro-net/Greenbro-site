<?php


namespace App\UnitTest\ModelsTests;


use PHPUnit\Framework\TestCase;


class CartModelTest extends TestCase
{
    // the unittest method below for getMemberCartItem()
    /** @test */
    public function mock_getMemberCartItem()
    {
        $CartModelObject = new \App\Model\CartModel();
        $ResultOfMethod = $CartModelObject->getMemberCartItem(107120210621);
        $this->assertNotEmpty($ResultOfMethod);
    }
    
}