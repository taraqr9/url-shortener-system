# URL Shortener System

## Overview
This is a simple URL shortener application built with Laravel, allowing users to create short and shareable links for long URLs. The application provides features for URL shortening, redirection, click statistics, and user authentication.

## Requirements
### URL Shortening
* Users can input long URLs via a web form.
* Logic is implemented to generate short URLs for the provided long URLs.
* Original long URLs and generated short URLs are displayed for reference.

### Redirection
* Short URLs redirect users to the original long URLs.

### Statistics
* The system tracks the click count for each short URL.
* Users can view the click count for their shortened URLs.

### User Authentication
* User authentication is implemented.
* Registered users can manage their shortened URLs and view click statistics.

### Security
* Data security and user privacy are ensured.
* Proper input validation is implemented.
* Protection against common web vulnerabilities is in place.

### Optional
* An API is provided for programmatically shortening URLs.

### Installation

1. Clone the repository.
```
git clone https://github.com/yourusername/url-shortener.git
```

2. Navigate to the project directory.
```
cd url-shortener
```

3. Install dependencies.
```
composer install
```

4. Create a copy of the .env.example file and rename it to .env.
```
cp .env.example .env
```

5. Generate an application key.
6. Configure your database settings in the .env file.

7. Run migrations and seed the database.
```
php artisan migrate --seed
```

8. Install npm packages.
```
npm install
```

9. Run the following command to build your assets.
```
npm run build
```

10. Serve the application.
```
php artisan serve
```

### Usage
* Access the application and register/login.
* Use the provided web form to shorten long URLs.
* View and manage your shortened URLs and click statistics in the dashboard.
* Access the API for programmatically shortening URLs.

### Security Considerations
* Ensure the .env file and sensitive information are properly secured.
* Regularly update dependencies and Laravel framework for security patches.
* Configure a secure environment for the application.

### Contributing
Contributions are welcome!

### License
This project is licensed under the MIT License.
