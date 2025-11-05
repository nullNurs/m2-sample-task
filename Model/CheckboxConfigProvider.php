<?php
/**
 * This file is part of the Sample_CheckoutCheckbox package.
 *
 * @copyright Copyright (c) 2025 Nurs
 * @author    Nurs
 * @license   MIT
 */

declare(strict_types=1);

namespace Sample\CheckoutCheckbox\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class CheckboxConfigProvider implements ConfigProviderInterface
{
    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ) {}

    /**
     * @inheritDoc
     */
    public function getConfig(): array
    {
        return [
            'isSampleCheckboxEnabled' => (bool)$this->scopeConfig->getValue(
                'checkout/options/enable_sample_checkbox',
                ScopeInterface::SCOPE_STORE
            )
        ];
    }
}
