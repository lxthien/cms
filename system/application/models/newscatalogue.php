<?php
class Newscatalogue extends DataMapper
{
    public $table = "newscatalogues";
    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
    public $has_one=array(
        'parentcat'=>array(
            'class'=>'newscatalogue',
            'other_field' => 'child'
        )
    );
    public $has_many=array(
        'article',
        'child'=>array(
            'class'=>'newscatalogue',
            'other_field'=>'parentcat'
        )
        
    );
    // --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
    public $validation = array(
         'name_vietnamese'=>array(
            'label'=>'Tên danh mục',
            'rules'=>array('trim','max_length'=>200)),
         'name_english'=>array(
            'label'=>'Tên danh mục tiếng anh',
            'rules'=>array('trim','max_length'=>200))
         ,'name_none'=>array(
            'label'=>'Tên ko d?u',
            'rules'=>array('required'))
    );

    function __construct($id=NULL)
    {
        parent::__construct($id);
    }

    function buildBreadCum(){
        //$url = '<a href="'.$this->name_none.'"> '.$this->name_vietnamese.' </a>';
        $newscatlogue = $this;
        while($newscatlogue->parentcat_id != null)
        {
            $newscatlogue = new Newscatalogue($newscatlogue->parentcat_id);
            $url = '<a href="'.base_url().$newscatlogue->name_none.'/'.$this->name_none.'"> '.$this->name_vietnamese.' </a> ';
        }

        return $url;
    }

    function getAllChildCat($parentCat = NULL, $listNewsCat = NULL) {
        if($listNewsCat == NULL) {
            $listNewsCat = array();
        }
        if($parentCat == NULL) {
            $parentCat = $this;
        }
        else {
            array_push($listNewsCat, $parentCat->get_clone());
        }
       
        $child = new Newscatalogue();
        $child->where('parentcat_id', $parentCat->id);
        $child->get_iterated();
        
        if($child->result_count() > 0) {
            foreach($child as $row) {
                $listNewsCat = $this->getAllChildCat($row, $listNewsCat);  
            }
        }
        
        return $listNewsCat;
    }

    function getAllNews($condition = array(), $orderBy = "id",$orderDirection = "desc", $offset = null, $limit = null)
    {
        $listChildCat = $this->getAllChildCat();
        $listIntChildCat = array();
       
        foreach($listChildCat as $row) {
            array_push($listIntChildCat, $row->id);
        } 
        array_push($listIntChildCat, $this->id);
        
        $news = new Article();
        $news->where_in_related_newscatalogue('id', $listIntChildCat);
        $news->order_by($orderBy, $orderDirection);
        if(count($condition) > 0) {
            $news->where($condition);
        }
        $news->distinct();
        $news->get_iterated($limit,$offset);
        
        return $news;
    }

    /********************************
    * Up the position 
    * swap position with object that have higher position
    **********************************/
    function up_position()
    {
            $max = new newscatalogue();
            $max->select_max('position');
            $max->where('position <', $this->position);
            $max->where('parentcat_id', $this->parentcat->id);
            $max->get();
            $o = new newscatalogue();
            $o->where('position', $max->position);
            $o->where('parentcat_id', $this->parentcat->id);
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
    function down_position()
    {
        $min = new newscatalogue();
        $min->select_min('position');
        $min->where('position >', $this->position);
        $min->where('parentcat_id', $this->parentcat->id);
        $min->get();
        $o = new newscatalogue();
        $o->where('position', $min->position);
        $o->where('parentcat_id', $this->parentcat->id);
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
    /********************************
    * Override the save method
    * check if new insert the position property
    **********************************/
    function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new newscatalogue();
            $o->select_max('position');
            $o->get();
            if (count($o->all) != 0) {
                $max = $o->position + 1;
                $this->position = $max;
            } else {
                $this->postion = 1;
            }
        }
        return parent::save($object, $related_field);
    }
}
/* End of file newscatalogue.php */
/* Location: ./application/models/newscatalogue.php */