<?php


namespace App\UnitTest\ModelsTests;


class CustomerModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for get_customer_data
    /** @test */
    public function mock_get_customer_data()
    {
        $CustomerModel = new \App\Model\CustomerModel;
        $ResultOfMethod = $CustomerModel->get_customer_data();
        $this->assertIsArray($ResultOfMethod);
    }

}