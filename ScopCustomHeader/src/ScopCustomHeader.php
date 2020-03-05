<?php declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license proprietär
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader;

use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;

class ScopCustomHeader extends Plugin
{
    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }
    }
}
