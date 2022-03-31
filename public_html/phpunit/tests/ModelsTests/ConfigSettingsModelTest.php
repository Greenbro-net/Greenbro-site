<?php


namespace App\UnitTest\ModelsTests;


class ConfigSettingsModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for get_json
    /** @test */
    public function mock_get_json()
    {
        $ConfigSettingsModelObject = new \App\Model\ConfigSettingsModel();
        $ResultOfMethod = $ConfigSettingsModelObject->get_json();
        $this->assertJsonStringEqualsJsonFile("../../config_settings.json", json_encode($ResultOfMethod));
    }
    
}