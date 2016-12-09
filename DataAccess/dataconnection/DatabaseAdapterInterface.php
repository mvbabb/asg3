<?php

interface DatabaseAdapterInterface{
    function setConnectionInfo($values=array());
    function closeconnection();

    function runQuery($sql, $parameters=array());
    function fetchRow($sql, $parameters=array());
    function fetchAsArray($sql, $parameters=array());

}



?>