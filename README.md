# framework
Modified Silex to allow Controllers, Models and DAOs using an Autoloader.

For this example to actually run you'll need to set up a MySQL instance with:

**DB Stuff**

1) Schema named 'test_schema'
2) Table under 'test_schema' named automobiles
Cols:
id INT(11) PK, NN, AI
type VARCHAR(45)
number_of_wheels VARCHAR(45)
color VARCHAR(45)
make VARCHAR(45)
model VARCHAR(45)

3) Table under 'test_schema' named users
Cols:
id INT(11) PK, NN, AI
first_name VARCHAR(45)
last_name VARCHAR(45)
dob VARCHAR(45)
phone_num VARCHAR(45)

4) Populate both tables with some information

**Code Stuff**

1) Pull down code somewhere PHP can run
2) Run Composer
3) Add correct config info in configs/config.php for MySQL instance


**Using POSTMAN or in a browser go to:**

http://YOUR_URL/api/v2/test
if working you should see a message telling you the API is working