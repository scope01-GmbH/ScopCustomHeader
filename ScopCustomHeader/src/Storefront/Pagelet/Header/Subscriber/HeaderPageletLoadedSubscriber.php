<?php declare(strict_types=1);

namespace Scop\ScopCustomHeader\Storefront\Pagelet\Header\Subscriber;

use Shopware\Core\Framework\Struct\ArrayEntity;
use Shopware\Storefront\Pagelet\Header\HeaderPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class HeaderPageletLoadedSubscriber implements EventSubscriberInterface
{

    /**
     * @var SystemConfigService
     */
    private $systemConfigService;

    /**
     * HeaderPageletLoadedSubscriber constructor.
     * @param SystemConfigService $systemConfigService
     */
    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            HeaderPageletLoadedEvent::class => 'HeaderPageletLoadedEvent',
        ];
    }

    /**
     * @param HeaderPageletLoadedEvent $event
     */
    public function HeaderPageletLoadedEvent(HeaderPageletLoadedEvent $event): void
    {
        $pluginConfig = $this->systemConfigService->get('ScopCustomHeader.config');
//var_dump($exampleConfig);die();
        $page = $event->getPagelet();

        $page->addExtension('ScopCH', new ArrayEntity($pluginConfig));
    }

}
