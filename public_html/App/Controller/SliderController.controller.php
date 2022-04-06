<?php


namespace App\Controller;


use App\Core\Controller;


class SliderController extends Controller
{   
    use \App\Traits\ConfigSettingsTrait;
    use \App\Traits\FilterDataTrait;


    protected $folder_id;

    
    protected function set_folder_id()
    {
        $folder_id = $this->folder_id = $this->filter_data($_POST['id']);
    }
    protected function get_folder_id()
    {
        $this->set_folder_id();
        return $this->folder_id;
    }

    public function get_slider_images()
    {
       return $this->load_model_obj('SliderModel')->grab_images($this->get_folder_id());
    }

    // the method below calls in item_cart_script.js by ajax
    public function display_slider_images(): void
    {
        echo $this->get_slider_images();
    }

}