<?php
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license MIT License
 * @link https://scope01.com
 */
declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license MIT
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Entity\HeaderColumnsTranslation;

use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\Framework\DataAbstractionLayer\TranslationEntity;

class HeaderColumnsTranslationEntity extends TranslationEntity
{
    use EntityIdTrait;

    /**
     * @var string|null
     */
    protected ?string $label = null;

    /**
     * @var string|null
     */
    protected ?string $iconId = null;

    /**
     * @var string|null
     */
    protected ?string $textLink = null;

    /**
     * @var MediaEntity|null
     */
    protected ?MediaEntity $icon = null;

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return void
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string|null
     */
    public function getIconId(): ?string
    {
        return $this->iconId;
    }

    /**
     * @param string|null $iconId
     * @return void
     */
    public function setIconId(?string $iconId): void
    {
        $this->iconId = $iconId;
    }

    /**
     * @return string|null
     */
    public function getTextLink(): ?string
    {
        return $this->textLink;
    }

    /**
     * @param string|null $textLink
     * @return void
     */
    public function setTextLink(?string $textLink): void
    {
        $this->textLink = $textLink;
    }

    /**
     * @return MediaEntity|null
     */
    public function getIcon(): ?MediaEntity
    {
        return $this->icon;
    }

    /**
     * @param MediaEntity|null $icon
     * @return void
     */
    public function setIcon(?MediaEntity $icon): void
    {
        $this->icon = $icon;
    }

}
