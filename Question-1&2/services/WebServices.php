<?php 

//Get the server connection
require_once('private/Connection.php');

//Create web services
class WebServices {
    private $connect = null;
    private $xmlData;

    public function __construct($xmlData) {
        $myconnect = new Connection();
        $this->connect = $myconnect->getConnect();
        $this->xmlData = $xmlData;
    }

    public function totalStudents() {
        try {
            // Retrieve the total number of users from the database
            $stmt = $this->connect->prepare("SELECT COUNT(*) FROM `candidates`");
            $stmt->execute();
            
            return $stmt->fetchColumn();

        } catch (Exception $ex) {
            //throw exception 
            return "Connection failed: ".$ex->getMessage();
        }
    }

    public function studentsWithCenter() {
        try {
            
            // Get the XML data from request
            $center = (int)$this->xmlData->seviceid;
            
            //Get the pagination details from the request
            $pagecount = (int)$this->xmlData->page;
            $perPage = (int)$this->xmlData->per_page;
            
            // Retrieve the total number of students
            $totalStudents = $this->totalStudents();
            
            // Compute the offset for sql query
            $offset = $perPage * ($pagecount - 1);

            
            // Retrieve the paginated list of users from the database
            $sql = "SELECT student.candidate_names, center.center_name
            FROM `candidates` as student
            INNER JOIN centers as center
            ON student.centre_id = center.center_id
            WHERE center.center_id = :center
            LIMIT :perpage OFFSET :offset";

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":center", $center, PDO::PARAM_INT);
            $stmt->bindParam(":perpage", $perPage, PDO::PARAM_INT);
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Create an XML document containing the paginated list of students
            $xml_response = new SimpleXMLElement("<response></response>");
            $xml_response->addChild("status", "success");
            $xml_students = $xml_response->addChild("students");

            foreach($students as $student) {
                $xml_student = $xml_students->addChild("student");

                $xml_student->addChild("studentname", $student['candidate_names']);
                $xml_student->addChild("center", $student['center_name']);
            }
            $xml_response->addChild("total_students", $totalStudents);

            // Return the XML document to the mobile app
            header("Content-Type: text/xml");
            echo $xml_response->asXML();
        } catch (Exception $ex) {
            //throw exception 
            return "Connection failed: ".$ex->getMessage();
        }
    }

    public function getSubjects($student) {
        try{
            $stmt = $this->connect->prepare("SELECT `subject_name` FROM `subjects` WHERE `category_id` = :categoryId");
            $stmt->bindParam(":categoryId", $student['category_id'], PDO::PARAM_INT);
            $stmt->execute();
            $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $subjectList = '';

            foreach ($subjects as $subject) {
                $subjectList .= " {$subject['subject_name']},";
            }

            return $subjectList;
            
        } catch (Exception $ex) {
            //throw exception 
            return "Connection failed: ".$ex->getMessage();
        }
    }

    public function studentsWithCategory() {
        try {
            
            // Get the XML data from request
            $categoryId = (int)$this->xmlData->seviceid;
            
            //Get the pagination details from the request
            $pagecount = (int)$this->xmlData->page;
            $perPage = (int)$this->xmlData->per_page;
            
            // Retrieve the total number of students
            $totalStudents = $this->totalStudents();
            
            // Compute the offset for sql query
            $offset = $perPage * ($pagecount - 1);

            
            // Retrieve the paginated list of users from the database
            $sql = "SELECT `candidate_names`, `category_id` 
            FROM `candidates`
            WHERE category_id = :categoryId
            LIMIT :perpage OFFSET :offset";

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(":perpage", $perPage, PDO::PARAM_INT);
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

            
            // Create an XML document containing the paginated list of students
            $xml_response = new SimpleXMLElement("<response></response>");
            $xml_response->addChild("status", "success");
            $xml_students = $xml_response->addChild("students");

            foreach($students as $student) {
                $xml_student = $xml_students->addChild("student");

                $xml_student->addChild("studentname", $student['candidate_names']);
                $xml_student->addChild("subjects", $this->getSubjects($student));
            }

            $xml_response->addChild("total_students", $totalStudents);

            // Return the XML document to the mobile app
            header("Content-Type: text/xml");
            echo $xml_response->asXML();
        } catch (Exception $ex) {
            //throw exception 
            return "Connection failed: ".$ex->getMessage();
        }
    }

    public function studentsWithCount() {
        try {
            
            // Get the XML data from request
            $categoryId = (int)$this->xmlData->seviceid;
            $catArr = ['Science', 'Art', 'Commercial'];

            // Retrieve the paginated list of users from the database
            $sql = "SELECT COUNT(*) AS tot_count
            FROM `candidates`
            WHERE category_id = :categoryId";

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_BOTH);

            
            // Create an XML document containing the paginated list of students
            $xml_response = new SimpleXMLElement("<response></response>");
            $xml_response->addChild("status", "success");
            $xml_category = $xml_response->addChild("categories");

            $xml_category->addChild("category", $catArr[$categoryId - 1]);
            $xml_category->addChild("students", $students[0]['tot_count']);
        

            // Return the XML document to the mobile app
            header("Content-Type: text/xml");
            echo $xml_response->asXML();
        } catch (Exception $ex) {
            //throw exception 
            return "Connection failed: ".$ex->getMessage();
        }
    }

}




