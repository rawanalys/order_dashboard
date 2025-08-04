# 🧾 Customer Order Dashboard

The Customer Order Dashboard is a web-based application built with **CodeIgniter 4**, **MySQL**, and **vanilla JavaScript**. It provides a user-friendly interface to view, search, and paginate customer data along with order counts.

---

## 🚀 Features

- REST API with paginated customer data
- Frontend search by name or email
- Display 50 customers per page with Next/Previous navigation
- Responsive and clean UI with a styled table
- Built on MVC architecture with secure backend

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.1+, CodeIgniter 4
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript (No framework)
- **API:** RESTful endpoints for customer data

---

## 🔍 API Overview

- `GET /api/customers?page=1&limit=50`: Returns paginated customer data
- Supports dynamic search and frontend filtering

---

## 📦 Features in Detail

- Customer records shown in a modern table layout
- Responsive input field for real-time filtering
- Efficient pagination controls
- Fallback messages for loading errors or empty states

---

## 🧠 Notes

- You can configure memory limits if needed (`memory_limit = 512M` in `.env` or `php.ini`)
- All data is dynamically fetched and rendered using JavaScript

---

## 📬 Contact

For any questions or collaboration, feel free to reach out via LinkedIn or raise an issue in this repo.
