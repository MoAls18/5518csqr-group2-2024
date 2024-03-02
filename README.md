# 5518csqr-group2-2024

## Overview

Welcome to our Blog Application! This web application provides users a platform for reading and creating blog posts as well as commenting on them. This web app employs secure software development practices to ensure the security and safety of the users data and information. This app aims to protect the user by employing methods such as authentication and authorization, input validation, secure communication, and more. These measures along with the use of the three-tier architecture design will enable us to create a secure and safe web application.

## Project Structure

Our application uses the three-tier architecture model. The layers consist of the following:

1. Presentation Layer (PL)

- Contains HTML and CSS for displaying the user interface
- Contains the code to display web pages to the user
- Gathers data through API calls to the Business Logic Layer

2. Business Logic Layer (BLL)

- Processes and manipulates data taken from the Data Access Layer
- Controllers take input from the PL and process the input
- Services contain the app logic such as creating new blog posts
- Validators validate input before displaying or storing in the database

3. Data Access Layer

- The Data Access Layer interfaces with the database and the BLL
- Models contains data structures representing database entities
- Repositories interact with the database during retrieval and storage of data.

## Secure Software Development

Our blog app also includes secure software development techniques to maintain the security and integrity of the data. It includes:

- Input Validation
- Authentication and Authorization
- Data Encryption
- Session Management
- Error Handling

## Getting Started

### Contributing

To start contributing, navigate to your XAMPP/htdocs folder and clone this repo:

```bash

git clone https://github.com/MoAls18/5518csqr-group2-2024.git

```

Then create a new branch off of the dev branch to implement your features.

### Importing Database

1. go to [phpmyadmin](localhost/phpmyadmin)
2. create a new database and name it `blog`
3. Click on import and navigate to `data/blog.sql`

### Using Composer To Install Dependencies

Included in the project is a file called `composer.phar`. This file allows the project dependencies to be installed and updated using the following commands:

#### Installing

```
php composer.phar install
```

#### Updating

```
php composer.phar update
```
