<?php

namespace App\Tests\Unit\Service;


use App\Repository\MyRepository;
use App\ResponseModel\CalculationResponseObject;
use App\Service\MyService;
use App\Service\RelatedService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class MyServicePreparationTest extends MockeryTestCase
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

	protected function setUp(): void
	{
		$this->repository = Mockery::mock(MyRepository::class);
		$this->relatedService = Mockery::mock(RelatedService::class);

		$this->myService = new MyService(
			$this->relatedService,
			$this->repository
		);
	}

	/**
	 * checks if an even number is used as expected
	 */
	public function testCalculateTheMessageEven(): void
	{
		$returnValue = 2;

		$responseObjectMock = Mockery::mock(CalculationResponseObject::class);
		$responseObjectMock->expects()->getReturnValue()->andReturns($returnValue);

		$this->relatedService->expects()->calculateOtherStuff(
			Mockery::on(
				function (DateTime $param) {
					return $param < new DateTime();
				}
			)
		)->andReturns($responseObjectMock);

		$this->repository->expects()->getAllTheData($returnValue)->andReturns("2ataDemos");


		$resultMessage = $this->myService->calculateTheMessage($returnValue);

		$this->assertEquals("someData2", $resultMessage);

		/*
		$this->assertNotEquals();
		$this->assertTrue();
		$this->assertNull();
		$this->assertEmpty();
		$this->assertNotEmpty();
		$this->assertInstanceOf();
		$this->assertContains();
		$this->assertGreaterThan();
		$this->assertGreaterThanOrEquals();
		$this->assertJsonStringEqualsJsonString();
		$this->assertCount();
		$this->assertContains();
		$this->assertArrayHasKey();
*/
		//Mockery::any()
	}

	/**
	 * checks if an odd number is used as expected
	 */
	public function testCalculateTheMessageOdd(): void
	{
		$returnValue = 3;

		$responseObjectMock = Mockery::mock(CalculationResponseObject::class);
		$responseObjectMock->expects()->getReturnValue()->andReturns($returnValue);

		$this->relatedService->expects()->calculateOtherStuff($returnValue)->andReturns($responseObjectMock);

		$resultMessage = $this->myService->calculateTheMessage($returnValue);

		$this->assertEquals("this makes no sense", $resultMessage);
	}

	/**
	 * tests if the Error message is handled
	 */
	public function testCalculateTheMessageError(): void
	{
		$returnValue = 2;

		$responseObjectMock = Mockery::mock(CalculationResponseObject::class);
		$responseObjectMock->expects()->getReturnValue()->andReturns($returnValue);

		$this->relatedService->expects()->calculateOtherStuff($returnValue)->andReturns($responseObjectMock);

		$this->repository->expects()->getAllTheData($returnValue);

		$this->expectException(Mockery\Exception::class);
		$this->myService->calculateTheMessage($returnValue);
	}

}