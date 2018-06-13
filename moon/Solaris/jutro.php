<?php

// Enter your longitude and latitude,
// (use negative longitude value for WEST),
// (use negative latitude value for SOUTH)
// example for Cocoa Florida

$lat = 28.36;    // North
$long = -80.78;    // West

// note for date_sunrise function,
// Because of daylight savings, the offset changes, so rather than static value...
// set the offset to zero, then use default for date to convert final answer to your timezone
// instead of SUNFUNCS_RET_STRING use SUNFUNCS_RET_TIMESTAMP and take resulting

$offset = 0;
date_default_timezone_set('America/New_York');

// Note that twilight is a different zenith variable:
//`Zenith' is the angle that the centre of the Sun makes to a line perpendicular to the Earth's surface.
//  The best Overall figure for zenith is 90+(50/60) degrees for true sunrise/sunset
//  Civil twilight 96 degrees - Conventionally used to signify twilight
//  Nautical twilight 102 degrees - the point at which the horizon stops being visible at sea.
//  Astronical twilight at 108 degrees - the point when Sun stops being a source of any illumination.

$zenith=90+50/60;
$twilightzenith=96;

// set time for today
$todayTime=time();

// set time for tomorrow, calculate for next day...
$tomorrowTime=strtotime(date("Y-m-d", time()) . " +1 day");


// today sunrise/sunset
$sunStartTimeStamp=date_sunrise($todayTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $zenith, $offset);
$sunStartTime=date("h:i", date_sunrise($todayTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $zenith, $offset) );
$sunEndTimeStamp=date_sunset($todayTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $zenith, $offset) ;
$sunEndTime=date("h:i", date_sunset($todayTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $zenith, $offset) );
// today dusk/dawn
$darkEndTimeStamp=date_sunrise($todayTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $twilightzenith, $offset);
$darkEndTime=date("h:i", date_sunrise($todayTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $twilightzenith, $offset) );
$darkStartTimeStamp=date_sunset($todayTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $twilightzenith, $offset);
$darkStartTime=date("h:i", date_sunset($todayTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $twilightzenith, $offset) );

// tomorrow sunrise/sunset
$sunStartTime2=date("h:i", date_sunrise($tomorrowTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $zenith, $offset) );
$sunEndTime2=date("h:i", date_sunset($tomorrowTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $zenith, $offset) );
// tomorrow dawn/dusk
$darkEndTime2=date("h:i", date_sunrise($tomorrowTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $twilightzenith, $offset) );
$darkStartTime2=date("h:i", date_sunset($tomorrowTime, SUNFUNCS_RET_TIMESTAMP, $lat, $long, $twilightzenith, $offset) );


echo "<small>";

// Determine time and if case today or tomorrow for display
// if now is before sunrise, then show all today
// if now is after sunrise but before sunset, then show sunset/dark today, dawn/sunrise tomorrow
// if now is after darkhour, then show all tomorrow

if ($todayTime <= $sunStartTimeStamp){
// show all today not tomorrow
  echo "<p>Today, ".date("F j, Y",$todayTime)."</p>";
  echo "<p>";
  echo "Dawn: $darkEndTime A.M.";
  echo "<br>";
  echo "Sunrise: $sunStartTime A.M.";
  echo "</p><p>";
  echo "Sunset: $sunEndTime P.M.";
  echo "<br>";
  echo "Dark: $darkStartTime P.M.";
  echo "</p>";
} elseif ($todayTime >= $darkStartTimeStamp) {
// show all tomorrow
  echo "<p>Tomorrow, ".date("F j, Y",$tomorrowTime)."</p>";
  echo "<p>";
  echo "Dawn: $darkEndTime2 A.M.";
  echo "<br>";
  echo "Sunrise: $sunStartTime2 A.M.";
  echo "</p><p>";
  echo "Sunset: $sunEndTime2 P.M.";
  echo "<br>";
  echo "Dark: $darkStartTime2 P.M.";
  echo "</p>";
} else {
// show sunset/dusk for today and dawn/sunrise for tomorrow
  echo "<p>Today, ".date("F j, Y",$todayTime)."</p>";
  echo "<p>";
  echo "Sunset: $sunEndTime P.M.";
  echo "<br>";
  echo "Dark: $darkStartTime P.M.";
  echo "</p>";
  echo "<p>Tomorrow, ".date("F j, Y",$tomorrowTime)."</p>";
  echo "<p>";
  echo "Dawn: $darkEndTime2 A.M.";
  echo "<br>";
  echo "Sunrise: $sunStartTime2 A.M.";
  echo "</p>";
}

echo "</small>";

?>