<?php
// include_once("../authentication.php");
include_once 'DbConfig.php';

class Crud extends DbConfig
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getData($query)
	{
		$result = $this->connection->query($query);

		if ($result == false) {
			return false;
		}

		return $result;
		// $rows = array();

		// while ($row = $result->fetch_assoc()) {
		// 	$rows[] = $row;
		// }


	}

	public function execute($query)
	{
		$result = $this->connection->query($query);

		if ($result == false) {
			echo 'Error: cannot execute the command';
			return false;
		} else {
			return true;
		}
	}

	public function delete($id, $table)
	{
		$column = str_replace('s', '', $table);
		$query = "DELETE FROM $table WHERE " . $column . "_id = $id";

		$result = $this->connection->query($query);

		if ($result == false) {
			echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
			return false;
		} else {
			return true;
		}
	}

	public function escape_string($value)
	{
		return $this->connection->real_escape_string($value);
	}

	public function debug($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}
