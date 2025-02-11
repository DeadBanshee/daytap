<?php 

if (session()->has('person_id')) {
    session_destroy();
    
}

?>