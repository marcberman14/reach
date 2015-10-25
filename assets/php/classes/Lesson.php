<?php


require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/LessonDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectLessonDao.php";

class lesson
{
  private $lesson_title;
  private $lesson_name;
  private $lesson_description;
  private $lesson_concept;
  private $lesson_material;
  private $lesson_file;
  private $lesson_video;
  
   public function __construct($lesson_title, $lesson_name, $lesson_description, $lesson_concept, $lesson_material, $lesson_file, $lesson_video)
    {
        $this->lesson_title = $lesson_title;
        $this->lesson_name= $lesson_name;
        $this->lesson_description = $lesson_description;
        $this->lesson_concept = $lesson_concept;
        $this->lesson_material = $lesson_material;
		$this->lesson_file = $lesson_file;
        $this->lesson_video = $lesson_video;
        
    }
  
    public function addLesson($value){
	  
	$lesson = new LessonDao();
	$lessonDetails = $lesson->addLesson($value);
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
  
  
  public static function editLesson($values){
	  
	$lesson = new LessonDao();
	$lessonDetails = $lesson->editLesson($values);
	//$sublesson = new SubjectLesson();
	//$sublessoninfo = $sublesson->edit($values);
	//$firstname = $userDetails['firstname'];	
	
	  
  }
  
  
  public function setLesson_file($newval)
  {
      $this->lesson_file = $newval;
  }
 
  public function getLesson_file()
  {
      return $this->lesson_file;
  }
  
  
  public function setLesson_video($newval)
  {
      $this->lesson_video = $newval;
  }
 
  public function getLesson_video()
  {
      return $this->lesson_video;
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