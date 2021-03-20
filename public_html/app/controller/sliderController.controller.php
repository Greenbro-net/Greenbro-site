<?php

class sliderController extends Controller
{
    use ConfigSettingsTrait;
    use modelTrait;
    use FilterDataTrait;
    
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
        $this->get_slider_model()->grab_images($this->get_folder_id());
    }
}