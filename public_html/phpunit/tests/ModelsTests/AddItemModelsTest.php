<?php


namespace App\UnitTest\ModelsTests;


use PHPUnit\Framework\TestCase;


class AddItemModelsTest extends TestCase
{   
    // the test method below for get_last_products_id() 
    /** @test */
    public function mock_get_last_products_id()
    {
        $AddItemModelObject = new \App\Model\AddItemModel();
        $ResultOfMethod = $AddItemModelObject->get_last_products_id();
        $this->assertIsInt($ResultOfMethod);
    }

    // the test method below for check_existing_of_file()
    /** @test */
    public function mock_check_existing_of_file()
    {
        $AddItemModelObject = new \App\Model\AddItemModel();
        $ResultOfMethod = $AddItemModelObject->check_existing_of_file("../images/AAA.jpg");
        $this->assertEmpty($ResultOfMethod);
    }
    
    // the test method below for is_file_image()
    /** @test */
    public function mock_check_file_type()
    {
        $AddItemModelObject = new \App\Model\AddItemModel();
        $ResultOfMethod = $AddItemModelObject->check_file_type("jpg"); //image type in directory
        $this->assertEmpty($ResultOfMethod);
    }
    
}