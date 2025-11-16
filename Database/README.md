# Database Files

## Schema
- **sdp_db_schema.sql** - Complete database structure (tables, indexes, constraints)
  - Contains CREATE TABLE statements for all 50 tables
  - No data included (structure only)

## Seed Data
- **sdp_db_seed_data.sql** - Essential configuration and reference data
  - service (services configuration)
  - service_type (service types)
  - operators (telecom operators: Zain, Sudani, MTN, Ching)
  - shortcode (shortcode configurations)
  - errorcodes (system error codes)
  - service_keys (service keywords)
  - system_message (system messages templates)

## Important Notes
- Large transactional tables (subscriptions, messages, inbox) are NOT included in seed data
- To restore on new server:
  ```bash
  mysql -u username -p < sdp_db_schema.sql
  mysql -u username -p sdp_db < sdp_db_seed_data.sql
  ```

## Database Credentials
- See `/etc/sdp/SDPConfig.json` on production server
- Default: suda1 / suda1@pwd1 (CHANGE IN PRODUCTION!)
