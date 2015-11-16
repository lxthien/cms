<?php
function tree_out($note)
{
    $ci =& get_instance();
    $sex = $note->sex=="nam"?"male":"female";
    $link = site_url("home/note/".$note->id);
    echo '<li><a href="'.$link.'" class="fancylink"><span class="'.$sex.'">Đời thứ '.$note->level.' - '.$note->name.'</span></a>';
    
    //$ci->firephp->log($note->countChild());
    $count = $note->countChild();
    //echo '-----'.$count;
    while($count >0)
    {
        //$ci->firephp->log($note->countChild());
        //echo $note->countChild(); 
        echo "<ul>";
        $child = $note->getChild();
        
        foreach($child as $row):
            tree_out($row);
            //$ci->firephp->log($row->id);
        endforeach;
        echo "</ul>";
        
        $count = 0;
    }
    echo "</li>";
    
}
function tree_out_admin($note)
{
    $ci =& get_instance();
    $sex = $note->sex=="nam"?"male":"female";
    $link = site_url("home/note/".$note->id);
    echo '<li><a href="'.$link.'" class="fancylink"><span class="'.$sex.'">Đời thứ '.$note->level.' - '.$note->name.'</span></a>';
    
    echo '<a class="addChildNote" href="'.base_url().'admin/notes/edit/'.$note->id.'" >Add child<a>';
    echo '<a class="editChildNote" href="'.base_url().'admin/notes/edit/'.$note->parentnote_id.'/'.$note->id.'" >Edit<a>';
    echo '<a class="deleteChildNote" href="'.base_url().'admin/notes/deleteTreenote/'.$note->id.'" >Delete<a>';
  
    
    //$ci->firephp->log($note->countChild());
    $count = $note->countChild();
    //echo '-----'.$count;
    while($count >0)
    {
        //$ci->firephp->log($note->countChild());
        //echo $note->countChild(); 
        echo "<ul>";
        $child = $note->getChild();
        
        foreach($child as $row):
            tree_out_admin($row);
            //$ci->firephp->log($row->id);
        endforeach;
        echo "</ul>";
        
        $count = 0;
    }
    echo "</li>";
    
}