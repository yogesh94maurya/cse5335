<center>
<h1>Programming Assignment 8<br>
Using Cloud Storage</h1>
</center>
<p>
</p><hr>
<p>
</p><h2>Description</h2>
<p>
</p><p>
The goal of this project is to 
develop a photo-album application that uses cloud storage.
More specifically, you will use the Dropbox API
to create a photo album, in which you can upload, delete, and browse photographs. 
</p><p>
This project must be done individually. No copying is permitted. 
<b>Note: We will use a system for detecting software plagiarism, called
<a href="http://theory.stanford.edu/~aiken/moss/" target="_top">Moss</a>,
which is an automatic system for determining
the similarity of programs.</b>  That is, your program will be
compared with the programs of the other students in class as well as
with the programs submitted in previous years. This program will find
similarities even if you rename variables, move code, change code
structure, etc.
</p>
<p>
Note that, if you use a Search Engine to find similar programs on the
web, we will find these programs too. So don't do it because you will
get caught and you will get an F in the course (this is
cheating). Don't look for code to use for your project on the web or
from other students (current or past). Just do your project alone using the help
given in this project description and from your instructor and GTA
only.
</p><p>
</p><h2>Platform</h2>
<p>
You will develop this project on your PC/laptop using XAMPP
and you will test it using using your Mozilla Firefox web browser.
Download <a href="project8.zip">project8.zip</a> and unarchive the files inside your web server document root directory.<br>
<b>Note (11/30/2017):</b> There is a new project8.zip file now that works correctly with the new Dropbox API.
</p>
<h2>Documentation</h2>
<p>
This project must be done in PHP. Please look at Project 3 for links to PHP tutorials. 
Your scripts must use the <a href="https://www.dropbox.com/developers/apps" target="_top">Dropbox API</a>
to upload, delete, and retrieve photographs, and the PHP library
<a href="http://fabi.me/en/php-projects/dropphp-dropbox-api-client/" target="_top">DropPHP</a>.
You will first need to <a href="https://www.dropbox.com/developers/apps" target="_top">create a Dropbox account</a> and a Dropbox API app with both Files and datastores, which will have the App name: cse5335_xyz1234, where xyz1234 is your NetID.
Steps: go to <a href="https://www.dropbox.com/developers/apps">My apps</a> and push "Create app".
Select "Dropbox API" and "App folder", and name your app "cse5335_xyz1234", where xyz1234 is your NetID.
In the settings, add the URL <tt>https://localhost/project8/sample.php?auth_redirect=1</tt> in the Redirect URIs part.
You also need to add album.php link too later. This page also gives you the App key and App secret (hidden).
Then, edit the file <tt>project8/sample.php</tt> and set the <tt>app_key</tt> and <tt>app_secret</tt>
to your Dropbox API key and secret. 
You can test your setup on your web browser by using the URL address
<a href="http://localhost/project8/sample.php" target="_top">http://localhost/project8/sample.php</a><br>
Look at the code in <tt>sample.php</tt>; your <tt>album.php</tt> must have a similar authentication.
</p><p>
</p><h2>Project Requirements</h2>
<p>
You will develop a trivial photo-album application on Dropbox.
Your task is to modify your <tt>album.php</tt> script in your <tt>project8</tt> directory
to support the following operations:
</p><ul>
<li> Provide a form to upload a new image (a *.jpg). Look at the class slides for a PHP example that handles uploads.
</li><li> A display window that lists the names of the images in your dropbox directory. For each image name you have
a link that, when you click it, it downloads and displays the image in the image section.
Each image name also has a button to delete this image from the dropbox storage.
</li><li> An image section that displays the current image. You can change the image by changing the
src attribute value of the <tt>&lt;img ...&gt;</tt> element (you don't need Ajax; you just need to generate javascript from your album.php).
</li></ul>
Note that the images that you display/delete are those stored in your cse5335_xyz1234 dropbox directory. You should not display any local images.
<p>
