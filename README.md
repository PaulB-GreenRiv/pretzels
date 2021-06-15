# pretzels
This site allows users to remotely order Stuffed, Bitesize or Regular pretzels. To order, a user fills out a simple form describing what pretzels they want, and another form for delivery info, orders can be viewed by name or by order on our search page.

## Authors
- **Yurii Zhuk** - Co-Founder/Developer
- **Paul Butler** - Co-Founder/Developer

## Requirements

:heavy_check_mark: 1. Separates all database/business logic using the MVC pattern.
  * Includes Classes for model, view and controller (Controller is in the classes folder)

:heavy_check_mark: 2. Routes all URLs and leverages a templating language using the Fat-Free framework.
  * The controller class reroutes the view to other pages using Fat-Free

:heavy_check_mark: 3. Has a clearly defined database layer using PDO and prepared statements. You should have at least two related tables.
  * In the data-layer file, PDO is used to insert and grab customer, order and pretzel data from a database

:heavy_check_mark: 4. Data can be viewed and added.
  * New orders are input into the database when ordering on the site

:heavy_check_mark: 5. Has a history of commits from both team members to a Git repository. Commits are clearly commented.
  * Nearly 80 commits were made from the two collaborators

:heavy_check_mark: 6. Uses OOP, and defines multiple classes, including at least one inheritance relationship.
  * Utilizes a customer class, and a Pretzel class with two child classes (Stuffed and Bitesize)

:heavy_check_mark: 7. Contains full Docblocks for all PHP files and follows PEAR standards.
  * PHP Code Contains Docblocks 
  * Complies with PEAR standards

:heavy_check_mark: 8. Has full validation on the client side through JavaScript and server side through PHP.
  * Utilizes server side validation for the pretzel and customer forms

:heavy_check_mark: 9. All code is clean, clear, and well-commented. DRY (Don't Repeat Yourself) is practiced.
  * Fully commented code

:heavy_check_mark: 10. Your submission shows adequate effort for a final project in a full-stack web development course.
  * Our site incorporates everything that wasn't newly introduced within the last week of class

:heavy_check_mark: 11. BONUS:  Incorporates Ajax that access data from a JSON file, PHP script, or API. If you implement Ajax, be sure to include how you did so in your readme file.
  * Our site doesn't incorporate Ajax

## UML Class Diagram
![Class Diagram - Paul Butler](https://github.com/PaulB-GreenRiv/pretzels/blob/33d8079ebf58b43b97524fa2fa5d3a241df90b07/UMLDiagram.png)

## ER Database Diagram
![Database Diagram - Yurii Zhuk](https://github.com/PaulB-GreenRiv/pretzels/blob/33d8079ebf58b43b97524fa2fa5d3a241df90b07/DatabaseDiagram.PNG)





