<?php

/*
 * This file is part of the jquery-querybuilder-bundle package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\JQuery\QueryBuilderBundle\Tests\Decorator\Operator;

use WBW\Bundle\JQuery\QueryBuilderBundle\API\QueryBuilderOperatorInterface;
use WBW\Bundle\JQuery\QueryBuilderBundle\API\QueryBuilderRule;
use WBW\Bundle\JQuery\QueryBuilderBundle\Decorator\Operator\IsNotNullQueryBuilderOperator;
use WBW\Bundle\JQuery\QueryBuilderBundle\Tests\AbstractTestCase;

/**
 * Is not null QueryBuilder operator test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Bundle\JQuery\QueryBuilderBundle\Tests\Decorator\Operator
 */
class IsNotNullQueryBuilderOperatorTest extends AbstractTestCase {

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function testConstruct() {

        $obj = new IsNotNullQueryBuilderOperator();

        $this->assertEquals(QueryBuilderOperatorInterface::OPERATOR_IS_NOT_NULL, $obj->getOperator());
    }

    /**
     * Tests the toSQL() method.
     *
     * @return void
     */
    public function testToSQL() {

        // Set a QueryBuilder rule mock.
        $rule = new QueryBuilderRule();
        $rule->setField("field");

        $obj = new IsNotNullQueryBuilderOperator();

        $this->assertEquals("field IS NOT NULL", $obj->toSQL($rule));
    }
}