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
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\Language\LanguageEntity;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\Translation\TranslatorBagInterface;

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
                'enabled' => $salesChannelConfig['active'] ?? null,
                'height' => $salesChannelConfig['height'] ?? null,
                'background' => $salesChannelConfig['background'] ?? null,
                'textFontSize' => $salesChannelConfig['textFontSize'] ?? null,
                'textColor' => $salesChannelConfig['textColor'] ?? null,
                'hover' => $salesChannelConfig['hover'] ?? null,
                'paddingTop' => $salesChannelConfig['paddingTop'] ?? null,
                'paddingBottom' => $salesChannelConfig['paddingBottom'] ?? null,
                'paddingLeft' => $salesChannelConfig['paddingLeft'] ?? null,
                'paddingRight' => $salesChannelConfig['paddingRight'] ?? null,

                'textFontSizeMobile' => $salesChannelConfig['textFontSizeMobile'] ?? null,
                'paddingTopMobile' => $salesChannelConfig['paddingTopMobile'] ?? null,
                'paddingRightMobile' => $salesChannelConfig['paddingRightMobile'] ?? null,
                'paddingLeftMobile' => $salesChannelConfig['paddingLeftMobile'] ?? null,
                'paddingBottomMobile' => $salesChannelConfig['paddingBottomMobile'] ?? null,
                'mobileBreakpointCarousel' => $salesChannelConfig['mobileBreakpointCarousel'] ?? null,
                'mobileCarouselSpeed' => $salesChannelConfig['mobileCarouselSpeed'] ?? null,
                'salesChannelId' => $salesChannelId
            ]
        ], $context);

        $columnRepository->create([
            [
                'id' => Uuid::randomHex(),
                'headerId' => $headerId,
                'label' => $this->resolveTranslation($salesChannelConfig['left'] ?? null, $context),
                'iconId' => $salesChannelConfig['iconLeft'] ?? null,
                'textLink' => $this->resolveTranslation($salesChannelConfig['textLinkLeft'] ?? null, $context),
                'openInNewTab' => $salesChannelConfig['openInNewTabLeft'] ?? null,
                'showMobile' => ($salesChannelConfig['displayTextLeft'] ?? null) && !($salesChannelConfig['mobileBreakpointDisplay'] ?? null),
                'position' => 1
            ]
        ], $context);

        $columnRepository->create([
            [
                'id' => Uuid::randomHex(),
                'headerId' => $headerId,
                'label' => $this->resolveTranslation($salesChannelConfig['middle'] ?? null, $context),
                'iconId' => $salesChannelConfig['iconMiddle'] ?? null,
                'textLink' => $this->resolveTranslation($salesChannelConfig['textLinkMiddle'] ?? null, $context),
                'openInNewTab' => $salesChannelConfig['openInNewTabMiddle'] ?? null,
                'showMobile' => ($salesChannelConfig['displayTextMiddle'] ?? null) && !($salesChannelConfig['mobileBreakpointDisplay'] ?? null),
                'position' => 2
            ]
        ], $context);

        $columnRepository->create([
            [
                'id' => Uuid::randomHex(),
                'headerId' => $headerId,
                'label' => $this->resolveTranslation($salesChannelConfig['right'] ?? null, $context),
                'iconId' => $salesChannelConfig['iconRight'] ?? null,
                'textLink' => $this->resolveTranslation($salesChannelConfig['textLinkRight'] ?? null, $context),
                'openInNewTab' => $salesChannelConfig['openInNewTabRight'] ?? null,
                'showMobile' => ($salesChannelConfig['displayTextRight'] ?? null) && !($salesChannelConfig['mobileBreakpointDisplay'] ?? null),
                'position' => 3
            ]
        ], $context);

    }

    private function resolveTranslation(?string $value, Context $context): string|array|null
    {
        if ($value === null)
            return null;
        if (!str_starts_with($value, 'scopCustomHeader.'))
            return $value;

        /**
         * @var TranslatorBagInterface $translator
         */
        $translator = $this->container->get('translator');

        $languageRepository = $this->container->get('language.repository');
        $criteria = new Criteria();
        $criteria->addAssociation('locale');
        $languages = $languageRepository->search($criteria, $context)->getElements();

        $translatedValue = [];
        /**
         * @var LanguageEntity $language
         */
        foreach ($languages as $language) {
            $localeCode = $language->getLocale()->getCode();
            $translationCatalogue = $translator->getCatalogue($localeCode);
            if ($translationCatalogue?->has($value)) {
                $translatedValue[$localeCode] = $translationCatalogue->get($value);
            }
        }

        return $translatedValue;
    }
}
