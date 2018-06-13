<html>
<head>
   <script src="suncalc-master/suncalc.js"></script> 
    <script src="suncalc-master/test.js"></script>

</head>



<body>
    
    
        <script type="text/javascript">
            var times = SunCalc.getTimes(new Date(), 51.5, -0.1);
            var sunriseStr = times.sunrise.getHours() + ':' + times.sunrise.getMinutes();
            var sunrisePos = SunCalc.getPosition(times.sunrise, 51.5, -0.1);
            var sunriseAzimuth = sunrisePos.azimuth * 180 / Math.PI;


    </script>
    
    
    
 <?php
//Dane dla NS
//Dlugosc Geograficzna: 20,69
//Szerokosc Geograficzna: 49,62
//GMT:1 






    $miesiacNazwa = Array("Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", 
    "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"); //Tablica z nazwami miesiec


    if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
    if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");

    $cMiesiac = $_REQUEST["month"];
    $cRok = $_REQUEST["year"];


    $rok_wstecz = $cRok;
    $rok_dalej = $cRok;
    $mies_wstecz = $cMiesiac-1;
    $mies_dalej = $cMiesiac+1;

    if ($mies_wstecz == 0 ) {
        $mies_wstecz = 12;
        $rok_wstecz = $cRok - 1;
    }
    if ($mies_dalej == 13 ) {
        $mies_dalej = 1;
        $rok_dalej = $cRok + 1;
    }
?>



<table width="60%"> 

<tr align="center">
    <td bgcolor="#1dd948" style="color:#FFFFFF">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">          
                <tr>
                    <td width="50%" align="left">  
                        <a href=" <?php echo $_SERVER["PHP_SELF"] . "?month=". $mies_wstecz . "&year=" . $rok_wstecz; ?>" style="color:#FFFFFF">Wstecz</a>
                    </td>

                    <td width="50%" align="right">
                        <a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $mies_dalej . "&year=" . $rok_dalej; ?>" style="color:#FFFFFF">Dalej</a>  
                    </td>
                </tr>
        </table>
     </td>
</tr>



<tr>
<td align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
    
    
<tr align="center">
    <td colspan="7" bgcolor="#1dd948" style="color:#FFFFFF">
        <strong><?php echo $miesiacNazwa[$cMiesiac-1].' '.$cRok; ?></strong>
    </td>
</tr>
    
<tr>
    <td align="center" bgcolor="#ff0000" style="color:#FFFFFF"><strong>Nd</strong></td>
    <td align="center" bgcolor="#00c4ff" style="color:#FFFFFF"><strong>Pn</strong></td>
    <td align="center" bgcolor="#00c4ff" style="color:#FFFFFF"><strong>Wt</strong></td>
    <td align="center" bgcolor="#00c4ff" style="color:#FFFFFF"><strong>Śr</strong></td>
    <td align="center" bgcolor="#00c4ff" style="color:#FFFFFF"><strong>Cz</strong></td>
    <td align="center" bgcolor="#00c4ff" style="color:#FFFFFF"><strong>Pt</strong></td>
    <td align="center" bgcolor="#ff0000" style="color:#FFFFFF"><strong>So</strong></td>
</tr>



<?php
    include 'MoonPhase.php';
    
    /*===============================================================*/
    /*=*/$moon = new Solaris\MoonPhase();                         /*=*/
    /*=*/                        /*=*/
    /*=*/$stage = $moon->phase() < 0.5 ? 'przybywa' : 'ubywa';    /*=*/
    /*=*/             /*=*/
    /*=*/$next = gmdate( 'G:i:s, j M Y', $moon->next_new_moon() );/*=*/
    /*=*/$illumination=(round( $moon->illumination(),2)*100);           /*=*/
    /*===============================================================*/
    /*
    echo "Księżyc ma obecnie $age dni, i go $stage. ";
    echo "Jest $distance km od Ziemi. ";
    echo "Następny nowy księżyc jest $next.";
    echo "Iluminacja na poziomie $illumination%";
    */
?> 


<?php
    /*===============================================================*/
    /*=*/$timestamp = mktime(0,0,0,$cMiesiac,1,$cRok);             /*=*/
    /*=*/$maxday = date("t",$timestamp);                          /*=*/
    /*=*/$thismonth = getdate ($timestamp);                       /*=*/
    /*=*/$startday = $thismonth['mday'];                          /*=*/
    /*===============================================================*/
    
    
    

    
    
    
for ($i=0; $i<($maxday+$startday); $i++) 
    {$ts = mktime(12, 0, 0, date("m"), $i, date("Y"));
        
        if(($i % 7) == 0 ) 

            
             echo "<tr>";

                    if($i < $startday) echo "<td></td>";
                    else 
                    {

                        
        echo "<td align='center' valign='middle' height='60px' width:'60px'>"
                            .($i - $startday + 1) 
                            .'</br> Wschód ' .date_sunrise($ts, SUNFUNCS_RET_STRING,  $_POST["lat"], $_POST["long"] ,  90.50,  $_POST["offset"])
                            .' </br> Zachód ' .date_sunset($ts, SUNFUNCS_RET_STRING, $_POST["lat"], $_POST["long"] ,  90.50,  $_POST["offset"]). 


    
 
     "</br>Księżyca go $stage. </br>".
    "Następny księżyc </br> $next.</br>".
   "Iluminacja $illumination%</br>";
                        
                
                           echo "</td>";
                        
                if(($i % 7) == 6 ) 
             "</tr>";   
    }
    }
?>
    
</table>
</td>
</tr>
</table>



<style text/css>
    table,th,td {
        border:1px solid black;
    }
</style>   
    
    
</body>

</html>



