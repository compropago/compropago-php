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
 * @since 1.0.1
 * @author Rolando Lucio <rolando@compropago.com>
 * @version 1.0.1
 */
namespace Compropago\Utils;

class Utils{

	/**
	 * Normalize all keys in an array to lower-case.
	 * @param array $arr
	 * @return array Normalized array.
	 * @since 1.0.1
	 * @version 1.0.1
	 */
	public static function normalize($arr)
	{
		if (!is_array($arr)) {
			return array();
		}
		$normalized = array();
		foreach ($arr as $key => $val) {
			$normalized[strtolower($key)] = $val;
		}
		return $normalized;
	}
	/**
	 * Convert a string to camelCase
	 * @param  string $value
	 * @return string
	 * @since 1.0.1
	 * @version 1.0.1
	 */
	public static function camelCase($value)
	{
		$value = ucwords(str_replace(array('-', '_'), ' ', $value));
		$value = str_replace(' ', '', $value);
		$value[0] = strtolower($value[0]);
		return $value;
	}
	
	/**
	 * Convert Array to QueryString or validate string
	 * @param array $query | string QueryString
	 * @param string $prefix
	 * @since 1.0.1
	 * @version 1.0.1
	 */
	public static function encodeQueryString( $query, $prefix=null) {
		if (!is_array($query)){
			if (parse_url($query, PHP_URL_QUERY)){
				return $query;
			}else{
				return $query;
			}
		}
		
		
		return http_build_query($query,$prefix);
	}
	
}