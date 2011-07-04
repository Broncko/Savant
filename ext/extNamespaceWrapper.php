<?php
namespace
{
    function invokeClass($pClass, $pArgs = array())
    {
        echo "file namespace: ".__NAMESPACE__."\n";
        $instance = call_user_func_array(array($pClass,'__construct'), $pArgs);
        return $instance;
    }
}
?>