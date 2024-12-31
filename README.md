## SlashLogin: Streamline Your Laravel Development

### Tired of repetitive logins during development? Let us **Slash** your **Login**!

![GitHub contributors](https://img.shields.io/github/contributors/fahadyousafmahar/slash-login)
![Packagist Downloads](https://img.shields.io/packagist/dt/fahadyousafmahar/slash-login)

![GitHub top language](https://img.shields.io/github/languages/top/fahadyousafmahar/slash-login)
![GitHub License](https://img.shields.io/github/license/fahadyousafmahar/slash-login)
![GitHub repo size](https://img.shields.io/github/repo-size/fahadyousafmahar/slash-login)

#### Simplify your development workflow today with SlashLogin!

SlashLogin is a Laravel package designed to simplify your development / testing workflow. It allows you to quickly log in as any user in your application by accessing a configured route. It's perfect for developers who want to save time and effort by eliminating repetitive logins during development.

**Key Features:**

* **Effortless Login:** Login as any user with a single route.
* **Flexible Configuration:** Customize the login route, user model, redirect route, and more.
* **Secure by Design:** Designed for development environments only, ensuring production security.
* **Easy Installation and Usage:** Quick setup and intuitive configuration.

**How It Works:**

1. **Installation:** Install using Composer (`composer require --dev fahadyousafmahar/slash-login`).
2. **Configuration:** Customize the settings in the configuration file (`config/slash-login.php`).
3. **Usage:** Access the configured route with the desired user ID to log in.

**Example:**

If you configure the route as `login` then you can log in as user with ID `123` by visiting `http://your-app.com/login/123`.

**Benefits:**

- **Accelerated Development:** Save time and effort by eliminating repetitive logins.
- **Enhanced Testing:** Quickly test different user scenarios without manual logins.
- **Simplified Debugging:** Easily access various user accounts for debugging purposes.

**Installation:**

1. **Require the package:**
   ```bash
   composer require --dev fahadyousafmahar/slash-login
   ```

2. **Publish the configuration:**
   ```bash
   php artisan vendor:publish --tag="slash-login-config"
   ```

3. **Configure as needed:**
   Edit the `config/slash-login.php` file to customize the login behavior.

   * route: The route segment for login (default: login).
   * model: The User model class to fetch user data.
   * redirect_route: The route to redirect to after login.
   * guard: The authentication guard to use (default: web).
   * custom_session_data: Additional session data to set after login.
   
* **Note:**
  This package is intended for **development and testing environments only**. It automatically disables itself in production environments based on the `APP_ENV` configuration.

**Keywords:** Laravel, development, testing, login, authentication, efficiency, productivity, developer tool.

**Author:** [Fahad Yousaf Mahar](https://fahadyousafmahar.com)

**Contributors:**

[Austin White](http://austinw.me)