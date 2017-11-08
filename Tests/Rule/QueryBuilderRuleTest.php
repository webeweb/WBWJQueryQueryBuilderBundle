<?php

/*
 * This file is part of the WBWJQueryQueryBuilderBundle package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\JQuery\QueryBuilderBundle\Tests\Rule;

use Exception;
use PHPUnit_Framework_TestCase;
use WBW\Bundle\JQuery\QueryBuilderBundle\Rule\QueryBuilderRule;
use WBW\Library\Core\Exception\Argument\IllegalArgumentException;

/**
 * jQuery QueryBuilder rule test.
 *
 * @author NdC/WBW <https://github.com/webeweb/>
 * @package WBW\Bundle\JQuery\QueryBuilderBundle\Rule
 * @final
 */
final class QueryBuilderRuleTest extends PHPUnit_Framework_TestCase {

	/**
	 * Tests the __construct() method.
	 *
	 * @return void
	 */
	public function testConstruct() {

		try {
			new QueryBuilderRule(["id" => "id", "field" => "id", "input" => QueryBuilderRule::INPUT_NUMBER, "operator" => "exception", "type" => QueryBuilderRule::TYPE_INTEGER, "value" => 1]);
		} catch (Exception $ex) {
			$this->assertInstanceOf(IllegalArgumentException::class, $ex, "The method __construct() does not throw the expecetd exception");
			$this->assertEquals("The operator \"exception\" is invalid", $ex->getMessage(), "The method getMessage() does not return the expected value");
		}

		$obj = new QueryBuilderRule(["id" => "id", "field" => "id", "input" => QueryBuilderRule::INPUT_NUMBER, "operator" => QueryBuilderRule::OPERATOR_EQUAL, "type" => QueryBuilderRule::TYPE_INTEGER, "value" => 1]);

		$this->assertEquals("id", $obj->getId(), "The method getId() does not return the expected value");
		$this->assertEquals(null, $obj->getDecorator(), "The method getDecorator() does not return the expected value");
		$this->assertEquals("id", $obj->getField(), "The method getField() does not return the expected value");
		$this->assertEquals(QueryBuilderRule::INPUT_NUMBER, $obj->getInput(), "The method getInput() does not return the expected value");
		$this->assertEquals(QueryBuilderRule::OPERATOR_EQUAL, $obj->getOperator(), "The method getOperator() does not return the expected value");
		$this->assertEquals(QueryBuilderRule::TYPE_INTEGER, $obj->getType(), "The method getType() does not return the expected value");
		$this->assertEquals(1, $obj->getValue(), "The method getValue() does not return the expected value");
	}

	/**
	 * Tests the toSQL() method.
	 *
	 * @retrun void
	 */
	public function testToSQLWithDouble() {

		// Initialize the rule.
		$rule = ["id" => "id", "field" => "id", "input" => QueryBuilderRule::INPUT_NUMBER, "type" => QueryBuilderRule::TYPE_DOUBLE, "value" => "1.0"];

		$res01 = "id LIKE '1.0%'";
		$this->assertEquals($res01, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_BEGINS_WITH])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_BEGINS_WITH");

		$rule2			 = array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_BETWEEN]);
		$rule2["value"]	 = ["1.0", "2.0"];

		$res02 = "id BETWEEN 1.0 AND 2.0";
		$this->assertEquals($res02, (new QueryBuilderRule($rule2))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_CONTAINS");

		$res03 = "id LIKE '%1.0%'";
		$this->assertEquals($res03, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_CONTAINS])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_CONTAINS");

		$res04 = "id LIKE '%1.0'";
		$this->assertEquals($res04, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_ENDS_WITH])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_ENDS_WITH");

		$res05 = "id = 1.0";
		$this->assertEquals($res05, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_EQUAL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_EQUAL");

		$res06 = "id > 1.0";
		$this->assertEquals($res06, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_GREATER])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_GREATER");

		$res07 = "id >= 1.0";
		$this->assertEquals($res07, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_GREATER_OR_EQUAL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_GREATER_OR_EQUAL");

		$rule2["operator"] = QueryBuilderRule::OPERATOR_IN;

		$res08 = "id IN (1.0, 2.0)";
		$this->assertEquals($res08, (new QueryBuilderRule($rule2))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IN");

		$res09 = "id IS NULL";
		$this->assertEquals($res09, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_IS_EMPTY])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IS_EMPTY");

		$res10 = "id IS NOT NULL";
		$this->assertEquals($res10, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_IS_NOT_EMPTY])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IS_NOT_EMPTY");

		$res11 = "id IS NOT NULL";
		$this->assertEquals($res11, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_IS_NOT_NULL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IS_NOT_NULL");

		$res12 = "id IS NULL";
		$this->assertEquals($res12, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_IS_NULL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IS_NULL");

		$res13 = "id < 1.0";
		$this->assertEquals($res13, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_LESS])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_LESS");

		$res14 = "id <= 1.0";
		$this->assertEquals($res14, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_LESS_OR_EQUAL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_LESS_OR_EQUAL");

		$res15 = "id NOT LIKE '1.0%'";
		$this->assertEquals($res15, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_NOT_BEGINS_WITH])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_BEGINS_WITH");

		$rule2["operator"] = QueryBuilderRule::OPERATOR_NOT_BETWEEN;

		$res16 = "id NOT BETWEEN 1.0 AND 2.0";
		$this->assertEquals($res16, (new QueryBuilderRule($rule2))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_BEGINS_WITH");

		$rule2["operator"] = QueryBuilderRule::OPERATOR_NOT_IN;

		$res17 = "id NOT IN (1.0, 2.0)";
		$this->assertEquals($res17, (new QueryBuilderRule($rule2))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_IN");

		$res18 = "id NOT LIKE '%1.0%'";
		$this->assertEquals($res18, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_NOT_CONTAINS])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_CONTAINS");

		$res19 = "id NOT LIKE '%1.0'";
		$this->assertEquals($res19, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_NOT_ENDS_WITH])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_ENDS_WITH");

		$res20 = "id <> 1.0";
		$this->assertEquals($res20, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_NOT_EQUAL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_EQUAL");
	}

	/**
	 * Tests the toSQL() method.
	 *
	 * @retrun void
	 */
	public function testToSQLWithString() {

		// Initialize the rule.
		$rule = ["id" => "id", "field" => "id", "input" => QueryBuilderRule::INPUT_TEXT, "type" => QueryBuilderRule::TYPE_STRING, "value" => "val'ue"];

		$res01 = "id LIKE 'val\'ue%'";
		$this->assertEquals($res01, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_BEGINS_WITH])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_BEGINS_WITH");

		$rule2			 = array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_BETWEEN]);
		$rule2["value"]	 = ["value1", "value2"];

		$res02 = "id BETWEEN 'value1' AND 'value2'";
		$this->assertEquals($res02, (new QueryBuilderRule($rule2))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_CONTAINS");

		$res03 = "id LIKE '%val\'ue%'";
		$this->assertEquals($res03, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_CONTAINS])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_CONTAINS");

		$res04 = "id LIKE '%val\'ue'";
		$this->assertEquals($res04, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_ENDS_WITH])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_ENDS_WITH");

		$res05 = "id = 'val\'ue'";
		$this->assertEquals($res05, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_EQUAL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_EQUAL");

		$res06 = "id > 'val\'ue'";
		$this->assertEquals($res06, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_GREATER])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_GREATER");

		$res07 = "id >= 'val\'ue'";
		$this->assertEquals($res07, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_GREATER_OR_EQUAL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_GREATER_OR_EQUAL");

		$rule2["operator"] = QueryBuilderRule::OPERATOR_IN;

		$res08 = "id IN ('value1', 'value2')";
		$this->assertEquals($res08, (new QueryBuilderRule($rule2))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IN");

		$res09 = "id IS NULL";
		$this->assertEquals($res09, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_IS_EMPTY])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IS_EMPTY");

		$res10 = "id IS NOT NULL";
		$this->assertEquals($res10, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_IS_NOT_EMPTY])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IS_NOT_EMPTY");

		$res11 = "id IS NOT NULL";
		$this->assertEquals($res11, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_IS_NOT_NULL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IS_NOT_NULL");

		$res12 = "id IS NULL";
		$this->assertEquals($res12, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_IS_NULL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_IS_NULL");

		$res13 = "id < 'val\'ue'";
		$this->assertEquals($res13, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_LESS])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_LESS");

		$res14 = "id <= 'val\'ue'";
		$this->assertEquals($res14, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_LESS_OR_EQUAL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_LESS_OR_EQUAL");

		$res15 = "id NOT LIKE 'val\'ue%'";
		$this->assertEquals($res15, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_NOT_BEGINS_WITH])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_BEGINS_WITH");

		$rule2["operator"] = QueryBuilderRule::OPERATOR_NOT_BETWEEN;

		$res16 = "id NOT BETWEEN 'value1' AND 'value2'";
		$this->assertEquals($res16, (new QueryBuilderRule($rule2))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_BEGINS_WITH");

		$rule2["operator"] = QueryBuilderRule::OPERATOR_NOT_IN;

		$res17 = "id NOT IN ('value1', 'value2')";
		$this->assertEquals($res17, (new QueryBuilderRule($rule2))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_IN");

		$res18 = "id NOT LIKE '%val\'ue%'";
		$this->assertEquals($res18, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_NOT_CONTAINS])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_CONTAINS");

		$res19 = "id NOT LIKE '%val\'ue'";
		$this->assertEquals($res19, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_NOT_ENDS_WITH])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_ENDS_WITH");

		$res20 = "id <> 'val\'ue'";
		$this->assertEquals($res20, (new QueryBuilderRule(array_merge($rule, ["operator" => QueryBuilderRule::OPERATOR_NOT_EQUAL])))->toSQL(), "The method toSQL() does not return the expected value with OPERATOR_NOT_EQUAL");
	}

}