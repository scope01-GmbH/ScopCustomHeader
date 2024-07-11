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

namespace Scop\ScopCustomHeader\Header;

use phpDocumentor\Reflection\Types\Boolean;
use Scop\ScopCustomHeader\Header\Columns\HeaderColumnsCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\SalesChannel\SalesChannelEntity;

class Header extends Entity
{
    use EntityIdTrait;

    /**
     * @var String $label
     */
    protected $label;
    /**
     * @var String $description
     */
    protected $description;
    /**
     * @var int $priority
     */
    protected $priority;
    /**
     * @var bool $enabled
     */
    protected $enabled;
    /**
     * @var int $height
     */
    protected $height;
    /**
     * @var String $background
     */
    protected $background;
    /**
     * @var int $textFontSize
     */
    protected $textFontSize;
    /**
     * @var String $textColor
     */
    protected $textColor;
    /**
     * @var String $hover
     */
    protected $hover;
    /**
     * @var int $paddingTop
     */
    protected $paddingTop;
    /**
     * @var int $paddingBottom
     */
    protected $paddingBottom;
    /**
     * @var int $paddingLeft
     */
    protected $paddingLeft;
    /**
     * @var int $paddingRight
     */
    protected $paddingRight;

    /**
     * @var int $textFontSizeMobile
     */
    protected $textFontSizeMobile;
    /**
     * @var int $paddingTopMobile
     */
    protected $paddingTopMobile;
    /**
     * @var int $paddingBottomMobile
     */
    protected $paddingBottomMobile;
    /**
     * @var int $paddingLeftMobile
     */
    protected $paddingLeftMobile;
    /**
     * @var int $paddingRightMobile
     */
    protected $paddingRightMobile;
    /**
     * @var bool $mobileBreakpointCarousel
     */
    protected $mobileBreakpointCarousel;
    /**
     * @var int $mobileCarouselSpeed
     */
    protected $mobileCarouselSpeed;

    protected int $heightMobile;

    protected string $backgroundColorMobile;

    protected string $hoverColorMobile;

    protected string $textColorMobile;


    /**
     * @var HeaderColumnsCollection $columns
     */
    protected $columns;

    /**
     * @var string|null $salesChannelId
     */
    protected $salesChannelId;
    /**
     * @var SalesChannelEntity|null $salesChannel
     */
    protected $salesChannel;

    /**
     * @return string
     */
    public function getLabel(): string
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled(boolean $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getBackground(): string
    {
        return $this->background;
    }

    public function setBackground(string $background): void
    {
        $this->background = $background;
    }

    public function getTextFontSize(): int
    {
        return $this->textFontSize;
    }

    public function setTextFontSize(int $textFontSize): void
    {
        $this->textFontSize = $textFontSize;
    }

    public function getTextColor(): string
    {
        return $this->textColor;
    }

    public function setTextColor(string $textColor): void
    {
        $this->textColor = $textColor;
    }

    public function getHover(): string
    {
        return $this->hover;
    }

    public function setHover(string $hover): void
    {
        $this->hover = $hover;
    }

    public function getPaddingTop(): int
    {
        return $this->paddingTop;
    }

    public function setPaddingTop(int $paddingTop): void
    {
        $this->paddingTop = $paddingTop;
    }

    public function getPaddingBottom(): int
    {
        return $this->paddingBottom;
    }

    public function setPaddingBottom(int $paddingBottom): void
    {
        $this->paddingBottom = $paddingBottom;
    }


    public function getPaddingLeft(): int
    {
        return $this->paddingLeft;
    }

    public function setPaddingLeft(int $paddingLeft): void
    {
        $this->paddingLeft = $paddingLeft;
    }

    public function getPaddingRight(): int
    {
        return $this->paddingRight;
    }

    public function setPaddingRight(int $paddingRight): void
    {
        $this->paddingRight = $paddingRight;
    }

    public function getTextFontSizeMobile(): int
    {
        return $this->textFontSizeMobile;
    }

    public function setTextFontSizeMobile(int $textFontSizeMobile): void
    {
        $this->textFontSizeMobile = $textFontSizeMobile;
    }

    public function getPaddingTopMobile(): int
    {
        return $this->paddingTopMobile;
    }

    public function setPaddingTopMobile(int $paddingTopMobile): void
    {
        $this->paddingTopMobile = $paddingTopMobile;
    }

    public function getPaddingBottomMobile(): int
    {
        return $this->paddingBottomMobile;
    }

    public function setPaddingBottomMobile(int $paddingBottomMobile): void
    {
        $this->paddingBottomMobile = $paddingBottomMobile;
    }

    public function getPaddingLeftMobile(): int
    {
        return $this->paddingLeftMobile;
    }

    public function setPaddingLeftMobile(int $paddingLeftMobile): void
    {
        $this->paddingLeftMobile = $paddingLeftMobile;
    }

    public function getPaddingRightMobile(): int
    {
        return $this->paddingRightMobile;
    }

    public function setPaddingRightMobile(int $paddingRightMobile): void
    {
        $this->paddingRightMobile = $paddingRightMobile;
    }

    public function isMobileBreakpointCarousel(): bool
    {
        return $this->mobileBreakpointCarousel;
    }

    public function setMobileBreakpointCarousel(bool $mobileBreakpointCarousel): void
    {
        $this->mobileBreakpointCarousel = $mobileBreakpointCarousel;
    }

    public function getMobileCarouselSpeed(): int
    {
        return $this->mobileCarouselSpeed;
    }

    public function setMobileCarouselSpeed(int $mobileCarouselSpeed): void
    {
        $this->mobileCarouselSpeed = $mobileCarouselSpeed;
    }

    public function getTextColorMobile(): string
    {
        return $this->textColorMobile;
    }

    public function setTextColorMobile(string $textColorMobile): void
    {
        $this->textColorMobile = $textColorMobile;
    }

    public function getHoverColorMobile(): string
    {
        return $this->hoverColorMobile;
    }

    public function setHoverColorMobile(string $hoverColorMobile): void
    {
        $this->hoverColorMobile = $hoverColorMobile;
    }

    public function getBackgroundColorMobile(): string
    {
        return $this->backgroundColorMobile;
    }

    public function setBackgroundColorMobile(string $backgroundColorMobile): void
    {
        $this->backgroundColorMobile = $backgroundColorMobile;
    }

    public function getHeightMobile(): int
    {
        return $this->heightMobile;
    }

    public function setHeightMobile(int $heightMobile): void
    {
        $this->heightMobile = $heightMobile;
    }


    public function getColumns(): ?HeaderColumnsCollection
    {
        return $this->columns;
    }

    public function setColumns(HeaderColumnsCollection $columns): void
    {
        $this->columns = $columns;
    }

    /**
     * @return string
     */
    public function getSalesChannelId(): ?string
    {
        return $this->salesChannelId;
    }

    /**
     * @param string $salesChannelId
     */
    public function setSalesChannelId(?string $salesChannelId): void
    {
        $this->salesChannelId = $salesChannelId;
    }

    /**
     * @return SalesChannelEntity|null
     */
    public function getSalesChannel(): ?SalesChannelEntity
    {
        return $this->salesChannel;
    }

    /**
     * @param SalesChannelEntity|null $salesChannel
     */
    public function setSalesChannel(?SalesChannelEntity $salesChannel): void
    {
        $this->salesChannel = $salesChannel;
    }

}
