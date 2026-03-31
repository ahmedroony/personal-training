# 🏋️‍♂️ Gym Management & Fitness Application

## 📖 Overview
A comprehensive web-based fitness application designed to streamline gym operations. This system is built to efficiently manage member attendance, provide customized diet plans, and offer a clear separation between administrative management tools and the client-facing interface.

## ✨ Key Features
* **Role-Based Access Control:** Distinct views and permissions for Admins (Managers) and Clients to ensure data security and ease of use.
* **Attendance Tracking:** Easy logging and monitoring of gym members' daily attendance.
* **Customized Diet Plans:** Database-driven dietary programs tailored to individual client needs, allowing clients to view their specific nutritional plans.
* **Clean Architecture:** Features a straightforward, basic code structure with a customized directory organization for CSS and JavaScript resources, outside the default configurations for better maintainability.

## 🛠️ Tech Stack
* **Backend:** PHP, Laravel Framework
* **Frontend:** HTML, CSS, JavaScript
* **Database:** SQL

## 🚀 Installation & Setup

1. **Clone the repository:**
   ```bash
git clone https://github.com/your-username/personal-training.gitcd your-repo-name

composer install

npm install
  
  Environment Setup:

Copy the .env.example file and rename it to .env.

Update your SQL database credentials in the new .env file.


php artisan key:generate

php artisan migrate

php artisan serve
