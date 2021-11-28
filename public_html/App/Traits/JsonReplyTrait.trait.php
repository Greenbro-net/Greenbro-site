<?php

namespace App\Traits;

trait JsonReplyTrait
{

    // the method below displays success message for eraseuserdataController
    protected function deletion_success_message($url)
    {
        $form_data['success'] = true;
        $form_data['posted'] = 'Дані успішно видалені';
        // the code below throw back url to ajax-deletion
        $form_data['url'] = $url;
        echo json_encode($form_data);
    }

    
    // the method below displays unsuccess message for eraseuserdataController
    protected function deletion_unsuccess_message()
    {
        $form_data['success'] = false;
        $form_data['posted'] = 'Дані не були видалені, сталася помилка';
        echo json_encode($form_data);
    }
    
    // the method below displays success message in validationController
    protected function registration_success_message()
    {
        $form_data['success'] = true;
        $form_data['posted'] = 'Реєстрація пройшла успішно';
        echo json_encode($form_data);
    }
    // the method below displays success message in validationController
    protected function registration_unsuccess_message()
    {
        $form_data['success'] = false;
        $form_data['posted'] = 'Ви не зареєструвалися';
        echo json_encode($form_data);
    }


    // the method below for jquery return response by AJAX in validationController
    protected function response_not_login() 
    {
        $form_data['success'] = false;
        $form_data['posted'] = "User did not log in";
        echo json_encode($form_data);
    }   
    // the method below for jquery return response by AJAX in validationController
    protected function response_login()
    {
        $form_data['success'] = true;
        $form_data['posted'] = "User was log in";
        echo json_encode($form_data);
    }

    // the method below displays success message for responseController
    protected function display_response_success_message()
    {
        $form_data['success'] = true;
        $form_data['posted'] = 'Method addNewRating was executed successful';
        echo json_encode($form_data);
    }
    // the method below displays unsucces message for responseController
    protected function display_response_unsuccess_message()
    {
        $form_data['success'] = false;
        $form_data['posted'] = 'Error is';
        echo json_encode($form_data);
    }

    // the method below displays unsuccess message for responseController
    protected function display_response_quantity_unsuccess_message()
    {
        $form_data['success'] = false;
        $form_data['posted'] = "User has already added a comment for the item";
        echo json_encode($form_data);
    }
    // the method below displays success message for responseController
    protected function display_response_quantity_success_message()
    {
        $form_data['success'] = true;
        $form_data['posted'] = "User hasn't added a comment for the item yet";
        echo json_encode($form_data);
    }

    // the method below display casual user email
    protected function display_casual_user_email($result)
    {
        $form_data['success'] = true;
        $form_data['posted'] = $result[0]["email"];
        echo json_encode($form_data);
    }
    // the method below display user email from FB
    protected function display_fb_user_email()
    {
        $form_data['success'] = true;
        $form_data['posted'] = $_SESSION['userData']['email'];
        $form_data['user_email'] = $_SESSION['userData']['email'];
        echo json_encode($form_data); 
    }
    // the method below display user phone number for casual user
    protected function display_casual_user_data($result_user_email, $result_user_phone_number)
    {
        $form_data['success'] = true;
        $form_data['user_email'] = $result_user_email[0]["email"];
        $form_data['phone_number'] = $result_user_phone_number[0]["phone_number"];
        echo json_encode($form_data);
    }
}