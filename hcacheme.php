<?php
/**
 * name: CacheMe
 * description: mein CacheSystem
 * version: 0.1
 * folder: cacheme
 * class: hCacheMe
 * type: system
 * hooks: theme_index_top
 * author: Andreas Votteler
 * authorurl: http://www.trendkraft.de
 *
 * PHP version 5
 *
 * LICENSE: Hotaru CMS is free software: you can redistribute it and/or 
 * modify it under the terms of the GNU General Public License as 
 * published by the Free Software Foundation, either version 3 of 
 * the License, or (at your option) any later version. 
 *
 * Hotaru CMS is distributed in the hope that it will be useful, but WITHOUT 
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 * FITNESS FOR A PARTICULAR PURPOSE. 
 *
 * You should have received a copy of the GNU General Public License along 
 * with Hotaru CMS. If not, see http://www.gnu.org/licenses/.
 * 
 * @category  Content Management System
 * @package   HotaruCMS
 * @author    Nick Ramsay <admin@hotarucms.org>
 * @copyright Copyright (c) 2013, Hotaru CMS
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link      http://www.hotarucms.org/
 */

class hCacheMe
{    

    /**
    *
    * @param 
    * @param 
    * @return 
    */ 
    public function theme_index_top($h)
    {
        

        $url = $h->cage->server->sanitizeTags('REQUEST_URI');
        $cacheid = 'cacheme_' . md5($url);


        if(apc_exists($cacheid) != false)
        {

            $output = apc_fetch($cacheid);
            echo $output;
            //exit;
        } 
        
        


        ob_start();


        require_once('index.php');


        $output = ob_get_contents();


        apc_store($cacheid, $output, 300);

        }

    }

?>