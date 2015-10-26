<?php
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TestDao.php";
$test = new TestDao();


class Test{
    
    private $test_id;
    private $test_name;
    private $questions = array();
    private $subject;
    
    public function __construct($test_name, $subject){
        $this->test_name = $test_name;
        $this->subject = $subject;
    }
    
    public function getTestID(){
        return $this->test_id;
    }
    
    public function insertTest(){
        $tester = new TestDao();
        $values = Array('testname'=>$this->test_name, 'subj_id'=>$this->subject);
        $tester->createTest($values); 
    }
    
    public function addQuestion($questionToAdd){
        $index = count($this->questions);
        if($index < 25){
            $questions[index] = $questionToAdd;
        }
        else {
            //error stuff
        }
    }
    
    public function getQuestion($index){
        return $this->questions[$index];
    }
    
     public static function pullTestsBySubject($subject_id){
        $tester = new TestDao();
        $testlist = array();
        for ($i=0; $i<count($subject_id); $i++){
            $values = Array('subj_id' => $subject_id[$i]);
            $addlist = $tester->TestsbySubject($values);
            array_push($testlist, $addlist);
        }
        return $testlist;
    }
    
}

?>