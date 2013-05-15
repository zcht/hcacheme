<?php

    //print_r($info);

    echo '<ul>';
        echo '<li>Memory Size: ' . $info['mem_size'] . '</li>';
        echo '<li>Entries: ' . $info['num_entries'] . '</li>';
        echo '<li>Hits: ' . $info['num_hits'] . '</li>';
    echo '</ul>';

    
    echo '<h3>' . $h->lang['hcacheme_latest_cached_files'] . '</h3>';     
    
    echo '<table class="table table-bordered">';
        echo '<tr class="info">';
            echo '<td>Filename</td>';
            echo '<td>Created</td>';
            echo '<td>Memory</td>';
            echo '<td>Hits</td>';
        echo '</tr>';
        
        foreach ($info['cache_list'] as $cache) {
            echo '<tr>';
            echo '<td>' . $cache['filename'] . '</td>';
            echo '<td>' . $cache['creation_time'] . '</td>';
            echo '<td>' . $cache['mem_size'] . '</td>';
            echo '<td>' . $cache['num_hits'] . '</td>';
            echo '</tr>';
        }
    echo '</table>';
    
?>
