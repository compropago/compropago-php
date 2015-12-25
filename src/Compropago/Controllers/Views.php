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
namespace Compropago\Controllers;

class Views{
	
	
	public static function loadView($view,$compropagoData,$method='include',$ext='php',$path=null){
		if($path==null){
			//path relativo al vendor Compropago/views
			$path=__DIR__ . '/../../../views/';
		}
		$filename=$path.$view.$ext;
		if( !file_exists($filename) ){
			throw new Exception('Compropago Error: No se encontro el archivo de View solicitado');
			return;
		}
		switch ($method){
			case 'ob':
				return $this->loadOb($filename , $compropagoData);
			break;
			case 'include':
			default:
				 $this->loadInclude($filename, $compropagoData);
				 return true;
			
		}
		
	}
	
	private function loadInclude($filename,$compropagoData){
		require $filename;
	}
	private function loadTpl(){
	
	}
	private function loadTwig(){
		
	}
	/**
	 * Process by PHP output buffering
	 * Some plugins might require to (string)output
	 * @param string $file Php path/File to output buffer to var
	 * @param mixed $compropagoData data to be processed
	 * @return bool
	 * @return buffer
	 */
	private function loadOb($filename,$compropagoData){
		ob_start();
		require $filename;
		return ob_get_clean();
	}
	
}