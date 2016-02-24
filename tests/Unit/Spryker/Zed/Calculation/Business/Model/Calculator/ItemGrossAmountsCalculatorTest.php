<?php
/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\Spryker\Zed\Calculation\Business\Model\Calculator;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ProductOptionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Transfer\Exception\RequiredTransferPropertyException;
use Spryker\Zed\Calculation\Business\Model\Calculator\ItemGrossAmountsCalculator;

class ItemGrossAmountsCalculatorTest extends \PHPUnit_Framework_TestCase
{

    const UNIT_GROSS_PRICE = 100;
    const QUANTITY = 2;

    /**
     * @return void
     */
    public function testCalculatorWhenOnlyItemAmountsPresentShouldCalculateItemGrossSum()
    {
        $itemGrossAmountsCalculator = $this->createItemGrossAmountsCalculator();

        $quoteTransfer = $this->createQuoteTransferWithFixtureData(self::UNIT_GROSS_PRICE, self::QUANTITY);
        $itemGrossAmountsCalculator->recalculate($quoteTransfer);
        $calculatedItemSumGrossPrice = $quoteTransfer->getItems()[0]->getSumGrossPrice();

        $this->assertEquals(self::UNIT_GROSS_PRICE * self::QUANTITY, $calculatedItemSumGrossPrice);
    }

    /**
     * @return void
     */
    public function testWhenItemQuantityIsNotPresentShouldThrowAssertException()
    {
        $this->setExpectedException(RequiredTransferPropertyException::class);

        $itemGrossAmountsCalculator = $this->createItemGrossAmountsCalculator();

        $quoteTransfer = $this->createQuoteTransferWithFixtureData(self::UNIT_GROSS_PRICE, null);
        $itemGrossAmountsCalculator->recalculate($quoteTransfer);
    }

    /**
     * @return void
     */
    public function testWhenItemUnitPriceIsNotPresentShouldThrowAssertException()
    {
        $this->setExpectedException(RequiredTransferPropertyException::class);

        $itemGrossAmountsCalculator = $this->createItemGrossAmountsCalculator();

        $quoteTransfer = $this->createQuoteTransferWithFixtureData(null, self::QUANTITY);
        $itemGrossAmountsCalculator->recalculate($quoteTransfer);
    }

    /**
     * @param int $unitGrossPrice
     * @param int $itemQuantity
     * @param array $productOptions
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function createQuoteTransferWithFixtureData($unitGrossPrice, $itemQuantity, array $productOptions = [])
    {
        $quoteTransfer = $this->createQuoteTransfer();

        $itemTransfer = $this->createItemTransfer();
        $itemTransfer->setUnitGrossPrice($unitGrossPrice);
        $itemTransfer->setQuantity($itemQuantity);
        $quoteTransfer->addItem($itemTransfer);

        return $quoteTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function createQuoteTransfer()
    {
        return new QuoteTransfer();
    }

    /**
     * @return \Spryker\Zed\Calculation\Business\Model\Calculator\ItemGrossAmountsCalculator
     */
    protected function createItemGrossAmountsCalculator()
    {
        return new ItemGrossAmountsCalculator();
    }

    /**
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    protected function createItemTransfer()
    {
        return new ItemTransfer();
    }

    /**
     * @return \Generated\Shared\Transfer\ProductOptionTransfer
     */
    protected function createProductOptionTransfer()
    {
        return new ProductOptionTransfer();
    }

}