# ads-management

To run the task after cloning the repository, inside the project directory run `composer install` and then run `php artisan serve`

You will find a file named `ADS Management.postman_collection.json` contain the postman file to test the endpoints to test the CRUD operations of categories, tags and the filter operation.

To test the schedule daily email please run `php artisan ads:reminder`

Put the configuration of the mail server you will use EX: 
[Mail Trap](https://mailtrap.io/)

MAIL_MAILER=smtp

MAIL_HOST=smtp.mailtrap.io

MAIL_PORT=2525

MAIL_USERNAME=YOUR_USERNAME

MAIL_PASSWORD=YOUR_PASSWORD

MAIL_ENCRYPTION=tls
