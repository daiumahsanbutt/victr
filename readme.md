# VICTR - SKILL ASSESSMENT!

Hi! This project was created by Daium Butt for VICTR's skill assessment. The project is build in Codeigniter3 and should be relatively straight forward to get setup and working on your machine. 


# Step 1 - Download

Download the repo to your computer and extract into XAMPP, in the HTDOCS folder or upload to your web server.

# Step 2 - Update URL's

Now you need to update the URL in the project. 

1) Go to Application/config/config.php and search for "$config['base_url']" replace the value for base_url to your URL. This would either be the address to your localhost folder or your website url.

2) Go to Application/config/constants.php and search for "BASE_URL". Update the URL again to the one you entered in the config file. 

Please note, the URL must end with a "/".

# Step 3 - Update Database

1) Create a new Database in your MYSQL.
2) Import the Database File "victr.sql" to your MYSQL database.
3) Go to Application/config/database.php and update the variables to match the database you just created. Primarily you will need to update "username", "password", and "database". However, depending on your server environment you might need to update other settings too.

# Step 4 - RUN

That's it! The project should run at the URL you setup. Simply go to the URL and press the "Sync Projects" button on the top right corner to fetch the top 30 PHP projects based on stars.
You can use the table to paginate, sort and search records. Clicking on the action button will allow you to view project details!