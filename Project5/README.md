<center>
<h1>Programming Assignment 5<br>
A Message Board using PHP and MySQL</h1>
</center>
<hr>
<h2>Description</h2>
<p>
The goal of this project is to 
learn server-side web programming using PHP and a relational database system (MySQL).
More specifically, you will create a message board
where registered users can post messages.
</p>
<p>
This project must be done individually. No copying is permitted. 
<b>Note: We will use a system for detecting software plagiarism, called
<a href="http://theory.stanford.edu/~aiken/moss/" target="_top">Moss</a>,
which is an automatic system for determining the similarity of programs.</b>
That is, your program will be compared with the programs of the other students in class
as well as with the programs submitted in previous years.
</p>
<p>
Note that, if you use a Search Engine to find similar programs on the web, we will find these programs too.
So don't do it because you will get caught and you will get an F in the course (this is cheating).
Don't look for code to use for your project on the web or from other students (current or past).
Just do your project alone using the help given in this project description and from your instructor and GTA only.
Finally, you should not post your code nor deploy your project on a public web site.
</p>
<p></p><h2>Platform</h2>
<p>
As in the previous projects, you will develop this project on your PC/laptop using XAMPP
and you will test it using using your Mozilla Firefox web browser.
Download <a href="project5.zip">project5.zip</a> and unarchive the files inside your web server document root directory.
The project5 directory contains the file <tt>createDB.sql</tt>, which 
contains the SQL description of the tables: users and posts, that have the following schema:
</p><pre>users ( username, password, fullname, email )
posts ( id, replyto, postedby, datetime, message )
</pre>
Primary keys: <tt>users.username</tt> and <tt>posts.id</tt>.<br>
Foreign keys: <tt>posts.postedby-&gt;users.username</tt> and
<tt>posts.replyto-&gt;posts.id</tt>.<br>
To create the database, start the Apache Web Server and the MySQL Database on your PC using
the XAMPP manager console. Run
<a href="http://localhost/phpmyadmin/" target="_top">phpMyAdmin</a> on your browser,
create a new database with name <tt>board</tt> by clicking on New.
After you create it,
select this database (under the name <tt>board</tt>), go to the SQL tab, and cut and paste the SQL code in  <tt>createDB.sql</tt> and push Go.
This will create your schema.
You can test your setup on your web browser by using the URL address
<a href="http://localhost/project5/board.php" target="_top">http://localhost/project5/board.php</a>
<p></p>
<p>
The project5 directory contains the file <tt>board.php</tt> that
uses the PDO extension of PHP to
insert a new user and to query the users table using MySQL.
</p>
<h2>Documentation</h2>
<p>
Please read
<a href="http://php.net/manual/en/intro.pdo.php" target="_top">The PHP Data Objects (PDO) extension</a>, especially
the <a href="http://www.php.net/manual/en/class.pdo.php" target="_top">PDO class</a>.
</p>
<h2>Project Requirements</h2>
<p>
You need to write two PHP scrips <tt>login.php</tt> and <tt>board.php</tt>.
The <tt>login.php</tt> script generates a form that has two text windows for username and password and a "Login" button.
The <tt>board.php</tt> has a "Logout" button, a textarea to write a message, 
a "New Post" button, and a list of messages.
The board script prints all the messages in the database as a flat list ordered by date/time (newest first, oldest last).
Note: messages should not be organized based on their replyto attributes.
For each posted message, it prints:
</p><ul>
<li> The message ID.
</li><li> The username and the fullname of the person who posted the message.
</li><li> The date and time when this message was posted.
</li><li> If this is a reply to a message, the ID of this message.
</li><li> The message text.
</li><li> A button "Reply" to reply to this message.
</li></ul>
From the login script,
if the user enters a wrong username/password and pushes "Login", it should go to the login script again.
If the user enters a correct username/password and pushes "Login", it should go to the board script.
From the board script, if the user pushes "Logout", it should logout and go to the login script.
The board script must always make sure that only authorized used (users who have logged-in properly) can
view and post messages.
From the board script, if the user fills out the textarea and pushes the "New Post" button,
it will insert the new message in the database (with null replyto attribute)
and will go to the board script again. If the user fills out the textarea and pushes the "Reply" button,
it will insert the message in the database -- but this time you need to set the replyto value,
and will go to the board script again. 
<p></p>
<p>
Hints: 
Each Reply button must have an action that submits the form to board.php with a different replyto value.
You may use a <a href="http://www.w3schools.com/tags/tag_button.asp" target="_top">form button</a>
with type="submit" and formaction="board.php?replyto=12345" to reply to a message with ID 12345.<br>
Use <a href="http://us2.php.net/manual/en/function.md5.php" target="_top">md5</a> to encode passwords in PHP.
Use <a href="http://php.net/manual/en/function.uniqid.php" target="_top">uniqid</a> to generate a unique id in PHP.
Use the MySQL function <a href="http://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html" target="_top">now()</a> to return the current date and time.
</p>
