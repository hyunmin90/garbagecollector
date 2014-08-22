<?php
//http://mattiasbackstrom.se/dynamic-header-and-footer-in-codeigniter/

class MY_Loader extends CI_Loader {
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        $content  = $this->view('templates/main_header_dev', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('templates/main_footer_dev', $vars, $return);
 
        if ($return)
        {
            return $content;
        }
    }
}
?>