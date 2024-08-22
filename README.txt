Connect is a modern IoT platform that allows connecting and managing various devices through integration with the Tuya platform. This project is designed to simplify the management of IoT resources in corporate networks by providing a user-friendly web interface.

Key features
Integration with Tuya: The platform allows you to easily connect and manage Tuya-supported devices through the API.
Web interface: Provides an intuitive interface for managing IoT resources.
Air quality monitoring: The ability to track and analyze real-time air quality indicators.
Asset Management: Offers a solution for effective IoT-based management of corporate assets.
Requirements
PHP 7.x or later
MySQL 5.x or later
Web server (Apache, Nginx, etc.)
Tuya API access (API keys)
Installation.
Cloning the repository:

bash
Copy the code
git clone https://github.com/your-username/connect.git
cd connect
Setting up the database:

Create a new database in MySQL.
Import the SQL file database.sql to create the necessary tables.
Edit the config.php file and add information about connecting to your database.
Configure the Tuya API:

Add your API_KEY, API_SECRET, and other necessary parameters to the config.php file.
Start the web server:

Make sure your web server is configured to handle PHP files.
Open a browser and navigate to your project URL to check the performance.
Usage.
Demo mode: Available after authorization. Go to the “DEMO” section to view the platform's capabilities.
Monitoring: Select the appropriate category to view data from connected devices.
Management: Configure settings, add or remove devices via the web interface.