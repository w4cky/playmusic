<?php
$ip = "192.168.51.162";
while(1){
        $ping = exec("ping -c 1 -s 64 -t 64 ".$ip);
        if(!empty($ping))
        {
                //  Initiate curl session
                $handle = curl_init();
                // Will return the response, if false it prints the response
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                // Set the url
                        $url = "http://$ip/httpapi.asp?command=getPlayerStatus";
                curl_setopt($handle, CURLOPT_URL,$url);
                // Execute the session and store the contents in $result
                $result=curl_exec($handle);
                // Closing the session
                curl_close($handle);
                $array = json_decode($result, true);
        //      var_dump($array);

        //      if($array['mode']=='0') // czyli jesli jest ten hash to nie gra
        //      {
                        if($array['status']=='stop')
                        {
                        echo 'nie!!!'; // wiec trzeba puscic muzyke
                        //  Initiate curl session
                        $handle = curl_init();
                        // Will return the response, if false it prints the response
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                        // Set the url
                        $url_radio = "http://$ip/httpapi.asp?command=setPlayerCmd:play:http://pr320.pinguinradio.nl/listen.pls";
        #               $url_radio = "http://$ip/httpapi.asp?command=setPlayerCmd:play:http://zt02.cdn.eurozet.pl/zet-old.mp3?redirected=02";
                        $vol = "http://$ip/httpapi.asp?command=setPlayerCmd:vol:20";
                        curl_setopt($handle, CURLOPT_URL,$url_radio);
                        // Execute the session and store the contents in $result
                        $result=curl_exec($handle);
                        // Closing the session
                        curl_close($handle);
                                curl_setopt($handle, CURLOPT_URL,$vol);
                        // Execute the session and store the contents in $result
                        $result=curl_exec($handle);
                        // Closing the session
                        curl_close($handle);
                        }
        #}
                else
                {
                        echo 'gra'; // gra radio wiec nic juz nie robie :) czekam
                        sleep(10);
                }
        }
}
