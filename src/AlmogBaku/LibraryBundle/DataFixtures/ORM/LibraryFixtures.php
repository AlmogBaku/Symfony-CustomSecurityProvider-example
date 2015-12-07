<?php
/**
 * @author  Almog Baku
 *          almog.baku@gmail.com
 *          http://www.almogbaku.com/
 *
 * 05/04/15 17:35
 */

namespace AlmogBaku\LibraryBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class LibraryFixtures extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return  array(
            __DIR__ . '/../authors.yml',
            __DIR__ . '/../books.yml',
        );
    }
}