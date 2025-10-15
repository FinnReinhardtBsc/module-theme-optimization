<?php

declare(strict_types=1);

namespace MageOS\ThemeOptimization\Observer;

use Magento\Framework\App\Response\HttpInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Stale speculative loads can be cleared using the `prefetchCache` and `prerenderCache` value of the `Clear-Site-Data` response header.
 * See [MDN documentation](https://developer.mozilla.org/en-US/docs/Web/HTTP/Reference/Headers/Clear-Site-Data#prefetchcache)
 */
class AddClearSiteDataHeader implements ObserverInterface
{
    public function execute(Observer $observer): void
    {
        /** @var HttpInterface|null $response */
        $response = $observer->getResponse();

        if (!$response) {
            return;
        }

        $response->setHeader(
            'Clear-Site-Data',
            '"prefetchCache", "prerenderCache"',
            true
        );
    }
}
