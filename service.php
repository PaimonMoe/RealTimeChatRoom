<?php
    if(@$_GET['action']=='fetch'){
        $fp = file("log.db");
        echo @$fp[count($fp)-4]."`";
        echo @$fp[count($fp)-3]."`";
        echo @$fp[count($fp)-2]."`";
        echo @$fp[count($fp)-1]."`";
    }
    elseif(@$_GET["action"]=='send'){
        $fp = fopen("log.db","a");
        var_dump($_REQUEST);
        fwrite($fp,"\n".$_REQUEST['name']."|".$_REQUEST['msg']);
        fclose($fp);
    }
    else{
        //phpinfo();
        echo "_Error: missing parama 'action' in GET method or unrecognizable val";
    }

?>