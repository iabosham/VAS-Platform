# VAS Platform - Complete Installation Guide

## Server Requirements

### Operating System
- Ubuntu 22.04 LTS (Recommended)
- At least 4GB RAM
- 100GB+ storage

### Software Stack
- **Web Server:** Apache 2.4+
- **Database:** MySQL 8.0+
- **PHP:** 7.4+ (8.1 recommended)
- **Java:** OpenJDK 11
- **Application Server:** Tomcat 9

## Installation Steps

### 1. System Preparation
```bash
sudo apt update
sudo apt upgrade -y
```

### 2. Install Apache
```bash
sudo apt install apache2 -y
sudo systemctl enable apache2
sudo systemctl start apache2

# Enable required modules
sudo a2enmod rewrite
sudo a2enmod ssl
sudo a2enmod headers
```

### 3. Install MySQL
```bash
sudo apt install mysql-server -y
sudo mysql_secure_installation

# Create database and user
mysql -u root -p
CREATE DATABASE sdp_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE sdp_archive_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE sdp_warehouse_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'suda1'@'localhost' IDENTIFIED BY 'YOUR_STRONG_PASSWORD';
GRANT ALL PRIVILEGES ON sdp_db.* TO 'suda1'@'localhost';
GRANT ALL PRIVILEGES ON sdp_archive_db.* TO 'suda1'@'localhost';
GRANT ALL PRIVILEGES ON sdp_warehouse_db.* TO 'suda1'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 4. Install PHP
```bash
sudo apt install php php-mysql php-cli php-curl php-json php-mbstring php-xml php-zip -y
sudo systemctl restart apache2
```

### 5. Install Java & Tomcat
```bash
sudo apt install openjdk-11-jdk -y
sudo apt install tomcat9 tomcat9-admin -y
sudo systemctl enable tomcat9
sudo systemctl start tomcat9
```

### 6. Deploy Database
```bash
cd Database/
mysql -u suda1 -p sdp_db < sdp_db_schema.sql
mysql -u suda1 -p sdp_db < sdp_db_seed_data.sql
```

### 7. Deploy Web Applications
```bash
sudo cp -r CCI CMS SDPAdmin SDP_API_Sudani SDPWebService VASWebService /var/www/html/
sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 755 /var/www/html/
```

### 8. Configure System
```bash
# Copy configuration file
sudo mkdir -p /etc/sdp
sudo cp Config/SDPConfig.json.example /etc/sdp/SDPConfig.json
sudo nano /etc/sdp/SDPConfig.json  # Update with your settings

# Copy Apache configs
sudo cp Apache/000-default.conf /etc/apache2/sites-available/
sudo cp Apache/000-default-le-ssl.conf /etc/apache2/sites-available/
sudo a2ensite 000-default.conf
sudo a2ensite 000-default-le-ssl.conf
sudo systemctl reload apache2

# Copy PHP config (optional - review before applying)
# sudo cp PHP/php.ini /etc/php/8.1/apache2/php.ini

# Copy MySQL config (optional - review before applying)
# sudo cp MySQL/mysqld.cnf /etc/mysql/mysql.conf.d/mysqld.cnf
# sudo systemctl restart mysql
```

### 9. Deploy Java Applications
```bash
# Deploy Tomcat application
sudo cp BillingGateway/BillingGateway.war /var/lib/tomcat9/webapps/
sudo systemctl restart tomcat9

# Deploy processors
sudo mkdir -p /opt/vas/processors
sudo cp Processors/*.jar /opt/vas/processors/
sudo cp -r Processors/lib /opt/vas/processors/

# Install systemd services
sudo cp SystemD/sdp-sudani.service /etc/systemd/system/
sudo cp SystemD/sdp-wave.service /etc/systemd/system/
sudo systemctl daemon-reload
sudo systemctl enable sdp-sudani.service
sudo systemctl start sdp-sudani.service
```

### 10. SSL Certificate (Production)
```bash
sudo apt install certbot python3-certbot-apache -y
sudo certbot --apache -d yourdomain.com
```

## Configuration

### Update SDPConfig.json
Edit `/etc/sdp/SDPConfig.json` with your settings:
- Database credentials
- Operator IDs
- API endpoints
- Payment gateway URLs
- Timeout values

### Update Apache VirtualHosts
Edit Apache configs to match your domain name.

## Testing

### Test Web Applications
- http://your-server/CCI
- http://your-server/CMS
- http://your-server/SDPAdmin
- http://your-server/VASWebService

### Test Tomcat
- http://your-server:8080/BillingGateway

### Test Services
```bash
sudo systemctl status sdp-sudani.service
sudo journalctl -u sdp-sudani.service -f
```

## Troubleshooting

### Check Logs
- Apache: `/var/log/apache2/error.log`
- Tomcat: `/var/log/tomcat9/catalina.out`
- MySQL: `/var/log/mysql/error.log`
- Processors: `sudo journalctl -u sdp-sudani.service`

### Common Issues
1. **Permission denied:** Check file ownership and permissions
2. **Database connection failed:** Verify credentials in SDPConfig.json
3. **Service won't start:** Check logs with `journalctl`

## Security Checklist

- [ ] Change all default passwords
- [ ] Configure firewall (ufw)
- [ ] Enable SSL/TLS
- [ ] Restrict database access
- [ ] Set proper file permissions
- [ ] Configure fail2ban
- [ ] Regular backups

## Backup Strategy

### Database
```bash
mysqldump -u suda1 -p sdp_db > backup_$(date +%Y%m%d).sql
```

### Files
```bash
tar -czf vas-backup-$(date +%Y%m%d).tar.gz /var/www/html /etc/sdp
```

## Support
For issues, check the documentation or contact support.
