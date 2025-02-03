# PHPMailer Docker Container

This is a lightweight **Alpine-based** Docker container that runs **PHP-FPM** with **PHPMailer** pre-installed. The container stays up perpetually, allowing other services to send emails using PHPMailer without needing to reinstall it after updates.

---

## Features

✅ **Lightweight Alpine-based PHP-FPM container**  
✅ **Pre-installed PHPMailer**  
✅ **Runs continuously**  
✅ **Easily configurable via environment variables**  
✅ **Works seamlessly with Nginx, Apache, or other web services**  

---

## Getting Started

### 1. Pull from GitHub Container Registry (Preferred Method)
The easiest way to use this container is to pull it directly from **GitHub Container Registry (GHCR)**:
```bash
docker pull ghcr.io/cypac-cybersecurity/phpmailer:latest
```

### 2. Use Docker Compose
For a persistent deployment, use **Docker Compose** to pull and run the container:
```yaml
version: '3.8'

services:
  phpmailer:
    container_name: PHPMailer
    image: ghcr.io/cypac-cybersecurity/phpmailer:latest
    restart: always
    environment:
      - SMTP_HOST=smtp.example.com
      - SMTP_USER=your@email.com
      - SMTP_PASS=yourpassword
      - SMTP_SECURE=tls
      - SMTP_PORT=587
      - MAIL_FROM=your@email.com
      - MAIL_TO=recipient@email.com
```
Then run:
```bash
docker-compose up -d
```

### 3. Build from Source (Alternative Method)
If you prefer to build the container from source, clone the GitHub repository and build manually:
```bash
git clone https://github.com/Cypac-Cybersecurity/PHPMailer.git
cd PHPMailer
docker build -t phpmailer .
```

---

## Configuration

Set the following **environment variables** to configure SMTP settings. These are optional and only required when using `sendmail.php` for direct email testing:

| Environment Variable | Description |
|----------------------|-------------|
| `SMTP_HOST` | Your SMTP server (e.g., `smtp.gmail.com`) |
| `SMTP_USER` | Your SMTP username/email |
| `SMTP_PASS` | Your SMTP password |
| `SMTP_SECURE` | Security protocol (`tls` or `ssl`) |
| `SMTP_PORT` | SMTP port (e.g., `587` for TLS, `465` for SSL) |
| `MAIL_FROM` | Sender email address |
| `MAIL_TO` | Default recipient email address |

---

## Using PHPMailer in Forms

If this container is added as a dependency to an Nginx web service, developers can use it to send emails from their PHP forms.

### Example: Contact Form (`contact.html`)
```html
<form action="contact.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    
    <button type="submit">Send</button>
</form>
```

### Backend Script (`contact.php`)
```php
<?php
require '/var/www/html/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = getenv('SMTP_HOST') ?: 'smtp.example.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USER') ?: 'your@email.com';
        $mail->Password = getenv('SMTP_PASS') ?: 'yourpassword';
        $mail->SMTPSecure = getenv('SMTP_SECURE') ?: 'tls';
        $mail->Port = getenv('SMTP_PORT') ?: 587;
        
        $mail->setFrom(getenv('MAIL_FROM') ?: 'your@email.com', 'Website Contact');
        $mail->addAddress('recipient@email.com', 'Admin');
        
        $mail->Subject = "New Contact Form Submission";
        $mail->Body    = "Name: $name\nEmail: $email\nMessage:\n$message";
        
        if ($mail->send()) {
            echo "Email sent successfully!";
        } else {
            echo "Email sending failed.";
        }
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
```

Once the container is running alongside the webserver, this setup allows forms to send emails using PHPMailer.

---

## Deploying to GitHub Container Registry
To push the container to **GHCR**:
```bash
docker login ghcr.io -u Cypac-Cybersecurity --password-stdin

docker tag phpmailer ghcr.io/cypac-cybersecurity/phpmailer:latest

docker push ghcr.io/cypac-cybersecurity/phpmailer:latest
```

---

## License
MIT License

---

## Contributing
Pull requests are welcome! If you find an issue or have suggestions, feel free to open an issue or contribute via a PR.

---

## Credits
Developed by [Cypac Cybersecurity](https://github.com/Cypac-Cybersecurity) 🚀
