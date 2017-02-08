---------------------------------------------------------------------------------------------------------------------------
#Music Library Application
---------------------------------------------------------------------------------------------------------------------------
Music library is a common use case in our day today life to search our favorite songs. 
This app is intended to mimic a professional online music streaming website. 
It falls in between personnel music library and an online music streaming service. 
Be it artist based selection, or composer based, movie based or create and edit playlist, organizing the songs into a library helps us to achieve this goal faster.Options are provided with respect to both administrator and users’ perspective. I also recorded the user’s history and the songs liked by the user. 

----------------------------------------------------------------------------------------------------------------------------
####Components
----------------------------------------------------------------------------------------------------------------------------
##### 1.Web App Code (PHP,Javascript,HTML)
	1.1 LoginPage.php 
	1.2 NewUserRegister.php
	1.3 MusicLibrary_user.php
	1.4 MusicLibrary_admin.php
	1.5 actions_ajax.php
	1.6 Logout.php	
	1.7 LibraryStylesheet.css
	1.8 loginStyleSheet.css
##### 2. DB Back end code(MySQL)
  2.1 MusicLibrary-Implementation-Queries.sql - contains queries of all functionalities implemented.
  2.2 Group13_DBSchema_DataLoad.sql- contains Schema structure and data
  
---------------------------------------------------------------------------------------------------------------------------
####How to run
----------------------------------------------------------------------------------------------------------------------------
- Import the SQL script(Group13_DBSchema_DataLoad.sql) that has schema structure and data to create the schema and load data into all tables.
- The php code can be run using any PHP server like Microsoft Webmatrix,  WampServer etc.
- Replace the parameters in connectDB() function with mysqlserver name,username,password and database name.
- Start with the LoginPage.php to execute the code. (Refer the front end flow in code flow in the folder).
