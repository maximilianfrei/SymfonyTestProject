<?php

namespace App\ResponseModel;


class CalculationResponseObject
{
	/** @var int */
	private $returnValue;

	/**
	 * @return int
	 */
	public function getReturnValue(): int
	{
		return $this->returnValue;
	}

	/**
	 * @param int $returnValue
	 */
	public function setReturnValue(int $returnValue): void
	{
		$this->returnValue = $returnValue;
	}


}