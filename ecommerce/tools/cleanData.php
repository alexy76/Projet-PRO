<?php

function cleanData(array $postData)
{
    return array_map(
        function($elt){
            return trim(stripslashes(htmlspecialchars($elt)));
        }
    , $postData);
}

?>