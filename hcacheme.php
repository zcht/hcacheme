<?php
/**
 * name: hCacheMe
 * description: APC for Hotaru CMS
 * version: 0.1
 * folder: hcacheme
 * class: hCacheMe
 * type: system
 * hooks: theme_index_top, debug_footer, admin_plugin_tabLabel_pre_first, admin_plugin_tabContent_pre_first
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
        // fail if apc not loaded
        if (!extension_loaded('apc')) return false;
        
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

        
        
     /**
    *
    * @param 
    * @param 
    * @return 
    */ 
        public function debug_footer($h)
        {
            if (!extension_loaded('apc')) { 
                echo " | apc not loaded";
            } else  {
                $cacheid = 'cacheme_' . md5($h->cage->server->sanitizeTags('REQUEST_URI'));
                    if(apc_exists($cacheid) != false) $msg = " and page was cached"; else $msg = " but page not cached";             
                echo ' | apc loaded' . $msg;
            }
        }

        
        public function admin_plugin_tabLabel_pre_first($h)
        {            
                echo '<li><a href="#dashboard" data-toggle="tab">Dashboard</a></li>';
        }        

        public function admin_plugin_tabContent_pre_first($h)
        {                                    
                $info = apc_cache_info();
                echo '<div class="tab-pane" id="dashboard">';     
                    include('templates/hcacheme_dashboard.php');
                echo '</div>';
        }
                
    }

?>