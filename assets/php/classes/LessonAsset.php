<?php


require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/LessonDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/assets/php/database/dao/SubjectLessonDao.php";

class LessonAsset
{
  private $lesson_id;
  private $file_id;
  private $type;
  private $url;
  private $file_name;
  
  
   public function __construct($lesson_id, $file_id, $type, $url, $file_name)
    {
        $this->lesson_id = $lesson_id;
        $this->file_id = $file_id;
        $this->type = $type;
        $this->url = $url;
        $this->file_name = $file_name;
        
    }
  
    public function addAsset($value){
	  
	$asset = new LessonAssetDao();
	$assetDetails = $asset->addAsset($value);
	return $assetDetails;
	  
  }
  
  
  public function deleteAsset($value){
	  
	$asset = new LessonAssetDao();
	//$sublesson = new SubjectLessonDao();
	$assetDetails = $asset->deleteAsset(Array('fileid'=>$value));
	//$sub = $sublesson->delete(Array('lessonid'=>$value));	
	//$firstname = $userDetails['firstname'];	
	//return $lessonDetails;
	  
  }
  
  
  public static function editAsset($values){
	  
	$asset = new LessonAssetDao();
	$assetDetails = $asset->editAsset($values);
	//$sublesson = new SubjectLesson();
	//$sublessoninfo = $sublesson->edit($values);
	//$firstname = $userDetails['firstname'];	
	
	  
  }
    
  public function pullUrl($values){
    $asset = new LessonAssetDao();
	$assetUrl = $asset->getAssetURL($values);
      return $assetUrl;
  }
  
  
  public function setLesson_id($newval)
  {
      $this->lesson_id = $newval;
  }
 
  public function getLesson_id()
  {
      return $this->lesson_id;
  }
  
  
  public function setFile_id($newval)
  {
      $this->file_id = $newval;
  }
 
  public function getFile_id()
  {
      return $this->file_id;
  }
    
  public function setFile_name($newval)
  {
      $this->file_name = $newval;
  }
 
  public function getFile_name()
  {
      return $this->file_name;
  }
  
 
  public function setType($newval)
  {
      $this->type = $newval;
  }
 
  public function getType()
  {
      return $this->type;
  }

  public function setUrl($newval)
  {
      $this->url = $newval;
  }
 
  public function getUrl()
  {
      return $this->url;
  }

}

?>