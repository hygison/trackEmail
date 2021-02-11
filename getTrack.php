<?php

    /**
     * Show all emails open and not open yet in a table
     */
    require 'includes/autoload.inc.php';

    $table = new EmailTrack;
    echo $table->getEmails();
?>