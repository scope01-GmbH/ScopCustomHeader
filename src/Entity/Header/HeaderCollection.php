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

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void          add(HeaderEntity $entity)
 * @method void          set(string $key, HeaderEntity $entity)
 * @method HeaderEntity[]    getIterator()
 * @method HeaderEntity[]    getElements()
 * @method HeaderEntity|null get(string $key)
 * @method HeaderEntity|null first()
 * @method HeaderEntity|null last()
 */
class HeaderCollection extends EntityCollection
{

    /**
     * {@inheritDoc}
     * @see \Shopware\Core\Framework\DataAbstractionLayer\EntityCollection::getExpectedClass()
     */
    protected function getExpectedClass(): string
    {
        return HeaderEntity::class;
    }
}
