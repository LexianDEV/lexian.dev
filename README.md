# Portfolio
This is a portfolio of our work. It connects to Github, and automatically updates every hour.

This portfolio is in use at [our website](https://lexian.dev).

## How to use
1. Download the code
2. Run the command ``npm install`` to install the node dependencies.
3. Run the command ``composer install`` to install the composer dependencies.
4. Run the command ``npm run build`` to build the assets.
5. Run the command ``php artisan key:generate`` to generate a new key.
6. Run the command ``php artisan migrate`` to create the database tables.
7. Edit the .env file with your Github username.
8. Go to ``/resources/views/components/brand-logo.blade.php`` and change the SVG file within to your own logo.
9. Go to ``/resources/views/components/footer.blade.php`` and change the data of the footer to your own.
10. On your github account or repository, create a new repository called ".portfolio" and add a README.md file, this is your portfolio content, you can add anything you want here.
11. Run the command ``php artisan github:generate`` and it will fill out the data.
12. Run the command ``php artisan serve`` to start the server.
13. Start the scheduler by running the command ``php artisan schedule:work``. (For production, you may want to add this as a CRON job.)
14. Visit the ``http://127.0.0.1:8000`` address in your browser to see your portfolio.

## Generating a static site
After you've completed set up, you may run the command ``php artisan export`` to generate a static site. This will create a folder called "dist" which you may upload to your web server.

**Note:** When using this method of hosting; you will need to change the .env variable ``APP_URL`` to the URL of your website.

## Settings
You can change the settings in the .env file. Here are some of the important settings that you can change:

- ``APP_NAME``: The name of your website.
- ``APP_URL``: The URL of your website.
- ``GITHUB_USERNAME``: Your Github username.
- ``GITHUB_FILTER_FORKS``: Whether to filter out forked repositories. (true/false)
- ``GITHUB_FILTER_ARCHIVED``: Whether to filter out archived repositories. (true/false)
- ``GITHUB_FILTER_DESCRIPTION``: Whether to filter out repositories without a description. (true/false)