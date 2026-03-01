# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Service layer architecture (FoodService, LibraryService, ActivityLogService, ImageService)
- Soft deletes for Makanan model
- Status field for food items (draft, published, archived)
- Query scopes for Makanan model (published, byRegion, popular, recent, search)
- Model observers for automatic cache invalidation
- Unique constraint on library table to prevent duplicates
- Database indexes for performance optimization
- Type hints for all model relationships
- Model factories for testing (Makanan, Daerah)
- Comprehensive test suite for controllers
- Image optimization service with multiple sizes
- PHPDoc comments throughout codebase

### Changed
- Updated APP_NAME from "Laravel" to "MaKhasi"
- Configured test database to use SQLite in-memory
- Improved .env.example with proper placeholders
- Enhanced code quality with strict typing

### Fixed
- Security: Removed database credentials from .env.example
- Database: Added missing unique constraint on library table
- Tests: Configured proper test database isolation

### Security
- Enabled CSRF protection on all forms
- Sanitized user input in search functionality
- Implemented proper authentication checks

## [1.0.0] - 2024-06-04

### Added
- Initial release
- Laravel 11 with Jetstream authentication
- AdminLTE 3 admin panel
- Food management system
- User library (favorites) functionality
- Activity logging
- DataTables integration
- Regional food categorization
- Search and filter capabilities

[Unreleased]: https://github.com/yourusername/makhasi2-library/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/yourusername/makhasi2-library/releases/tag/v1.0.0
