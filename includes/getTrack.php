<?php

    /**
     * Show all emails open and not open yet in a table
     */
    require 'autoload.inc.php';

    $table = new EmailTrack;
    echo $table->getEmails();
    unset($table);
?>