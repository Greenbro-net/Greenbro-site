<?php
trait jsonreplyTrait
{
    // the method below displays success message for eraseuserdataController
    protected function deletion_success_message()
    {
        $form_data['success'] = true;
        $form_data['posted'] = 'Дані успішно видалені';
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
}