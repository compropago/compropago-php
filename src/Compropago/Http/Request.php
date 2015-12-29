<?php
/*
* Copyright 2015 Compropago.
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*     http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
/**
 * @author Rolando Lucio <rolando@compropago.com>
 */
namespace Compropago\Http;

use Compropago\Utils\Utils;
use Compropago\Exception;

class Request{
	
	protected $userAgent;
	protected $requestMethod;
	protected $url;
	protected $options;
	protected $data;
	protected $requestHeaders;
	protected $auth;
	
	public function __construct($url,$method = 'GET',$headers = array(),$data = null) {
		if(empty($url)){
			throw new Exception('Missing Url');
		}
				$this->setUrl($url);
				$this->setRequestMethod($method);
				$this->setRequestHeaders($headers);
				$this->setData($data);
	}
	public function setUrl($url){
		$this->url=$url;
	}
	public function appendUrl($add){
		$this->url=$this->url.$add;
	}
	public function setAuth($arr){
		if(!is_array($arr)){
			return false;
		}
		//eval keys reg express
		$this->auth= $arr[0] . ":" . $arr[1];
	}
	public function getAuth(){
		return $this->auth;
	}
	
	public function setOptions($options){
	    $this->options = $options + $this->options;
	}
	
	public function getOptions(){
		return $this->options;
	}
	
	/**
	 * Set Method Options
	 * @param string $method
	 * @throws Exception
	 */
	public function setMethodOptions($method){
		switch ($method){
			case 'GET':
				$this->options[CURLOPT_HTTPGET] = 1;
			break;
			case 'DELETE':
				$this->options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
			break;
			case 'POST':
				$this->data=json_encode($this->data);
				$this->options[CURLOPT_POST] = 1;
				$this->options[CURLOPT_POSTFIELDS] = $this->datadata;;
			break;
			case 'PUT':
				$this->data=json_encode($this->data);
				$this->options[CURLOPT_CUSTOMREQUEST] = 'PUT';
				$this->options[CURLOPT_POSTFIELDS] = $this->data;
			break;			
			default:
				throw new Exception('Invalid Request Method');
		}
		if(!$this->evalData() && $method!='GET'){
			throw new Exception('Method require Data');
		}	
	}
	
	public function setRequestMethod($method){
		$this->requestMethod = strtoupper($method);
		return true;
	}
	
	public function setRequestHeaders($headers){
		$headers = Utils::normalize($headers);
		if ($this->requestHeaders) {
			$headers = array_merge($this->requestHeaders, $headers);
		}
		$this->requestHeaders = $headers;
	}
	
	public function setUserAgent($suffix,$prefix,$contained=null){
		$this->userAgent= ($contained) ? $suffix.$prefix.' ('.$contained.')' : $suffix.$prefix;
	}
	
	public function getUserAgent(){
		return $this->userAgent;
	}
	
	public function getRequestMethod(){
		return $this->requestMethod;
	}
	
	public function setData($data){
		$this->data=$data;
	}
	
	
	/**
	 * Check if data is going to be sent or not data
	 * @return boolean 
	 * @throws Exception
	 */
	public function evalData(){
	    if (($this->getRequestMethod() == "POST" || $this->getRequestMethod() == "PUT" ) && !empty($this->data)) {
	    	if(!json_decode($this->data)){
	    		throw new Exception('Invalid Json for Data');
	    	}
	    	
			$this->setRequestHeaders(
		          array(
		            "content-type" => "application/json",
		          	"content-length" => strlen($this->data)
		          )
		    );
			return true;
	    }
	    
	    if(($this->getRequestMethod() == "GET" || $this->getRequestMethod() == "DELETE" ) && !empty($this->data)){
	    	
	    	$this->data=Utils::encodeQueryString($this->data);
	    	if(!$this->data){
	    		throw new Exception('Invalid Query String for Data');
	    	}
	    	return true;
	    }
	    
	    if(!empty($this->data)){
	    	throw new Exception('Method should be defined');
	    }
	    //no data
	    return false;   
	} 
	
	
}