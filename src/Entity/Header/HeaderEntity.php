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

namespace Scop\ScopCustomHeader\Entity\Header;

use Scop\ScopCustomHeader\Entity\HeaderColumns\HeaderColumnsCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\SalesChannel\SalesChannelEntity;

class HeaderEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var String $label
     */
    protected string $label;
    /**
     * @var String|null $description
     */
    protected ?string $description = null;
    /**
     * @var int $priority
     */
    protected int $priority;
    /**
     * @var bool $enabled
     */
    protected ?bool $enabled = null;
    /**
     * @var int|null $height
     */
    protected ?int $height = null;
    /**
     * @var String|null $background
     */
    protected ?string $background = null;
    /**
     * @var int|null $textFontSize
     */
    protected ?int $textFontSize = null;
    /**
     * @var String|null $textColor
     */
    protected ?string $textColor = null;
    /**
     * @var String|null $hover
     */
    protected ?string $hover = null;
    /**
     * @var int|null $paddingTop
     */
    protected ?int $paddingTop = null;
    /**
     * @var int|null $paddingBottom
     */
    protected ?int $paddingBottom = null;
    /**
     * @var int|null $paddingLeft
     */
    protected ?int $paddingLeft = null;
    /**
     * @var int|null $paddingRight
     */
    protected ?int $paddingRight = null;

    /**
     * @var int|null $textFontSizeMobile
     */
    protected ?int $textFontSizeMobile = null;
    /**
     * @var int|null $paddingTopMobile
     */
    protected ?int $paddingTopMobile = null;
    /**
     * @var int|null $paddingBottomMobile
     */
    protected ?int $paddingBottomMobile = null;
    /**
     * @var int|null $paddingLeftMobile
     */
    protected ?int $paddingLeftMobile = null;
    /**
     * @var int|null $paddingRightMobile
     */
    protected ?int $paddingRightMobile = null;
    /**
     * @var bool $mobileBreakpointCarousel
     */
    protected ?bool $mobileBreakpointCarousel = null;
    /**
     * @var int|null $mobileCarouselSpeed
     */
    protected ?int $mobileCarouselSpeed = null;

    /**
     * @var int|null
     */
    protected ?int $heightMobile = null;

    /**
     * @var string|null
     */
    protected ?string $backgroundColorMobile = null;

    /**
     * @var string|null
     */
    protected ?string $hoverColorMobile = null;

    /**
     * @var string|null
     */
    protected ?string $textColorMobile = null;


    /**
     * @var HeaderColumnsCollection|null $columns
     */
    protected ?HeaderColumnsCollection $columns = null;

    /**
     * @var string|null $salesChannelId
     */
    protected ?string $salesChannelId;
    /**
     * @var SalesChannelEntity|null $salesChannel
     */
    protected ?SalesChannelEntity $salesChannel = null;

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
     * @return string|null
     */
    public function getDescription(): ?string
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
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return void
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string|null
     */
    public function getBackground(): ?string
    {
        return $this->background;
    }

    /**
     * @param string $background
     * @return void
     */
    public function setBackground(string $background): void
    {
        $this->background = $background;
    }

    /**
     * @return int|null
     */
    public function getTextFontSize(): ?int
    {
        return $this->textFontSize;
    }

    /**
     * @param int $textFontSize
     * @return void
     */
    public function setTextFontSize(int $textFontSize): void
    {
        $this->textFontSize = $textFontSize;
    }

    /**
     * @return string|null
     */
    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    /**
     * @param string $textColor
     * @return void
     */
    public function setTextColor(string $textColor): void
    {
        $this->textColor = $textColor;
    }

    /**
     * @return string|null
     */
    public function getHover(): ?string
    {
        return $this->hover;
    }

    /**
     * @param string $hover
     * @return void
     */
    public function setHover(string $hover): void
    {
        $this->hover = $hover;
    }

    /**
     * @return int|null
     */
    public function getPaddingTop(): ?int
    {
        return $this->paddingTop;
    }

    /**
     * @param int $paddingTop
     * @return void
     */
    public function setPaddingTop(int $paddingTop): void
    {
        $this->paddingTop = $paddingTop;
    }

    /**
     * @return int|null
     */
    public function getPaddingBottom(): ?int
    {
        return $this->paddingBottom;
    }

    /**
     * @param int $paddingBottom
     * @return void
     */
    public function setPaddingBottom(int $paddingBottom): void
    {
        $this->paddingBottom = $paddingBottom;
    }


    /**
     * @return int|null
     */
    public function getPaddingLeft(): ?int
    {
        return $this->paddingLeft;
    }

    /**
     * @param int $paddingLeft
     * @return void
     */
    public function setPaddingLeft(int $paddingLeft): void
    {
        $this->paddingLeft = $paddingLeft;
    }

    /**
     * @return int|null
     */
    public function getPaddingRight(): ?int
    {
        return $this->paddingRight;
    }

    /**
     * @param int $paddingRight
     * @return void
     */
    public function setPaddingRight(int $paddingRight): void
    {
        $this->paddingRight = $paddingRight;
    }

    /**
     * @return int|null
     */
    public function getTextFontSizeMobile(): ?int
    {
        return $this->textFontSizeMobile;
    }

    /**
     * @param int $textFontSizeMobile
     * @return void
     */
    public function setTextFontSizeMobile(int $textFontSizeMobile): void
    {
        $this->textFontSizeMobile = $textFontSizeMobile;
    }

    /**
     * @return int|null
     */
    public function getPaddingTopMobile(): ?int
    {
        return $this->paddingTopMobile;
    }

    /**
     * @param int $paddingTopMobile
     * @return void
     */
    public function setPaddingTopMobile(int $paddingTopMobile): void
    {
        $this->paddingTopMobile = $paddingTopMobile;
    }

    /**
     * @return int|null
     */
    public function getPaddingBottomMobile(): ?int
    {
        return $this->paddingBottomMobile;
    }

    /**
     * @param int $paddingBottomMobile
     * @return void
     */
    public function setPaddingBottomMobile(int $paddingBottomMobile): void
    {
        $this->paddingBottomMobile = $paddingBottomMobile;
    }

    /**
     * @return int|null
     */
    public function getPaddingLeftMobile(): ?int
    {
        return $this->paddingLeftMobile;
    }

    /**
     * @param int $paddingLeftMobile
     * @return void
     */
    public function setPaddingLeftMobile(int $paddingLeftMobile): void
    {
        $this->paddingLeftMobile = $paddingLeftMobile;
    }

    /**
     * @return int|null
     */
    public function getPaddingRightMobile(): ?int
    {
        return $this->paddingRightMobile;
    }

    /**
     * @param int $paddingRightMobile
     * @return void
     */
    public function setPaddingRightMobile(int $paddingRightMobile): void
    {
        $this->paddingRightMobile = $paddingRightMobile;
    }

    /**
     * @return bool|null
     */
    public function isMobileBreakpointCarousel(): ?bool
    {
        return $this->mobileBreakpointCarousel;
    }

    /**
     * @param bool $mobileBreakpointCarousel
     * @return void
     */
    public function setMobileBreakpointCarousel(bool $mobileBreakpointCarousel): void
    {
        $this->mobileBreakpointCarousel = $mobileBreakpointCarousel;
    }

    /**
     * @return int|null
     */
    public function getMobileCarouselSpeed(): ?int
    {
        return $this->mobileCarouselSpeed;
    }

    /**
     * @param int $mobileCarouselSpeed
     * @return void
     */
    public function setMobileCarouselSpeed(int $mobileCarouselSpeed): void
    {
        $this->mobileCarouselSpeed = $mobileCarouselSpeed;
    }

    /**
     * @return string|null
     */
    public function getTextColorMobile(): ?string
    {
        return $this->textColorMobile;
    }

    /**
     * @param string $textColorMobile
     * @return void
     */
    public function setTextColorMobile(string $textColorMobile): void
    {
        $this->textColorMobile = $textColorMobile;
    }

    /**
     * @return string|null
     */
    public function getHoverColorMobile(): ?string
    {
        return $this->hoverColorMobile;
    }

    /**
     * @param string $hoverColorMobile
     * @return void
     */
    public function setHoverColorMobile(string $hoverColorMobile): void
    {
        $this->hoverColorMobile = $hoverColorMobile;
    }

    /**
     * @return string|null
     */
    public function getBackgroundColorMobile(): ?string
    {
        return $this->backgroundColorMobile;
    }

    /**
     * @param string $backgroundColorMobile
     * @return void
     */
    public function setBackgroundColorMobile(string $backgroundColorMobile): void
    {
        $this->backgroundColorMobile = $backgroundColorMobile;
    }

    /**
     * @return int|null
     */
    public function getHeightMobile(): ?int
    {
        return $this->heightMobile;
    }

    /**
     * @param int $heightMobile
     * @return void
     */
    public function setHeightMobile(int $heightMobile): void
    {
        $this->heightMobile = $heightMobile;
    }


    /**
     * @return HeaderColumnsCollection|null
     */
    public function getColumns(): ?HeaderColumnsCollection
    {
        return $this->columns;
    }

    /**
     * @param HeaderColumnsCollection $columns
     * @return void
     */
    public function setColumns(HeaderColumnsCollection $columns): void
    {
        $this->columns = $columns;
    }

    /**
     * @return string|null
     */
    public function getSalesChannelId(): ?string
    {
        return $this->salesChannelId;
    }

    /**
     * @param string|null $salesChannelId
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
