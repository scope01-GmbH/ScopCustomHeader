<?php
declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license MIT
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Entity\HeaderColumnsTranslation;

use Scop\ScopCustomHeader\Entity\HeaderColumns\HeaderColumnsDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class HeaderColumnsTranslationDefinition extends EntityTranslationDefinition
{

    /**
     * @var string
     */
    public const ENTITY_NAME = 'scop_custom_header_columns_translation';

    /**
     * @see EntityDefinition::getEntityName
     */
    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    /**
     * {@inheritDoc}
     * @see EntityDefinition::getCollectionClass
     */
    public function getCollectionClass(): string
    {
        return HeaderColumnsTranslationCollection::class;
    }

    /**
     * {@inheritDoc}
     * @see EntityDefinition::getEntityClass
     */
    public function getEntityClass(): string
    {
        return HeaderColumnsTranslationEntity::class;
    }

    protected function getParentDefinitionClass(): string
    {
        return HeaderColumnsDefinition::class;
    }

    /**
     * @see EntityDefinition::defineFields
     */
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            new StringField("label", "label"),
            new FkField('icon_id', 'iconId', MediaDefinition::class),
            new StringField('text_link', 'textLink'),

            new ManyToOneAssociationField('icon', 'icon_id', MediaDefinition::class, 'id', false),
        ]);
    }
}
