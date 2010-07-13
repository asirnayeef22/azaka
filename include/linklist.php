<?php
include_once("../include/userobject.php");
class LinkList {
	var $links;
	var $counter;
	var $u;
	function __construct(&$u){
		$this->links = array();
		$this->counter = 0;
		$this->u = $u;
	}
	function additem($label,$link, $reqaccess){
		if ($this->u->access >= $reqaccess){
			$this->links[$this->counter]["label"] = $label;
			$this->links[$this->counter++]["link"] = "javascript:grabContent('$link');";
		}
	}
	function addlink($label,$link, $reqaccess){
		if ($this->u->access >= $reqaccess){
			$this->links[$this->counter]["label"] = $label;
			$this->links[$this->counter++]["link"] = $link;
		}
	}
	function addbreak(){
		$this->counter++;
	}
	function dispList(){
		if($this->counter!=0){
			$output = "<div id=\"linklist\"><ul>".$this->dispBar()."</div>";
			return $output;
		}
	}
	function dispBox($rows){ //TODO
		if($this->counter!=0){
			$output = "<div id=\"linklist\"><ul>".$this->dispBar()."</div>";
			return $output;
		}
	}
	function dispBar(){
	if($this->counter!=0){
		$output = "<ul>";
		for($i=0; $i != $this->counter; $i++)
			if(isset($this->links[$i]['label']) && $this->links[$i]['label'] != "")
				$output .= "<li><a href=\"".$this->links[$i]["link"]."\">".$this->links[$i]["label"]."</a></li>";
	}
	$output .= "</ul>";
	$this->counter=0;
	return $output;
	}
}
?>