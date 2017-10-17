<?php

/*
 * This file is part of the WBWJQueryQueryBuilderBundle package.
 *
 * (c) 2017 WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\JQuery\QueryBuilderBundle\API\Type;

/**
 * QueryBuilder type interface.
 *
 * @author WBW <https://github.com/webeweb/WBWJQueryQueryBuilderBundle>
 * @package WBW\JQuery\QueryBuilderBundle\API\Type
 * @version 2.4.3
 * @final
 */
interface IQueryBuilderType {

    /**
     * Types.
     */
    const TYPES = [
        self::TYPE_BOOLEAN  => self::TYPE_BOOLEAN,
        self::TYPE_DATE     => self::TYPE_DATE,
        self::TYPE_DATETIME => self::TYPE_DATETIME,
        self::TYPE_DOUBLE   => self::TYPE_DOUBLE,
        self::TYPE_INTEGER  => self::TYPE_INTEGER,
        self::TYPE_STRING   => self::TYPE_STRING,
        self::TYPE_TIME     => self::TYPE_TIME,
    ];

    /**
     * Type boolean.
     */
    const TYPE_BOOLEAN = "boolean";

    /**
     * Type date.
     */
    const TYPE_DATE = "date";

    /**
     * Type datetime.
     */
    const TYPE_DATETIME = "datetime";

    /**
     * Type double.
     */
    const TYPE_DOUBLE = "double";

    /**
     * Type integer.
     */
    const TYPE_INTEGER = "integer";

    /**
     * Type string.
     */
    const TYPE_STRING = "string";

    /**
     * Type time.
     */
    const TYPE_TIME = "time";

}
