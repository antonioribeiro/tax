<?php

namespace CommerceGuys\Tax\Tests\Model;

use CommerceGuys\Tax\Model\TaxRate;

/**
 * @coversDefaultClass \CommerceGuys\Tax\Model\TaxRate
 */
class TaxRateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TaxRate
     */
    protected $taxRate;

    public function setUp()
    {
        $this->taxRate = new TaxRate();
    }

    /**
     * @covers ::getType
     * @covers ::setType
     */
    public function testType()
    {
        $type = $this
            ->getMockBuilder('CommerceGuys\Tax\Model\TaxType')
            ->getMock();

        $this->taxRate->setType($type);
        $this->assertSame($type, $this->taxRate->getType());
    }

    /**
     * @covers ::getId
     * @covers ::setId
     */
    public function testId()
    {
        $this->taxRate->setId('de_vat_standard');
        $this->assertEquals('de_vat_standard', $this->taxRate->getId());
    }

    /**
     * @covers ::getName
     * @covers ::setName
     * @covers ::__toString
     */
    public function testName()
    {
        $this->taxRate->setName('Standard');
        $this->assertEquals('Standard', $this->taxRate->getName());
        $this->assertEquals('Standard', (string) $this->taxRate);
    }

    /**
     * @covers ::getDisplayName
     * @covers ::setDisplayName
     */
    public function testDisplayName()
    {
        $this->taxRate->setDisplayName('% VAT');
        $this->assertEquals('% VAT', $this->taxRate->getDisplayName());
    }

    /**
     * @covers ::getAmounts
     * @covers ::setAmounts
     * @covers ::hasAmounts
     * @covers ::addAmount
     * @covers ::removeAmount
     * @covers ::hasAmount
     * @uses \CommerceGuys\Tax\Model\TaxRateAmount::setRate
     */
    public function testAmounts()
    {
        $firstAmount = $this
            ->getMockBuilder('CommerceGuys\Tax\Model\TaxRateAmount')
            ->getMock();
        $secondAmount = $this
            ->getMockBuilder('CommerceGuys\Tax\Model\TaxRateAmount')
            ->getMock();

        $this->assertEquals(false, $this->taxRate->hasAmounts());
        $rates = array($firstAmount, $secondAmount);
        $this->taxRate->setAmounts($rates);
        $this->assertEquals($rates, $this->taxRate->getAmounts());
        $this->assertEquals(true, $this->taxRate->hasAmounts());
        $this->taxRate->removeAmount($secondAmount);
        $this->assertEquals(array($firstAmount), $this->taxRate->getAmounts());
        $this->assertEquals(false, $this->taxRate->hasAmount($secondAmount));
        $this->assertEquals(true, $this->taxRate->hasAmount($firstAmount));
        $this->taxRate->addAmount($secondAmount);
        $this->assertEquals($rates, $this->taxRate->getAmounts());
    }
}
