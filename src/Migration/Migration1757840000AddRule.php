<?php
declare(strict_types=1);

namespace Scop\ScopCustomHeader\Migration;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
#[Package('core')]
class Migration1757840000AddRule extends MigrationStep
{

    /**
     * @return int
     */
    public function getCreationTimestamp(): int
    {
        return 1757840000;
    }

    /**
     * @param Connection $connection
     * @return void
     * @throws Exception
     */
    public function update(Connection $connection): void
    {
        $columns = $connection->fetchFirstColumn('SHOW COLUMNS FROM `scop_custom_header` LIKE \'rule_id\'');
        if (!empty($columns)) {
            return;
        }

        $connection->executeStatement(<<<SQL
ALTER TABLE `scop_custom_header`
    ADD COLUMN `rule_id` BINARY(16) NULL AFTER `salesChannelId`,
    ADD KEY `fk.scop_custom_header.rule_id` (`rule_id`),
    ADD CONSTRAINT `fk.scop_custom_header.rule_id` FOREIGN KEY (`rule_id`) REFERENCES `rule` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
SQL);
    }

}
