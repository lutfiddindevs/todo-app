<?php  

// icnlude database connection class 
include 'DBConnection.php';

class Task {
	protected $db;
	private $taskID;
	private $item;
	private $status;

	public function setTaskID($taskID) {
		$this->taskID = $taskID;
	}

	public function setItem($item) {
		$this->item = $item;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function __construct() {
		$this->db = new DBConnection();
		$this->db = $this->db->returnConnection();
	}
    // create Task function 
	public function createTask() {
		try {
			$query = 'INSERT INTO todo_lists(task, status) VALUES(:task, :status")';
			$data = [
                'task' => $this->item,
                'status' => $this->status,
			];
			$stmt = $this->db->prepare($query);
			$stmt->execute($data);
			$status = $this->db->lastInsertId();
			return $status;
		} catch (Exception $e) {
		    echo 'Oh, sorry there was an error in the query' . $e->getMessage();	
		}
	}
	// update Task function 
	public function updateTask() {
        try {
        	$query = 'UPDATE todo_lists SET status = :status WHERE id = :taskID';
        	$data = [
                'status' => $this->status,
                'taskID' => $this->taskID, 
        	];
        	$stmt = $this->db->prepare($query);
        	$stmt->execute($data);
        	$status = $stmt->rowCount();
        	return $status;
        } catch (Exception $e) {
        	die('Oh, nooo there was an error in the query!' . $e->getMessage());
        }
	}

	// get all tasks
	public function getAllTask() {
		try {
			$query = 'SELECT id, task, status FROM todo_lists WHERE status != :status';
			$stmt = $this->db->prepare($query);
			$data = [
                'status' => $this->status
			];
			$stmt->execute($data);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		} catch (Exception $e) {
			die('Oh, nooo there was an error in the query' . $e->getMessage());
		}
	}

	// delete task
	public function delete() {
		try {
			$query = 'DELETE FROM todo_lists WHERE id = :task_id';
            $stmt = $this->db->prepare($query);
            $data = [
                'task_id' => $this->taskID 
            ];
            $stmt->execute($data);
            $status = $stmt->rowCount();
            return $status;
		} catch (Exception $e) {
			die('Oh, nooo there was an error in the query!' . $e->getMessage());
		}
	}
} 
