<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/SubjectDao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/database/dao/TutorSubjectDao.php";

class Subject
{
    private $subject_code;
    private $subject_name;
    private $subject_grade;
    private $subject_description;
    private $subject_category;

    public function __construct($subject_code, $subject_name, $subject_grade, $subject_description, $subject_category)
    {
        $this->subject_code = $subject_code;
        $this->subject_name = $subject_name;
        $this->subject_grade = $subject_grade;
        $this->subject_description = $subject_description;
        $this->subject_category = $subject_category;

    }


    public static function pullSubject($value)
    {
        $subject = new SubjectDao();
        $subjectDetails = $subject->getSubject($value);
        return $subjectDetails;

    }

    public function addSubject($value)
    {

        $subject = new SubjectDao();
        $subjectDetails = $subject->addSubject($value);
        //$sublesson = new SubjectLessonDao();
        //$sub = $sublesson->add($value);
        //$firstname = $userDetails['firstname'];
        return $subjectDetails;

    }


    public function deleteSubject($value)
    {

        $subject = new SubjectDao();
        $tutsub = new TutorSubjectDao();
        $subjectDetails = $subject->deleteSubject(Array('subjectid' => $value));
        $tut = $tutsub->delete(Array('subjectid' => $value));
        //$firstname = $userDetails['firstname'];
        //return $lessonDetails;

    }


    public static function editSubject($values)
    {

        $subject = new SubjectDao();
        $subjectDetails = $subject->editSubject($values);
        //$sublesson = new SubjectLesson();
        //$sublessoninfo = $sublesson->edit($values);
        //$firstname = $userDetails['firstname'];


    }

    public static function enrolGenerate()
    {
        $subject = new SubjectDao();
        $subs = $subject->enrolmentGetAllSubs(Array("studid"=>$_SESSION['user']->getStudentID()));
        if($subs > 0) {
            foreach ($subs as $subject) {
                echo '<section class="toggle">
                        <label>'.$subject['subject_code'].' - '.$subject['subject_name'].'</label>
                        <div class="toggle-content">
                            <h3>Description:</h3>
                            <p>'.$subject['subject_description'].'</p>
                            <a class="btn btn-primary" href="/assets/includes/process_enrolment.php?id='.urlencode($subject["subject_id"]).'&studentid='.urlencode($_SESSION['user']->getStudentID()).'">Enrol in this subject</a>
                        </div>
                     </section>';
            }
        } else {
            echo '<p>No subjects are available for you to enrol in, please try again later</p>';
        }
    }

    public static function myEnrolGenerate()
    {
        $subject = new SubjectDao();
        $subs = $subject->myEnrolments(Array("studid"=>$_SESSION['user']->getStudentID()));
        if($subs > 0) {
            foreach ($subs as $subject) {
                echo '<section class="toggle">
                        <label>'.$subject['subject_code'].' - '.$subject['subject_name'].'</label>
                        <div class="toggle-content">
                            <h3>Description:</h3>
                            <p>'.$subject['subject_description'].'</p>
                            <a class="btn btn-primary" href="/assets/includes/process_enrolment.php?id='.urlencode($subject["subject_id"]).'&studentid='.urlencode($_SESSION['user']->getStudentID()).'">Enrol in this subject</a>
                        </div>
                     </section>';
            }
        } else {
            echo '<p>No subjects are available for you to enrol in, please try again later</p>';
        }
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