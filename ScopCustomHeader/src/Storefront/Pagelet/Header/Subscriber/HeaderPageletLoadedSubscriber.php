<?php declare(strict_types=1);

namespace Scop\ScopCustomHeader\Storefront\Pagelet\Header\Subscriber;

use Psr\Log\LoggerInterface;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Log\LoggingService;
use Shopware\Core\Framework\Struct\ArrayEntity;
use Shopware\Storefront\Pagelet\Header\HeaderPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Core\Content\Media\MediaService;
use Shopware\Core\Content\Media\File\FileLoader;

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
     * @var EntityRepositoryInterface
     */
    private $mediaRepository;

    /**
     * @var LoggingService
     */
    private $loggingService;

    /**
     * HeaderPageletLoadedSubscriber constructor.
     *
     * @param SystemConfigService $systemConfigService
     */
    public function __construct(SystemConfigService $systemConfigService, MediaService  $mediaService, EntityRepositoryInterface $mediaRepository, LoggerInterface $loggerInterface)
    {
        $this->systemConfigService = $systemConfigService;
        $this->mediaService = $mediaService;
        $this->mediaRepository = $mediaRepository;
        $this->loggingService = $loggerInterface;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            // subscribing to HeaderPageLetLoadedEvent
            HeaderPageletLoadedEvent::class => 'HeaderPageletLoadedEvent',
        ];
    }

    /**
     * Subscriber to HeaderLoading Event (It is dispatched when the header template is build)
     *
     * @param HeaderPageletLoadedEvent $event
     * @throws \Shopware\Core\Framework\DataAbstractionLayer\Exception\InconsistentCriteriaIdsException
     */
    public function HeaderPageletLoadedEvent(HeaderPageletLoadedEvent $event): void
    {

        $context = $event->getContext();

        // Saving plugin configurations in pluginConfig variable
        $pluginConfig = $this->systemConfigService->get('ScopCustomHeader.config');

        $page = $event->getPagelet();

        // Getting the iconsID from Configurations
        $mediaIdLeft = $this->systemConfigService->get('ScopCustomHeader.config.iconLeft');
        $mediaIdRight = $this->systemConfigService->get('ScopCustomHeader.config.iconRight');
        $mediaIdMiddle = $this->systemConfigService->get('ScopCustomHeader.config.iconMiddle');

        $imgArray = [
            $mediaIdLeft,
            $mediaIdRight,
            $mediaIdMiddle
        ];


        // finding each media path by mediaID
        foreach($imgArray as $index => $img){
            if($img != null && (string) trim($img) !== ''){

                if($this->findMediaById($img, $context) instanceof MediaEntity){
                    $imgPath  = $this->findMediaById($img, $context)->getUrl();

                    // Writing in imgArray the media path instead of mediaID
                    $imgArray[$index] = $imgPath;

                } else {

                    // Logging Error if media wasnt found by mediaID
                    $logError =  new \DirectoryIterator(dirname(__DIR__));
                    $logError = "MEDIA NOT FOUND ERROR -> " .  "Failed to find Media Path for Media ID: " . $img . " in " . $logError . "/HeaderPageletLoadedSubscriber.php" . "\n";
                    $logInfo  = "Check if selected image exists in Media";

                    $this->loggingService->error($logError);
                    $this->loggingService->info($logInfo);
                }
            }
        }

        // Adding the image path array as a variable in plugin configuration
        $this->systemConfigService->set('ScopCustomHeader.config.imgArray', $imgArray);

        // Sending the Plugin configuration in ScopCH variable extension in TWIG
        $page->addExtension('ScopCH', new ArrayEntity($pluginConfig));
    }


    /**
     * The function find the media by ID
     *
     * @param string $mediaId
     * @param Context $context
     * @return MediaEntity
     * @throws \Shopware\Core\Framework\DataAbstractionLayer\Exception\InconsistentCriteriaIdsException
     */

    private function findMediaById(string $mediaId, Context $context): ?MediaEntity
    {
        $criteria = new Criteria([$mediaId]);
        $criteria->addAssociation('mediaFolder');
        return $this->mediaRepository
            ->search($criteria, $context)
            ->get($mediaId);
    }
}
