<?php

namespace atoum\report\fields\runner\tests;

use
	atoum,
	atoum\report,
	atoum\runner
;

abstract class coverage extends report\field
{
	protected $coverage = null;

	public function __construct()
	{
		parent::__construct(array(runner::runStop));
	}

	public function getCoverage()
	{
		return $this->coverage;
	}

	public function handleEvent($event, atoum\observable $observable)
	{
		if (parent::handleEvent($event, $observable) === false)
		{
			return false;
		}
		else
		{
			$this->coverage = $observable->getScore()->getCoverage();

			return true;
		}
	}
}
