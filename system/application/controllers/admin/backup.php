<?php
class Backup extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
    }
    function backnews()
    {
        $this->load->model("common");
        $old_news = $this->common->getall('mf_news');
        $newscatalogue = new Newscatalogue(8);
        foreach($old_news as $row){
            $news = $this->common->getdetaildata('mf_node',array('id'=>$row->nid));
            $article = new Article();
            $article->title_vietnamese = $news->title;
            $article->title_none = $news->title_seo;
            $article->full_vietnamese = str_replace('src="/','src="',$news->content);
            $article->short_vietnamese = $news->description;
            $article->tag = $news->title;
            $article->old_id = 1;
            
            $article->dir = "";
            $article->active = 1;
            $article->image = substr($news->img_url, 1,strlen($news->img_url)-1);
            
            if(!$article->save($newscatalogue))   
            {
                foreach($article->error->all as $error){
						echo "<br>".$error;
					}
            }
               
            $article->clear();
        }
        
    }
    
    function backproject()
    {
        $this->load->model("common");
        $old_news = $this->common->getall('mf_project');
        $newscatalogue = new Newscatalogue(21);
        foreach($old_news as $row){
            $news = $this->common->getdetaildata('mf_node',array('id'=>$row->nid));
            $article = new Article();
            $article->title_vietnamese = $news->title;
            $article->title_none = $news->title_seo;
            $article->full_vietnamese = str_replace('src="/','src="',$news->content);
            $article->short_vietnamese = $news->description;
            $article->tag = $news->title;
            $article->old_id = 1;
            
            $article->dir = "";
            $article->active = 1;
            $article->image = substr($news->img_url, 1,strlen($news->img_url)-1);
            
            if(!$article->save($newscatalogue))   
            {
                foreach($article->error->all as $error){
						echo "<br>".$error;
					}
            }
               
            $article->clear();
        }
        
    }
}