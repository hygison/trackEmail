<?php

    $fileName = $_POST['fileName'];
    $html = file_get_contents('../email/'.$fileName);
    echo $html;

?>