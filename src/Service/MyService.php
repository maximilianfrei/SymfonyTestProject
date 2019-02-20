<?php

namespace App\Service;


use App\Repository\MyRepository;
use App\ResponseModel\CalculationResponseObject;
use Mockery\Exception;

class MyService
{

	/**
	 * @var MyRepository
	 */
	private $repository;

	/**
	 * @var RelatedService
	 */
	private $relatedService;

	/**
	 * constructor.
	 *
	 * @param RelatedService $relatedService
	 * @param MyRepository $repository
	 */
	public function __construct(RelatedService $relatedService, MyRepository $repository)
	{
		$this->relatedService = $relatedService;
		$this->repository = $repository;
	}

	/**
	 * This is where the magic happens
	 *
	 * @param int $value
	 * @return string
	 */
	public function calculateTheMessage(int $value): string
	{
		/** @var CalculationResponseObject $calculationResponseObject */
		$calculationResponseObject = $this->relatedService->calculateOtherStuff($value);

		$returnValue = $calculationResponseObject->getReturnValue();

		if ($returnValue % 2 === 0) {
			$message = $this->repository->getAllTheData($returnValue);
		} else {
			$message = "esnes on sekam siht";
		}

		if(!$message){
			throw new Exception();
		}

		return $this->decrypt($message);
	}

	/**
	 * Returns the string in reversed order
	 *
	 * @param string $encryptedFile
	 * @return string
	 */
	private function decrypt(string $encryptedFile): string
	{
		return strrev($encryptedFile);
	}
}