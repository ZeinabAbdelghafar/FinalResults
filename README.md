# 📜 Student Certification System

A Laravel-based web application for managing and displaying student exam results and certificates for the Libyan Ministry of Education.

## 🌐 Live Demo

**[https://finalresults.site/](https://finalresults.site/)**

## ✨ Features

- **Public Certificate Search**: Students can search for their exam results using their seat number
- **Admin Dashboard**: Secure admin panel for managing student records
- **CRUD Operations**: Create, Read, Update, and Delete student certificates
- **QR Code Generation**: Each certificate includes a QR code for verification
- **Responsive Design**: Mobile-friendly interface
- **Arabic RTL Support**: Full right-to-left language support
- **Secure Authentication**: Protected admin routes with Laravel authentication

## 🛠️ Tech Stack

- **Framework**: Laravel 11
- **Database**: MySQL
- **Frontend**: Blade Templates, CSS3
- **Authentication**: Laravel Breeze
- **QR Code**: SimpleSoftwareIO/QrCode

## 📋 Requirements

- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ZeinabAbdelghafar/Final-Results.git
   cd Final-Results
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM packages**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   
   Update `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed Admin User**
   ```bash
   php artisan db:seed --class=AdminSeeder
   ```

8. **Start the Development Server**
   ```bash
   php artisan serve
   ```


## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   └── StudentController.php    # Main controller for student operations
│   └── Models/
│       └── Student.php              # Student model
├── database/
│   ├── migrations/                  # Database migrations
│   └── seeders/
│       └── AdminSeeder.php          # Admin user seeder
├── resources/views/
│   ├── auth/
│   │   └── login.blade.php          # Login page
│   └── students/
│       ├── index.blade.php          # Student list (admin)
│       ├── create.blade.php         # Create student form
│       ├── edit.blade.php           # Edit student form
│       ├── show.blade.php           # Display certificate
│       ├── certificate.blade.php    # Certificate view after creation
│       └── certification-form.blade.php  # Public search form
└── routes/
    └── web.php                      # Web routes
```

## 🔗 Routes

| Route | Method | Description | Auth |
|-------|--------|-------------|------|
| `/` | GET | Public certificate search page | No |
| `/` | POST | Search by seat number | No |
| `/login` | GET | Admin login page | No |
| `/dashboard` | GET | Admin dashboard | Yes |
| `/admin` | GET | Student list | Yes |
| `/admin/create` | GET | Create student form | Yes |
| `/admin/{id}/edit` | GET | Edit student form | Yes |
| `/student/{hashedId}` | GET | View certificate | Yes |
| `/certificate/{hashedId}` | GET | Certificate after creation | Yes |

## 🔒 Security

- All admin routes are protected with authentication middleware
- Student IDs are encrypted in URLs using Laravel's Crypt facade
- CSRF protection on all forms

## 📱 Screenshots

The application features:
- A professional header with educational logos
- Arabic RTL interface
- Responsive card-based student listing
- Detailed certificate view with grades table
- QR code for certificate verification

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👩‍💻 Author

**Zeinab Abdelghafar**

- GitHub: [@ZeinabAbdelghafar](https://github.com/ZeinabAbdelghafar)

---

⭐ Star this repository if you find it helpful!
