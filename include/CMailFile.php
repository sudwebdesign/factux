<?php
/* notes from Dan Potter:
Sure. I changed a few other things in here too though. One is that I let
you specify what the destination filename is (i.e., what is shows up as in
the attachment). This is useful since in a web submission you often can't
tell what the filename was supposed to be from the submission itself. I
also added my own version of chunk_split because our production version of
PHP doesn't have it. You can change that back or whatever though =).
Finally, I added an extra "\r\n" before the message text gets added into the
MIME output because otherwise the message text wasn't showing up.
/*
note: someone mentioned a command-line utility called 'mutt' that
can mail attachments.
*/
/*
If chunk_split works on your system, change the call to my_chunk_split
to chunk_split
*/
/* Note: if you don't have base64_encode on your system it will not work */

// simple class that encapsulates mail() with addition of mime file attachment.
class CMailFile {
 public $subject;

 public $addr_to;

 public $text_body;

 public $text_encoded;

 public $mime_headers;

 public $mime_boundary = "--==================_846811060==_";

 public $smtp_headers;

 public function CMailFile($subject,$to,$from,string $msg,$filename,string $mimetype = "application/octet-stream", $mime_filename = false) {
  $this->subject = $subject;
  $this->addr_to = $to;
  $this->smtp_headers = $this->write_smtpheaders($from);
  $this->text_body = $this->write_body($msg);
  $this->text_encoded = $this->attach_file($filename,$mimetype,$mime_filename);
  $this->mime_headers = $this->write_mimeheaders($filename, $mime_filename);
 }

 public function attach_file($filename,string $mimetype,$mime_filename): string {
  $encoded = $this->encode_file($filename);
  if ($mime_filename) {
      $filename = $mime_filename;
  }

  $out = "--" . $this->mime_boundary . "\r\n";
  $out .= "Content-type: {$mimetype}; name=\"{$filename}\";\r\n";
  $out .= "Content-Transfer-Encoding: base64\r\n";
  $out .= "Content-disposition: attachment; filename=\"{$filename}\"\r\n\r\n";
  $out .= $encoded . "\r\n";
  return $out . "--" . $this->mime_boundary . "--\r\n";
  // added -- to notify email client attachment is done
 }

 public function encode_file($sourcefile): string {
  if (is_readable($sourcefile)) {
   $fd = fopen($sourcefile, "r");
   $contents = fread($fd, filesize($sourcefile));
   $encoded = my_chunk_split(base64_encode($contents));
   fclose($fd);
  }

  return $encoded;
 }

 public function sendfile(): bool {
  $headers = $this->smtp_headers . $this->mime_headers;
  $message = $this->text_body . $this->text_encoded;
  if (mail($this->addr_to,$this->subject,$message,$headers)) {
      return true;
  } else {
      return false;
  }
 }

 public function write_body(string $msgtext): string {
  $out = "--" . $this->mime_boundary . "\r\n";
  $out .= "Content-Type: text/plain; charset=\"us-ascii\"\r\n\r\n";
  return $out . $msgtext . "\r\n";
 }

 public function write_mimeheaders($filename, $mime_filename): string {
  if ($mime_filename) {
      $filename = $mime_filename;
  }

  $out = "MIME-version: 1.0\r\n";
  $out .= "Content-type: multipart/mixed; ";
  $out .= "boundary=\"$this->mime_boundary\"\r\n";
  $out .= "Content-transfer-encoding: 7BIT\r\n";
  return $out . "X-attachments: {$filename};\r\n\r\n";
 }

 public function write_smtpheaders($addr_from): string {
  $out = sprintf('From: %s%s', $addr_from, PHP_EOL);
  $out .= sprintf('Reply-To: %s%s', $addr_from, PHP_EOL);
  $out .= "X-Mailer: PHP3\r\n";
  return $out . sprintf('X-Sender: %s%s', $addr_from, PHP_EOL);
 }
}

// usage - mimetype example "image/gif"
// $mailfile = new CMailFile($subject,$sendto,$replyto,$message,$filename,$mimetype);
// $mailfile->sendfile();

// Splits a string by RFC2045 semantics (76 chars per line, end with \r\n).
// This is not in all PHP versions so I define one here manuall.
function my_chunk_split($str): string {
 $stmp = $str;
 $len = strlen($stmp);
 $out = "";
 while ($len > 0) {
  if ($len >= 76) {
   $out = $out . substr($stmp, 0, 76) . "\r\n";
   $stmp = substr($stmp, 76);
   $len -= 76;
  }
  else {
   $out = $out . $stmp . "\r\n";
   $stmp = "";
   $len = 0;
  }
 }

 return $out;
}

// end script

