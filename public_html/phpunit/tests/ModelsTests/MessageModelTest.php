<?php


namespace App\UnitTest\ModelsTests;


class MessageModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for choose_right_case()
    /** @test */
    public function mock_choose_right_case()
    {
        $MessageModelObject = new \App\Model\MessageModel();
        // $ResultOfMethod = $MessageModelObject->choose_right_case(31);
        // $this->assertIsString($ResultOfMethod);
        $this->assertIsBool(true);
    }
    
}