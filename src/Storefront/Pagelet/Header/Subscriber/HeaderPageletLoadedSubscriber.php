<?php declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license proprietär
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Storefront\Pagelet\Header\Subscriber;

use Scop\ScopCustomHeader\Entity\Header\HeaderEntity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsAnyFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\OrFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Sorting\FieldSorting;
use Shopware\Core\Framework\Struct\ArrayStruct;
use Shopware\Storefront\Pagelet\Header\HeaderPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class HeaderPageletLoadedSubscriber
 * @package Scop\ScopCustomHeader\Storefront\Pagelet\Header\Subscriber
 */
class HeaderPageletLoadedSubscriber implements EventSubscriberInterface
{

    private EntityRepository $headerRepository;

    /**
     * HeaderPageletLoadedSubscriber constructor.
     *
     * @param EntityRepository $headerRepository
     */
    public function __construct(
        EntityRepository $headerRepository,
    )
    {
        $this->headerRepository = $headerRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            // Subscribing to HeaderPageLetLoadedEvent
            HeaderPageletLoadedEvent::class => 'HeaderPageletLoadedEvent',
        ];
    }

    /**
     * @param HeaderPageletLoadedEvent $event
     */
    public function HeaderPageletLoadedEvent(HeaderPageletLoadedEvent $event): void
    {
        $salesChannelContext = $event->getSalesChannelContext();
        $context = $salesChannelContext->getContext();

        $criteria = new Criteria();

        $criteria->addAssociation('columns');

        $salesChannelId = $salesChannelContext->getSalesChannelId();

        $criteria->addFilter(new EqualsFilter('enabled', true));

        $criteria->addFilter(new OrFilter([new EqualsFilter('salesChannelId', $salesChannelId), new EqualsFilter('salesChannelId', null)]));

        $ruleFilters = [new EqualsFilter('ruleId', null)];
        $ruleIds = $salesChannelContext->getRuleIds();
        if (!empty($ruleIds)) {
            $ruleFilters[] = new EqualsAnyFilter('ruleId', $ruleIds);
        }
        $criteria->addFilter(new OrFilter($ruleFilters));

        $criteria->addSorting(new FieldSorting('priority', FieldSorting::DESCENDING));

        /**
         * @var HeaderEntity $header
         */
        $headers = $this->headerRepository->search($criteria, $context);
        if ($headers->count() > 0) {
            $twigHeaders = new ArrayStruct();
            $page = $event->getPagelet();

            foreach ($headers as $header) {
                $desktopVisible = false;
                $mobileVisible = false;
                foreach ($header->getColumns() as $column) {
                    if ($column->isShowDesktop()) {
                        $desktopVisible = true;
                    }
                    if ($column->isShowMobile()) {
                        $mobileVisible = true;
                    }
                }
                $header->addArrayExtension('ScopVisible', [
                    'desktopVisible' => $desktopVisible,
                    'mobileVisible' => $mobileVisible
                ]);

                $twigHeaders->offsetSet($header->getId(), $header);
            }

            // Sending the Plugin configuration in ScopCH variable extension in TWIG
            $page->addExtension('ScopCH', $twigHeaders);
        }
    }

}
