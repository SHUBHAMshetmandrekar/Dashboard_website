# Employee Details Management System

## 📌 Overview
The **Employee Details Management System** is a web application designed to manage employee information efficiently. It provides functionalities such as adding, deleting, updating, and viewing member details. Users can also download PDFs of individual member details and the total member list.

This system is specifically designed for **SocialPact Organisation** to match their structure, which includes:
- **President**
- **Secretary**
- **Treasurer**
- **Five Departments**:
  - HR
  - Sports
  - Media and Marketing
  - Educational
  - Technical

Each department has **one head**, and the system ensures that there is only **one President and one department head per department** using JavaScript validation while adding new members.

## 🎯 Features
- ➕ Add, 🗑️ Delete, and ✏️ Update member details
- 👀 View member details
- 📄 Download PDFs of individual member details and total member list
- 🎯 Structured hierarchy enforcement for SocialPact Organisation
- 🛑 JavaScript validation to prevent multiple Presidents or multiple department heads

## 🛠️ Technologies Used
- **Frontend:** HTML, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## 🚀 Installation & Setup
### Prerequisites
Ensure you have the following installed:
- PHP
- MySQL
- Apache or any web server (XAMPP recommended)

### Steps to Run Locally
1. Clone the repository:
   ```bash
   git clone https://github.com/SHUBHAMshetmandrekar/Employee_Details_Management_System.git
   ```
2. Move to the project directory:
   ```bash
   cd Employee_Details_Management_System
   ```
3. Start your local server (if using XAMPP, start Apache and MySQL).
4. Import the database:
   - Open **phpMyAdmin**
   - Create a new database (e.g., `Employee_Management_db`)
   - Import `Employee_Management.sql` from the project folder
5. Configure database connection in `config.php`
6. Run the application by accessing:
   ```
   http://localhost/Employee_Details_Management_System/
   ```

## 💡 Future Enhancements
- 🛠️ Role-based authentication
- 📊 Dashboard with analytics
- 🔍 Advanced search and filter options


## 📞 Contact
For any queries or suggestions, reach out to:
- **Shubham Shet Mandrekar**
- GitHub: [SHUBHAMshetmandrekar](https://github.com/SHUBHAMshetmandrekar)
- Email : shetmandrekarshubham107@gmail.com

