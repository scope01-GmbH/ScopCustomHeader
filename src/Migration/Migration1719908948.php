<?php
declare(strict_types=1);

namespace Scop\ScopCustomHeader\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
#[Package('core')]
class Migration1719908948 extends MigrationStep
{

    /**
     * @return int
     */
    public function getCreationTimestamp(): int
    {
        return 1719908948;
    }

    /**
     * @param Connection $connection
     * @return void
     */
    public function update(Connection $connection): void
    {

        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `scop_custom_header` (
    `id` BINARY(16) NOT NULL,
    `label` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NULL,
    `priority` INT(11) NOT NULL,
    `enabled` TINYINT(1) NULL DEFAULT '0',
    `height` INT(11) NULL,
    `background` VARCHAR(255) NULL,
    `text_font_size` INT(11) NULL,
    `text_color` VARCHAR(255) NULL,
    `hover` VARCHAR(255) NULL,
    `padding_top` INT(11) NULL,
    `padding_bottom` INT(11) NULL,
    `padding_left` INT(11) NULL,
    `padding_right` INT(11) NULL,
    `text_font_size_mobile` INT(11) NULL,
    `padding_top_mobile` INT(11) NULL,
    `padding_bottom_mobile` INT(11) NULL,
    `padding_left_mobile` INT(11) NULL,
    `padding_right_mobile` INT(11) NULL,
    `mobile_breakpoint_carousel` TINYINT(1) NULL DEFAULT '0',
    `mobile_carousel_speed` INT(11) NULL,
    `height_mobile` INT(11) NULL,
    `background_color_mobile` VARCHAR(255) NULL,
    `hover_color_mobile` VARCHAR(255) NULL,
    `text_color_mobile` VARCHAR(255) NULL,
    `salesChannelId` BINARY(16) NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`id`),
    KEY `fk.scop_custom_header.salesChannelId` (`salesChannelId`),
    CONSTRAINT `fk.scop_custom_header.salesChannelId` FOREIGN KEY (`salesChannelId`) REFERENCES `sales_channel` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;
        $connection->executeUpdate($sql);

        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `scop_custom_header_columns` (
    `id` BINARY(16) NOT NULL,
    `header_id` BINARY(16) NOT NULL,
    `open_in_new_tab` TINYINT(1) NULL DEFAULT '0',
    `position` INT(11) NULL,
    `show_desktop` TINYINT(1) NULL DEFAULT '1',
    `show_mobile` TINYINT(1) NULL DEFAULT '1',
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`id`),
    KEY `fk.scop_custom_header_columns.header_id` (`header_id`),
    CONSTRAINT `fk.scop_custom_header_columns.header_id` FOREIGN KEY (`header_id`) REFERENCES `scop_custom_header` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;
        $connection->executeUpdate($sql);

        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `scop_custom_header_columns_translation` (
    `scop_custom_header_columns_id` BINARY(16) NOT NULL,
    `language_id` BINARY(16) NOT NULL,
    `label` VARCHAR(255) NULL,
    `icon_id` BINARY(16) NULL,
    `text_link` VARCHAR(255) NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`scop_custom_header_columns_id`, `language_id`),
    KEY `fk.scop_custom_header_columns.scop_custom_header_columns_id` (`scop_custom_header_columns_id`),
    KEY `fk.scop_custom_header_columns.language_id` (`language_id`),
    KEY `fk.scop_custom_header_columns.icon_id` (`icon_id`),
    CONSTRAINT `fk.scop_custom_header_columns.scop_custom_header_columns_id` FOREIGN KEY (`scop_custom_header_columns_id`) REFERENCES `scop_custom_header_columns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk.scop_custom_header_columns.language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk.scop_custom_header_columns.icon_id` FOREIGN KEY (`icon_id`) REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;
        $connection->executeUpdate($sql);
    }

}
