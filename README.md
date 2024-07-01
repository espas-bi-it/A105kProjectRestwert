![Logo](https://projekt-restwert.ch/wp-content/themes/yootheme/cache/b3/headerbild-rwlanding-b302bbfb.webp)

# Project Customer Form
Projekt Restwert Zürich required a tool to register new customers and maintain their data, with the goal of integrating this information into their existing ERP system. The tool needed to be accessible via iPad tablets for ease of use by their team.

Once the customer's data is validated and saved, they will receive an email containing Projekt Restwert's Terms of Service. 

https://restwert.espas-it.ch


## Features

- **reCaptcha:** To enhance security and prevent spam.
- **Confirmation Email with ToS:** Customers receive an automated email containing the Terms of Service after their data is processed
- **Database Access and Modification:** Employees can access the database and perform changes to entries.
- **Filter and Search Options:** To easily find and manage customer information.
- **Responsive Design:** Accessible and user-friendly on iPad tablets and other devices.
- **Restricted Access:** Only logged-in users can view and interact with the database.
    


## Used By

This project is used by the following companies:

- Projekt Restwert Zürich https://projekt-restwert.ch/


## 🛠 Skills
PHP, Laravel, Laravel Breeze, Google API, Bootstrap, HTML, CSS, APACHE, MYSQL

## Local Deployment

**This project can easily be set up locally with XAMPP. Install Node.js and Composer to run the app.**

git clone the project and run 

```bash
  composer update
```

Create .env file with a connection to your DB. Enter the following command

```bash
  php artisan migrate
```

Start the page by running

```bash
  npm run dev
```

followed by this in another terminal

```bash
  php artisan serve
```


