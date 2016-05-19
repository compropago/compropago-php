<?php
/**
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
 * Compropago php-sdk
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 */

namespace CompropagoSdk\Libs\Views;


class ChargeView
{
    /**
     * @param null $view
     * @param null $dataView
     * @param null $getMethod
     * @param null $ext
     * @return bool|mixed|string
     * @throws \Exception
     */
    public static function getView($view = null, $dataView = null, $getMethod = null, $ext = null)
    {
        $view = empty($view) ? 'raw' : $view;
        $getMethod = empty($getMethod) ? 'include' : $getMethod;
        $ext = empty($ext) ? 'php' : $ext;

        $file = "$view.$ext";
        $full_dir = __DIR__ . "/$ext/$file";

        if(!file_exists($full_dir)){
            throw new \Exception("Vista no localizada: ".$full_dir);
        }

        switch ($getMethod){
            case 'ob':
                return self::loadOb($full_dir, $dataView);
                break;
            case 'include':
                self::loadInclude($full_dir, $dataView);
                return true;
                break;
            case 'path':
                return $full_dir;
                break;
            case 'src':
                return self::loadSrc($full_dir, $dataView);
                break;
            default:
                throw new \Exception("Method not supported");
        }

    }


    /**
     * @param $view
     * @param $dataView
     * @return mixed
     */
    private static function loadSrc($view, $dataView)
    {
        $src = file_get_contents($view);
        if(is_array($dataView)){
            foreach ($dataView as $key => $value){
                if(preg_match("/^{{(.+)}}$/",$key)){
                    $src = str_replace($key,$value,$src);
                }
            }
        }

        return $src;
    }


    /**
     * @param $view
     * @param $dataView
     */
    private static function loadInclude($view, $dataView)
    {
        include_once $view;
    }


    /**
     * @param $view
     * @param $dataView
     * @return mixed
     */
    private static function loadOb($view, $dataView)
    {
        ob_start();
        include_once $view;
        return ob_get_clean();
    }
}