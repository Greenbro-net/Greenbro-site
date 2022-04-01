<?php


namespace App\UnitTest\ModelsTests;


class SliderModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for grab_images()
    /** @test */
    public function mock_grab_images()
    {
        $SliderModelObject = new \App\Model\SliderModel();
        $ResultOfMethod = $SliderModelObject->grab_images(241);
        $this->assertEmpty($ResultOfMethod);
    }
    
}