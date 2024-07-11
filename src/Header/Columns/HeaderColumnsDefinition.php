<?php
declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license MIT
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Header\Columns;

use Scop\ScopCustomHeader\Header\Header;
use Scop\ScopCustomHeader\Header\HeaderCollection;
use Scop\ScopCustomHeader\Header\HeaderDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\SalesChannel\SalesChannelDefinition;

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
        return HeaderColumns::class;
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
            new StringField("label", "label"),
            new FkField('icon_id', 'iconId', MediaDefinition::class),
            new StringField('text_link', 'textLink'),
            new BoolField('open_in_new_tab', 'openInNewTab'),
            new IntField('position', 'position'),
            new BoolField('show_desktop', 'showDesktop'),
            new BoolField('show_mobile', 'showMobile'),

            new ManyToOneAssociationField('header', 'header_id', HeaderDefinition::class, 'id'),
            new ManyToOneAssociationField('icon', 'icon_id', MediaDefinition::class, 'id', false),
        ]);
    }
}
