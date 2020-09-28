<?php
    /**
     * this class gets the email address of the user and sends an email to the email address with a token inside the link to authenticate the user by clicking the link
     */
    class ForgetPassword extends SetQuery {
        
        /**
         * a string property to store the email address of the user
         *
         * @var string
         */
        public $email = '';
        public $error = array('email'=>'');

        /**
         * validate the given email address by the user
         *
         * @param string $data email address
         * @return void
         */
        public function emailValidate($data) {
            if(empty($data) || trim($data) == '') {
                $this->error['email'] = "Es muss eine E-Mail-Adresse angegeben werden.";
            } elseif(!filter_var(trim($data), FILTER_VALIDATE_EMAIL)) {
                $this->error['email'] = "Bitte geben Sie eine gültige E-Mail-Adresse an.";
            } else {
                $this->email = htmlspecialchars($data);
            }
        }

        /**
         * checks the error array and if there is no error then create the link with the token inside it
         *
         * @return void
         */
        public function checkError() {
            $check = true;
            $error = $this->error;
            foreach($error as $key=>$value) {
                if($value !== '') {
                    echo '<h1 class="error"><i class="fas fa-exclamation-triangle"></i> Bitte überprüfen Sie Ihre Eingaben!</h1>';
                    $check = false;
                    break;
                }
            }
            if($check) {

                // creating token that is a part of our link which we send to user by email:
                //"cryptographically secure" using random bytes generator, and then converting these bytes to  a hexadecimal format:
                $selectorToken = bin2hex(random_bytes(32));
                
                //creating the link:
                $url = "http://localhost/app/resetpasscheck_page.php?selectorToken=" . $selectorToken . "&email=" .$this->email;
                $expire = date("U") + 3600;

                //first we make sure there is no token of the same email(user) address in DB:
                $this->deleteToken($this->email);
                
                //then inserting the new token info into DB:
                $this->insertToken($this->email, $selectorToken, $expire);

                //ctreate email text and include link inside
                $to = $this->email;
                $subject = "Passwort-Wiederherstellung für Wienerberg Apotheke Website";
                $message = "<h1>Passwort-Wiederherstellung</h1>";
                $message .= "<p>Wir haben eine Anfrage zum Zurücksetzen des Passworts erhalten. Wenn Sie diese Anfrage nicht gestellt haben, ignorieren Sie diese E-Mail einfach.</p>";
                $message .= "<p>Andernfalls finden Sie hier den Link zum Zurücksetzen des Passworts:</p>";
                $message .= '<p><a href="' . $url . '">' . $url . '</a></p>';

                $headers = "From: Apotheke-App <o.soleimani.wd@gmail.com>\r\n";
                $headers .= "Reply-To: o.soleimani.wd@gmail.com\r\n";
                $headers .= "Content-type: text/html\r\n";

                mail($to, $subject, $message, $headers);
                header ("location: $app_path/app/login_page.php?message=Wir haben Ihnen eine E-Mail gesendet, bitte überprüfen Sie Ihre E-Mail nach einer Weile.&status=success");
            }
        }
    }