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

### 1. Clone the Repository
```bash
git clone https://github.com/yourgithubusername/phpmailer-container.git
cd phpmailer-container
```

### 2. Build the Docker Image
```bash
docker build -t yourdockerhubusername/phpmailer .
```

### 3. Run the Container
```bash
docker run -d --name phpmailer \
  -e SMTP_HOST=smtp.example.com \
  -e SMTP_USER=your@email.com \
  -e SMTP_PASS=yourpassword \
  -e SMTP_SECURE=tls \
  -e SMTP_PORT=587 \
  -e MAIL_FROM=your@email.com \
  -e MAIL_TO=recipient@email.com \
  yourdockerhubusername/phpmailer
```

Alternatively, you can use **Docker Compose**:
```bash
docker-compose up -d
```

---

## Configuration

Set the following **environment variables** to configure SMTP settings:

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

## Sending Emails

### Using the Container Manually
To send an email from inside the container, run:
```bash
docker exec -it phpmailer php /var/www/html/sendmail.php
```

### Calling from Another Service
If another container or service needs to send an email, you can execute:
```php
<?php
exec("php /var/www/html/sendmail.php");
?>
```

---

## Deploying to Docker Hub
To push the container to **Docker Hub**:
```bash
docker login
docker tag yourdockerhubusername/phpmailer yourdockerhubusername/phpmailer:latest
docker push yourdockerhubusername/phpmailer:latest
```

---

## Deploying to GitHub
To store this project on **GitHub**:
```bash
git init
git add .
git commit -m "Initial PHPMailer container"
git remote add origin https://github.com/yourgithubusername/phpmailer-container.git
git branch -M main
git push -u origin main
```

---

## License
MIT License

---

## Contributing
Pull requests are welcome! If you find an issue or have suggestions, feel free to open an issue or contribute via a PR.

---

## Credits
Developed by [Matt Kent](https://github.com/Matt-Cyberguy) & ChatGPT🚀

