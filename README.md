<center>7 php Nikita</center>
===
-----
<center>Website with designed with MVC</center>
---
-----
### <center>Environment:</center>
- minimal PHP version is 7.3.33
- mysql 5.7.37


### <center>How to use</center>
- first of all you need to install php, use this commands on terminal:


>sudo add-apt-repository ppa:ondrej/php <br> <br>
>sudo apt update <br> <br>
>sudo apt-get install php7.3 php7.3-bz2 php7.3-common php7.3-cgi php7.3-cli php7.3-dba php7.3-dev libphp7.3-embed php7.3-bcmath php7.3-gmp php7.3-fpm php7.3-mysql php7.3-tidy php7.3-sqlite3 php7.3-json php7.3-sybase php7.3-curl php7.3-ldap php7.3-phpdbg php7.3-imap php7.3-xml php7.3-xsl php7.3-intl php7.3-zip php7.3-odbc php7.3-mbstring php7.3-readline php7.3-gd php7.3-interbase php7.3-xmlrpc php7.3-snmp php7.3-soap php7.3-pspell


- clone this repository with:
>git clone https://git.lachestry.tech/education/dev-interns-2022/mvc-nikita.git
>
- configure `.env.sample` file with needful fields and then rename to it `.env`
- run on terminal `composer install` and `-S localhost:8000`


-----
### <center>The task of project:
Create an extensible web service that will interact with the database and process requests dynamically


---
### <center>General pages:
#### Mainpage - contains welcome words and navigation tabs

#### Products - contains a list of products and (will contain an add to cart)

#### Storage - contains a list of warehouses with a map

#### Category - contains a list with product categories

#### Client - contains a list of clients with information

#### Order - order receipt, will contain a basket with added goods

---

### <center>Folders:
#### App - application main folder. It contains all the logic of the program
has the following folders:

- `/Blocks` - the set of classes responsible for rendering the visualization


- `/Controllers` - a set of classes responsible for linking models and their views


- `/Models` - a set of classes that is responsible for the operation of the business logic of the service and interaction with the database. Also contains a local configuration handling class


- `/Router` - ensures dynamic operation of the service


- `/Environment` - class created to process the configuration file


- `/Resource` - group of classes that interact with the database


- `/views` - responsible for displaying model data to the user, reacting to model changes


- `/styles` - style sheet for views

---

### <center>General classes:
#### Router - the class responsible for dynamically determining the controller type

>>receives an input uri and processes it

#### AbstractController` - parent class for controllers that defines a single method and basic operations

>>the abstract render method of the corresponding template
> 
>> basic methods for determining the type of request, getting data and redirecting to the desired page

#### -Block - group of classes designed for correct and strict rendering of templates

>> contains a field with the corresponding template

#### Model - provides encapsulation for models

>> defines getters and setters for interacting with models


#### HandlerResourceModel - the parent class for resource models, like child classes, performs the tasks of deleting / changing / and displaying information from the database

>> contains the most common solutions for the required tasks


#### Database - Makes a connection to the database

>> pdo extension is used to connect
