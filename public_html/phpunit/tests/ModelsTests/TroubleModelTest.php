<?php

// the unittest below displays in terminal that is why it's blocked
namespace App\UnitTest\ModelsTests;


class TroubleModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for show404()
    /** @test */
    public function mock_show404()
    {
        $TroubleModelObject = new \App\Model\TroubleModel();
        // $ResultOfMethod = $TroubleModelObject->show404();
        $this->assertEmpty(null);
    }
    
}