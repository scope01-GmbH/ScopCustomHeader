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

namespace Scop\ScopCustomHeader\Header\Columns;

use phpDocumentor\Reflection\Types\Boolean;
use Scop\ScopCustomHeader\Header\Header;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\SalesChannel\SalesChannelEntity;

class HeaderColumns extends Entity
{
    use EntityIdTrait;

    /**
     * @var String $headerId
     */
    protected $headerId;

    /**
     * @var String $label
     */
    protected $label;

    /**
     * @var String $iconId
     */
    protected $iconId;
    /**
     * @var String $textLink
     */
    protected $textLink;
    /**
     * @var bool $openInNewTab
     */
    protected $openInNewTab;

    /**
     * @var int $position
     */
    protected $position;

    protected $showDesktop;

    protected $showMobile;

    /**
     * @var Header $header
     */
    protected $header;


    /**
     * @return string
     */
    public function getHeaderId(): string
    {
        return $this->headerId;
    }

    /**
     * @param String $headerId
     */
    public function setHeaderId(string $headerId): void
    {
        $this->headerId = $headerId;
    }


    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param String $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getIconId(): ?string
    {
        return $this->iconId;
    }

    public function setIconId(string $iconId): void
    {
        $this->iconId = $iconId;
    }

    public function getTextLink(): ?string
    {
        return $this->textLink;
    }

    public function setTextLink(string $textLink): void
    {
        $this->textLink = $textLink;
    }

    public function isOpenInNewTab(): ?bool
    {
        return $this->openInNewTab;
    }

    public function setOpenInNewTab(bool $openInNewTab): void
    {
        $this->openInNewTab = $openInNewTab;
    }

    public function isShowDesktop(): ?bool
    {
        return $this->showDesktop;
    }

    public function setShowDesktop(bool $showDesktop): void
    {
        $this->showDesktop = $showDesktop;
    }

    public function isShowMobile(): ?bool
    {
        return $this->showMobile;
    }

    public function setShowMobile(bool $showMobile): void
    {
        $this->showMobile = $showMobile;
    }


    public function getHeader(): ?Header
    {
        return $this->header;
    }

    public function setHeader(Header $header): void
    {
        $this->header = $header;
    }


}
