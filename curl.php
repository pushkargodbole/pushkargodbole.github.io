<html>
<head>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23171247-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<title>Grades ??</title>
</html>
<?php


function curl_grab_page($url,$ref_url,$data,$login,$proxy,$proxystatus){
    if($login == 'true') {
        $fp = fopen("cookie.txt", "w");
        fclose($fp);
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if ($proxystatus == 'true') {
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, $ref_url);

    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    ob_start();
    $tt = curl_exec ($ch); // execute the curl command
    $ttt=explode("-",$tt);
    $bb=strpos($tt,"Year/Semeser: 2010-11/2");
    $tts=strpos($tt,"Email");
    ob_end_clean();
    curl_close ($ch);
     $ttsy='';
   for ($i=$bb; $i<$tts; $i++)
    {
		//$i=$bb;
	//	while ($tt[$i]!="Name")
		{
		$ttsy=$ttsy.$tt[$i];
		//$i++;
	    }
	}
        $nn=strpos($ttsy, "Personal Info");
        for ($i=23;$i<$nn;$i++)
        {
			echo $ttsy[$i];
		}
        
    unset($ch);
}
if (isset($_POST['submission']))
{
$user=$_POST['user'];
	$pass=$_POST['pwd'];
echo curl_grab_page("https://www.iitb.ac.in/asc/ldaplogin.jsp", "http://www.iitb.ac.in/asc", "user=$user&pass=$pass", "true",  "null", "false");
}
?>
