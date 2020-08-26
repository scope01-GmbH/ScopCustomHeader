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
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
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

    /**
     * @var EntityRepositoryInterface
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
     * @param EntityRepositoryInterface $mediaRepository
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(
        SystemConfigService $systemConfigService,
        EntityRepositoryInterface $mediaRepository,
        LoggerInterface $loggerInterface
    ) {
        $this->systemConfigService = $systemConfigService;
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

        $page = $event->getPagelet();

        // Getting the iconsID from Configurations
        $mediaIdLeft = $this->systemConfigService->get('ScopCustomHeader.config.iconLeft');
        $mediaIdRight = $this->systemConfigService->get('ScopCustomHeader.config.iconRight');
        $mediaIdMiddle = $this->systemConfigService->get('ScopCustomHeader.config.iconMiddle');

        // inserts the iconID in an array to loop through
        $imgArray = [
            $mediaIdLeft,
            $mediaIdMiddle,
            $mediaIdRight
        ];

        // Looping through the array and replacing the id with image-path
        foreach ($imgArray as $index => $img) {
            if ($img !== null && (string)trim($img) !== '') {
                if ($this->findMediaById($img, $context) instanceof MediaEntity) {
                    $imgPath = $this->findMediaById($img, $context)->getUrl();

                    // Writing in imgArray the media path instead of mediaID
                    $imgArray[$index] = $imgPath;
                } else {

                    // Logging Error if media wasnt found by mediaID
                    $logError = new \DirectoryIterator(dirname(__DIR__));
                    $logError = "MEDIA NOT FOUND ERROR -> " . "Failed to find Media Path for Media ID: " . $img . " in " . $logError . "/HeaderPageletLoadedSubscriber.php" . "\n";
                    $logInfo = "Check if selected image exists in Media";

                    $this->loggerInterface->error($logError);
                    $this->loggerInterface->info($logInfo);
                }
            }
        }

        // Adding the image path array as a variable in plugin configuration
        $this->systemConfigService->set('ScopCustomHeader.config.imgArray', $imgArray);

        // Get configuration
        $pluginConfig = $this->systemConfigService->get('ScopCustomHeader.config');

        // Sending the Plugin configuration in ScopCH variable extension in TWIG
        $page->addExtension('ScopCH', new ArrayEntity($pluginConfig));
    }


    /**
     * @param string $mediaId
     * @param Context $context
     * @return MediaEntity|null
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
