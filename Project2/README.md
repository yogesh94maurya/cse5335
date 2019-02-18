<center>
<h1>Programming Assignment 2<br>
A Music Web Application</h1>
</center>
<hr>
<h2>Description</h2>
<p>
This project must be done individually. No copying is permitted. The
goal of this project is to learn client-side web programming using
JavaScript and AJAX.  More specifically, you will create 
a Web application that displays information about music artists.
</p>
This project must be done individually. No copying is permitted. 
<b>Note: We will use a system for detecting software plagiarism, called
<a href="http://theory.stanford.edu/~aiken/moss/" target="_top">Moss</a>,
which is an automatic system for determining the similarity of programs.</b>
That is, your program will be compared with the programs of the other students in class
as well as with the programs submitted in previous years. This program will find
similarities even if you rename variables, move code, change code structure, etc.
<p></p>
<p>
Note that, if you use a Search Engine to find similar programs on the web, we will find these programs too.
So don't do it because you will get caught and you will get an F in the course (this is cheating).
Don't look for code to use for your project on the web or from other students (current or past).
Just do your project alone using the help given in this project description and from your instructor and GTA only.
Finally, you should not post your code nor deploy your project on a public web site.
</p>
<h2>Platform</h2>
<p>
You will do this project on your own PC/laptop.
You need to install the <a href="https://www.apachefriends.org/" target="_top">XAMPP</a> web server,
which includes the Apache http web server, PHP, MySQL (MariaDB), and PHPMyAdmin (these are the only components you need).
It's about 125MBs (775MBs after installation) and can be installed on Windows, Linux, and OS X.
The installation directory is <tt>\xampp</tt> for Windows, <tt>/opt/lampp</tt> for Linux, and <tt>/Applications/XAMPP</tt> for OS X.
To start the server on Windows, you run <tt>\xampp\xampp-control.exe</tt> and you start the Apache web server.
You may have to change the Security properties of this executable to Full Control for Users.
You will test the project on your PC/laptop using the Mozilla Firefox web browser.
The project grading will be done on a Firefox browser.
</p>
<h2>Setting up your project</h2>
<p>
Download the project2 zip file <a href="project2.zip">project2.zip</a>. Unzip it inside your web server document root directory (ie, inside the <tt>htdocs</tt> sub-directory in the XAMPP instalation directory). On Linux, you may have to do this as the root user.
</p>
<p>
The project2 directory contains 3 files: <tt>proxy.php</tt>, <tt>music.html</tt>, and <tt>music.js</tt>.
The proxy script <tt>proxy.php</tt> is used to
avoid the cross-domain restriction when using Ajax. All the web service requests to Last.Fm
should go through this proxy. See the example in <tt>music.js</tt>.
Your project is to edit <tt>music.html</tt> and <tt>music.js</tt> as described in the description of the web application.
</p>
<h2>Getting an access key from Last.fm</h2>
<p>
You are going to use the Web Service REST API of the music application <a href="http://www.last.fm/" target="_top">Last.fm</a>.
You first need to get an API access key from
<a href="http://www.last.fm/api/account/create" target="_top">Get an API Account at Last.fm</a>.
The access key will allow you to send web service requests to Last.fm (maximum 1 request per second).
</p><p>
After you get the API key, you put it in <tt>music.js</tt> and you
test your setup on your web browser by using the URL address:<br>
<a href="http://localhost/project2/music.html" target="_top">http://localhost/project2/music.html</a><br>
and by typing the name of your favorite singer/band.
This will display information about the singer in JSON form.
</p>
<p></p>
<h2>Documentation</h2>
<p>
The following web pages contain various tutorials. Use them as a
reference only. The class slides contain enough information on
JavaScript and AJAX.
</p><ul>
<li> <a href="http://www.last.fm/api/rest" target="_top">Last.fm Web Services: REST Requests</a> (especially the JSON responses)</li>
<li> <a href="http://www.w3schools.com/js/js_ajax_intro.asp" target="_top">AJAX Tutorial</a></li>
<li> <a href="http://www.cs.rochester.edu/courses/210/spring2011/lectures/012/" target="_top">Ajax</a></li>
</ul>
<p></p>
<h2>Description of the Web Application</h2>
<p>
Your project is to develop a web application to get information about music artists, their albums, etc.
This application should be developed using plain JavaScript and Ajax.
You should not use any JavaScript library, such as JQuery.
The Ajax requests should return JSON, not XML.
Note that everything should be done asynchronously and your web page should never be redrawn/refreshed completely.
This means that the buttons or any other input element in your HTML forms must have JavaScript actions,
and should not be regular HTTP requests.
</p>
<p>
Your application should have a text window where one can type the artist name (eg, The Beatles).
It should display the artist name, a link to the Last.fm web page of the artist, information about the artist (including a long biography), their picture (large),
a list of their top albums (titles &amp; pictures), and a list of names of similar artists.
You need to use the following Last.fm methods:
</p><ul>
<li><a href="http://www.last.fm/api/show/artist.getInfo" target="_top">Get the metadata for an artist, including biography</a></li>
<li><a href="http://www.last.fm/api/show/artist.getTopAlbums" target="_top">Get the top albums for an artist</a></li>
<li><a href="http://www.last.fm/api/show/artist.getSimilar" target="_top">Get all the artists similar to this artist</a></li>
</ul>
You may assume that the person who uses this application will type the correct complete name
of the artist. So you don't have to check for errors. For example, if someone types "Beatles" instead
of "The Beatles", it will be an error, but you don't need to check for such errors.
<p>
Note that there is a lot of information returned by these web services. You don't need to use them all.
Just use some of them.
</p>
<p></p>
