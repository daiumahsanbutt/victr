<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Rogervila\ArrayDiffMultidimensional;
class RouterModal extends CI_Model {
    
    public function index(){
        return array(

        );
    }
    public function getProjects(){
        $this->benchmark->mark('server_processing_start');
        $projects = array();
        $total_records = 0;
        $filteredRecords = 0;
        $columns = [
            'repo_id',
            'name',
            "stars",
            "",
        ];
        $this->db->select('COUNT(*) as totalEntries');
        $query = $this->db->get(TB_PROJECTS);
        $total_records = $query->result_array()[0]['totalEntries'];

        $this->db->select('COUNT(*) as totalEntries');
        if(isset($_POST['search']['value']) && $_POST['search']['value'] != ""){
            $searchPhrase = $_POST['search']['value'];
            $this->db->group_start();
            $this->db->or_like('name', trim($searchPhrase)); 
            $this->db->or_like('repo_id', trim($searchPhrase)); 
            $this->db->or_like('stars', trim($searchPhrase)); 
            $this->db->group_end(); 
        }     
        $query = $this->db->get(TB_PROJECTS);
        $filteredRecords = $query->result_array()[0]['totalEntries'];


        $this->db->select("*");
        if(isset($_POST['search']['value']) && $_POST['search']['value'] != ""){
            $searchPhrase = $_POST['search']['value'];
            $this->db->group_start();
            $this->db->or_like('name', trim($searchPhrase)); 
            $this->db->or_like('repo_id', trim($searchPhrase)); 
            $this->db->or_like('stars', trim($searchPhrase));
            $this->db->group_end(); 
        }       
        if(isset($_POST['order'])){
            $orderSettings = $_POST['order'];
            foreach($orderSettings as $order){
                $index = $order['column'];
                $direction = $order['dir'];
                $this->db->order_by($columns[$index] . " " . $direction); 
            }
        } else {
            $this->db->order_by("stars", "desc");
        }          
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'], $_POST['start']);
        } else {
            $this->db->limit(10, 0);
        }
        $query = $this->db->get(TB_PROJECTS);
        $projects = $query->result_array();
        $this->benchmark->mark('server_processing_end');
        $output = array(
            "recordsTotal" => $total_records,
            "recordsFiltered" => $filteredRecords,
            "data" => $projects,
            "server_processing_time" => $this->benchmark->elapsed_time("server_processing_start","server_processing_end")
        );
        return $output;
    }      
	public function syncProjects() {
        $url = 'https://api.github.com/search/repositories?q=language:php&sort=stars&order=desc';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'VICTR');
        $result = curl_exec($ch);
        curl_close($ch);
        $projects = json_decode($result, true)['items'];
		$projectsToInsert = array();
		foreach($projects as $project){
			array_push($projectsToInsert, array(
				'repo_id' => $project['id'],
				'name' => $project['name'],
				'url' => $project['html_url'],
				'created_date' => date('Y-m-d', strtotime($project['created_at'])),
				'last_push_date' => date('Y-m-d', strtotime($project['pushed_at'])),
				'description' => $project['description'],
				'stars' => $project['stargazers_count']
			));
		}
		$this->db->truncate(TB_PROJECTS);
		$this->db->trans_begin();
        $project_chunks = array_chunk($projectsToInsert, 10);
		foreach($project_chunks as $chunk){
            $this->db->insert_batch(TB_PROJECTS, $chunk); 
        }
		if ($this->db->trans_status() === FALSE){
            $error = $this->db->error();
            $this->db->trans_rollback();
            return array(
                "status" => 0,
                "errors" => array(
                    "projects" => "There was an error syncing projects. Please try again or contact support."
                ),
                "error" => $error
            );
        }
        $this->db->trans_commit();
		return array(
            "status" => 1,
            "text" => "Projects synced successfully."
        );
    }
}

?>