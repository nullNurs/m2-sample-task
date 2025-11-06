<?php
/**
 * This file is part of the Sample_CheckoutCheckbox package.
 *
 * @copyright Copyright (c) 2025 Nurs
 * @author    Nurs
 * @license   MIT
 */

declare(strict_types=1);

namespace Sample\CheckoutCheckbox\Plugin;

use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Checkout\Api\ShippingInformationManagementInterface;
use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Api\Data\ShippingInformationExtensionInterfaceFactory;
use Psr\Log\LoggerInterface;

class SaveSampleCheckboxOnQuote
{
    /**
     * @param CartRepositoryInterface                      $quoteRepository
     * @param LoggerInterface                              $logger
     * @param ShippingInformationExtensionInterfaceFactory $extensionFactory
     */
    public function __construct(
        private readonly CartRepositoryInterface $quoteRepository,
        private readonly LoggerInterface $logger,
        private readonly ShippingInformationExtensionInterfaceFactory $extensionFactory
    ) {}

    /**
     * Save sample checkbox value on quote before saving shipping information
     *
     * @param ShippingInformationManagementInterface $subject
     * @param                                        $cartId
     * @param ShippingInformationInterface           $addressInformation
     *
     * @return null
     * @throws NoSuchEntityException|InputException
     */
    public function beforeSaveAddressInformation(
        ShippingInformationManagementInterface $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ): null {
        if ($addressInformation->getExtensionAttributes() === null) {
            $extensionAttributes = $this->extensionFactory->create();
            $addressInformation->setExtensionAttributes($extensionAttributes);
        }

        $extensionAttributes = $addressInformation->getExtensionAttributes();
        $sampleCheckbox = $extensionAttributes->getSampleCheckbox();

        if ($sampleCheckbox === null) {
            return null;
        }

        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setSampleCheckbox($sampleCheckbox);

        try {
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            $this->logger->critical($e);
            throw new InputException(
                __(
                    'The sample checkbox was unable to be saved. Error: "%message"',
                    ['message' => $e->getMessage()]
                )
            );
        }

        return null;
    }
}
