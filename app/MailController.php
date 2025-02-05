<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class MailController
{

  protected $mail;

  private $url = 'https://localhost';

  public function __construct()
  {
    $this->mail = new PHPMailer(true);
    $this->mail->isSMTP();
    $this->mail->Host = 'sandbox.smtp.mailtrap.io';
    $this->mail->SMTPAuth = true;
    $this->mail->Port = 2525;
    $this->mail->Username = '81e733deb2151e';
    $this->mail->Password = '67818cb081bb14';

  }

  public function sendOrderMail($email, $name, $surname, $orderData)
  {
    $url = $this->url;
    $order = $orderData;
    ob_start();
    include APP_PATH . 'mail/order.php';
    $body = ob_get_clean();
    try {
      $this->mail->setFrom('no-reply@laflamewear.com', 'La Flame Wear');
      $this->mail->addAddress($email, $name . ' ' . $surname);
      $this->mail->isHTML(true);
      $this->mail->Subject = 'Order Confirmation';
      $this->mail->CharSet = 'UTF-8';
      $this->mail->Body = $body; // Use the content from the included file
      $this->mail->send();

      return true; // Indicate success

    } catch (Exception $e) {
      // Log the error instead of echoing it
      error_log("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
      return false; // Indicate failure
    }
  }

}