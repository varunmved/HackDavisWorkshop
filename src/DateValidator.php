<?php

class DateValidator
{
  private $monthInt;

  private $dayInt;

  private $yearInt;


  public function __construct(String $mdy)
  {

    $loc1 = 0;
    $loc2 = 0;
    $monthStr = '';
    $dayStr = '';
    $yearStr = '';
    $bdayIn = $mdy;

    // find the delimiters
    $loc1 = strpos($bdayIn, '/');
    $loc2 = strpos($bdayIn, '/', $loc1 + 1);

    // extract the substring, clean it up, upper case it
    $monthStr = substr($bdayIn, 0, $loc1);
    $dayStr = substr($bdayIn, $loc1 + 1, $loc2);
    $yearStr = substr($bdayIn, $loc2 + 1, strlen($bdayIn));
    $monthStr = trim($monthStr);
    $dayStr = trim($dayStr);
    $yearStr = trim($yearStr);

    $this->dayInt = (int)$dayStr;
    $this->monthInt = (int)$monthStr;
    $this->yearInt = (int)$yearStr;

  }

  public function isLeapYear(int $monthT, int $dayT, int $yearT)
  {
    $isLeap = false;
    if ($monthT == 2 && $dayT == 29) {
      if (($yearT % 4 == 0 || $yearT % 100 == 0) || $yearT % 400 == 0) {
        $isLeap = true;
      } else {
        $isLeap = false;
      }
    }
    return $isLeap;
  }

  public function maxDaysMonth($monthInt, $yearInt)
  {
    $maxDay = 31;
    if ($monthInt == 1 || $monthInt == 3 || $monthInt == 5 || $monthInt == 7
      | $monthInt == 8 || $monthInt == 10 || $monthInt == 12) {
      return $maxDay;
    }
    if ($monthInt == 4 || $monthInt == 6 || $monthInt == 5 || $monthInt == 9 || $monthInt == 11) {
      $maxDay = 30;
      return $maxDay;
    }
    if ($monthInt == 2) {
      if (($yearInt % 4 == 0 || $yearInt % 100 == 0) || $yearInt % 400 == 0) {
        $maxDay = 29;
        return $maxDay;
      } else {
        $maxDay = 28;
        return $maxDay;
      }
    }

    return $maxDay;
  }


  public function isValidDate($dayInt, $monthInt, $yearInt)
  {
    /*
        //Exceptions will help test that datatypes are really ints.
        //The equality or relational operators will check the numerical
        //values or ranges of those ints.
        */
    $validMonth = false;
    $validYear = false;
    $validDay = false;


    if ($monthInt == 2 && $dayInt == 29) {
      $this->isLeapYear($monthInt, $dayInt, $yearInt);
    }

    if ($monthInt <= 12 || $monthInt >= 1) {
      $validMonth = true;
      //return $validMonth;
    } else {
      $validMonth = false;
      //return $validMonth;
    }

    if ($dayInt <= 31 || $dayInt >= 0) {
      $validDay = true;
      //return $validDay;
    } else {
      $validDay = false;
      //return $validDay;
    }
    if ($yearInt <= 2018 || $yearInt >= 1900) {
      $validYear = true;
      //return $validDay;
    } else {
      $validYear = false;
      //return $validDay;
    }

    $maxDay = $this->maxDaysMonth($monthInt, $yearInt);
    $isLeap = $this->isLeapYear($monthInt, $dayInt, $yearInt);

    if ($validMonth == true && $validYear == true && $validDay == true) {
      if (($monthInt == 1 || $monthInt == 3 || $monthInt == 5
          || $monthInt == 7 || $monthInt == 8 || $monthInt == 10 || $monthInt == 12)
        && $maxDay >= $dayInt) {

        $validMonth = true;
        $validDay = true;
      } else {
        $validMonth = false;
        $validDay = false;

      }
      if (($monthInt == 4 || $monthInt == 6 || $monthInt == 9
          || $monthInt == 11) && $maxDay >= $dayInt) {

        $validMonth = true;
        $validDay = true;
      } else {
        $validMonth = false;
        $validDay = false;
      }
      if ($isLeap == true && $dayInt == 29 && $monthInt == 2) {
        $validMonth = true;
        $validDay = true;
      }

      if ($isLeap == false && $dayInt == 29 && $monthInt == 2) {
        $validMonth = false;
        $validDay = false;
      }

    }

    return ($validMonth && $validDay && $validYear);
  }

  /**
   * @return int
   */
  public function getMonthInt(): int
  {
    return $this->monthInt;
  }

  /**
   * @return int
   */
  public function getDayInt(): int
  {
    return $this->dayInt;
  }

  /**
   * @return int
   */
  public function getYearInt(): int
  {
    return $this->yearInt;
  }

}
