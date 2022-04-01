<?php


namespace App\UnitTest\ModelsTests;


class TroubleModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for show404()
    /** @test */
    public function mock_show404()
    {
        $TroubleModelObject = new \App\Model\TroubleModel();
        $ResultOfMethod = $TroubleModelObject->show404();
        $this->assertEmpty($ResultOfMethod);
    }
    
}