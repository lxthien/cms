<?php
class Contacts extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>11));
        $this->load->library('login_manager');
    }

    function index()
    {
        $this->list_all();
    }

    function list_all()
    {
        $contact = new contact();
        $contact->order_by('id','desc');
        $contact->get();

        $dis['base_url']=base_url();
        $dis['view']='contact/list';
        $dis['menu_active']='Phản hồi liên hệ';
        $dis['title']="Phản hồi liên hệ";
        $dis['contact']=$contact;
        $this->viewadmin($dis);
    }

    function car_installment()
    {
        $contact = new contact();
        $contact->where('cat', 2);
        $contact->order_by('id','desc');
        $contact->get();

        $dis['base_url']=base_url();
        $dis['view']='contact/list';
        $dis['menu_active']='Mua xe trả góp';
        $dis['title']="Mua xe trả góp";
        $dis['contact']=$contact;
        $this->viewadmin($dis);
    }

    function car_buying_advice()
    {
        $contact = new contact();
        $contact->where('cat', 3);
        $contact->order_by('id','desc');
        $contact->get();

        $dis['base_url']=base_url();
        $dis['view']='contact/list';
        $dis['menu_active'] = 'Form tư vấn mua xe';
        $dis['title'] = "Form tư vấn mua xe";
        $dis['contact']=$contact;
        $this->viewadmin($dis);
    }

    function buy_old_car_hight_price()
    {
        $contact = new contact();
        $contact->where('cat', 205);
        $contact->order_by('id','desc');
        $contact->get();

        $dis['base_url']=base_url();
        $dis['view']='contact/list';
        $dis['menu_active'] = 'Mua xe ô tô cũ giá cao';
        $dis['title'] = "Form mua xe ô tô cũ giá cao";
        $dis['contact']=$contact;
        $this->viewadmin($dis);
    }

    function valuation_of_old_cars()
    {
        $contact = new contact();
        $contact->where('cat', 180);
        $contact->order_by('id','desc');
        $contact->get();

        $dis['base_url']=base_url();
        $dis['view']='contact/list';
        $dis['menu_active'] = 'Định giá xe ô tô cũ';
        $dis['title'] = "Form định giá xe ô tô cũ";
        $dis['contact']=$contact;
        $this->viewadmin($dis);
    }

    function consignment_of_old_cars()
    {
        $contact = new contact();
        $contact->where('cat', 175);
        $contact->order_by('id','desc');
        $contact->get();

        $dis['base_url']=base_url();
        $dis['view']='contact/list';
        $dis['menu_active'] = 'Nhận ký gửi xe ô tô cũ';
        $dis['title'] = "Form nhận kí gửi xe ô tô cũ";
        $dis['contact']=$contact;
        $this->viewadmin($dis);
    }

    function buy_fleet()
    {
        $contact = new contact();
        $contact->where_in('cat', array(4, 5));
        $contact->order_by('id','desc');
        $contact->get();

        $dis['base_url']=base_url();
        $dis['view']='contact/list_fleet';
        $dis['menu_active'] = 'Mua Fleet';
        $dis['title'] = "Form Mua fleet";
        $dis['contact'] = $contact;
        $this->viewadmin($dis);
    }
   
    function edit($id=0)
    {
        $contact=new contact($id);
        $dis['base_url']=base_url();
        $dis['title']="Thêm/ Sửa danh mục tin tức";
        $dis['menu_active']="Danh mục";
        $dis['view']="contact/edit";
        $dis['contact']=$contact;
        $this->load->view('admin/contact/edit',$dis);
    }
   
   
    function delete($id)
    {
      
        $contact = new contact($id);
        //delete city
        
        $contact->delete();
        //redirect to city
        redirect($this->admin.'contacts/list_all/');
    }
}
/* End of file contacts.php */
/* Location: ./application/controller/contacts.php */