<?php
/**
 * This file is part of the Sample_CheckoutCheckbox package.
 *
 * @copyright Copyright (c) 2025 Nurs
 * @author    Nurs
 * @license   MIT
 */

declare(strict_types=1);

namespace Sample\CheckoutCheckbox\Observer;

use Magento\Framework\DataObject\Copy;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CopyCheckboxFromQuoteToOrder implements ObserverInterface
{
    /**
     * @param Copy $objectCopyService
     */
    public function __construct(
        private readonly Copy $objectCopyService
    ) {}

    /**
     * @inheritdoc
     */
    public function execute(Observer $observer): static
    {
        $event = $observer->getEvent();
        $this->objectCopyService->copyFieldsetToTarget(
            'sales_convert_quote',
            'to_order',
            $event->getQuote(),
            $event->getOrder()
        );

        return $this;
    }
}
