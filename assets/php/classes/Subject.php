<?php


require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/TutorSubjectDao.php";
 
class subject
{
  private $subject_code;
  private $subject_name;
  private $subject_grade;
  private $subject_description;
  private $subject_category;
  
   public function __construct()
    {
        $this->subject_code = "Enter Details";
        $this->subject_name="Enter Details";
        $this->subject_grade ="Enter Details";
        $this->subject_description ="Enter Details";
        $this->subject_category ="Enter Details";
        
    }  
	
	
	public function pullSubject($value){
	  
	$subject = new SubjectDao();	
	$subjectDetails = $subject->getSubject(Array('subjectid'=>$value));
		
	return $subjectDetails;
	  
  }
  
    public function addSubject($value){
	  
	$subject = new SubjectDao();
	$subjectDetails = $subject->addSubject($value);
	//$sublesson = new SubjectLessonDao();	
	//$sub = $sublesson->add($value);
	//$firstname = $userDetails['firstname'];	
	return $subjectDetails;
	  
  }
  
  
  public function deleteSubject($value){
	  
	$subject = new SubjectDao();
	$tutsub = new TutorSubjectDao();
	$subjectDetails = $subject->deleteSubject(Array('subjectid'=>$value));
	$tut = $tutsub->delete(Array('subjectid'=>$value));	
	//$firstname = $userDetails['firstname'];	
	//return $lessonDetails;
	  
  }
  
  
  public function editSubject($values){
	  
	$subject = new SubjectDao();
	$subjectDetails = $subject->editSubject($values);
	//$sublesson = new SubjectLesson();
	//$sublessoninfo = $sublesson->edit($values);
	//$firstname = $userDetails['firstname'];	
	
	  
  }
	
 
  public function setSubject_code($newval)
  {
      $this->subject_code = $newval;
  }
 
  public function getSubject_code()
  {
      return $this->subject_code;
  }

  public function setSubject_name($newval)
  {
      $this->subject_name = $newval;
  }
 
  public function getSubject_name()
  {
      return $this->subject_name;
  }

  public function setSubject_grade($newval)
  {
      $this->subject_grade = $newval;
  }
 
  public function getSubject_grade()
  {
      return $this->subject_grade;
  }

  public function setSubject_description($newval)
  {
      $this->subject_description = $newval;
  }
 
  public function getSubject_description()
  {
      return $this->subject_description;
  }

  public function setSubject_category($newval)
  {
      $this->subject_category = $newval;
  }
 
  public function getSubject_category()
  {
      return $this->subject_category;

  }
}

?>