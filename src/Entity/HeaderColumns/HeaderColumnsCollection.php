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

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void          add(HeaderColumnsEntity $entity)
 * @method void          set(string $key, HeaderColumnsEntity $entity)
 * @method HeaderColumnsEntity[]    getIterator()
 * @method HeaderColumnsEntity[]    getElements()
 * @method HeaderColumnsEntity|null get(string $key)
 * @method HeaderColumnsEntity|null first()
 * @method HeaderColumnsEntity|null last()
 */
class HeaderColumnsCollection extends EntityCollection
{

    /**
     * {@inheritDoc}
     * @see EntityCollection::getExpectedClass
     */
    protected function getExpectedClass(): string
    {
        return HeaderColumnsEntity::class;
    }
}
