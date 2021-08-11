<?php
    require __DIR__.'/grade_info.php';

    if (!isset($_GET["student"]))
    {
        echo "School Board Test";
        return;    
    }

    $student_id = $_GET["student"];

    $grade_info = getGradeInfo($student_id);
    if ($grade_info)
    {
        $result = $grade_info->isPassed()? "Pass" : "Fail";

        if ($grade_info->board_name == "CSMB")
        {
            $xw = xmlwriter_open_memory();
            xmlwriter_set_indent($xw, 1);
            $res = xmlwriter_set_indent_string($xw, ' ');
        
            xmlwriter_start_document($xw, '1.0', 'UTF-8');
        
            xmlwriter_start_element($xw, 'StudentID');
            xmlwriter_text($xw, $grade_info->student_id);
            xmlwriter_end_element($xw);

            xmlwriter_start_element($xw, 'StudentName');
            xmlwriter_text($xw, $grade_info->student_name);
            xmlwriter_end_element($xw);

            xmlwriter_start_element($xw, 'Grades');
            for ($i = 0; $i < count($grade_info->grades); $i++)
            {
                xmlwriter_start_element($xw, 'Grade'.($i + 1));
                xmlwriter_text($xw, $grade_info->grades[$i]);
                xmlwriter_end_element($xw);
            }
            xmlwriter_end_element($xw);

            xmlwriter_start_element($xw, 'AverageGrade');
            xmlwriter_text($xw, $grade_info->average_grade);
            xmlwriter_end_element($xw);

            xmlwriter_start_element($xw, 'Result');
            xmlwriter_text($xw, $result);
            xmlwriter_end_element($xw);
                
            xmlwriter_end_document($xw);
        
            echo xmlwriter_output_memory($xw);
        }  
        else if ($grade_info->board_name == "CSM")
        {
            $ret = array();
            $ret['student_id'] = $grade_info->student_id;
            $ret['student_name'] = $grade_info->student_name;
            $ret['grades'] = $grade_info->grades;
            $ret['average_grade'] = $grade_info->average_grade;
            $ret['result'] = $result;

            echo json_encode($ret);
        }
    }
    else
        echo "Unregistered student!";
?>