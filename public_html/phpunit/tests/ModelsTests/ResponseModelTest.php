<?php


namespace App\UnitTest\ModelsTests;


class ResponseModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for findItemResponse()
    /** @test */
    public function mock_findItemResponse()
    {
        $ResponseModelObject = new \App\Model\ResponseModel();
        $ResultOfMethod = $ResponseModelObject->findItemResponse(241);
        $this->assertIsArray($ResultOfMethod);
    }
 
    // the unittest method below for grabQuantityComment()
    /** @test */
    public function mock_grabQuantityComment()
    {
        $ResponseModelObject = new \App\Model\ResponseModel();
        $ResultOfMethod = $ResponseModelObject->grabQuantityComment(5973695392656288, 241);
        $this->assertTrue($ResultOfMethod);
    }
    
}