# Contributing to MaKhasi

Thank you for considering contributing to MaKhasi! This document provides guidelines for contributing to the project.

## Code of Conduct

- Be respectful and inclusive
- Provide constructive feedback
- Focus on what is best for the community

## How to Contribute

### Reporting Bugs

1. Check if the bug has already been reported in Issues
2. If not, create a new issue with:
   - Clear title and description
   - Steps to reproduce
   - Expected vs actual behavior
   - Screenshots if applicable
   - Your environment (PHP version, Laravel version, etc.)

### Suggesting Features

1. Check if the feature has been suggested
2. Create a new issue with:
   - Clear description of the feature
   - Use cases
   - Potential implementation approach

### Pull Requests

1. Fork the repository
2. Create a new branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Write or update tests
5. Ensure all tests pass (`php artisan test`)
6. Run code formatting (`./vendor/bin/pint`)
7. Commit your changes (`git commit -m 'Add amazing feature'`)
8. Push to the branch (`git push origin feature/amazing-feature`)
9. Open a Pull Request

## Development Setup

```bash
# Clone the repository
git clone https://github.com/yourusername/makhasi2-library.git
cd makhasi2-library

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate --seed

# Link storage
php artisan storage:link

# Run development server
php artisan serve
```

## Coding Standards

- Follow PSR-12 coding standards
- Use type hints for all method parameters and return types
- Write PHPDoc comments for all public methods
- Keep methods focused and small
- Use meaningful variable and method names

## Testing

- Write tests for all new features
- Ensure existing tests pass
- Aim for 70%+ code coverage
- Use factories for test data

## Database Changes

- Always create migrations for schema changes
- Never modify existing migrations that have been deployed
- Include both `up()` and `down()` methods
- Test migrations on a fresh database

## Git Commit Messages

- Use present tense ("Add feature" not "Added feature")
- Use imperative mood ("Move cursor to..." not "Moves cursor to...")
- Limit first line to 72 characters
- Reference issues and pull requests

## Questions?

Feel free to open an issue for any questions about contributing.
