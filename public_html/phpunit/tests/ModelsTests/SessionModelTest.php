<?php


namespace App\UnitTest\ModelsTests;


class SessionModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for get_unite_date()
    /** @test */
    public function mock_get_unite_date()
    {
        $SessionModelObject = new \App\Model\SessionModel();
        $ResultOfMethod = $SessionModelObject->get_unite_date();
        $this->assertIsString($ResultOfMethod);
    }
 
    // the unittest method below for get_last_id()
    /** @test */
    public function mock_get_last_id()
    {
        $SessionModelObject = new \App\Model\SessionModel();
        $ResultOfMethod = $SessionModelObject->get_last_id();
        $this->assertIsInt($ResultOfMethod);
    }
    
    // the unittest method below for set_session()
    /** @test */
    public function mock_set_session()
    {
        $SessionModelObject = new \App\Model\SessionModel();
        $ResultOfMethod = $SessionModelObject->set_session();
        $this->assertIsInt($ResultOfMethod);
    }

    // the unittest method below for grab_united_order_items()
    /** @test */
    public function mock_grab_united_order_items()
    {
        $SessionModelObject = new \App\Model\SessionModel();
        $ResultOfMethod = $SessionModelObject->grab_united_order_items();
        $this->assertIsInt($ResultOfMethod);
    }
}