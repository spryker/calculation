<?php

namespace SprykerFeature\Zed\Calculation\Business\Model\Calculator;

use SprykerFeature\Shared\Calculation\Dependency\Transfer\TotalsInterface;
use SprykerFeature\Shared\Calculation\Dependency\Transfer\CalculableContainerInterface;
use SprykerFeature\Shared\Calculation\Dependency\Transfer\CalculableItemCollectionInterface;

/**
 * Interface SubtotalTotalsCalculatorInterface
 * @package SprykerFeature\Zed\Calculation\Business\Model\Calculator
 */
interface SubtotalTotalsCalculatorInterface
{
    /**
     * @param TotalsInterface $totalsTransfer
     * @param CalculableContainerInterface $calculableContainer
     * @param CalculableItemCollectionInterface $calculableItems
     */
    public function recalculateTotals(
        TotalsInterface $totalsTransfer,
        CalculableContainerInterface $calculableContainer,
        CalculableItemCollectionInterface $calculableItems
    );

    /**
     * @param CalculableItemCollectionInterface $calculableItems
     * @return int
     */
    public function calculateSubtotal(CalculableItemCollectionInterface $calculableItems);
}
