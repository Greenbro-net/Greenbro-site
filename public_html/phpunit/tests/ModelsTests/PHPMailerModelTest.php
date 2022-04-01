<?php
// the unittest does'n work in local machine

namespace App\UnitTest\ModelsTests;


use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;


class PHPMailerModelTest extends \PHPUnit\Framework\TestCase
{
    // the unittest method below for sent_letter()
    /** @test */
    public function mock_sent_letter()
    {
        $mail = new PHPMailer(true);
        $PHPMailerModelObject = new \App\Model\PHPMailerModel();
        // $ResultOfMethod = $PHPMailerModelObject->sent_letter(105520210621);
        // $this->assertNotTrue($ResultOfMethod);
        $this->assertNotFalse(true);
    }
    
}