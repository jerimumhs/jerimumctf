<?php

class Submission{
  public $id, $title, $email, $password, $description, $bio, $filename, $admin;
  function __construct($id, $title, $email, $password, $description, $bio, $filename ){
    $this->id = $id;
    $this->title= $title;
    $this->email = $email;
    $this->password = $password;
    $this->description = $description;
    $this->bio = $bio;
    $this->filename = $filename;

  }   

  function from_db($row) {
    return new Submission($row['id'],$row['title'],$row['email'], 
                          $row['password'], $row['description'],
                          $row['bio'],$row['filename']) ; 
  }
  function display() {
      $sql = "SELECT * FROM submissions where email='"; 
      $sql .= mysql_real_escape_string( $_POST["email"]);
      $sql .= "' and password='";
      $sql .= mysql_real_escape_string( $_POST["password"]);
      $sql.= "' limit 1";
      echo $sql;
      $result = mysql_query($sql);
      if ($result) {
      while ($row = mysql_fetch_assoc($result)) {
        $submission = Submission::from_db($row);
      }
      echo $submission->title;
      return $submission->render();
    }
 
  }

  function all($cat=NULL,$order =NULL) {
    $submissions = Array();
    $results = mysql_query("SELECT * FROM submissions");
    if ($results) {
      
      while ($row = mysql_fetch_assoc($results)) {
        $submissions[] = from_db($row);
      }
    }
    else {
      echo mysql_error();
    }
    return $submissions;
  }
 

 function render_edit() {
    $str = "<img src=\"uploads/".h($this->img)."\" alt=\"".h($this->title)."\" />";
    return $str;
  } 
  

  function render() {
    echo "in render";
    echo $this->title;
    echo h($this->title);
    $str = "<h1>".h($this->title)."</h1>";
    $str .= "<a href=\"".h($this->filename)."\">".h($this->filename)."</a>"; 
    $str .= "<h3>Description</h3><p>".h($this->description)."</p>";
    $str .= "<h3>Bio</h3><p>".h($this->bio)."</p>";
    return $str;
  }
	 
  function find($id) {
    if (!preg_match('/^[0-9]+$/', $id)) {
      die("ERROR: INTEGER REQUIRED");
    }
    $result = mysql_query("SELECT * FROM pictures where id=".$id);
    $row = mysql_fetch_assoc($result); 
    if (isset($row)){
      $picture = new Picture($row['id'],$row['title'],$row['img'],$row['cat']);
    }
    return $picture;
  
  }
  function delete($id) {
    if (!preg_match('/^[0-9]+$/', $id)) {
      die("ERROR: INTEGER REQUIRED");
    }
    $result = mysql_query("DELETE FROM pictures where id=".(int)$id);
    //should unlink the file
  }
  function last() {
    $result= mysql_query("SELECT * FROM pictures ORDER BY id DESC LIMIT 1");
    $row = mysql_fetch_assoc($result);
    if (isset($row)){
      return new Picture($row['id'],$row['title'],$row['img'],$row['cat']);
    }
  }
  function show($id) {
    $result= mysql_query("SELECT * FROM pictures where id=".$id);
    $row = mysql_fetch_assoc($result);
    if (isset($row)){
      return new Picture($row['id'],$row['title'],$row['img'],$row['cat']);
    }
  }
  
  function create(){
    if(isset($_FILES['pdf'])){
      $dir = 'uploads/';
      $file = $_FILES['pdf']['name'];
      if ((mime_content_type($_FILES['pdf']['tmp_name']) != "application/pdf")){ 
        DIE("File must be a PDF!!");
      }
      if (!preg_match('/\.pdf$/',$file)) {
        DIE("File must be a PDF!!");
      }
      else  { 
        if(!move_uploaded_file($_FILES['pdf']['tmp_name'], $dir . $file)) {
          die("Error during upload");
        }
      } 
      $sql = "INSERT INTO submissions (email,password,";
      $sql .= "title,description,bio, filename) VALUES ('";

      $title = mysql_real_escape_string($_POST["title"]);
      $file = $dir.mysql_real_escape_string( $file);
      $email = mysql_real_escape_string( $_POST["email"]);
      $password = mysql_real_escape_string( $_POST["password"]);
      $bio = mysql_real_escape_string( $_POST["bio"]);
      $description = mysql_real_escape_string( $_POST["description"]);

    
      $sql .= $email."','".$password."','".$title."','".$description."','";
      $sql .= $bio."','".$file;
      $sql.= "')";
      $result = mysql_query($sql);
      echo mysql_error(); 
    }
    

  }
}
?>
