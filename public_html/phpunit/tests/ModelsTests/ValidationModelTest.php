<?php


namespace App\UnitTest\ModelsTests;


class ValidationModelTest extends \PHPUnit\Framework\TestCase
{

    // the unittest method below for loginUser()
    /** @test */
    public function mock_loginUser()
    {
        $ValidationModelObject = new \App\Model\ValidationModel();
        $ResultOfMethod = $ValidationModelObject->loginUser("Alex", 11111111);
        $this->assertIsArray($ResultOfMethod);
    }

    // the unittest method below for findUserByEmail()
    /** @test */
    public function mock_findUserByEmail()
    {
        $ValidationModelObject = new \App\Model\ValidationModel();
        $ResultOfMethod = $ValidationModelObject->findUserByEmail("reeett@ukr.net");
        $this->assertIsBool($ResultOfMethod);
    }

    // the unittest method below for findUserByUsername()
    /** @test */
    public function mock_findUserByUsername()
    {
        $ValidationModelObject = new \App\Model\ValidationModel();
        $ResultOfMethod = $ValidationModelObject->findUserByUsername("Alex");
        $this->assertIsBool($ResultOfMethod);
    }

    // the unittest method below for findEmailByUserid()
    /** @test */
    public function mock_findEmailByUserid()
    {
        $ValidationModelObject = new \App\Model\ValidationModel();
        $ResultOfMethod = $ValidationModelObject->findEmailByUserid(534);
        $this->assertIsArray($ResultOfMethod);
    }

    // the unittest method below for findPhoneNumberByUserid()
    /** @test */
    public function mock_findPhoneNumberByUserid()
    {
        $ValidationModelObject = new \App\Model\ValidationModel();
        $ResultOfMethod = $ValidationModelObject->findPhoneNumberByUserid(535);
        $this->assertIsArray($ResultOfMethod);
    } 

}