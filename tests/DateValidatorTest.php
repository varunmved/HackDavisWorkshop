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
    //nothing required
  }

  public function test_valid_date_gets_parsed()
  {
    $validDate = "01/01/1994";
    $this->target = new DateValidator($validDate);

    self::assertEquals(1, $this->target->getMonthInt());
    self::assertEquals(1, $this->target->getDayInt());
    self::assertEquals(1994, $this->target->getYearInt());
  }

  public function test_valid_date_is_valid()
  {
    $validDate = "01/01/1994";
    $this->target = new DateValidator($validDate);

    self::assertTrue($this->target->isValidDate($this->target->getDayInt(), $this->target->getMonthInt(), $this->target->getYearInt()));
  }


}