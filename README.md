# MaKhasi - Traditional Indonesian Food Library

**MaKhasi** (Makanan Khas Indonesia) is a sophisticated web platform dedicated to preserving, managing, and showcasing the rich culinary heritage of Indonesia. Built with the robust **Laravel 11** framework and styled with a premium Dark/Gold aesthetic, it provides an immersive experience for food enthusiasts to discover, rate, and collect their favorite traditional dishes.

![MaKhasi Banner](/images/logo2.png)

---

## 🌟 Key Features

### 🌐 Public Access (Guest Experience)
*Features available to all visitors without login:*
- **Culinary Discovery**: Browse an extensive catalog of traditional Indonesian dishes.
- **Smart Filtering**: Filter dishes by major regions (Sumatra, Jawa, Kalimantan, Sulawesi, Papua, etc.).
- **Detailed Insights**: View comprehensive details including history, description, and high-quality imagery.
- **Responsive Design**: Optimized experience across mobile, tablet, and desktop devices.

### 👤 Member Features (Registered Users)
*Exclusive features for signed-in members:*
- **Personal Library**: Save favorite dishes to your "Library" for quick access.
- **Interactive Rating System**: 
  - Rate dishes on a 5-star scale.
  - Write detailed reviews and share culinary experiences.
  - View dynamic average ratings from the community.
- **Profile Management**: 
  - Securely update personal information.
  - Change password with **visibility toggle** (eye icon).
  - **Secure Logout** with confirmation modal to prevent accidental exit.
- **Library Management**: 
  - One-click "Add to Library".
  - Secure "Remove" with confirmation dialogs (Dark Theme UI).

### 🛠️ Administration (Back Office)
*Powerful tools for platform managers:*
- **Dashboard Analytics**: Real-time overview of total foods, user growth, and content distribution.
- **Food Content Management**: 
  - Full CRUD (Create, Read, Update, Delete) capabilities.
  - **Rich Text Editor (TinyMCE)** for professional descriptions.
  - **Bulk Actions**: Delete multiple items at once for efficiency.
- **User Management**: Monitor and manage registered users and administrators.
- **Activity & Audit Logs**: Detailed tracking of who did what and when (IP, Browser, Timestamp).
- **System Settings**: Configure site identity, logos, and footer content dynamically.
- **Data Export**: Export system data to PDF, Excel, or Print formats.

---

## 🚀 Technology Stack

**Core Framework**
- **Laravel 11**: The latest PHP framework for robust and scalable web applications.
- **PHP 8.2+**: Leveraging modern PHP features.

**Frontend & Interactive UI**
- **Livewire 3**: Real-time interactions without full page reloads.
- **Alpine.js**: Lightweight JavaScript framework for UI behavior (Modal toggles, Dropdowns).
- **Bootstrap 4.6**: Responsive layout grid.
- **AdminLTE 3**: Professional admin dashboard template.
- **Custom CSS**: Bespoke "Premium Dark/Gold" theme overrides.

**Database & Back-End Services**
- **MySQL / MariaDB**: Primary relational database.
- **Laravel Jetstream**: Advanced authentication starter kit.
- **Intervention Image**: Server-side image processing and optimization.

---

## 🛠️ Installation & Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/makhasi2-library.git
   cd makhasi2-library
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup**:
   - Create database e.g., `makhasi_library`
   - Update `.env` with DB credentials
   - Run migrations:
     ```bash
     php artisan migrate --seed
     ```

5. **Link Storage**:
   ```bash
   php artisan storage:link
   ```

6. **Serve Application**:
   ```bash
   php artisan serve
   ```
   Access at: `http://127.0.0.1:8000`

---

## 🔐 Security Highlights

- **Role-Based Access Control (RBAC)**: Strict middleware separation between Admin and User routes.
- **CSRF Protection**: Global protection against cross-site request forgery.
- **Secure Modals**: Critical actions (Logout, Delete) require explicit confirmation.
- **Input Sanitization**: All user inputs are validated and sanitized to prevent XSS/Injection.

---

## 📄 License

The MaKhasi project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

**Developed with ❤️ by Rifqi Primanda**
*Mei Semester 4 - Universitas Brawijaya*
