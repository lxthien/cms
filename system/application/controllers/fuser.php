<?php
class fuser extends MY_Controller{
    var $menu_active = "user";
    var $submenu_active = "";
    function fuser()
    {
        parent::__construct();
        $this->isCache = false;
        $this->isRobotFollow =false;
    }
    
    function regiter() 
    {
        $step = 1;
        $this->page_title = "Đăng ký thành viên didongviet.vn";
        $customer = new customer();
        $customer->sex = 'male';
        $msg = "";
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $customer->name = $this->input->post('regis_name');
            $customer->birthday = $this->input->post('regis_birthday');
            $customer->sex = $this->input->post('regis_sex');
            $customer->address = $this->input->post('regis_address');
            $customer->homePhone = $this->input->post('regis_homePhone');
            $customer->mobilePhone = $this->input->post('regis_mobilePhone');
            $customer->username = $this->input->post('regis_username');
            $customer->password = md5($this->input->post('regis_password'));
            $customer->email = $this->input->post('regis_email');
            $customer->isReceiverEmail = $this->input->post('regis_isReceiverEmail');
            $this->load->library("securimage");
            if ($this->securimage->check($_POST['captcha_code']) == false) {
                $msg = "Vui lòng nhập đúng hình ảnh xác nhận";
                $step = 2;
            }
            else
            {
                $customer->emailActiveCode = md5($customer->username.date("Y-m-d H:i:s"));
                $customer->save();
                $subject = "Chúc mừng bạn đã đăng ký thành công tài khoản trên di động việt";
                $content = "Chào ".$customer->name;
                $content.= "<br />Bạn đã đăng ký thành công tài khoản trên website didongviet.vn";
                $content.= "<br />Tên đăng nhập: ".$customer->username;
                $content.= "<br />Mật khẩu: ".$this->input->post('regis_password');
                $content.= "<br />Để hoàn thành đăng ký, vui lòng click vào đường dẫn dưới đây:";
                $content.= "<br /><br /><a href='".base_url()."xac-nhan-dang-ky/".$customer->emailActiveCode."' >".base_url()."xac-nhan-dang-ky/".$customer->emailActiveCode."</a>";
                
                $this->_send_email('myemail',$subject,$content,$customer->email);
                $step = 3;
            }
        }   
        $dis['customer'] = $customer;
        $dis['base_url']=base_url();
        $dis['view']='user/register';
        $dis['step'] = $step;
        $dis['msg'] =$msg;
		$this->viewfront($dis);
         
    }
    
    
    function account() 
    {
        $step = 1;
        $this->page_title = "Tài khoản thành viên didongviet.vn";
        
        $customer = new customer();
        $customer->get_by_username($this->loginUsername);
        if(!$customer->exists())
            show_404();
        $msg = "";
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $customer->name = $this->input->post('regis_name');
            $customer->birthday = $this->input->post('regis_birthday');
            $customer->sex = $this->input->post('regis_sex');
            $customer->address = $this->input->post('regis_address');
            $customer->homePhone = $this->input->post('regis_homePhone');
            $customer->mobilePhone = $this->input->post('regis_mobilePhone');
            //$customer->username = $this->input->post('regis_username');
            if($this->input->post('regis_password') != "")
            {
                $customer->password = md5($this->input->post('regis_password'));
            }
            
            //$customer->email = $this->input->post('regis_email');
            $customer->isReceiverEmail = $this->input->post('regis_isReceiverEmail');
            $this->load->library("securimage");
            if ($this->securimage->check($_POST['captcha_code']) == false) {
                $msg = "Vui lòng nhập đúng hình ảnh xác nhận";
                $step = 2;
            }
            else
            {
                
                $customer->save();
                $msg = "Cập nhật thành công.";
            }
        }   
        $dis['customer'] = $customer;
        $dis['base_url']=base_url();
        $dis['view']='user/account';
        $dis['step'] = $step;
        $dis['msg'] =$msg;
		$this->viewfront($dis);
         
    }
    
    
    
    function forgotPassword()
    {
        $msg = "";
        $view = "user/forgotPassword";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $email = $this->input->post('regis_email');
            
            $customer = new customer();
            $customer->get_by_email($email);
            $view = "user/forgotPasswordResult";
            if($customer->exists())
            {
                 
                if($customer->isEmailActive == 1)
                {
                    $newPassword = substr($customer->password,1,5);
                    $customer->password = md5($newPassword);
                    $subject = "Di động việt: Lấy lại mật khẩu";
                    $content = "Chào ".$customer->name;
                    $content.= "<br />Tài khoản của bạn đã được reset lại mật khẩu website didongviet.vn. vui lòng truy cập website http://didongviet.vn và đăng nhập với mật khẩu bên dưới";
                    $content.= "<br />Tên đăng nhập: ".$customer->username;
                    $content.= "<br />Mật khẩu: ".$newPassword;
                    $content.= "<br />Mật khẩu trên chỉ có giá trị trong vòng 24h. vui lòng truy cập website và đổi mật khẩu ngay khi đăng nhập";
                    $this->_send_email('myemail',$subject,$content,$customer->email);
                   
                    $msg = "Chúng tôi đã gửi email chứa mật khẩu mới của bạn. Vui lòng kiểm tra hộp thư spam hay bulk nếu không tìm thấy email của chúng tôi.";
                }
                else
                {
                    $msg = "Tài khoản của bạn chưa được kích hoạt. Vui lòng kiểm tra email để tìm mail kích hoạt của chúng tôi hoặc click <a href='".base_url()."gui-lai-mail-kich-hoat' >Vào đây</a>";
                    $msg.=" để được yêu cầu gửi lại mail kích hoạt.";
                }
            }else
            {
                $msg = "Tài khoản của bạn không tồn tại trong hệ thống.";
            }
        }
        $dis['base_url']=base_url();
        $dis['view']=$view;
        $dis['msg'] =$msg;
        $this->viewfront($dis);
    }
    
    
    function resentEmailActive()
    {
        $msg = "";
        $view = "user/resentEmailActive";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $email = $this->input->post('regis_email');
            $customer = new customer();
            $customer->get_by_email($email);
            
            $view = "user/resentEmailActiveResult";
            if($customer->exists())
            {
                
                if($customer->isEmailActive == 1)
                {
                    $msg = "Tài khoản của bạn đã được kích hoạt. Vui lòng  click <a href='".base_url()."quen-mat-khau' >Vào đây</a>";
                    $msg.=" để được yêu cầu gửi lại mật khẩu.";
                    
                }
                else
                {
                    $subject = "Chúc mừng bạn đã đăng ký thành công tài khoản trên di động việt";
                    $content = "Chào ".$customer->name;
                    $content.= "<br />Bạn đã đăng ký thành công tài khoản trên website didongviet.vn";
                    $content.= "<br />Tên đăng nhập: ".$customer->username;
                    $content.= "<br />Để hoàn thành đăng ký, vui lòng click vào đường dẫn dưới đây:";
                    $content.= "<br /><br /><a href='".base_url()."xac-nhan-dang-ky/".$customer->emailActiveCode."' >".base_url()."xac-nhan-dang-ky/".$customer->emailActiveCode."</a>";
                    $this->_send_email('myemail',$subject,$content,$customer->email);
                    $msg = "Chúng tôi đã gửi email kích hoạt mới của bạn. Vui lòng kiểm tra hộp thư spam hay bulk nếu không tìm thấy email của chúng tôi.";
                }
            }else
            {
                $msg = "Tài khoản của bạn không tồn tại trong hệ thống.";
            }
        }
        $dis['base_url']=base_url();
        $dis['view']=$view;
    
        $dis['msg'] =$msg;
        $this->viewfront($dis);
    }
    
    private function _loginUser($customer)
    {
        $this->session->set_userdata("userLogin",$customer->username);
        $this->session->set_userdata('userToken',md5($customer->id));
        $this->session->set_userdata('userLoginFlag',"1");
        $this->userLoginFlag = 1;
        $this->loginUsername = $customer->username;
        $this->loginUser = $customer;
    }
    
    function mailActive()
    {
        $code = $this->uri->segment(2);
        $customer = new customer();
        $customer->get_by_emailActiveCode($code);
        $msg = "";
        if($customer->exists()  )
        {
            if($customer->isEmailActive == 0)
            {
                $customer->isEmailActive = 1;
                $customer->save();
                $this->_loginUser($customer);
                $msg = "Chúc mừng ".$customer->name. " đã kích hoạt thành công tài khoản.";
                $msg .= "<br />Click vào đây để về trang chủ:<a href='".base_url()."' >Về trang chủ</a>";
            }else
            {
                $msg = "Tài khoản của bạn đã được kích hoạt từ trước. Liên kết này không có hiệu lực nữa.";
            }
        }else
        {
            $msg = "Tài khoản của bạn không tồn tại trong hệ thống.";
        }
        $dis['customer'] = $customer;
        $dis['base_url']=base_url();
        $dis['view']='user/activeEmail';
        //$dis['step'] = $step;
        $dis['msg'] =$msg;
		$this->viewfront($dis);
    }
    function logout()
    {
        $this->session->set_userdata("userLogin",NULL);
        $this->session->set_userdata('userToken',NULL);
        $this->session->set_userdata('userLoginFlag',NULL);
        redirect("/");
    }
    function login()
    {
        $msg = "";
        $url = $this->uri->uri_string();
        $this->firephp->log($url);
        $url = str_replace('dang-nhap',"",$url);
        $url = trim($url,'/');
        if($this->_checkLogin())
            redirect($url);
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $username = $this->input->post('login_username');
            $password = $this->input->post('login_password');
            $customer = new customer();
            $customer->where('username',$username);
            $customer->where('password',md5($password));
            $customer->get();
            if($customer->exists())
            {
                $this->session->set_userdata("userLogin",$customer->username);
                $this->session->set_userdata('userToken',md5($customer->id));
                $this->session->set_userdata('userLoginFlag',"1");
                
                if( $url != "")
                {
                    redirect($url);
                }
                else
                {
                    redirect("/");
                }
            }else
            {
                $msg = "Tài khoản hay mật khẩu của bạn chưa đúng.";
            }
        }
        $dis['url'] = $url;
        $dis['base_url']=base_url();
        $dis['view']='user/login';
        $dis['msg'] =$msg;
		$this->viewfront($dis);
    }
    
    function popup_login()
    {
        
    }
    
    
    function emailCheck()
    {
        $email = $this->input->post('regis_email');
        $customer = new customer();
        $customer->get_by_email($email);
        if($customer->exists())
            echo 'false';
        else
            echo 'true';
            
        exit;
    }
    
    function usernameCheck()
    {
        $username = $this->input->post('regis_username');
        $customer = new customer();
        $customer->get_by_username($username);
        if($customer->exists())
            echo 'false';
        else
            echo 'true';
            
        exit;
    }
}