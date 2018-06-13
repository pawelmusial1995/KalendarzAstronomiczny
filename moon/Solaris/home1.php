<html>
<head>
<style>
    body {
    background-image: url("../png/earth.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 

    }    

</style>    
</head>
<body>
<div class="calendar">  
 <?php
    include 'MoonPhase.php';
    
    /*===============================================================*/
    /*=*/$moon = new Solaris\MoonPhase();                         /*=*/
    /*=*/$stage = $moon->phase() < 0.5 ? 'przybywa' : 'ubywa';    /*=*/
    /*=*/$next = gmdate( 'G:i:s, j M Y', $moon->next_new_moon() );/*=*/
    /*=*/$illumination=(round( $moon->illumination(),2)*100);     /*=*/
    /*===============================================================*/
    /*
    echo "Księżyc ma obecnie $age dni, i go $stage. ";
    echo "Jest $distance km od Ziemi. ";
    echo "Następny nowy księżyc jest $next.";
    echo "Iluminacja na poziomie $illumination%";
    */
?> 

<?php
$gmt=1; //Stevka

$monat=date('n');
$jahr=date('Y');
$heute=date('d');
$monate=array('Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień');

echo '<table border=1 width=1000 style="background: #000; margin:0 auto;">';
echo '<th colspan=4 align=center style="font-family:Verdana; font-size:18pt; color:#ffffff; background: #3E416A;">'.'Kalendarz '.$jahr.'</th>';

for ($reihe=1; $reihe<=3; $reihe++) {
	echo '<tr>';
	for ($spalte=1; $spalte<=4; $spalte++) {
		$this_month=($reihe-1)*4+$spalte;//tabelka Line column
		$erster=date('w',mktime(0,0,0,$this_month,1,$jahr));//First
		$insgesamt=date('t',mktime(0,0,0,$this_month,1,$jahr));//Dni w miesiacu
		if ($erster==0) $erster=7;
        #E9696A
		echo '<td width="25%" valign=top>';
		echo '<table border=0 align=center style="font-size:8pt; font-family:Verdana; background: #000; width: 25%;">';
		echo '<th colspan=7 align=center style="font-size:12pt; font-family:Arial; color:#E9696A;">'.$monate[$this_month-1].'</th>';
		echo '<tr><td style="color:#ffffff; background: #3E416A";><b>Pon</b></td>
              <td style="color:#ffffff; background: #866981"><b>Wt</b></td>';
		echo '<td style="color:#ffffff; background: #4ACDDE"><b>Śr</b></td>
              <td style="color:#ffffff; background: #E9696A"><b>Czw</b></td>';
		echo '<td style="color:#ffffff; background: #A2D1C2"><b>Pt</b></td>
              <td style="color:#0000cc; background: #BBD8CB"><b>Sob</b></td>';
		echo '<td style="color:#cc0000; background: #FCD66B"><b>Nd</b></td></tr>';
		echo '<tr><br>';
		$i=1;
		while ($i<$erster) {
			echo '<td> </td>';
			$i++;
		}
		$i=1;
		while ($i<=$insgesamt) {
			$rest=($i+$erster-1)%7;
			if (($i==$heute) && ($this_month==$monat)) {
                $ts = mktime(12, 0, 0,$this_month, $i, date("Y"));
                    if ($i===29 AND $this_month===10) {$gmt=1;} //zmiana na zimowy           
                    if ($i===26 AND $this_month===3)  {$gmt=2;} //zmiana na letni
                
				echo '<td style="font-size:8pt; font-family:Verdana; background: #142FCC;" align=center>'
                    ."<img src=../png/sunrise.png>".
                    '</br> Wschód ' .date_sunrise($ts, SUNFUNCS_RET_STRING, $_POST["lat"], $_POST["long"], 90.50, $gmt).' '
                    ."<img src=../png/sunset.png>".
                    '</br> Zachód ' .date_sunset($ts, SUNFUNCS_RET_STRING, $_POST["lat"], $_POST["long"], $gmt).'</br>'.
                    "Następny księżyc </br> $next.</br>".
                    "Iluminacja $illumination%</br>".' ';
			} else {
                $ts = mktime(12, 0, 0, $this_month  , $i, date("Y"));                
                    if ($i===29 AND $this_month===10) {$gmt=1;} //zmiana na zimowy
                    if ($i===26 AND $this_month===3)  {$gmt=2;} //zmiana na letni
                
				echo '<td style="font-size:8pt; font-family:Verdana; background: #FF4200;" align=center>'
                    ."<img src=../png/sunrise.png>".
                    '</br> Wschód ' .date_sunrise($ts, SUNFUNCS_RET_STRING, $_POST["lat"], $_POST["long"], 90.50, $gmt).' '
                    ."<img src=../png/sunset.png>".
                    '</br> Zachód ' .date_sunset($ts, SUNFUNCS_RET_STRING, $_POST["lat"], $_POST["long"], 90.50, $gmt).'</br>'.' ';
			}
			if (($i==$heute) && ($this_month==$monat)) {
				echo '<span style="color:#ffffff;">'.$i.'</span>';
			}	else if ($rest==6) {
				echo '<span style="color:#0000cc">'.$i.'</span>';
			} else if ($rest==0) {
				echo '<span style="color:#cc0000">'.$i.'</span>';
			} else {
				echo $i;
			}
			echo "</td>\n";
			if ($rest==0) echo "</tr>\n<tr>\n";
			$i++;
		}
		echo '</tr>';
		echo '</table>';
		echo '</td>';
	}
	echo '</tr>';
}

echo '</table>';
?>    
</div>      
</body>    
</html>

