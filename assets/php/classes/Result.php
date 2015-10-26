<?php

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/ResultDao.php";
$question = new ResultDao();

class Result extends Question{

    private $result_id;
    private $grade;
    private $user_id;
    private $test_id;
    private $question_id;



    public function __construct($result_id, $grade, $user_id, $test_id, $question_id){
        $this-> result_id = $result_id;
        $this-> grade = $grade;
        $this-> user_id = $user_id;
        $this-> test_id = $test_id;
        $this-> question_id = $question_id;

    }

    public function getResultId(){
        return $this-> result_id;
    }

    public function insertResult(){
        $resultIn = new ResultDao();
        $values = array('grade' => $this->grade, 'user_id' => $this->user_id, 'test_id' => $this->test_id, 'question_id' => $this->question_id);
        $resultIn->createResult($values);
    }

    public function viewResult(){
        $resultShow = new ResultDao();
        $values = array('grade' => $this->grade, 'user_id' => $this->user_id, 'test_id' => $this->test_id, 'question_id' => $this->question_id);
        $resultShow->viewResult($values);
    }

    public function setGrade($gradeToAdd){
        $this-> grade = $gradeToAdd;
    }



}
