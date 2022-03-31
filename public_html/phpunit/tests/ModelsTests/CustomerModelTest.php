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

    // the unittest method below for get_customer_name()
    /** @test */
    public function mock_get_customer_name()
    {
        $CustomerModel = new \App\Model\CustomerModel;
        $ResultOfMethod = $CustomerModel->get_customer_name();
        $this->assertIsArray($ResultOfMethod);
    }

    // the unittest method below for checking_customer_name()
    /** @test */
    public function mock_checking_customer_name()
    {
        $CustomerModel = new \App\Model\CustomerModel;
        $ResultOfMethod = $CustomerModel->checking_customer_name("Олександр", "Ваншт");
        $this->assertTrue($ResultOfMethod);
    }

    // the unittest method below for checking_customer_date()
    /** @test */
    public function mock_checking_customer_data()
    {
        $CustomerModel = new \App\Model\CustomerModel;
        $ResultOfMethod = $CustomerModel->checking_customer_data("reqeee@ukr.net", "0982191799");
        $this->assertTrue($ResultOfMethod);
    }

    // the unittest method below for get_customer_id()
    /** @test */
    public function mock_get_customer_id()
    {
        $CustomerModel = new \App\Model\CustomerModel;
        $ResultOfMethod = $CustomerModel->get_customer_id(
            "Олександр", "Ваншт", "reeeee@ukr.net", "0637600126");
        $this->assertIsInt($ResultOfMethod); 
    }

}