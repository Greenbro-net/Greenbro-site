<?php


namespace App\UnitTest\ModelsTests;


class DeletionModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for get_deletion_code()
    /** @test */
    public function mock_get_deletion_code()
    {
        $DeletionModelObject = new \App\Model\DeletionModel();
        $_GET['code'] = 'testing_code';
        $ResultOfMethod = $DeletionModelObject->get_deletion_code();
        unset($_GET['code']);
        $this->assertNotEmpty($ResultOfMethod);
    }
    
}