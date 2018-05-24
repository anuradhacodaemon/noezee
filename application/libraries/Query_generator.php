<?php
/**
 * CodeIgniter Query Generator Library
 * Implementation for Rest API query generator for the get api.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Anuradha, Codaemon Softwares Pvt. Ltd.
 * @license         
 * @link            
 * @version         1.0.0
 */
class Query_generator {
	private $filterArray = array();
	private $likeArray = array();
	private $orderArray = array();
	/**
	* Currenly this function is generate only to generate AND Query.
	* Will updated it soon to generate or queries as well
	*/
	public function setfilters($filterString){
		
		$filters = explode(",",$filterString);
		//print_r($filters);
		foreach($filters as $filter)
		{	
			if(strpos($filter,"<=")!==false)
			{
				$this->setFilterKeyValue("<=", $filter);
			}
			else if(strpos($filter, ">=")!==false){
				$this->setFilterKeyValue(">=", $filter);
			}
			else if(strpos($filter, "!=")!==false){
				$this->setFilterKeyValue("!=", $filter);
			}
			else if(strpos($filter, "<")!==false){
				$this->setFilterKeyValue("<", $filter);
			}
			else if(strpos($filter, ">")!==false){
				$this->setFilterKeyValue(">", $filter);
			}
			else if(strpos($filter, "=")!==false){
				$this->setFilterLikeKeyValue($filter);
			}
		}
	}
	/** funciton used to generate equal filter **/
	private function setFilterLikeKeyValue($filter){
		$query = explode("=",$filter);
		if(substr($query[1], 0,1) == '*' && substr($query[1],-1) != '*'){
			$this->setLikeArray($query[0], $query[1], "before");
		}
		else if(substr($query[1], 0,1) != '*' && substr($query[1],-1) == '*'){
			$this->setLikeArray($query[0], $query[1], "after");
		}
		else if(substr($query[1], 0,1) == '*' && substr($query[1],-1) == '*'){
			$this->setLikeArray($query[0], $query[1]);
		}
		else{
			
			$this->filterArray[$query[0]] = $query[1];
		}
	}

	/** Function used to get key value pair **/
	private function setFilterKeyValue($operator,$filter){
		$query = explode($operator,$filter);
		$this->filterArray[$query[0].$operator] = $query[1];
	}

	/** function used to generate like query array **/
	private function setLikeArray($key,$value, $position = null){
		$likeArrCount = count($this->likeArray);
		$this->likeArray[$likeArrCount][0] = $key; 
		$this->likeArray[$likeArrCount][1] = str_replace("*", "", $value);
		if($position){
			$this->likeArray[$likeArrCount][2] = $position;
		}
	}

	/** Function used to preparet order array **/
	public function setOrder($orderString){
		$ordersArr = explode(",",$orderString);
		foreach($ordersArr as $order){
			if($order[0] == "-"){
				$this->orderArray[substr($order,1)] =  "desc";
			}else{
					$this->orderArray[substr($order,1)] =  "asc";
			}
		}
	}

	/** function return filter array **/
	public function getFilter(){
		return $this->filterArray;
	}

	/** function return like array **/
	public function getLike(){
		return $this->likeArray;
	}

	/** return order array **/
	public function getOrder(){
		return $this->orderArray;
	}
}