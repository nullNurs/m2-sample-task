<?php
/**
 * This file is part of the Sample_CheckoutCheckbox package.
 *
 * @copyright Copyright (c) 2025 Nurs
 * @author    Nurs
 * @license   MIT
 */

declare(strict_types=1);

namespace Sample\CheckoutCheckbox\ViewModel\Adminhtml;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Sales\Block\Adminhtml\Order\AbstractOrder;

class SampleCheckboxViewModel implements ArgumentInterface
{
    /**
     * @param AbstractOrder $abstractOrder
     */
    public function __construct(
        private readonly AbstractOrder $abstractOrder
    ) {}

    /**
     * @return bool|null
     * @throws LocalizedException
     */
    public function getSampleCheckbox(): ?bool {
        $order = $this->abstractOrder->getOrder();
        $sampleCheckbox = $order->getSampleCheckbox();

        if ($sampleCheckbox === null) {
            return null;
        }

        return (bool)$sampleCheckbox;
    }
}
