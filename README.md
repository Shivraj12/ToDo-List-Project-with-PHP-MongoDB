## ToDo-List-Project-with-PHP-MongoDB
A simple, responsive To-Do List web application built with PHP, MongoDB Atlas, and Tailwind CSS. This application demonstrates efficient use of PHP with MongoDB, offering functionality to create, update, mark as complete, and delete tasks.

## Features
- **Add New Tasks**: Users can add tasks with a title and description.
- **Edit/Update Tasks**: Modify existing tasks to keep them up to date.
- **Mark as Complete**: Quickly mark tasks as done.
- **Delete Tasks**: Remove tasks when they are no longer needed.
- **Responsive Design**: Tailwind CSS for a seamless experience across devices.

## Technologies Used
- **PHP**: Server-side scripting language for backend functionality.
- **MongoDB Atlas**: Cloud-based NoSQL database for data storage.
- **Tailwind CSS**: Utility-first CSS framework for a responsive and clean UI.

## Getting Started

### Prerequisites
- PHP 7.4+
- Composer
- MongoDB Atlas account (use the free tier for this project)

- ### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/Shivraj12/ToDo-List-Project-with-PHP-MongoDB
   cd ToDo-List-Project-with-PHP-MongoDB

2. Install dependencies using Composer:
   ```bash
   composer install

3. Set up your MongoDB connection string in the index.php file:
   ```bash
   $client = new MongoDB\Client("mongodb+srv://<username>:<password>@<cluster>.mongodb.net/?retryWrites=true&w=majority");

4. Install XAMPP and add DLL Files:
   ```bash

   WINDOWS INSTRUCTIONS :-
   
   Download the appropriate .dll file for your PHP version from the PECL repository. (https://pecl.php.net/package/mongodb)
   Place the downloaded .dll file into your PHP ext directory (usually located at C:\path\to\php\ext).
   Enable the extension by adding the following line to your php.ini file.
         extension=mongodb.dll
   
   Once the ext-mongodb extension is installed, you can install the mongodb/mongodb package via Composer:
         composer require mongodb/mongodb

   If you're still having trouble with the latest version of mongodb/mongodb, you can explicitly require an older compatible version:
         composer require mongodb/mongodb:^1.9

   Start The Apache Server

5. Run the project on a local server::
   ```bash
   php -S localhost:8000

   ---------------OR-------------------------(Easy Way)
   
   Install VSCode Extension : PHP Server and Serve Project
    Id: brapifra.phpserver
    Description: Serve your Project with PHP
    Version: 3.0.2
    Publisher: brapifra
    VS Marketplace Link: https://marketplace.visualstudio.com/items?itemName=brapifra.phpserver


6. Visit the application:
   ```bash
   Visit http://localhost:8000 in your browser to see the application.


