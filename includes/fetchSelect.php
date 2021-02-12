<?php
    /**
     * Simple method to fetch <select> tag with all available Email templates we have
     * It will find html templates inside the folder email and it will echo out:
     * 
     * <option value="HTML-FILE1.html">HTML-FILE1.html</option>
     * <option value="HTML-FILE2.html">HTML-FILE2.html</option>
     * ...
     * <option value="HTML-FILEn.html">HTML-FILEn.html</option>
     * <option value="text">Text Email</option>
     */



    $dir = __DIR__.'/../email';

    $files = scandir($dir);
    

    foreach($files as $value){
        $isHtml = end(explode('.',$value));
        if( strtolower($isHtml) === 'html'){
            echo '<option value="'.$value.'">'.$value.'</option>';
        }
    }
    echo '<option value="text">Type Text</option>';
?>