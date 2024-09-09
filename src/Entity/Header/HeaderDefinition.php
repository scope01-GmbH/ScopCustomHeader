<?php
declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license MIT
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Entity\Header;

use Scop\ScopCustomHeader\Entity\HeaderColumns\HeaderColumnsDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\SalesChannel\SalesChannelDefinition;

class HeaderDefinition extends EntityDefinition
{

    /**
     * @var string
     */
    public const ENTITY_NAME = 'scop_custom_header';

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
        return HeaderCollection::class;
    }

    /**
     * {@inheritDoc}
     * @see EntityDefinition::getEntityClass
     */
    public function getEntityClass(): string
    {
        return HeaderEntity::class;
    }

    /**
     * @see EntityDefinition::defineFields
     */
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new StringField("label", "label"))->addFlags(new Required()),
            new StringField("description", "description"),
            (new IntField("priority", "priority"))->addFlags(new Required()),
            new BoolField("enabled", "enabled"),
            new IntField('height', 'height'),
            new StringField('background', 'background'),
            new IntField('text_font_size', 'textFontSize'),
            new StringField('text_color', 'textColor'),
            new StringField('hover', 'hover'),
            new IntField('padding_top', 'paddingTop'),
            new IntField('padding_bottom', 'paddingBottom'),
            new IntField('padding_left', 'paddingLeft'),
            new IntField('padding_right', 'paddingRight'),

            (new OneToManyAssociationField('columns', HeaderColumnsDefinition::class, 'header_id'))->addFlags(new CascadeDelete()),
            new IntField('text_font_size_mobile', 'textFontSizeMobile'),
            new IntField('padding_top_mobile', 'paddingTopMobile'),
            new IntField('padding_bottom_mobile', 'paddingBottomMobile'),
            new IntField('padding_left_mobile', 'paddingLeftMobile'),
            new IntField('padding_right_mobile', 'paddingRightMobile'),
            new BoolField('mobile_breakpoint_carousel', 'mobileBreakpointCarousel'),
            new IntField('mobile_carousel_speed', 'mobileCarouselSpeed'),
            new IntField('height_mobile', 'heightMobile'),
            new StringField('background_color_mobile', 'backgroundColorMobile'),
            new StringField('hover_color_mobile', 'hoverColorMobile'),
            new StringField('text_color_mobile', 'textColorMobile'),

            (new FkField('salesChannelId', 'salesChannelId', SalesChannelDefinition::class))->addFlags(new ApiAware()),
            new ManyToOneAssociationField('salesChannel', 'salesChannelId', SalesChannelDefinition::class, 'id', false)
        ]);
    }
}
