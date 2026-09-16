<?php declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license MIT
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Extension;

use Scop\ScopCustomHeader\Entity\Header\HeaderDefinition;
use Shopware\Core\Content\Rule\RuleDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\RuleAreas;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class RuleExtension extends EntityExtension
{
    public const AREA = 'scop-custom-header';

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new OneToManyAssociationField('scopCustomHeaders', HeaderDefinition::class, 'rule_id'))
                ->addFlags(new RuleAreas(self::AREA))
        );
    }

    public function getEntityName(): string
    {
        return RuleDefinition::ENTITY_NAME;
    }
}
