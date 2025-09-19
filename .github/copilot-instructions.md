# GitHub Copilot Instructions for skynet-test

## Repository Summary

This is a PHP REST API project implementing a tariff management system for user services. The application provides endpoints to retrieve and set tariffs for users' services, with tariffs grouped by `tarif_group_id`. Built as a test assignment, it demonstrates a clean domain-driven architecture with custom dependency injection.

## High-Level Repository Information

- **Project Type**: PHP REST API
- **Size**: ~53 PHP files across modular domain structure
- **Languages**: PHP 8.3+ (tested with PHP 8.3.6)
- **Framework**: Custom lightweight framework with PSR-4 autoloading
- **Database**: MySQL with PDO
- **Architecture**: Domain-driven design with Service/Entity/Manager/Provider pattern
- **Entry Point**: `public/index.php`
- **Dependencies**: None (pure PHP with custom autoloader)

## Build and Validation Instructions

### Environment Setup (ALWAYS REQUIRED)

1. **PHP Version**: Requires PHP 8.3+ with PDO MySQL extension
   ```bash
   php --version  # Should show 8.3+
   php -m | grep pdo_mysql  # Should show pdo_mysql
   ```

2. **Database Configuration** (CRITICAL - ALWAYS CREATE FIRST):
   ```bash
   mkdir -p config/db
   ```
   Create `config/db/db_cfg.php` with your database settings:
   ```php
   <?php
   define("DB_HOST", "your_host");
   define("DB_USER", "your_user");
   define("DB_PASSWORD", "your_password");
   define("DB_NAME", "your_database");
   ```
   **Note**: This file is gitignored and MUST be created manually for the application to work.

### Running the Application

1. **Start Development Server** (ALWAYS from public directory):
   ```bash
   cd public
   php -S 127.0.0.1:8080
   ```

2. **Test Endpoints**:
   ```bash
   # GET tariffs
   curl -i -H "Accept: application/json" http://127.0.0.1:8080/users/1/services/1/tarifs
   
   # PUT tariff (set tariff)
   curl -X PUT http://127.0.0.1:8080/users/1/services/1/tarifs \
        -H "Accept: application/json" \
        -H "Content-Type: application/json" \
        -d '{"tarif_id": 1}'
   ```

### Validation Steps

1. **Syntax Check**: Always run before testing changes
   ```bash
   php -l public/index.php
   php -l config/bootstrap.php
   find src -name "*.php" -exec php -l {} \;
   ```

2. **Application Bootstrap Test**:
   ```bash
   cd public && timeout 5 php -S 127.0.0.1:8081 &
   sleep 2
   curl -f http://127.0.0.1:8081/users/1/services/1/tarifs || echo "Bootstrap failed"
   pkill -f "php -S"
   ```

### Common Issues and Workarounds

- **Database Connection Errors**: Ensure `config/db/db_cfg.php` exists with valid credentials
  - Error: `No such file or directory` = missing db_cfg.php file
  - Error: `getaddrinfo failed` = invalid hostname in db_cfg.php
- **Autoloader Issues**: File/class names must match PSR-4 conventions exactly
  - Error: `Class not found` = check namespace vs file path alignment
- **404 Errors**: Application expects URL rewriting - use built-in server from public/ directory
- **500 Errors**: Usually database-related - check db_cfg.php and MySQL connection
- **Timeout Issues**: Database operations may take 5-10 seconds on slow connections

## Project Layout and Architecture

### Directory Structure
```
skynet-test/
├── .github/copilot-instructions.md    # This file
├── .gitignore                          # Excludes config/db/ and .idea
├── README.md                           # Russian documentation with setup instructions
├── config/
│   ├── autoload.php                    # PSR-4 autoloader implementation
│   ├── bootstrap.php                   # Application initialization and DI setup
│   ├── config.php                      # Main configuration aggregator
│   ├── db/
│   │   ├── connection.php              # Database connection configuration
│   │   └── db_cfg.php                  # Database credentials (create manually)
│   └── router/
│       └── routes.php                  # Route definitions for API endpoints
├── public/
│   └── index.php                       # Entry point - handles all requests
└── src/
    ├── Application.php                 # Main application class with DI container
    ├── Domain/                         # Business logic layer
    │   ├── Behavior/
    │   │   └── AssertableBehavior.php  # Shared validation trait
    │   ├── Service/                    # Service management domain
    │   ├── Tarif/                      # Tariff management domain
    │   │   ├── Controller/Action/      # API endpoint handlers
    │   │   ├── Entity/                 # Tariff data models
    │   │   ├── Manager/                # Business logic layer
    │   │   ├── Mapper/                 # Database access layer
    │   │   └── Provider/               # DI service providers
    │   └── User/                       # User management domain
    └── Kernel/                         # Framework components
        ├── Http/                       # HTTP handling (Request/Response/Routing)
        └── Provider/                   # Core service providers
```

### Key Architectural Components

1. **Entry Point Flow**: `public/index.php` → `config/bootstrap.php` → `src/Application.php`

2. **Dependency Injection**: Custom ArrayAccess-based container in `Application.php`

3. **Routing**: Pattern-based routing in `config/router/routes.php`
   - GET `/users/{user_id}/services/{service_id}/tarifs` → `GetUsersServicesTarifsAction`
   - PUT `/users/{user_id}/services/{service_id}/tarifs` → `PutUsersServicesTarifsAction`

4. **Domain Structure**: Each domain (User, Service, Tarif) follows the pattern:
   - **Controller/Action**: HTTP request handlers
   - **Entity**: Data models with array serialization
   - **Manager**: Business logic interfaces and implementations
   - **Mapper**: Database access layer
   - **Provider**: DI service registration

5. **Database Layer**: PDO with custom connection handling via `DatabaseServiceProvider`

### API Specification

**GET Response Format**:
```json
{
  "result": "ok",
  "tarifs": [
    {
      "title": "Plan Name",
      "link": "http://example.com/plan",
      "speed": 50,
      "tarifs": [
        {
          "ID": 1,
          "title": "Plan (1 month)",
          "price": 480,
          "pay_period": "1",
          "new_payday": "1450213200+0300",
          "speed": 50
        }
      ]
    }
  ]
}
```

**PUT Request Body**:
```json
{"tarif_id": 1}
```

**PUT Response**:
```json
{"result": "ok"}  // or {"result": "error"}
```

### Configuration Files

- **Main Config**: `config/config.php` - Merges database and routing configs
- **Database**: `config/db/connection.php` - PDO configuration with charset cp1251
- **Routes**: `config/router/routes.php` - API endpoint definitions
- **Autoloader**: `config/autoload.php` - PSR-4 implementation for App namespace

### Root Directory Files
- `.gitignore` - Excludes config/db/ and .idea directories
- `README.md` - Russian setup instructions and API specification  
- `config/` - Application configuration and bootstrapping
- `public/` - Web server document root with index.php entry point
- `src/` - Application source code following domain-driven architecture

### Development Guidelines

1. **Making Changes**: 
   - Always validate syntax with `php -l filename.php`
   - Test with both GET and PUT endpoints
   - Ensure database connectivity before testing

2. **File Naming**: Follow PSR-4 exactly - `App\Domain\User\Entity\User` → `src/Domain/User/Entity/User.php`

3. **Error Handling**: All controllers return JSON with `{"result": "ok"}` or `{"result": "error"}`

4. **Database Schema**: Expects MySQL tables `services` and `tarifs` with `tarif_group_id` relationships

## Trust These Instructions

These instructions have been validated through comprehensive repository analysis and testing. Only search for additional information if:
- You encounter specific errors not covered here
- You need database schema details (not provided in codebase)
- You need to understand business logic beyond the API specification

The application structure is consistent and well-organized. Follow the established patterns when making changes.