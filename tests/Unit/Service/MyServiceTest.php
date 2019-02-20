<?php

namespace App\Tests\Unit\Service;

use App\Repository\MyRepository;
use App\ResponseModel\CalculationResponseObject;
use App\Service\MyService;
use App\Service\RelatedService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class MyServiceTest extends MockeryTestCase
{

	/**
	 * @var MyService
	 */
	private $myService;

	/**
	 * @var MyRepository
	 */
	private $repository;

	/**
	 * @var RelatedService
	 */
	private $relatedService;


	public function setup(): void
	{
		$this->relatedService = Mockery::mock(RelatedService::class);
		$this->repository = Mockery::mock(MyRepository::class);

		$this->myService = new MyService(
			$this->relatedService,
			$this->repository
		);
	}

	public function testCalculateTheMessageEven(): void
	{
		$value = 4;

		$object = Mockery::mock(CalculationResponseObject::class);
		$object->expects()->getReturnValue()->andReturns(1234);

		$this->relatedService->expects()
			->calculateOtherStuff($value)->andReturns($object);

		$this->repository->expects()->getAllTheData(1234)->andReturns("abcde");

		$result = $this->myService->calculateTheMessage($value);

		$this->assertEquals("edcba", $result);
	}

	public function testCalculateTheMessageOdd(): void
	{
		$value = 3;

		$object = Mockery::mock(CalculationResponseObject::class);
		$object->expects()->getReturnValue()->andReturns(123);

		$this->relatedService->expects()
			->calculateOtherStuff($value)->andReturns($object);

		$result = $this->myService->calculateTheMessage($value);

		$this->assertEquals('this makes no sense', $result);
	}

	public function testCalculateTheMessageException(): void
	{
		$value = 3;

		$object = Mockery::mock(CalculationResponseObject::class);
		$object->expects()->getReturnValue()->andReturns(124);

		$this->relatedService->expects()
			->calculateOtherStuff($value)->andReturns($object);

		$this->repository->expects()->getAllTheData(124);

		$this->expectException(Mockery\Exception::class);
		$this->myService->calculateTheMessage($value);
	}


















}