<?php


namespace App\UnitTest\ModelsTests;


class OrderModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for get_united_order_items()
    /** @test */
    public function mock_get_united_order_items()
    {
        $OrderModelObject = new \App\Model\OrderModel();
        $OrderModelObject->united_order_items = 105520210621;
        $ResultOfMethod = $OrderModelObject->get_united_order_items();
        $this->assertIsInt($ResultOfMethod);
    }

    // the unittest method below for gather_total_price()
    /** @test */
    public function mock_gather_total_price()
    {
        $OrderModelObject = new \App\Model\OrderModel();
        $ResultOfMethod = $OrderModelObject->gather_total_price(105520210621);
        $this->assertIsInt($ResultOfMethod);
    }
 
}