<?php 

namespace model;
/**
 * Returns the current time of the day
 * 
 * @return string 
 */
function getTime() {

  date_default_timezone_set('Europe/Stockholm');

  $time = getDate();

  $second = strftime('%S');
  $minute = strftime('%M');
  $hour = strftime('%H');
  $day = $time['mday'];
  $weekDay = $time['weekday'];
  $month = $time['month'];
  $year = $time['year'];

  return "$weekDay, the {$day}th of $month $year, The time is $hour:$minute:$second";

} 