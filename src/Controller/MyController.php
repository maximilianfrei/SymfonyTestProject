<?php

namespace App\Controller;

use App\Service\MyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyController extends AbstractController
{

	/**
	 * @var MyService
	 */
	private $service;

	public function __construct(MyService $service)
	{
		$this->service = $service;
	}

	/**
	 * @param int $value
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 *
	 * @Route("/my/controller/{value}", methods="GET")
	 */
	public function getMessage(int $value)
	{
		$message = $this->service->calculateTheMessage($value);

		return $this->json([
			'message' => $message
		]);
	}
}
