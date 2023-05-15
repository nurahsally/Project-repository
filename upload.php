<?php
$hostname = "localhost";
$database = "digital_library";
$username = "digital_library";
$password = "DJvmypDMXFyZ5GA";
$Con 	  = mysqli_connect($hostname, $username, $password,$database) or trigger_error(mysql_error(),E_USER_ERROR);

$DBhost = "localhost";
$DBuser = "digital_library";
$DBpass = "DJvmypDMXFyZ5GA";
$DBname = "digital_library";

try{
	
	$DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
	$DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Clean file names
function clean($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
} 

if (mysqli_num_rows(mysqli_query($Con, "SELECT * FROM information_schema.tables WHERE table_schema = 'digital_library' AND table_name = 'repository' LIMIT 1")) < 1) {
  // create table
  mysqli_query($Con, "CREATE TABLE `repository` (`id` int NOT NULL, `title` varchar(50) NOT NULL, `creator` varchar(50) NOT NULL, `date_created` varchar(20) NOT NULL, `subject` varchar(100) NOT NULL, `format` varchar(20) NOT NULL, `language` varchar(20) NOT NULL,
  `rights` varchar(50) NOT NULL, `description` text NOT NULL, `file` varchar(100) NOT NULL)");
  mysqli_query($Con, "ALTER TABLE `repository` ADD PRIMARY KEY (`id`)");
  mysqli_query($Con, "ALTER TABLE `repository` MODIFY `id` int NOT NULL AUTO_INCREMENT");
}

if(isset($_POST["submit_data"])) {

    $title    		= $_POST['title'];
    $creator    	= $_POST['creator'];
    $date    		= $_POST['date'];
    $subject    	= $_POST['subject'];
    $format    		= $_POST['format'];
    $language    	= $_POST['language'];
    $rights    		= $_POST['rights'];
    $description    = $_POST['description'];
    $files    		= $_FILES['files'];

            $file_name      = $_FILES['files']['name'];
            $file_size      = round($_FILES['files']['size']/1024, 2);
            $file_tmp       = $_FILES['files']['tmp_name'];
            $file_type      = $_FILES['files']['type'];

            $allowed        =  array('png', 'jpg', 'jpeg', 'zip', 'pdf', 'doc', 'docx', 'dot', 'odt', 'docm', 'dotx', 'dotm', 'docb', 'xls', 'xlt', 'xlm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xla', 'xlam', 'xll', 'xlw', 'ppt', 'pot', 'pps', 'pptx', 'pptm', 'potx', 'potm', 'ppam', 'ppsx', 'sldx', 'sldm', 'ACCDB', 'ACCDE', 'ACCDT', 'ACCRD','pub', 'zip', 'rar', 'mpp');
            $target_dir     = "files/";
            $target_file    = $target_dir . basename($file_name);
            $file_type      = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $actual_name    = strtolower(pathinfo($target_file,PATHINFO_FILENAME));
            if(!in_array($file_type, $allowed) ) {
                $_SESSION['err'] = "File ".$file_name." is not allowed.";
                header("location:repo.php");
            }elseif($file_size > 50000000) {
                $_SESSION['err'] = "Your file ".$file_name." is too big.";
                header("location:repo.php");
            }else{

                $i = 1;
                $tmp_name   = clean(strtolower(pathinfo($actual_name,PATHINFO_FILENAME)));
                $file_name  = $tmp_name.".".$file_type;
                while(file_exists($target_dir.$file_name)){       
                    $temp_name   = $tmp_name.$i;
                    $file_name   = $temp_name.".".$file_type;
                    $i++;
                }
                // UPLOAD FILES
                // Begin Transaction
                $DBcon->beginTransaction();
                $website        = $actual_link;
                $time           = date('Y-m-d H:i:s');
                
                $query  = "INSERT INTO `repository` (`id`, `title`, `creator`, `date_created`, `subject`, `format`, `language`, `rights`, `description`, `file`) VALUES (NULL, '$title', '$creator', '$date', '$subject', '$format', '$language', '$rights', '$description', '$file_name')";
                $stmt   = $DBcon->prepare($query);

               
