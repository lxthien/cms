<?php
class Fcontact extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->menu_active = 'proud'; 
		$this->load->library('email');
		$this->load->helper('email');
		$this->load->plugin('phpmailer');
        $this->show_news_left = true;
    }

    function index()
    {
		$this->load->library("securimage");
        $contact = new Contact();
        $msg = "";
       
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $contact->name = $this->input->post('name');
            $contact->title = $this->input->post('title');
            $contact->email = $this->input->post('email');
            $contact->content = $this->input->post('content');
            $contact->phone = $this->input->post('phone');
            $contact->sex = $this->input->post('sex');
            $contact->address = $this->input->post('address');
            $contact->cat = 1;


            if ($this->securimage->check($_POST['captcha_code']) == false) {
                $msg = "Vui lòng nhập đúng hình ảnh xác nhận";
                $type = 2;
            }
            else
            {
                if($contact->save())
                {
                    //redirect("lien-he/success");
                    $type = 1;
					/*
					$content = "<html><head></head><body>";
					$content .= "<br>Hi Mr/ms !";
					$content .= "<br>We've received a contact information from lienminh.com.vn website . Please see detail below :";
					$content .= "<br>Title:".$contact->title;
					$content .= "<br>Name:".$contact->name;
					$content .= "<br>Email:".$contact->email;
					$content .= "<br>Message:".$contact->content; 
					$content .="</body></html>";
					$this->sendMail($content);
					*/
					/*if($this->_send_email($file_name, $file_path))
					{
						$msg = "Chúng tôi đã nhận được thông tin của bạn. Cám ơn .";
					} else {
						$msg = "Có lỗi xảy ra trong quá trình gửi mail.";
					}*/
                    $msg = "Chúng tôi đã nhận được thông tin của bạn. Cám ơn .";
                    $contact->clear();
                }
                else
                {
                    $msg="Có 1 số lỗi sau :\n";
                    foreach($contact->error->all as $row)
                    {
                        $msg.=$row."\n";
                    }
                }
            }
        }
       
        $dis['contact']   = $contact;
        $this->menu_active ="contact";
        $this->page_title = "Liên hệ - ".$this->page_title;

        $news =  new Article(9);
        $dis['news'] = $news;

        $dis['msg'] = $msg;
        $dis['msg_type'] = 1;
        $dis['breadcum'] = '<span>'.$news->title_vietnamese.'</span>';

        $dis['base_url']=base_url();
        $dis['view']='contact';

        $this->page_title = $news->{'title_vietnamese'};
        $this->page_description = $news->short_vietnamese;
        $this->page_keyword = $news->tag;

        $this->viewfront($dis);
    }

    function form_buy_oto()
    {
        $this->load->library("securimage");
        $contact = new Contact();
        $msg = "";

        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $contact->name = $this->input->post('name');
            $contact->sex = $this->input->post('sex');
            $contact->email = $this->input->post('email');
            $contact->address = $this->input->post('address');
            $contact->phone = $this->input->post('phone');
            $contact->catalog = $this->input->post('catalog');
            $contact->price_lending = $this->input->post('price_lending');
            $contact->time_lending = $this->input->post('time_lending');
            $contact->title = 'Do not care';
            $contact->content = 'Do not care';
            $contact->cat = 2;


            if ($this->securimage->check($_POST['captcha_code']) == false) {
                $msg = "Vui lòng nhập đúng hình ảnh xác nhận";
                $type = 2;
            }
            else
            {
                if($contact->save())
                {
                    $msg = "Chúng tôi đã nhận được thông tin của bạn. Cám ơn .";
                    $contact->clear();
                }
                else
                {
                    $msg="Có 1 số lỗi sau :\n";
                    foreach($contact->error->all as $row)
                    {
                        $msg.=$row."\n";
                    }
                }
            }
        }

        $dis['msg'] = $msg;
        $dis['msg_type'] = 1;
        $dis['contact']   = $contact;

        $news =  new Article(226);
        $dis['news'] = $news;

        $this->page_title = $news->{'title_vietnamese'};
        $this->page_description = $news->short_vietnamese;
        $this->page_keyword = $news->tag;

        $dis['breadcum'] = '<span>'.$news->title_vietnamese.'</span>';
        $dis['base_url']=base_url();
        $dis['view']='catalogue';

        $this->viewfront($dis);
    }

    function form_advices_buy_oto()
    {
        $this->load->library("securimage");
        $contact = new Contact();
        $msg = "";

        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $contact->name = $this->input->post('name');
            $contact->title = 'Tư vấn mua xe';
            $contact->email = $this->input->post('email');
            $contact->content = $this->input->post('content');
            $contact->phone = $this->input->post('phone');
            $contact->sex = $this->input->post('sex');
            $contact->address = $this->input->post('address');
            $contact->cat = 3;


            if ($this->securimage->check($_POST['captcha_code']) == false) {
                $msg = "Vui lòng nhập đúng hình ảnh xác nhận";
                $type = 2;
            }
            else
            {
                if($contact->save())
                {
                    $msg = "Chúng tôi đã nhận được thông tin của bạn. Cám ơn .";
                    $contact->clear();
                }
                else
                {
                    $msg="Có 1 số lỗi sau :\n";
                    foreach($contact->error->all as $row)
                    {
                        $msg.=$row."\n";
                    }
                }
            }
        }

        $dis['msg'] = $msg;
        $dis['msg_type'] = 1;

        $news =  new Article(227);
        $dis['news'] = $news;

        $this->page_title = $news->{'title_vietnamese'};
        $this->page_description = $news->short_vietnamese;
        $this->page_keyword = $news->tag;

        $dis['breadcum'] = '<span>'.$news->title_vietnamese.'</span>';
        $this->uri = base_url().substr($this->uri->uri_string, 1, strlen($this->uri->uri_string));
        $dis['contact']   = $contact;
        $dis['base_url']=base_url();
        $dis['view']='advices_buy_oto';

        $this->viewfront($dis);
    }

    function sendMail($content)
    {
        $config = Array(
            'mailtype'  => 'html'
        );
        $this->load->helper('email');
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->clear();
        $this->email->from('info@lienminh.com.vn', 'Liên minh');
        $this->email->to(getconfigkey("email"));
        $this->email->subject("There're a new contact infomation from liemminh.com.vn");
        $this->email->message($content);
        $this->email->send();
    }
    
	function _send_email()
    {        
		$this->data['subject']		= $this->input->post('title');
		$this->data['message']   	= "<p><b><i>Email được gửi từ chức năng liên hệ của website <a href='http://didongviet.vn'>http://didongviet.vn</a></i></b></p> <br />"; 
		$this->data['message']   	.= "---------------- Thông Tin Người Gửi ---------------- <br />";        
        $this->data['message']   	.= "<b><i>Họ Tên:</i></b> ".$this->input->post('name')."<br />";
		$this->data['message']   	.= "<b><i>Email:</i></b> <a href='mailto:".$this->input->post('email')."'>".$this->input->post('email')."</a> <br />";
		$this->data['message']   	.= "<b><i>Điện Thoại:</i></b> ".$this->input->post('phone')."<br /><br />";
        $this->data['message']   	.= "---------------------- Nội Dung --------------------- <br />";
        $this->data['message']   	.= $this->input->post('content')."<br />";
		
		//Establish settings for phpmailer to use to send the mail
		$mailer = new PHPMailer();
		$mailer->CharSet = 'UTF-8';
		$mailer->SMTPDebug = 1;
		
		$mailer->IsSMTP(); // set mailer to use SMTP
		$mailer->Host = "smtp.googlemail.com"; // specify main and backup server
		$mailer->Port = 465; // set the port to use
		$mailer->SMTPAuth = true; // turn on SMTP authentication
		$mailer->SMTPSecure = 'ssl';
		$mailer->Username = "sendmail.sts@gmail.com"; // your SMTP username or your gmail username
		$mailer->Password = "123sts!@#"; // your SMTP password or your gmail password
		
		$mailer->From = $this->input->post('email');
		$mailer->FromName = $this->input->post('name');
		$mailer->Subject = $this->data['subject'];
		$mailer->Body = $this->data['message'];
		//$mailer->AddAttachment($file_path, $file_name); // add attache file
		$mailer->WordWrap = 50;
		$mailer->IsHTML(true);
		//$mailer->AddAddress('info@lienminh.com.vn','Info - Lien Minh');
		$mailer->AddAddress(getconfigkey('email_contact'),'Info - Di Dong Viet');
		//Send the mail
		if($mailer->Send()){
			return true;
		} else {
			return false;
		}
    }
}