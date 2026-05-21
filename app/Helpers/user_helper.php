<?php

    function format_username($name1, $name2) {
        return strtoupper($name1[0].$name2[0]);
    }

    function concat_name($name1, $name2) {
        return $name1." ".$name2;
    }

?>