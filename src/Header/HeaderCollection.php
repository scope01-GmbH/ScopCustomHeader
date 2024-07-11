<?php
declare(strict_types=1);
/**
 * Implemented by scope01 GmbH team https://scope01.com
 *
 * @copyright scope01 GmbH https://scope01.com
 * @license MIT
 * @link https://scope01.com
 */

namespace Scop\ScopCustomHeader\Header;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void          add(Header $entity)
 * @method void          set(string $key, Header $entity)
 * @method Header[]    getIterator()
 * @method Header[]    getElements()
 * @method Header|null get(string $key)
 * @method Header|null first()
 * @method Header|null last()
 */
class HeaderCollection extends EntityCollection
{

    /**
     * {@inheritDoc}
     * @see \Shopware\Core\Framework\DataAbstractionLayer\EntityCollection::getExpectedClass()
     */
    protected function getExpectedClass(): string
    {
        return Header::class;
    }
}
