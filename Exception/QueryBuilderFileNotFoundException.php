<?php

/*
 * This file is part of the WBWJQueryQueryBuilderBundle package.
 *
 * (c) 2017 WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\JQuery\QueryBuilderBundle\Exception;

/**
 * jQuery QueryBuilder file not found exception.
 *
 * @author WBW <https://github.com/webeweb/WBWJQueryQueryBuilderBundle>
 * @package WBW\JQuery\QueryBuilderBundle\Exception
 * @version 2.4.3
 * @final
 */
final class QueryBuilderFileNotFoundException extends AbstractQueryBuilderException {

    /**
     * Constructor.
     *
     * @param string $filename The file name.
     */
    public function __construct($filename) {
        parent::__construct("The file \"" . $filename . "\" was not found");
    }

}