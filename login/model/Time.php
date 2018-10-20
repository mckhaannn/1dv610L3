<?php 

namespace model;

/**
 * Returns the current time of the day
 * 
 * @return string 
 */

class Time {

  private $time;
  private $second;
  private $minute;
  private $hour;
  private $day;
  private $weekDay;
  private $month;
  private $year;

  public function __construct()
  {
    date_default_timezone_set('Europe/Stockholm');
    $this->time = getDate();
    $this->seconds = strftime('%S');
    $this->minute= strftime('%M');
    $this->hour = strftime('%H');
    $this->day = $this->time['mday'];
    $this->weekDay = $this->time['weekday'];
    $this->month = $this->time['month'];
    $this->year = $this->time['year'];  
  }
  
  
  function getTime() {
    return "{$this->weekDay}, the {$this->day}th of {$this->month} {$this->year}, The time is {$this->hour}:{$this->minute}:{$this->seconds}";
  }
}