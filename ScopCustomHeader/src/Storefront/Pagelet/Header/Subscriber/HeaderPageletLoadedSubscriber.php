<?php declare(strict_types=1);

namespace Scop\ScopCustomHeader\Storefront\Pagelet\Header\Subscriber;

use Gaufrette\File;
use Shopware\Core\Content\Media\Exception\MediaNotFoundException;
use Shopware\Core\Content\Media\Exception\MediaNotFoundException as mediaurlnotfound;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Struct\ArrayEntity;
use Shopware\Storefront\Pagelet\Header\HeaderPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Core\Content\Media\Pathname\UrlGenerator;
use Shopware\Core\Content\Media\MediaService;
use Shopware\Core\Content\Media\File\FileLoader;
use Psr\Log\LoggerInterface;

class HeaderPageletLoadedSubscriber implements EventSubscriberInterface
{

    /**
     * @var SystemConfigService
     */
    private $systemConfigService;

    /**
     * @var MediaService
     */
    private $mediaService;

    /**
     * @var FileLoader
     */
    private $fileLoader;

    /**
     * @var EntityRepositoryInterface
     */
    private $mediaRepo;
    /**
     * HeaderPageletLoadedSubscriber constructor.
     * @param SystemConfigService $systemConfigService
     */
    public function __construct(SystemConfigService $systemConfigService, MediaService  $mediaService, FileLoader $fileLoader, EntityRepositoryInterface $mediaRepo)
    {
        $this->systemConfigService = $systemConfigService;
        $this->mediaService = $mediaService;
        $this->fileLoader = $fileLoader;
        $this->mediaRepo = $mediaRepo;
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
        $mediaUrl = "";
        $context = $event->getContext();
        $pluginConfig = $this->systemConfigService->get('ScopCustomHeader.config');
        $page = $event->getPagelet();
        $mediaIdLeft = $this->systemConfigService->get('ScopCustomHeader.config.iconLeft');
        $mediaIdRight = $this->systemConfigService->get('ScopCustomHeader.config.iconRight');
        $mediaIdMiddle = $this->systemConfigService->get('ScopCustomHeader.config.iconMiddle');

        $imgArray = [
            $mediaIdLeft,
            $mediaIdRight,
            $mediaIdMiddle
        ];
        foreach($imgArray as $index => $img){
            if($img != null && $img != ""){

                try{
                    $imgPath  = $this->findMediaById($img, $context)->getUrl();
                    $imgArray[$index] = $imgPath;
                } catch (\Exception $e){
                 error_log($e->getMessage());
                };
            }
        }
        $this->systemConfigService->set('ScopCustomHeader.config.imgArray', $imgArray);
        $page->addExtension('ScopCH', new ArrayEntity($pluginConfig));
    }

    private function findMediaById(string $mediaId, Context $context): MediaEntity
    {
        $criteria = new Criteria([$mediaId]);
        $criteria->addAssociation('mediaFolder');
        $currentMedia = $this->mediaRepo
            ->search($criteria, $context)
            ->get($mediaId);

        if ($currentMedia === null) {
            $currentMedia = "";
        }
        return $currentMedia;
    }
}
