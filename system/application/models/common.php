<?php 
class Common extends Model{
	function Common ()
	{
		parent::Model();
	}
	function countall($st)
	{
		$rs=$this->db->get($st);
		return $rs->num_rows();
	}
	function getall($st,$orderby='id',$order='desc')
	{
		$this->db->order_by($orderby,$order);
		$rs=$this->db->get($st);
	
		return $rs->result();
	}
	function countalldata($st,$data)
	{	
		$rs=$this->db->get_where($st,$data);
	
		return $rs->num_rows();
	}
	function getmax($st,$fields)
	{
		$this->db->select_max($fields,'xmax');
		$rs=$this->db->get($st);
		return $rs->row();
	}
	function getmaxdata($st,$fields,$data)
	{
		$this->db->select_max($fields,'xmax');
		$this->db->where($data);
		$rs=$this->db->get($st);
		return $rs->row();
	}
	function getmaxrow($st,$field,$data)
	{
		$this->db->select_max($field);
		$this->db->where($data);
		$rs=$this->db->get($st);
		$k=$rs->row();
		if($k->{$field}!==NULL)
		{
		  $r=$this->db->get_where($st,array($field=>$k->{$field}));
		  return $r->row();
		  
		 }
		 else
		 	return $k;	
	}
	function getminrow($st,$field,$data)
	{
		$this->db->select_min($field);
		$this->db->where($data);
		$rs=$this->db->get($st);
		$k=$rs->row();
		if($k->{$field}!==NULL)
		{
		  $r=$this->db->get_where($st,array($field=>$k->{$field}));
		  return $r->row();
		 }
		 else
		 	return $k;	
	}
	function getalldata($st,$data,$orderby='id',$order='desc')
	{
	
		$this->db->order_by($orderby,$order);
		$rs=$this->db->get_where($st,$data);

		return $rs->result();
	}
	function getlimit($st,$limit,$offset,$orderby='id',$order='desc')
	{
		$this->db->order_by($orderby,$order);
		$rs=$this->db->get($st,$limit,$offset);
		return $rs->result();
	}
	function getlimitdata($st,$data,$limit,$offset,$orderby='id',$order='desc')
	{
		$this->db->order_by($orderby,$order);
		$rs=$this->db->get_where($st,$data,$limit,$offset,$orderby='id');
		//	echo $this->db->last_query();
		return $rs->result();
	}
	function getfirstrow($st,$data,$orderby='id',$order='desc')
	{
		$this->db->order_by($orderby,$order);
		$rs=$this->db->get_where($st,$data);
		return $rs->row();
	}
	function getdetail($st,$id)
	{
			
	
		$rs=$this->db->get_where($st,array('id'=>$id));
	
		if($rs->num_rows()>0)
			return $rs->row();
		else
			return 0;
	}
	function getdetaildata($st,$data)
	{
		
	
		$rs=$this->db->get_where($st,$data);
		
		if($rs->num_rows()>0)
			return $rs->row();
		else
			return 0;
	}
	
	//insert update delete
	function insert($st,$data)
	{
		$this->db->insert($st,$data);
		//	var_dump($rs);
		
	}
	function insertBanner($st,$data)
	{
		$this->db->insert($st,$data);
		$rs=$this->db->get_where($st,array('create_datetime'=>$data['create_datetime']));
		//	var_dump($rs);
		if($rs->num_rows()>0)
		{
			$result=$rs->row();
			return $result->id;
		}
	}
	function update($st,$id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update($st,$data);
	}
	function updatedata($st,$da,$data)
	{
		$this->db->where($da);
		$this->db->update($st,$data);
	}
	function delete($st,$id)
	{
		$this->db->where('id',$id);
		$this->db->delete($st);
	}
	function deletedata($st,$data)
	{
		$this->db->where($data);
		$this->db->delete($st);
	}
	function getquery($query)
	{
		$rs=$this->db->query($query);
		return $rs->result();	
	}
	//end insert update delete
	
	function query($query)
	{
		$rs=$this->db->query($query);
		
		return $rs->result();
			
	}		
    function check_field_exist($table_name,$field_name)	
    {
        return $this->db->field_exists($field_name,$table_name);
    }	
    function create_field($tablename,$data)
    {
        $this->load->dbforge();
        $this->dbforge->add_column($tablename, $data);
    }
		
}