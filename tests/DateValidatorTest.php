<?php
namespace DateValidator;
use PHPUnit\Framework\TestCase;
use DateValidator;

class DateValidatorTest extends TestCase
{
  /**
   * @var DateValidator
   */
  private $target;

  public function setUp()
  {
  }

  public function test_valid_date_gets_validated()
  {
    $validDate = "07/05/1994";
    $this->target = new DateValidator($validDate);

    self::assertEquals(7, $this->target->getMonthInt());
    self::assertEquals(5, $this->target->getDayInt());
    self::assertEquals(1994, $this->target->getYearInt());

  }


}