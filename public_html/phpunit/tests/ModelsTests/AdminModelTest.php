<?php


namespace App\UnitTest\ModelsTests;


class AdminModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for check_manager_name
    /** @test */
    public function mock_check_manager_name()
    {   
        $AdminControllerObject = new \App\Controller\AdminController();
        $AdminControllerObject->manager_name = "Admin";
        $AdminModelObject = new \App\Model\AdminModel();
        $ResultOfMethod = $AdminModelObject->check_manager_name($AdminControllerObject);
        $this->assertNotEmpty($ResultOfMethod);
    }

    // the unittest method get_crypted_password()
    /** @test */
    public function mock_get_crypted_password()
    {
        $AdminControllerObject = new \App\Controller\AdminController();
        $AdminControllerObject->manager_password = "111111";
        $AdminModelObject = new \App\Model\AdminModel();
        $ResultOfMethod = $AdminModelObject->get_crypted_password($AdminControllerObject);
        $this->assertIsString($ResultOfMethod);
    }

}   
