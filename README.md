# How to install and use

+ Create a database (called yellow)
    - Set database encoding to utf-8
+ Import db.sql using phpmyadmin
+ Edit settings at **config.php** and set necessary values
    ````php
    $config = array(
        'db_dsn' => 'mysql:host=localhost;port=8889;dbname=yellow',
        'db_user' => 'root',
        'db_pass' => 'root'
    );
    ````
+ Create a directory called **yellow** at document root and copy project into it

# Components
This project uses
+ PHP
    + PHP FatFree minimalistic framework <http://bcosca.github.com/fatfree/>;
    + Twig template engine to render output and separate application logic and presentation logic
+ Client side
    + RequireJS to load and manage client side application logic <http://requirejs.org/>;
    + Twitter Bootstrap responsive css framework <http://twitter.github.com/bootstrap>;
    + UnderscoreJS used to render the ajax request results into a client side template <http://underscorejs.org/>
    + JQuery the popular JS tooling to simplify DOM traversing <http://jquery.com/>