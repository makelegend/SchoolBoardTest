<?php
require __DIR__.'/db.php';

class GradeInfo
{
    public $student_id;
    public $student_name;
    public $grades;
    public $board_name;
    public $average_grade;

    public function isPassed()
    {
        if ($this->board_name == "CSM")
        {
            return $this->average_grade >= 7;
        }
        else if ($this->board_name == "CSMB")
        {
            $max_grade = max($this->grades);
            return $max_grade > 8;
        }
    }
}

function getBoardName($board_id)
{
    $conn = db_connect();
    if (!$conn)
        return null;

    $query_result = $conn->query("SELECT name FROM boards WHERE id='{$board_id}'");
    if (!$query_result)
        return null;

    $row = $query_result->fetch_row();
    if (!$row)
        return null;

    return $row[0];
}

function getGradeInfo($student_id)
{
    $conn = db_connect();
    if (!$conn)
        return null;

    $query_result = $conn->query("SELECT student_name, board_id, grade1, grade2, grade3, grade4 FROM grades WHERE student_id='{$student_id}'");
    if (!$query_result)
        return null;

    $row = $query_result->fetch_row();
    if (!$row)
        return null;

    $grade_info = new GradeInfo;
    $grade_info->student_id = $student_id;
    $grade_info->student_name = $row[0];
    
    $board_id = $row[1];
    $grade_info->board_name = getBoardName($board_id);

    $grades = array($row[2], $row[3], $row[4], $row[5]);
    $grades = array_filter($grades, function($grade) {
        return $grade >= 0;
    });

    $grade_info->average_grade = array_sum($grades) / count($grades);
    $grade_info->grades = $grades;

    return $grade_info;
}
?>