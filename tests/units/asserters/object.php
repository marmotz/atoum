<?php

namespace mageekguy\atoum\tests\units\asserters;

use \mageekguy\atoum;
use \mageekguy\atoum\asserters;

require_once(__DIR__ . '/../../../runners/autorunner.php');

/**
@isolation off
*/
class object extends atoum\test
{
	public function test__construct()
	{
		$score = new atoum\score();
		$locale = new atoum\locale();

		$asserter = new asserters\object($score, $locale);

		$this->assert
			->object($asserter->getScore())->isIdenticalTo($score)
			->object($asserter->getLocale())->isIdenticalTo($locale)
		;
	}

	public function testSetWith()
	{
		$currentMethod = substr(__METHOD__, strrpos(__METHOD__, ':') + 1);

		$locale = new atoum\locale();
		$score = new atoum\score();

		$asserter = new asserters\object($score, $locale);

		$exception = null;

		$variable = uniqid();

		try
		{
			$line = __LINE__; $asserter->setWith($variable);
		}
		catch (\exception $exception) {}

		$this->assert
			->exception($exception)
				->isInstanceOf('\mageekguy\atoum\asserter\exception')
				->hasMessage(sprintf($locale->_('%s is not an object'), asserters\object::toString($variable)))
			->integer($score->getFailNumber())->isEqualTo(1)
			->collection($score->getFailAssertions())->isEqualTo(array(
					array(
						'class' => __CLASS__,
						'method' => $currentMethod,
						'file' => __FILE__,
						'line' => $line,
						'asserter' => get_class($asserter) . '::setWith()',
						'fail' => $exception->getMessage()
					)
				)
			)
			->integer($score->getPassNumber())->isZero()
			->string($asserter->getVariable())->isEqualTo($variable)
		;

		$variable = $this;

		$exception = null;

		try
		{
			$line = __LINE__; $this->assert->object($asserter->setWith($variable))->isIdenticalTo($asserter);
		}
		catch (\exception $exception) {}

		$this->assert
			->variable($exception)->isNull()
			->integer($score->getFailNumber())->isEqualTo(1)
			->integer($score->getPassNumber())->isEqualTo(1)
			->collection($score->getPassAssertions())->isEqualTo(array(
					array(
						'class' => __CLASS__,
						'method' => $currentMethod,
						'file' => __FILE__,
						'line' => $line,
						'asserter' => get_class($asserter) . '::setWith()',
						'fail' => null
					)
				)
			)
			->object($asserter->getVariable())->isIdenticalTo($variable)
		;
	}

	public function testHasSize()
	{
		$currentMethod = substr(__METHOD__, strrpos(__METHOD__, ':') + 1);

		$locale = new atoum\locale();
		$score = new atoum\score();

		$asserter = new asserters\object($score, $locale);

		$asserter->setWith($this);

		$score->reset();

		$exception = null;

		try
		{
			$line = __LINE__; $asserter->hasSize(0);
		}
		catch (\exception $exception) {}

		$this->assert
			->exception($exception)
				->isInstanceOf('\mageekguy\atoum\asserter\exception')
				->hasMessage(sprintf($locale->_('%s has not size %d'), $asserter, 0))
			->integer($score->getFailNumber())->isEqualTo(1)
			->collection($score->getFailAssertions())->isEqualTo(array(
					array(
						'class' => __CLASS__,
						'method' => $currentMethod,
						'file' => __FILE__,
						'line' => $line,
						'asserter' => get_class($asserter) . '::hasSize()',
						'fail' => $exception->getMessage()
					)
				)
			)
			->integer($score->getPassNumber())->isZero()
		;

		$exception = null;

		try
		{
			$line = __LINE__; $this->assert->object($asserter->hasSize(sizeof($this)))->isIdenticalTo($asserter);
		}
		catch (\exception $exception) {}

		$this->assert
			->variable($exception)->isNull()
			->integer($score->getFailNumber())->isEqualTo(1)
			->integer($score->getPassNumber())->isEqualTo(1)
			->collection($score->getPassAssertions())->isEqualTo(array(
					array(
						'class' => __CLASS__,
						'method' => $currentMethod,
						'file' => __FILE__,
						'line' => $line,
						'asserter' => get_class($asserter) . '::hasSize()',
						'fail' => null
					)
				)
			)
		;
	}

	public function testIsEmpty()
	{
		$currentMethod = substr(__METHOD__, strrpos(__METHOD__, ':') + 1);

		$locale = new atoum\locale();
		$score = new atoum\score();

		$asserter = new asserters\object($score, $locale);

		$asserter->setWith($this);

		$score->reset();

		$exception = null;

		try
		{
			$line = __LINE__; $asserter->isEmpty();
		}
		catch (\exception $exception) {}

		$this->assert
			->exception($exception)
				->isInstanceOf('\mageekguy\atoum\asserter\exception')
				->hasMessage(sprintf($locale->_('%s has size %d'), $asserter, sizeof($this)))
			->integer($score->getFailNumber())->isEqualTo(1)
			->collection($score->getFailAssertions())->isEqualTo(array(
					array(
						'class' => __CLASS__,
						'method' => $currentMethod,
						'file' => __FILE__,
						'line' => $line,
						'asserter' => get_class($asserter) . '::isEmpty()',
						'fail' => $exception->getMessage()
					)
				)
			)
			->integer($score->getPassNumber())->isZero()
		;

		$asserter->setWith(new \arrayIterator());

		$score->reset();

		$exception = null;

		try
		{
			$line = __LINE__; $this->assert->object($asserter->isEmpty())->isIdenticalTo($asserter);
		}
		catch (\exception $exception) {}

		$this->assert
			->variable($exception)->isNull()
			->integer($score->getFailNumber())->isEqualTo(0)
			->integer($score->getPassNumber())->isEqualTo(1)
			->collection($score->getPassAssertions())->isEqualTo(array(
					array(
						'class' => __CLASS__,
						'method' => $currentMethod,
						'file' => __FILE__,
						'line' => $line,
						'asserter' => get_class($asserter) . '::isEmpty()',
						'fail' => null
					)
				)
			)
		;
	}
}

?>