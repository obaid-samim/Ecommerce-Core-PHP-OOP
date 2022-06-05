<?php
	require_once 'Db.php';

	class Crud extends Db{

		/*$insert_data = array(
			 'username' => 'Obaid',
			 'pass' => $password,
		);*/

		public function insert($table_name, $data){
			if(!empty($data)){
				$fields = $placeholder = [];

				foreach ($data as $field => $values) {
					$fields[] = $field;
					$placeholder[] = ":{$field}";
				}
			}

			$sql = "INSERT INTO {$table_name} (" .implode(',', $fields).") values(". implode(',', $placeholder). ")";
				$stmt = $this->db->prepare($sql);

				try{
					$this->db->beginTransaction();
					$stmt->execute($data);
					$this->db->commit();
					//return $insert_id;

				}catch(PDOException $e){
					echo "Error: ". $e->getMessage();
				}
			}

		public  function slugify($text, $slug_url, $table_name)
			{
				//preg_replace(pattern, replacement, input, limit)	
				$text = preg_replace('/[^a-z0-9]+/i','-',strtolower($text));

				$query = "SELECT $slug_url FROM  $table_name WHERE $slug_url LIKE'$text%'";
				$stmt = $this->db->prepare($query);
				$stmt->execute();
				if ($stmt->rowCount()>0) {
					$result = $stmt->fetchAll();
					foreach ($result as $row) {
						$data[] = $row[$slug_url];
					}

					if (in_array($text, $data)) {
						$count = 0;
						while (in_array(($text.'-'. ++$count),$data)); 
							$text = $text . '-' .$count;
						
					}
				}
				return $text;
			} 

	public function get($table_name, $offset, $records_per_page){
		$sql = "SELECT * FROM $table_name LIMIT $offset, $records_per_page";
		//prepare our query
		$stmt = $this->db->prepare($sql);
		//execution of prepare method
		$stmt->execute();
		//fetch all data from the table
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function pagination($table, $no_of_records_per_page){
		$query = "SELECT count(*) FROM $table";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$total_records = $stmt->fetchColumn();
			$total_pages = ceil($total_records / $no_of_records_per_page);

			return $total_pages;
	}
	public function delete($table_name, $where){
		$sql = "DELETE FROM $table_name  $where";
		$stmt = $this->db->prepare($sql);
		try{
			$stmt->execute();
			return true;
		}catch (PDOException $e){
			echo " Error: " .$e->getMessage();
			$this->db->rollback();
		}

	}
}
?>