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

namespace Scop\ScopCustomHeader\Entity\HeaderColumns;

use Scop\ScopCustomHeader\Entity\Header\HeaderEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class HeaderColumnsEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var String $headerId
     */
    protected string $headerId;

    /**
     * @var String|null $label
     */
    protected ?string $label = null;

    /**
     * @var String|null $iconId
     */
    protected ?string $iconId = null;
    /**
     * @var String|null $textLink
     */
    protected ?string $textLink = null;
    /**
     * @var bool $openInNewTab
     */
    protected ?bool $openInNewTab = null;

    /**
     * @var int|null $position
     */
    protected ?int $position = null;

    /**
     * @var bool|null
     */
    protected ?bool $showDesktop = null;

    /**
     * @var bool|null
     */
    protected ?bool $showMobile = null;

    /**
     * @var HeaderEntity $header
     */
    protected ?HeaderEntity $header = null;


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
     * @return string|null
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

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return void
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    /**
     * @return string|null
     */
    public function getIconId(): ?string
    {
        return $this->iconId;
    }

    /**
     * @param string $iconId
     * @return void
     */
    public function setIconId(string $iconId): void
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
     * @param string $textLink
     * @return void
     */
    public function setTextLink(string $textLink): void
    {
        $this->textLink = $textLink;
    }

    /**
     * @return bool|null
     */
    public function isOpenInNewTab(): ?bool
    {
        return $this->openInNewTab;
    }

    /**
     * @param bool $openInNewTab
     * @return void
     */
    public function setOpenInNewTab(bool $openInNewTab): void
    {
        $this->openInNewTab = $openInNewTab;
    }

    /**
     * @return bool|null
     */
    public function isShowDesktop(): ?bool
    {
        return $this->showDesktop;
    }

    /**
     * @param bool $showDesktop
     * @return void
     */
    public function setShowDesktop(bool $showDesktop): void
    {
        $this->showDesktop = $showDesktop;
    }

    /**
     * @return bool|null
     */
    public function isShowMobile(): ?bool
    {
        return $this->showMobile;
    }

    /**
     * @param bool $showMobile
     * @return void
     */
    public function setShowMobile(bool $showMobile): void
    {
        $this->showMobile = $showMobile;
    }


    /**
     * @return HeaderEntity|null
     */
    public function getHeader(): ?HeaderEntity
    {
        return $this->header;
    }

    /**
     * @param HeaderEntity $header
     * @return void
     */
    public function setHeader(HeaderEntity $header): void
    {
        $this->header = $header;
    }


}
