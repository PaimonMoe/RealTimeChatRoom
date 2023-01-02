<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>基于PHP的聊天室</title>
    <style>
        @font-face {
            font-family: reg;
            src: url("res/font_regular.ttf");
        }
        *{
            color:rgba(0,0,0,0,.8);
            margin: 0px;
            padding: 0px;
            font-size: 16px;
            font-family: reg;
            box-sizing: border-box;
            transition: .4s;
        }
        html{
            height: 100%;
            width: 100%;
        }
        body {
            background-color: black;
            position: relative;
            text-align: center;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }
        .bg_video{
            position: absolute;
        }
        .wrap{
            display: inline-block;
            background-color: rgba(255,255,255,.85);
            height: 35em;
            width: 40em;
            position: relative;
            top:5em;
            border-radius: 2em;
            text-align:center;
        }
        .paimon_icon{
            position: absolute;
            transform: rotateZ(-36deg);
            top:-5em;
            left: -3em;
        
        }
        .logging{
            background-color:rgba(255,255,255,.3);
            width: 80%;
            height: 70%;
            display: inline-block;
            position: relative;
            top:2em;
            padding: 1em;
        }
        .typewriter{
            position: absolute;
            bottom: .6em;
            left:5em;
            /* background-color: pink; */
        }
        .send{
            border: 0;
            background-color: rgba(0,0,0,0);
            float:right;
            
        }
        .item{
            padding: 1em 2em 1em 2em;
        }
    </style>
</head>
<body>
    <div class="bg_video">
        <video src="./res/bg_video.mp4" loop muted autoplay></video>
    </div>
    <div class="wrap">
        <div class="paimon_icon">
            <img src="./res/paimon_icon.png" alt="png_load_error">
        </div>
        <div style="font-size: 1.5em;margin-top: 1em;">
            实时聊天室
        </div>
        <div class="logging">

            <div id="log0" class="item">
                <div id="log0_name" style="text-align:left;">
                    
                </div>
                <div id="log0_msg" style="text-align:left;padding-left: 3em;">
                    
                </div>
            </div>
            <div id="log1" class="item">
                <div id="log1_name" style="text-align:left;">
                    
                </div>
                <div id="log1_msg" style="text-align:left;padding-left: 3em;">
                    
                </div>
            </div>
            <div id="log2" class="item">
                <div id="log2_name" style="text-align:left;">
                    
                </div>
                <div id="log2_msg" style="text-align:left;padding-left: 3em;">
                    
                </div>
            </div>
            <div id="log3" class="item">
                <div id="log3_name" style="text-align:left;">
                    
                </div>
                <div id="log3_msg" style="text-align:left;padding-left: 3em;">
                    
                </div>
            </div>
            
        </div>
        <div class="typewriter">
            <input type="text" placeholder="说点什么吧..." id="input_msg" onkeydown="if(event.keyCode==13){xhr_msg_send()}" style="background-color:rgba(0,0,0,0);border: none;border-bottom:1px solid black;outline:none;width:15em;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" placeholder="你的身份" id="input_name" style="background-color:rgba(0,0,0,0);border: none;border-bottom:1px solid black;outline:none;width:8em;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button class="send" id="btn_send" onclick="xhr_msg_send()">
                <img src="./res/send_icon.png" alt="pnd_load_error" style="width:2em;">
            </button>
        </div>
    </div>

    <script>
        
        function xhr_msg_fetch(){
            var xhr_fetch = new XMLHttpRequest();
            xhr_fetch.open("POST","service.php?action=fetch");
            xhr_fetch.send();
            xhr_fetch.onreadystatechange = function(){
                if(xhr_fetch.readyState == 4 && xhr_fetch.status == 200){
                    // alert(xhr_fetch.responseText);
                    var fetch_str = xhr_fetch.responseText;
                    var array = fetch_str.split("`");
                    for(var i=0;i<4;i++){
                        var name = array[i].split("|")[0];
                        var msg = array[i].split("|")[1];
                        document.getElementById("log"+i+"_name").innerHTML=name+"说：";
                        document.getElementById("log"+i+"_msg").innerHTML=msg;
                    }
                }
            };
        }
        var msg_fetch_timer = setInterval("xhr_msg_fetch()",500);

        function xhr_msg_send(){
            var xhr_send = new XMLHttpRequest();
            xhr_send.open("POST","service.php?action=send");
            xhr_send.setRequestHeader("content-type","application/x-www-form-urlencoded");
            var name = document.getElementById("input_name").value;
            var msg = document.getElementById("input_msg").value;
            xhr_send.send("name="+name+"&msg="+msg);
            document.getElementById("input_msg").value="";
        }

    </script>
</body>

</html>