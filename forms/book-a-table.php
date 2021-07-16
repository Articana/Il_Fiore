<?php


  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'brianponce937@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $book_a_table = new PHP_Email_Form;
  $book_a_table->ajax = true;
  
  $book_a_table->to = $receiving_email_address;
  $book_a_table->from_name = $_POST['name'];
  $book_a_table->from_email = $_POST['email'];
  $book_a_table->subject = "New table booking request from the website";

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  
  $book_a_table->smtp = array(
    'host' => 'smtp.gmail.com',
    'username' => 'brianponce937@gmail.com',
    'password' => 'pc?gamerconrx590',
    'port' => '587'
  );

  $book_a_table->add_message( $_POST['name'], 'Nombre');
  $book_a_table->add_message( $_POST['email'], 'E-mail');
  $book_a_table->add_message( $_POST['phone'], 'Telefono', 4);
  $book_a_table->add_message( $_POST['date'], 'Fecha', 4);
  $book_a_table->add_message( $_POST['time'], 'Hora', 4);
  $book_a_table->add_message( $_POST['people'], 'Numero de personas', 1);
  $book_a_table->add_message( $_POST['mesota'], 'Mesa');
  $book_a_table->add_message( $_POST['message'], 'Mensaje');

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "il_fiore";
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $nombre = $_POST['name'];
  $correo = $_POST['email'];
  $tel = $_POST['phone'];
  $fecha = $_POST['date'];
  $tiempo = $_POST['time'];
  $personas = $_POST['people'];
  $mesa = $_POST['mesota'];
  $msg = $_POST['message'];

  echo $book_a_table->send();

  $sql = "INSERT INTO mesa_1 (Nombre, Email, Telefono, Fecha, Hora, Personas, Mensaje, Mesa)
  VALUES ('$nombre', '$correo', '$tel', '$fecha', '$tiempo', '$personas', '$msg', '$mesa')"; 
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
?>
