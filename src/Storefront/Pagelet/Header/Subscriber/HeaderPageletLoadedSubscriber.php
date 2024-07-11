<?php declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license proprietär
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Storefront\Pagelet\Header\Subscriber;

use Psr\Log\LoggerInterface;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\Api\Context\SalesChannelApiSource;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\MultiFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\OrFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Sorting\FieldSorting;
use Shopware\Core\Framework\Log\LoggingService;
use Shopware\Core\Framework\Struct\ArrayEntity;
use Shopware\Storefront\Pagelet\Header\HeaderPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\System\SystemConfig\SystemConfigService;

/**
 * Class HeaderPageletLoadedSubscriber
 * @package Scop\ScopCustomHeader\Storefront\Pagelet\Header\Subscriber
 */
class HeaderPageletLoadedSubscriber implements EventSubscriberInterface
{

    /**
     * @var SystemConfigService
     */
    private $systemConfigService;

    private $headerRepository;

    /**
     * @var EntityRepository
     */
    private $mediaRepository;

    /**
     * @var LoggingService
     */
    private $loggerInterface;

    /**
     * HeaderPageletLoadedSubscriber constructor.
     *
     * @param SystemConfigService $systemConfigService
     * @param EntityRepository $headerRepository
     * @param EntityRepository $mediaRepository
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(
        SystemConfigService $systemConfigService,
        EntityRepository    $headerRepository,
        EntityRepository    $mediaRepository,
        LoggerInterface     $loggerInterface
    )
    {
        $this->systemConfigService = $systemConfigService;
        $this->headerRepository = $headerRepository;
        $this->mediaRepository = $mediaRepository;
        $this->loggerInterface = $loggerInterface;
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
        $context = $event->getContext();

        $criteria = new Criteria();

        $criteria->addAssociation('columns');

        /** @var SalesChannelApiSource $source */
        $source = $context->getSource();
        $salesChannelId = $source->getSalesChannelId();

        $criteria->addFilter(new EqualsFilter('enabled', true));

        $criteria->addFilter(new OrFilter([new EqualsFilter('salesChannelId', $salesChannelId), new EqualsFilter('salesChannelId', null)]));

        $criteria->addSorting(new FieldSorting('priority', FieldSorting::DESCENDING));

        $criteria->setLimit(1);

        $header = $this->headerRepository->search($criteria, $context)->first();
        $page = $event->getPagelet();

        // Sending the Plugin configuration in ScopCH variable extension in TWIG
        if ($header) {
            $page->addExtension('ScopCH', $header);
        }
    }

}
