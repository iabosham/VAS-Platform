# VAS (Value Added Services) Platform

## Overview
Complete VAS platform for managing value-added services for telecom operators in Sudan.

## System Components

### PHP Web Applications
- **CCI** - Central Control Interface (Admin Panel)
- **CMS** - Content Management System
- **SDPAdmin** - SDP Administration Portal
- **SDP_API_Sudani** - Sudani Operator API
- **SDPWebService** - Legacy SOAP/REST Web Services
- **VASWebService** - Current Active Web Services

### Java Applications
- **BillingGateway** - Billing and Payment Gateway (Tomcat)
- **SDPProcessorSudani** - Background Message Processor
- **SDPDirectProcessor** - Direct Charging Processor

### Databases
- **sdp_db** - Main operational database
- **sdp_archive_db** - Archive database
- **sdp_warehouse_db** - Data warehouse

## Technology Stack

### Backend
- PHP 7.4+
- Java 11 (OpenJDK)
- MySQL 8.0

### Web Servers
- Apache 2.4 (HTTP/HTTPS)
- Tomcat 9 (Java applications)

### External Integrations
- Sudani Payment Gateway
- SDP Gateway API
- Multiple Operator APIs (Zain, Sudani, MTN)

## Project Structure

```
VAS-Project/
├── CCI/                    # Central Control Interface
├── CMS/                    # Content Management System
├── SDPAdmin/               # SDP Administration
├── SDP_API_Sudani/         # Sudani API
├── SDPWebService/          # Legacy Web Services
├── VASWebService/          # Active Web Services
├── BillingGateway/         # Billing Gateway WAR
├── Processors/             # Java JAR Processors
├── Config/                 # Configuration files (template)
└── README.md
```

## Database Schema Highlights

### Main Tables (sdp_db)
- `service_subscription` - Active subscriptions (600K+ records)
- `subscriber` - Subscriber information (195K+ records)
- `message_queue` - Message processing queue
- `inbox` - Incoming messages (336K+ records)
- `service` - Available services
- `operators` - Telecom operator configurations
- `vendor` - Vendor management
- `user` - System users

## Installation & Deployment

### Prerequisites
- Ubuntu 22.04 LTS
- Apache 2.4+
- MySQL 8.0+
- PHP 7.4+ with extensions (mysqli, json, curl)
- Java 11 (OpenJDK)
- Tomcat 9

### Configuration
1. Copy `Config/SDPConfig.json.example` to `/etc/sdp/SDPConfig.json`
2. Update database credentials
3. Configure operator APIs
4. Set up Apache virtual hosts
5. Deploy Tomcat applications
6. Configure systemd services

### Database Setup
```bash
mysql -u root -p < database/schema.sql
mysql -u root -p < database/initial_data.sql
```

### Web Applications Deployment
```bash
cp -r CCI CMS SDPAdmin SDP_API_Sudani SDPWebService VASWebService /var/www/html/
chown -R www-data:www-data /var/www/html/
```

### Java Processors Deployment
```bash
cp Processors/*.jar /opt/vas/processors/
cp systemd/*.service /etc/systemd/system/
systemctl daemon-reload
systemctl enable sdp-sudani.service
systemctl start sdp-sudani.service
```

## API Endpoints

### VASWebService
- `POST /VASWebService/PostMessage/` - Send messages
- `GET /VASWebService/GetReceivedMessages/` - Retrieve messages
- `GET /VASWebService/CheckMessageStatus/` - Check message status
- `POST /VASWebService/subscribe/` - Subscribe to service
- `POST /VASWebService/remove/` - Unsubscribe from service
- `GET /VASWebService/CheckSubscription/` - Check subscription status

## Security Notes
- All sensitive configuration files are in `.gitignore`
- Update default passwords before deployment
- Configure firewall rules
- Enable SSL/TLS for production
- Use environment variables for sensitive data

## Monitoring & Logs
- Apache logs: `/var/log/apache2/`
- Processor logs: Check systemd journal
- Application logs: Each app has its own `log/` directory

## License
Proprietary - Alwisam Company

## Support
Contact: vas@alwisam.com

---
**Note:** This is a production system. Handle with care and always backup before making changes.
