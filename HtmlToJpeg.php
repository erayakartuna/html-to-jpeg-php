<?php

/**
 * @author Eray Akartuna - eray.info
 * Class HtmlToJpeg
 * Html To Jpeg Converter With 2d canvas javascript library
 */

class HtmlToJpeg
{

    /**
     * @var array
     */
    public $config = array(
        'folder'                => 'temp',
        'action_url'            => 'download.php',
        'hidden_image_names'    => 'img_values',
        'content_class_name'    => 'htmltojpeg-container',
        'form_id'               => 'myForm',
        'download_button_label' => 'Save and Download Images',
        'append_scripts'        => array(
            'js/render.js'
        )
    );

    /**
     * @var array
     */

    private $html_contents = array();

    /**
     * Form Creator
     * @return string
     */


    public function output()
    {
        $output = '<form id="'.$this->config['form_id'].'" action="'.$this->config['action_url'].'" method="POST">';

        foreach($this->html_contents as $i=>$htm)
        {
            $output .= '<div class="'.$this->config['content_class_name'].'" id="page-'.$i.'">'.$htm.'</div>';
        }

        $output .= '<button type="submit">'.$this->config['download_button_label'].'</button>';
        $output .= '</form>';

        $output .= "<script>"
                .  '   var hidden_image_names = "'.$this->config['hidden_image_names'].'";'
                .  '   var content_class_name = "'.$this->config['content_class_name'].'";'
                .  '   var form_id = "'.$this->config['form_id'].'";'
                .  "</script>";

        $output .= $this->appendJsFiles();

        return $output;
    }

    
    /**
     * @param string $html
     */

    public function renderHtml($html = '')
    {
        $this->html_contents[] = $html;
    }

    /**
     * View renderer
     * @param string $src
     */

    public function renderView($src = '')
    {
        try {

            if (!file_exists($src))
            {
                throw new Exception ($src.' does not exist');
            }
            else
            {
                ob_start();
                include($src);
                $content = ob_get_contents();
                ob_end_clean();
            }

        }
        catch(Exception $e) {
            echo "Message : " . $e->getMessage();
            echo "Code : " . $e->getCode();
            die();
        }

        return $this->renderHtml($content);
    }

    /**
     * Download images as a zip
     */

    public function download()
    {
        $zipname = $this->saveImages();

        if($zipname == ""){
            echo "error";
            die;
        }

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }

    /**
     * Save Images as a Zip From Post
     * @return string
     */
    public function saveImages(){
        $posts = isset($_POST[$this->config['hidden_image_names']]) ? $_POST[$this->config['hidden_image_names']] : array();

        if(empty($posts)){
            return "";
        }

        $imageprefix = uniqid(rand(), true);
        $zipname = uniqid(rand(), true) . '.zip';


        foreach($posts as $key=>$post){
            $files[] = $this->base64_to_jpeg($post,$imageprefix.'-'.$key.'.jpg',$this->config['folder']);
        }

        if(!$this->create_zip($files,$zipname,$this->config['folder']))
        {
            return "";
        }

        return $zipname;
    }

    /**
     * @param $base64_string
     * @param $output_file
     * @return mixed
     */

    private function base64_to_jpeg($base64_string, $output_file,$folder = "") {
        $ifp = fopen($folder.'/'.$output_file, "wb");
        $data = explode(',', $base64_string);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return $output_file;
    }

    /**
     * @param array $files
     * @param string $destination
     * @param string $folder
     * @return bool
     */

    private function create_zip($files = array(),$destination = '',$folder = "") {

        $valid_files = array();

        if(is_array($files)) {

            foreach($files as $file) {
                //make sure the file exists
                if(file_exists($folder.'/'.$file)) {
                    $valid_files[] = $file;
                }
            }
        }

        if(count($valid_files)) {

            $zip = new ZipArchive();
            if($zip->open($destination,ZIPARCHIVE::CREATE) !== true) {

                return false;
            }

            foreach($valid_files as $file) {
                $zip->addFile($folder.'/'.$file,$file);
            }

            $zip->close();

            return file_exists($destination);
        }
        else
        {
            return false;
        }
    }

    /**
     * @return string
     */

    private function appendJsFiles()
    {
        $htm = '';
        $scripts = $this->config['append_scripts'];

        foreach($scripts as $script){
            $htm .= '<script src="'.$script.'"></script>';
        }

        return $htm;
    }
}

