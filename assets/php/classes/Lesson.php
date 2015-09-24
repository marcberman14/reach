<?php


require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/LessonDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectLessonDao.php";


//$user = new LessonDao();


 
class lesson
{
  private $lesson_title;
  private $lesson_name;
  private $lesson_decription;
  private $lesson_concept;
  private $lesson_material;
  public $lesson;
  public $sublesson;
  
   public function __construct()
    {
        $this->lesson_title = "Enter Details";
        $this->lesson_name="Enter Details";
        $this->lesson_decription ="Enter Details";
        $this->lesson_concept ="Enter Details";
        $this->lesson_material ="Enter Details";
        
    }  
	
  public function pullLesson($value){
	  
	$lesson = new LessonDao();	
	$lessonDetails = $lesson->getLesson(Array('lessonid'=>$value));
	//$firstname = $userDetails['firstname'];	
	return $lessonDetails;
	  
  }
  
    public function addLesson($value){
	  
	$lesson = new LessonDao();
	$lessonDetails = $lesson->addLesson($value);
	//$sublesson = new SubjectLessonDao();	
	//$sub = $sublesson->add($value);
	//$firstname = $userDetails['firstname'];	
	return $lessonDetails;
	  
  }
  
  
  public function deleteLesson($value){
	  
	$lesson = new LessonDao();
	$sublesson = new SubjectLessonDao();
	$lessonDetails = $lesson->deleteLesson(Array('lessonid'=>$value));
	$sub = $sublesson->delete(Array('lessonid'=>$value));	
	//$firstname = $userDetails['firstname'];	
	//return $lessonDetails;
	  
  }
  
  
  public function editLesson($values){
	  
	$lesson = new LessonDao();
	$lessonDetails = $lesson->editLesson($values);
	//$sublesson = new SubjectLesson();
	//$sublessoninfo = $sublesson->edit($values);
	//$firstname = $userDetails['firstname'];	
	
	  
  }
  
 
  public function setLesson_title($newval)
  {
      $this->lesson_title = $newval;
  }
 
  public function getLesson_title()
  {
      return $this->lesson_title;
  }

  public function setLesson_name($newval)
  {
      $this->lesson_name = $newval;
  }
 
  public function getLesson_name()
  {
      return $this->lesson_name;
  }

  public function setLesson_decription($newval)
  {
      $this->lesson_description = $newval;
  }
 
  public function getLesson_description()
  {
      return $this->lesson_description;
  }

  public function setLesson_concept($newval)
  {
      $this->lesson_concept = $newval;
  }
 
  public function getLesson_concept()
  {
      return $this->lesson_concept;
  }

  public function setLesson_material($newval)
  {
      $this->lesson_material = $newval;
  }
 
  public function getLesson_material()
  {
      return $this->lesson_material;

  }
}

?>