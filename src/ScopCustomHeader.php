<?php /** @noinspection ALL */
declare(strict_types=1);

/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license proprietär
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader;

use Doctrine\DBAL\Connection;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\SystemConfig\SystemConfigService;

/**
 * Class ScopCustomHeader
 * @package Scop\ScopCustomHeader
 */
class ScopCustomHeader extends Plugin
{
    /**
     * @param UninstallContext $uninstallContext
     */
    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }

        /**
         *
         * @var Connection $connection
         */
        $connection = $this->container->get(Connection::class);

        $sql = "DROP TABLE IF EXISTS `scop_custom_header_columns_translation`;";

        $connection->executeUpdate($sql);

        $sql = "DROP TABLE IF EXISTS `scop_custom_header_columns`;";

        $connection->executeUpdate($sql);

        $sql = "DROP TABLE IF EXISTS `scop_custom_header`;";

        $connection->executeUpdate($sql);
    }

    public function activate(Plugin\Context\ActivateContext $activateContext): void
    {
        // Create a default Header if plugin gets updated or installed
        $headerRepository = $this->container->get('scop_custom_header.repository');
        $columnRepository = $this->container->get('scop_custom_header_columns.repository');

        $config = $this->container->get(SystemConfigService::class);
        $context = $activateContext->getContext();

        if ($headerRepository->search(new Criteria(), $context)->getTotal() === 0) {

            $salesChannelCriteria = new Criteria();
            $salesChannelCriteria->addFilter(new EqualsFilter('typeId', Defaults::SALES_CHANNEL_TYPE_STOREFRONT));
            $salesChannelRepository = $this->container->get('sales_channel.repository');
            $salesChannelIds = $salesChannelRepository->search($salesChannelCriteria, $context)->getIds();

            $salesChannelConfigArray = [];
            foreach ($salesChannelIds as $id) {
                $salesChannelConfig = $config->get('ScopCustomHeader.config', $id);
                array_push($salesChannelConfigArray, $salesChannelConfig);
            }

            if ($this->allArraysIdentical($salesChannelConfigArray)) {
                $this->migrateValues($id, $context, $headerRepository, $columnRepository, $config, null);
            } else {
                foreach ($salesChannelIds as $id) {
                    $this->migrateValues($id, $context, $headerRepository, $columnRepository, $config, $id);
                }
            }

        }


    }

    private function allArraysIdentical($arrays)
    {
        if (empty($arrays)) {
            return true;
        }

        if (isset($arrays[0]) && isset($arrays[0]["imgArray"])) {
            if ($arrays[0]["imgArray"][0] === NULL && $arrays[0]["imgArray"][1] === NULL && $arrays[0]["imgArray"][2] === NULL) {
                unset($arrays[0]["imgArray"]);
            }
        }

        $firstArraySerialized = serialize($arrays[0]);
        // Test wenn der zweite++ SalesChannel auch imgArray hat
        foreach ($arrays as $array) {
            if (isset($array) && isset($array["imgArray"])) {
                if ($array["imgArray"][0] === NULL && $array["imgArray"][1] === NULL && $array["imgArray"][2] === NULL) {
                    unset($array["imgArray"]);
                }
            }

            if (serialize($array) !== $firstArraySerialized) {
                return false;
            }
        }

        return true;
    }

    private function migrateValues($id, $context, $headerRepository, $columnRepository, $config, $salesChannelId)
    {
        $salesChannelConfig = $config->get('ScopCustomHeader.config', $id);

        $headerId = Uuid::randomHex();

        $headerRepository->create([
            [
                'id' => $headerId,
                'label' => 'Default USP',
                'description' => '',
                'priority' => 1,
                'enabled' => isset($salesChannelConfig['active']) && $salesChannelConfig['active'] ? $salesChannelConfig['active'] : false, // not required
                'height' => isset($salesChannelConfig['height']) && $salesChannelConfig['height'] ? $salesChannelConfig['height'] : 10, // not required
                'background' => isset($salesChannelConfig['background']) && $salesChannelConfig['background'] ? $salesChannelConfig['background'] : '#ffffff', // not required,
                'textFontSize' => isset($salesChannelConfig['textFontSize']) && $salesChannelConfig['textFontSize'] ? $salesChannelConfig['textFontSize'] : 10, // not required
                'textColor' => isset($salesChannelConfig['textColor']) && $salesChannelConfig['textColor'] ? $salesChannelConfig['textColor'] : '#000000', // not required,
                'hover' => isset($salesChannelConfig['hover']) && $salesChannelConfig['hover'] ? $salesChannelConfig['hover'] : '#14b79f', // not required,
                'paddingTop' => isset($salesChannelConfig['paddingTop']) && $salesChannelConfig['paddingTop'] ? $salesChannelConfig['paddingTop'] : 10, // not required,,
                'paddingBottom' => isset($salesChannelConfig['paddingBottom']) && $salesChannelConfig['paddingBottom'] ? $salesChannelConfig['paddingBottom'] : 10, // not required,
                'paddingLeft' => isset($salesChannelConfig['paddingLeft']) && $salesChannelConfig['paddingLeft'] ? $salesChannelConfig['paddingLeft'] : 10, // not required,
                'paddingRight' => isset($salesChannelConfig['paddingRight']) && $salesChannelConfig['paddingRight'] ? $salesChannelConfig['paddingRight'] : 10, // not required,

                'textFontSizeMobile' => isset($salesChannelConfig['textFontSizeMobile']) && $salesChannelConfig['textFontSizeMobile'] ? $salesChannelConfig['textFontSizeMobile'] : 10, // not required
                'paddingTopMobile' => isset($salesChannelConfig['paddingTopMobile']) && $salesChannelConfig['paddingTopMobile'] ? $salesChannelConfig['paddingTopMobile'] : 10, // not required
                'paddingRightMobile' => isset($salesChannelConfig['paddingRightMobile']) && $salesChannelConfig['paddingRightMobile'] ? $salesChannelConfig['paddingRightMobile'] : 10, // not required
                'paddingLeftMobile' => isset($salesChannelConfig['paddingLeftMobile']) && $salesChannelConfig['paddingLeftMobile'] ? $salesChannelConfig['paddingLeftMobile'] : 10, // not required
                'paddingBottomMobile' => isset($salesChannelConfig['paddingBottomMobile']) && $salesChannelConfig['paddingBottomMobile'] ? $salesChannelConfig['paddingBottomMobile'] : 10, // not required
                'mobileBreakpointCarousel' => isset($salesChannelConfig['mobileBreakpointCarousel']) && $salesChannelConfig['mobileBreakpointCarousel'] ? $salesChannelConfig['mobileBreakpointCarousel'] : true, // not required
                'mobileCarouselSpeed' => isset($salesChannelConfig['mobileCarouselSpeed']) && $salesChannelConfig['mobileCarouselSpeed'] ? $salesChannelConfig['mobileCarouselSpeed'] : 5, // not required
                'salesChannelId' => $salesChannelId
            ]
        ], $context);

        $columnRepository->create([
            [
                'id' => Uuid::randomHex(),
                'headerId' => $headerId,
                'label' => isset($salesChannelConfig['left']) && $salesChannelConfig['left'] ? $salesChannelConfig['left'] : 'Home',
                'iconId' => isset($salesChannelConfig['iconLeft']) && $salesChannelConfig['iconLeft'] ? $salesChannelConfig['iconLeft'] : null,
                'textLink' => isset($salesChannelConfig['textLinkLeft']) && $salesChannelConfig['textLinkLeft'] ? $salesChannelConfig['textLinkLeft'] : '/',
                'openInNewTab' => isset($salesChannelConfig['openInNewTabLeft']) && $salesChannelConfig['openInNewTabLeft'] ? $salesChannelConfig['openInNewTabLeft'] : true,
                'showMobile' => isset($salesChannelConfig['displayTextLeft']) && $salesChannelConfig['displayTextLeft'] ? $salesChannelConfig['displayTextLeft'] : false,
                'position' => 1
            ]
        ], $context);

        $columnRepository->create([
            [
                'id' => Uuid::randomHex(),
                'headerId' => $headerId,
                'label' => isset($salesChannelConfig['middle']) && $salesChannelConfig['middle'] ? $salesChannelConfig['middle'] : 'Home',
                'iconId' => isset($salesChannelConfig['iconMiddle']) && $salesChannelConfig['iconMiddle'] ? $salesChannelConfig['iconMiddle'] : null,
                'textLink' => isset($salesChannelConfig['textLinkMiddle']) && $salesChannelConfig['textLinkMiddle'] ? $salesChannelConfig['textLinkMiddle'] : '/',
                'openInNewTab' => isset($salesChannelConfig['openInNewTabMiddle']) && $salesChannelConfig['openInNewTabMiddle'] ? $salesChannelConfig['openInNewTabMiddle'] : true,
                'showMobile' => isset($salesChannelConfig['displayTextMiddle']) && $salesChannelConfig['displayTextMiddle'] ? $salesChannelConfig['displayTextMiddle'] : false,
                'position' => 2
            ]
        ], $context);

        $columnRepository->create([
            [
                'id' => Uuid::randomHex(),
                'headerId' => $headerId,
                'label' => isset($salesChannelConfig['right']) && $salesChannelConfig['right'] ? $salesChannelConfig['right'] : 'Home',
                'iconId' => isset($salesChannelConfig['iconRight']) && $salesChannelConfig['iconRight'] ? $salesChannelConfig['iconRight'] : null,
                'textLink' => isset($salesChannelConfig['textLinkRight']) && $salesChannelConfig['textLinkRight'] ? $salesChannelConfig['textLinkRight'] : '/',
                'openInNewTab' => isset($salesChannelConfig['openInNewTabRight']) && $salesChannelConfig['openInNewTabRight'] ? $salesChannelConfig['openInNewTabRight'] : true,
                'showMobile' => isset($salesChannelConfig['displayTextRight']) && $salesChannelConfig['displayTextRight'] ? $salesChannelConfig['displayTextRight'] : false,
                'position' => 3
            ]
        ], $context);

    }
}
