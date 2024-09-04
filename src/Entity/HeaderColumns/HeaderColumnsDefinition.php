<?php
declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license MIT
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Entity\HeaderColumns;

use Scop\ScopCustomHeader\Entity\Header\HeaderDefinition;
use Scop\ScopCustomHeader\Entity\HeaderColumnsTranslation\HeaderColumnsTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class HeaderColumnsDefinition extends EntityDefinition
{

    /**
     * @var string
     */
    public const ENTITY_NAME = 'scop_custom_header_columns';

    /**
     * {@inheritDoc}
     * @see \Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition::getEntityName()
     */
    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    /**
     * {@inheritDoc}
     * @see \Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition::getCollectionClass()
     */
    public function getCollectionClass(): string
    {
        return HeaderColumnsCollection::class;
    }

    /**
     * {@inheritDoc}
     * @see \Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition::getEntityClass()
     */
    public function getEntityClass(): string
    {
        return HeaderColumnsEntity::class;
    }

    /**
     * {@inheritDoc}
     * @see \Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition::defineFields()
     */
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('header_id', 'headerId', HeaderDefinition::class, 'id'))->addFlags(new Required()),
            new TranslatedField("label"),
            new TranslatedField('iconId'),
            new TranslatedField('textLink'),
            new BoolField('open_in_new_tab', 'openInNewTab'),
            new IntField('position', 'position'),
            new BoolField('show_desktop', 'showDesktop'),
            new BoolField('show_mobile', 'showMobile'),

            new ManyToOneAssociationField('header', 'header_id', HeaderDefinition::class, 'id'),
            new TranslationsAssociationField(HeaderColumnsTranslationDefinition::class, 'scop_custom_header_columns_id'),
        ]);
    }
}
