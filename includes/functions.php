<!-- // All the basic functions are stored here -->
<?php


function confirm_query($result_set) {
  global $con;
  if(!$result_set) {
    die("Database query failed" . mysqli_error($con));
  }
}

function get_all_subjects($public = true) {
  global $con;
  $query = "SELECT *
          from subjects ";
          if($public) {
            $query .= "WHERE visible = 1 ";
          }
          $query.= "ORDER BY position ASC";
  $subject_set = mysqli_query($con, $query);
  confirm_query($subject_set);
  return $subject_set;
}

function get_all_pages() {
  global $con;
  $query = "SELECT *
          from pages
          ORDER BY position ASC";
  $page_set = mysqli_query($con, $query);
  confirm_query($page_set);
  return $page_set;
}

function get_pages_for_subject($subject_id, $public = true) {
  global $con;
  $query = "SELECT *
           FROM pages
           WHERE subject_id = {$subject_id} ";
  if($public) {
    $query .= " AND visible = 1 ";
  }
  $query .= "ORDER BY position ASC";

  $page_set = mysqli_query($con , $query );
  confirm_query($page_set);

  return $page_set;
}

function get_subject_by_id($subject_id) {
  global $con;
  $query = "SELECT * ";
  $query .= "FROM subjects ";
  $query .= "WHERE id=" . $subject_id .  " ";
  $query .= "LIMIT 1";
  $result_set = mysqli_query($con, $query);
  confirm_query($result_set);
  // if no rows are returned, fetch array will return false
  if($subject = mysqli_fetch_array($result_set)) {
    return $subject;
  }
  else {
    return NULL;
  }
}

function get_page_by_id($page_id) {
  global $con;
  $query = "SELECT * ";
  $query .= "FROM pages ";
  $query .= "WHERE id=" . $page_id .  " ";
  $query .= "LIMIT 1";
  $result_set = mysqli_query($con, $query);
  confirm_query($result_set);
  // if no rows are returned, fetch array will return false
  if($subject = mysqli_fetch_array($result_set)) {
    return $subject;
  }
  else {
    return NULL;
  }
}

function get_default_page($subject_id) {
 $page_set = get_pages_for_subject($subject_id, true);
 if($first_page = mysqli_fetch_array($page_set)){
   return $first_page;
 } else {
   return NULL;
 }
}

function find_selected_page() {
  global $sel_subject;
  global $sel_page;
     if(isset($_GET['subj'])) {
     $sel_subject = get_subject_by_id($_GET['subj']);
     $sel_page = get_default_page($sel_subject['id']);
  } elseif(isset($_GET['page'])) {
    $sel_subject = NULL;
    $sel_page = get_page_by_id($_GET['page']);
  } else {
    $sel_subject = NULL;
    $sel_page = NULL;
  }
}

function navigation($sel_subject, $sel_page, $public = false) {
  $output =  "<ul>";
  $subject_set = get_all_subjects($public);

  while($subject = mysqli_fetch_array($subject_set)) {
    $output .=  "<li " .  (($sel_subject['id'] == $subject['id']) ?  "class=\"selected\"" : "")  . "><a href=\"edit_subject.php?subj=" . urlencode($subject['id']) . "\">{$subject["menu_name"]}</a></li> <br />";

 $page_set = get_pages_for_subject($subject["id"], false);

      $output .=  "<ul>";
      while($page = mysqli_fetch_array($page_set)) {
        $output .=  "<li " .  (($sel_page['id'] == $page['id']) ?  "class=\"selected\"" : "")  . "><a href=\"content.php?page=" . urlencode($page['id']) . "\">{$page["menu_name"]}</a></li> <br />";
        }
      $output .=  "</ul>";
  }

  $output .=  "</ul>";
  return $output;
}

function publicNavigation($sel_subject, $sel_page, $public = true) {
  $output =  "<ul>";
  $subject_set = get_all_subjects($public);

  while($subject = mysqli_fetch_array($subject_set)) {
    $output .=  "<li " .  (($sel_subject['id'] == $subject['id']) ?  "class=\"selected\"" : "")  . "><a href=\"index.php?subj=" . urlencode($subject['id']) . "\">{$subject["menu_name"]}</a></li> <br />";
if($subject['id'] == $sel_subject['id']) {
 $page_set = get_pages_for_subject($subject["id"]);

      $output .=  "<ul>";
      while($page = mysqli_fetch_array($page_set)) {
        $output .=  "<li " .  (($sel_page['id'] == $page['id']) ?  "class=\"selected\"" : "")  . "><a href=\"index.php?page=" . urlencode($page['id']) . "\">{$page["menu_name"]}</a></li> <br />";
        }
      $output .=  "</ul>";
    }
  }

  $output .=  "</ul>";
  return $output;
}


function mysql_prep($con, $value){
 return  mysqli_real_escape_string($con, $value);
}

function redirect_to($location = NULL){
  if($location != NULL) {
  header("Location: {$location}");
  exit();
  }
}





function check_required_fields($required_fields, $POST){
  $errors = array();
  foreach($required_fields as $fieldname) {
      if(!isset($POST[$fieldname]) || empty($POST[$fieldname])){
        $errors[] = $fieldname;
      }
  }
  return $errors;
}

function check_max_field_lengths($fields_with_lengths, $POST) {
  $errors = array();
  global $con;
foreach($fields_with_lengths as $fieldname => $maxlength) {
if(strlen(trim(mysql_prep($con, $POST[$fieldname]))) > $maxlength) {
  $errors[] = $fieldname;
}
}
return $errors;
}

function display_errors($errors) {
  foreach($errors as $error) {
    echo $error . "<br />";
  }

}
?>
