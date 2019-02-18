<center>
<h1>Programming Assignment #7<br>
Using XQuery
</h1>
</center>
<hr>
<h2>Description</h2>
<p>
The purpose of this project is to learn XQuery.
</p>
<p>
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
</p>
<h2>Platform</h2>
<p>
You will do this project on your own PC/laptop.
You will use Zorba, which is a free implementation of XQuery.
</p><ul>
  <li><a href="http://www.zorba.io/download" target="_top">Download Zorba</a>. It provides binaries for Windows, Linux, and Mac OS. The link on this site is broken; use the following link to install <a href="https://github.com/zorba-processor/zorba/releases" target="_top">https://github.com/zorba-processor/zorba/releases</a>.
On Mac, for example, after you install it, you may run it using <tt>/opt/local/bin/zorba</tt>.
</li></ul>
Put all XQueries in a file "queries.xq" and use the
<a href="http://www.zorba.io/documentation/latest/zorba/cli/" target="_top">Zorba Command Line Utility</a> to evaluate the XQueries.
<p>
Note: 
If you get the error message on Windows: "The program can not start because libiconv.dll is missing from your computer. Try reinstalling the program to fix the problem",
rename the iconv.dll library in the bin folder to libiconv.dll.
</p><p>
</p><h2>Documentation</h2>
<p>
The following provide some tutorials. Use them as a reference only. 
</p><ul>
<li> <a href="http://www.zorba.io/documentation/latest" target="_top">Zorba 3.0 Documentation</a>
</li><li> <a href="http://lambda.uta.edu/cse5335/spring13/sigmod03_xquery.pdf" target="_top">XQuery: A Query Language for XML</a>
</li><li> <a href="http://lambda.uta.edu/cse5335/spring13/Katz_xquery.pdf" target="_top">XQuery: A Guided Tour</a>
</li></ul>
<p></p>
<p></p><h2>Project Requirements</h2>
<p>
Consider the following XML document along with its DTD that describes auctions:
</p><pre><a href="auction.zip">auction.zip</a> (the zipped XML document)
</pre>
It contains synthetic data (automatically generated).
The words for text paragraphs are taken from Shakespeare's plays.
There is also a <a href="auction.dtd">DTD</a>
 (the link is not broken; use Save As to save it) for the XML file but it is not very useful.
Express the following queries using XQuery and run them against the file <tt>auction.xml</tt> using Zorba:
<ol>
<li> Print the number of items listed on all continents.
</li><li> List the names of items registered in Europe along with their descriptions.
</li><li> List the names of persons and the number of items they bought.
</li><li> List all persons according to their interest (ie, for each interest category, display the persons on that category).
</li><li> Group persons by their categories of interest and output the size of each group.
</li><li> List the names of persons and the names of the items they bought in Europe.
</li><li> Give an alphabetically ordered list of all items along with their location.
</li><li> List the reserve prices of those open auctions where a
certain person with id person3 issued a bid before another person with
id person6. (Here before means "listed before in the XML document", that is, before in document order.)
</li></ol>
<p>
</p><h2>What to Submit</h2>
<p>
Use the form below to submit your XQuery file (or you may zip all XQuery files and submit the zipped file).
</p>
