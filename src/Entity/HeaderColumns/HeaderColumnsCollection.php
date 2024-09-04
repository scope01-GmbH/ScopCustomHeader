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

use Scop\ScopCustomHeader\Entity\HeaderColumnsTranslation\HeaderColumnsTranslationEntity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void          add(HeaderColumnsTranslationEntity $entity)
 * @method void          set(string $key, HeaderColumnsTranslationEntity $entity)
 * @method HeaderColumnsTranslationEntity[]    getIterator()
 * @method HeaderColumnsTranslationEntity[]    getElements()
 * @method HeaderColumnsTranslationEntity|null get(string $key)
 * @method HeaderColumnsTranslationEntity|null first()
 * @method HeaderColumnsTranslationEntity|null last()
 */
class HeaderColumnsCollection extends EntityCollection
{

    /**
     * {@inheritDoc}
     * @see \Shopware\Core\Framework\DataAbstractionLayer\EntityCollection::getExpectedClass()
     */
    protected function getExpectedClass(): string
    {
        return HeaderColumnsEntity::class;
    }
}
