# Contact Form 7 Extender
This extension for Contact Form 7 and its plugin CFDB7 adds a link to a file in the email body.

## Usage

1. **Installation**:
    - Clone the repository or download the ZIP file.
    - Place the files in your WordPress plugin directory.

2. **Activate the Plugin**:
    - Go to the WordPress admin dashboard.
    - Navigate to `Plugins -> Installed Plugins`.
    - Find and activate the "Contact Form 7 Extender" plugin.

3. **Configure the Services**:
    - Ensure CFDB7 is installed and activated.
    - The plugin will automatically register the necessary services and hooks upon activation.

## Structure
```
.
├── Container
│  └── DIContainer.php
├── Main
│  └── Extender.php
├── Service
│  ├── FileNameRetriever.php
│  └── MailBodyAppender.php
└── ServiceProvider.php
```

## Code Details
- **Container/DIContainer.php**: A simple Dependency Injection Container used to register and resolve services.
- **Main/Extender.php**: The main extension class that initializes hooks for Contact Form 7 and CFDB7.
    - `initializeHooks()`: Sets up the WordPress hooks for extending the functionality.
- **Service/FileNameRetriever.php**: Service responsible for retrieving file names to be used in the email body.
    - `filter()`: Method hooked to `cfdb7_before_save_data` to manipulate data before saving.
- **Service/MailBodyAppender.php**: Service responsible for appending content to the email body.
    - `append()`: Method hooked to `wpcf7_before_send_mail` to add a link to the file in the email body.
- **ServiceProvider.php**: The service provider class that registers the services in the DI container.

## Example
ere is a basic example of how the extender works:

When a form is submitted, `FileNameRetriever` will manipulate the data before it is saved to the database. Then, `MailBodyAppender` will add a file link to the email that is sent out via Contact Form 7.

```php
<?php
add_action('plugins_loaded', function() {
    $container = new \Container\DIContainer();
    new \ServiceProvider($container);

    // Example usage
    $extender = $container->get('extender');
});
```

This setup ensures that the DI container registers the services and hooks them into the WordPress lifecycle appropriately.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
