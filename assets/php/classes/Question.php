<?php

require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/QuestionDao.php";
$test = new QuestionDao();

class Question extends Test{
    
    private $question_id;
    private $question_text;
    private $correct_answer;
    private $wrong_answer1;
    private $wrong_answer2;
    private $wrong_answer3;
    private $test_id;
    
    public function __construct($question_text, $correct_answer, $wrong_answer1, $wrong_answer2, $wrong_answer3, $test_id){
        $this-> question_text = $question_text;
        $this-> correct_answer = $correct_answer;
        $this-> wrong_answer1 = $wrong_answer1;
        $this-> wrong_answer2 = $wrong_answer2;
        $this-> wrong_answer3 = $wrong_answer3;
        $this-> test_id = $test_id;
    }
    
    public function getQuestionId(){
        return $this-> question_id;
    }
    
    public function insertQuestion(){
        $quester = new QuestionDao();
        $values = array('qtext' => $this->question_text, 'canswer' => $this->correct_answer, 'wanswer1' => $this->wrong_answer1, 'wanswer2' => $this->wrong_answer2, 'wanswer3' => $this->wrong_answer3, 'testid' => $this->test_id);
        $quester->createQuestion($values);
    }
    
    public function setMainQuestion($mainToAdd){
        $this-> question_text = $mainToAdd;
    }
    
    
    public function setCorrectAnswer($corrToAdd){
        $this-> correct_answer = $corrToAdd;
    }
    
    
    public function setWrongAnswer1($wrong1ToAdd){
        $this-> wrong_answer1 = $wrong1ToAdd;
    }
    
    
    public function setWrongAnswer2($wrong2ToAdd){
        $this-> wrong_answer2 = $wrong2ToAdd;
    }
    
    
    public function setWrongAnswer3($wrong3ToAdd){
        $this-> wrong_answer3 = $wrong3ToAdd;
    }
    
}

?>