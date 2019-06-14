<?php

/*
 * This file is part of the jquery-querybuilder-bundle package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\JQuery\QueryBuilderBundle\Decorator\Operator;

use WBW\Bundle\JQuery\QueryBuilderBundle\API\QueryBuilderRuleInterface;
use WBW\Bundle\JQuery\QueryBuilderBundle\Decorator\QueryBuilderDecoratorFactory;

/**
 * Contains QueryBuilder operator.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Bundle\JQuery\QueryBuilderBundle\Decorator\Operator
 */
class ContainsQueryBuilderOperator extends AbstractQueryBuilderOperator {

    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(self::OPERATOR_CONTAINS);
    }

    /**
     * {@inheritDoc}
     */
    public function toSQL(QueryBuilderRuleInterface $rule, $wrap = false) {

        $qbt = QueryBuilderDecoratorFactory::newQueryBuilderType($rule->getType());

        $sql = [
            parent::toSQL($rule, $wrap),
            "'%" . $qbt->toSQL($rule, false) . "%'",
        ];

        return implode(" ", $sql);
    }
}