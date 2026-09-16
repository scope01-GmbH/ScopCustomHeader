<?php declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license MIT
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Subscriber;

use Scop\ScopCustomHeader\Extension\RuleExtension;
use Shopware\Core\Framework\Adapter\Cache\Http\Extension\ResolveCacheRelevantRuleIdsExtension;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ResolveRuleAreasSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        if (!class_exists(ResolveCacheRelevantRuleIdsExtension::class)) {
            return [];
        }

        return [
            ResolveCacheRelevantRuleIdsExtension::NAME . '.pre' => 'addRuleArea',
        ];
    }

    public function addRuleArea(ResolveCacheRelevantRuleIdsExtension $extension): void
    {
        if (!\in_array(RuleExtension::AREA, $extension->ruleAreas, true)) {
            $extension->ruleAreas[] = RuleExtension::AREA;
        }
    }
}
