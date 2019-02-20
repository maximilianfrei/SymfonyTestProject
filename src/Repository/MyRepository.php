<?php

namespace App\Repository;

class MyRepository
{

	private const DUMMY_DATA = [
		0 => "0ataDemos",
		1 => "1ataDemos",
		2 => "2ataDemos",
		3 => "3ataDemos",
		4 => "4ataDemos",
		5 => "5ataDemos",
		6 => "6ataDemos"
	];

	/**
	 * Returns the most important Data for the most important Ids
	 *
	 * @param int $id
	 * @return string|null
	 */
	public function getAllTheData(int $id): ?string
	{
		if (array_key_exists($id, self::DUMMY_DATA)) {

			return self::DUMMY_DATA[$id];
		}
		return null;
	}
}