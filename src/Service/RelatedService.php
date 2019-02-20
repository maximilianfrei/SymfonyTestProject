<?php

namespace App\Service;


use App\ResponseModel\CalculationResponseObject;

class RelatedService
{

	public function calculateOtherStuff(int $value): CalculationResponseObject
	{
		$responseObject = new CalculationResponseObject();
		$responseObject->setReturnValue($value);

		return $responseObject;
	}
}