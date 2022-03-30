<?php


namespace App\UnitTest\ModelsTests;


use PHPUnit\Framework\TestCase;
use App\Controller\AdminController;


class AdminModelTest extends \PHPUnit\Framework\TestCase
{
    // the test method below for 
    /** @test */
    public function mock_check_manager_name()
    {   
        $AdminControllerObject = new AdminController();
        $AdminControllerObject->manager_name = "Admin";
        $AdminModelObject = new \App\Model\AdminModel();
        $ResultOfMethod = $AdminModelObject->check_manager_name($AdminControllerObject);
        $this->assertNotEmpty($ResultOfMethod);
    }

}   
