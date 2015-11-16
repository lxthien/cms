<?php
class Article extends DataMapper
{
    public $table = "articles";

    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
    public $has_one=array(
        'newscatalogue',
        'newstopic'
    );

    public $has_many=array(
        'newscomment'    
    );

    // --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
    public $validation = array(
         'title_vietnamese'=>array(
            'label'=>'Tiêu đề tin tức',
            'rules'=>array('trim','required'))
         ,'title_none'=>array(
            'label'=>'Tiêu đề không dấu',
            'rules'=>array('trim','required'))
         ,'short_vietnamese'=>array(
            'label'=>'Tin ngắn',
            'rules'=>array('trim','required'))
         ,'full_vietnamese'=>array(
            'label'=>'Tin đầy đủ',
            'rules'=>array('trim','required'))
        ,'newscatalogue'=>array(
            'label'=>'Danh mục',
            'rules'=>array('required'))
    );


    function __construct($id=NULL) {
        parent::__construct($id);
    }

    
    function increase_view() {
        $this->view_count  += 1 ;
        $this->save();
    }


    function buildBreadCum(){
        $url = '<span>'.$this->title_vietnamese.'</span>';
        $newsCat = $this;
        while($newsCat->newscatalogue_id != null) {
            $newsCat = new Newscatalogue($newsCat->newscatalogue_id);
            if ($newsCat->isSystem == 0) {
                $url = '<a href="'.$newsCat->title_none.'"> '.$newsCat->name_vietnamese.' </a>'.$url;
            }
        }
        
        return $url;
    }
    

    /********************************
    * Up the position 
    * swap position with object that have higher position
    **********************************/
    function up_position() {
        $max = new article();
        $max->select_max('position');
        $max->where('position <', $this->position);
        $max->where('parentmenu_id', $this->parentmenu->id);
        $max->get();
        $o = new article();
        $o->where('position', $max->position);
        $o->where('parentmenu_id', $this->parentmenu->id);
        $o->get();
        
        if ($o->result_count() > 0) {
            $tg = $this->position;
            $this->position = $o->position;
            $o->position = $tg;
            $o->save();
            $this->save();
            return TRUE;
        } else 
            return FALSE;
    }


    /********************************
    * Down the position 
    * swap position with object that have lower position
    **********************************/
    function down_position() {
        $min = new article();
        $min->select_min('position');
        $min->where('position >', $this->position);
        $min->where('parentmenu_id', $this->parentmenu->id);
        $min->get();
        $o = new article();
        $o->where('position', $min->position);
        $o->where('parentmenu_id', $this->parentmenu->id);
        $o->get();
        if ($o->result_count() > 0) {
            $tg = $this->position;
            $this->position = $o->position;
            $o->position = $tg;
            $o->save();
            $this->save();
            return true;
        } else {
            return false;
        }
    }


    function down_position_home() {
        $min = new article();
        $min->select_min('home_hot_position');
        $min->where('home_hot_position >', $this->home_hot_position);
        $min->where('home_hot', 1);
        $min->get();
        $o = new article();
        $o->where('home_hot_position', $min->home_hot_position);
        $o->where('home_hot', 1);
        $o->get();
        if ($o->result_count() > 0) {
            $tg = $this->home_hot_position;
            $this->home_hot_position = $o->home_hot_position;
            $o->home_hot_position = $tg;
            $o->save();
            $this->save();
            $this->arrange_position_home();
            return true;
        } else {
            return false;
        }
    }


    function up_position_home() {
        $max = new article();
        $max->select_max('home_hot_position');
        $max->where('home_hot_position <', $this->home_hot_position);
        $max->where('home_hot', 1);
        $max->get();
        $o = new article();
        $o->where('home_hot_position', $max->home_hot_position);
        $o->where('home_hot', 1);
        $o->get();
        if ($o->result_count() > 0) {
            $tg = $this->home_hot_position;
            $this->home_hot_position = $o->home_hot_position;
            $o->home_hot_position = $tg;
            $o->save();
            $this->save();
            $this->arrange_position_home();
            return true;
        } else {
            return false;
        }
    }

    
    function up_position_home_top() {
        $this->home_hot_position = 1;
        $this->save();
        $this->arrange_position_home();
    }


    function down_position_home_bottom() {
        $max = new article();
        $max->select_max('home_hot_position');
        $max->where('home_hot', 1);
        $max->get();
        $this->home_hot_position = $max->home_hot_position + 1;
        $this->save();
        $this->arrange_position_home();
    }

    
    //add news to top of homepage
    function set_home() {
        if($this->home_hot !=1 )
        {
            $o = new article();
            $o->where('home_hot',1);
            $o->select_max('home_hot_position');
            $o->get();
            if (count($o->all) != 0) {
                    $max = $o->home_hot_position + 1;
                    $this->home_hot_position = $max;
            } else {
                    $this->home_hot_postion = 2;
            }
            $this->home_hot = 1;
            $this->save();
            $this->arrange_position_home();
        }
    }


    private function arrange_position_home() {
        $o =  new Article();
        $o->where('home_hot',1);
        $o->order_by('home_hot_position','asc');
        $o->get();
        $c = $o->count();
        $i=1;
        foreach($o as $row)
        {
            $i++;
            $row->home_hot_position = $i;
            $row->save();
        }
        
    }


    function unset_home() {
        $this->home_hot = 0;
        $this->home_hot_position = 0;
        $this->save();
    }


    /********************************
    * Override the save method
    * check if new insert the position property
    **********************************/
    function save($object = '', $related_field = '') {
        if (!$this->exists() ||  empty($this->code)) {
            $o = new article();
            $o->select_max('position');
            $o->get();
            if (count($o->all) != 0) {
                $max = $o->position + 1;
                $this->position = $max;
            } else {
                $this->postion = 1;
            }
            $position=(string)$this->position;
            $l=5-strlen($position);
            $st="";
            for($i=0;$i<$l;$i++)
            {
                $st.="0";
            }
            $position=$st.$position;
            $this->code="NEWS".$position;
        }
        return parent::save($object, $related_field);
    }


    function deep_delete()
    {
        $this->delete(array($this->newscomment));
        parent::delete();
    }
}
/* End of file news.php */
/* Location: ./application/models/news.php */