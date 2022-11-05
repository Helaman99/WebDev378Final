# WebDev378Final
---
This was the final project for my Web Application Development class.

This was completed on 6/16/2022, and was done so alone in the space of about 2 hours.

---

The scenario for the project was a library website, where a user could create an account, login to their account, see what books they have checked out, and change which books they have checked out.

The project had the following requirements:
* Create a MySQL database (starting contents were given in a .sql file)
* Build a registration page with the following requirements:
  * After filling data, the client is saved in the database (client database). The client will enter to dashboard page
  * The password should be encrypted before inserting
  * Login link to login.php page
* Build a login page with the following requirements:
  * Enter a username and password, check if exists in the client table. If correct, the client will enter the dashboard page
  * 'Click to Register' link to register page
* Build a dashboard page with the following requirements:
  * The username should be shown on the top of the page
  * A client cannot access the dashboard without login or register
  * A 'Logout' link that returns to the login page
  * The list of all books not rented yet which should be shown in a multiple select list
    * For each option of the books list, you have to show the book title, author name and the price
  * The ability to select books in the list to add/remove them from the list of checked out books
    * The status of the book should be modified within the database (in multiple tables)
    * If nothing was selected, there should be an appropriate error message
  * After the list of books is modified, the changes should be displayed to the user.

Validation/sanitization techniques were not required for this project, although encryption of credentials was.
