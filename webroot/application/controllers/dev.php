<?php
class Dev extends CI_Controller {
	public function manage()
    {
        $data['data'] = '';
        $this->load->helper('Url');
        $list = file_get_contents("./assets_dev/dev_pages.txt");
        $data['page_list'] = explode("|",$list);

        $this->load->template('dev/view_dev_manage',$data);
    }

    public function header()
    {
        $data['data'] = '';
        $this->load->template('dev/view_dev_herader',$data);
    }

    public function p($link = '')
    {
        if($link == '')
        {
           $list = file_get_contents("./assets_dev/dev_pages.txt");
           $data['page_list'] = explode("|",$list);
           $this->load->template('dev/view_dev_tong_list',$data);
           return;
        }
        
        $data['tong_img_path'] = '/assets_dev/tong/'.$link.'.png';
        $image_content = file_get_contents('.'.$data['tong_img_path']);
        $image = imagecreatefromstring($image_content);
        $data['tong_img_width'] = imagesx($image);
        $data['tong_img_height'] = imagesy($image);

        $this->load->template('dev/view_dev_tong',$data);
    }
    public function p_u()
    {
        $dev_ui = json_decode(file_get_contents("./assets_dev/dev_ui.json"),true);

        $link = $this->input->get_post('link');

        $config['upload_path'] = './assets_dev/tong/';
        $config['allowed_types'] = 'png';
        $config['file_name'] = $link.'.png';
        $config['overwrite'] = 'true';
        $config['max_size'] = '40960';
        
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            return show_alert('업로드 실패','/dev/manage');  
        }

        $list = file_get_contents("./assets_dev/dev_pages.txt");
        $page_list = explode("|",$list);
        foreach ($page_list as $value) {
            if($value == $link) return show_alert('페이지 덮음 완료.','/dev/manage');
        }

        $myFile = "./assets_dev/dev_pages.txt";
        $fh = fopen($myFile, 'a') or die("can't open file");
        $stringData = "|".$link;
        fwrite($fh, $stringData);
        fclose($fh);

        return show_alert('페이지 추가 완료.','/dev/p');
    }

    public function p_d($link = '')
    {
        if($link == '')
        {
           return show_alert('need link','/dev/p');
        }

        $list = file_get_contents("./assets_dev/dev_pages.txt");
        $list = str_replace('|'.$link,'', $list);
        $list = str_replace($link.'|','', $list);
        $list = str_replace($link,'', $list);
        
        $myFile = "./assets_dev/dev_pages.txt";
        $fh = fopen($myFile, 'w') or die("can't open file");
        fwrite($fh, $list);
        fclose($fh);

        return show_alert('success delete','/dev/p');
    }

    public function form_ok()
    {
        $dev_ui = json_decode(file_get_contents("./assets_dev/dev_ui.json"),true);

        $form_type = $this->input->get_post('form_type');
        if($form_type == 'upload_header_img')
        {
            if(!@copy('.'.$dev_ui['header_img_path'],'.'.$dev_ui['header_img_path'].'_'.date('YmdHis')))
            {
                $errors= error_get_last();
                print_r("COPY ERROR: ".$errors['type']);
                print_r("<br />\n".$errors['message']);
            }

            $config['upload_path'] = './assets_dev/';
            $config['allowed_types'] = 'png';
            $config['file_name'] = 'header.png';
            $config['overwrite'] = 'true';
            
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                $error = array('error' => $this->upload->display_errors());
                return show_alert('업로드 실패','/dev/manage');    
            }
            return show_alert('반영 완료.','/dev/manage');
        }
        else if($form_type == 'upload_header_tag')
        {
            
        }
        else if($form_type == 'upload_footer_img')
        {
            if(!@copy('.'.$dev_ui['footer_img_path'],'.'.$dev_ui['footer_img_path'].'_'.date('YmdHis')))
            {
                $errors= error_get_last();
                print_r("COPY ERROR: ".$errors['type']);
                print_r("<br />\n".$errors['message']);
            }

            $config['upload_path'] = './assets_dev/';
            $config['allowed_types'] = 'png';
            $config['file_name'] = 'footer.png';
            $config['overwrite'] = 'true';
            
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                $error = array('error' => $this->upload->display_errors());
                return show_alert('업로드 실패','/dev/manage');    
            }
            return show_alert('반영 완료.','/dev/manage');
        }
        else if($form_type == 'upload_footer_tag')
        {
            
        }
    }
}
?>
