<?php

/**
 * This file is part of the jquery-querybuilder-bundle package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\JQuery\QueryBuilderBundle\Exception;

use Exception;

/**
 * Abstract jQuery QueryBuilder exception.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Bundle\JQuery\QueryBuilderBundle\Exception
 * @abstract
 */
abstract class AbstractQueryBuilderException extends Exception {

    /**
     * Constructor.
     *
     * @param string $message The message.
     * @param int $code The code.
     * @param Exception $previous The previous exception.
     */
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}
