<?php
class Pages extends CI_Controller {
	
    public function _remap()
    {
        $this->load->helper('file');
        $this->load->helper('page');
        $this->load->library('markdown');

        $file_path = get_page_path($this->uri->uri_string(), $data['ext']);
        if($file_path == null)
        {
            //파일이 없거나 category가 틀립니다.
            echo "404 Error";
            return;
        }

        //md 파일이면
        if($data['ext'] == 'md')
        {
            $data['content'] = $this->markdown->parse_file('.'.$file_path);
        }
        else if($data['ext'] == 'content')
        {
            $data['content'] = file_get_contents('.'.$file_path);
        }
        else if($data['ext'] == 'php')
        {
            $data['content'] = $file_path;
        }
        else if($data['ext'] == 'html' || $data['ext'] == 'link')
        {
            $data['content'] = $file_path;
        }
        else if($data['ext'] == 'url') 
        {
            $url = read_file('.'.$file_path);
            if(substr($url,-3)=='.md')
            {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_HEADER  ,0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $output = curl_exec($ch);
                curl_close($ch);
                $data['ext'] = 'md';
                $data['content'] = $this->markdown->parse($output);
            }
            else 
            {
                $data['ext'] = 'html';
                $data['content'] = $url;
            }
        }

        $this->load->template('page',$data);        
    }
}
?>
