<center>
<h1>Programming Assignment 6<br>
Using XPath and XSLT
</h1>
</center>
<p>
</p><hr>
<p>
</p><h2>Description</h2>
<p>
The goal of this project is to learn XPath and XSLT to query XML data.
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
<p>
</p><h2>Platform</h2>
<p>
You will do this project on your own PC/laptop. You may use a text editor to develop your Java programs
but you may use an IDE, such as Eclipse or Netbeans, if you want.
</p>
<p>
Here are some examples:
</p><ul>
<li> <a href="examples/xpath.java">Using XPath in Java</a>
</li><li> <a href="examples/xslt-example.xsl">An XSLT transformation</a>
</li><li> <a href="examples/xslt.java">Using XSLT in Java</a>
</li><li> <a href="examples/cs.xml">The cs.xml XML document used in Java</a><a>
</a></li></ul><a>

<p></p>
<h2>Documentation</h2>
<p>
The following web pages provide some tutorials. Use them as a reference only. 
</p></a><ul><a>
</a><li><a> </a><a href="http://www.zvon.org/xxl/XPathTutorial/General/examples.html" target="_top">XPath Tutorial</a>
</li><li> <a href="http://www.w3schools.com/xml/xpath_intro.asp" target="_top">Another XPath Tutorial</a>
</li><li> <a href="http://java.sun.com/javase/6/docs/api/javax/xml/xpath/package-summary.html" target="_top">Java API for javax.xml.xpath</a>
</li><li> <a href="http://www.w3schools.com/xml/xsl_intro.asp" target="_top">XSLT Tutorial</a>
</li><li> <a href="http://www.zvon.org/xxl/XSLTutorial/Output/contents.html" target="_top">Another XSLT tutorial</a>
</li><li> <a href="http://www.ibiblio.org/xml/books/bible2/chapters/ch17.html" target="_top">XSL Transformations (by XML Bible)</a>
</li></ul>
<p></p>
<h2>Project Requirements</h2>
<p>
</p><ol>
<li>Download the file <a href="examples/xpath.java">xpath.java</a> and edit it to include the following XPath queries.
First, download the following XML document along with its DTD that describes journal articles:
<ul>
<li> <a href="SigmodRecord.xml">SigmodRecord.xml</a>.
</li><li> <a href="SigmodRecord.dtd">SigmodRecord.dtd</a> (the DTD of the document).
</li></ul>
Note: the links are NOT broken. Just right click and use "Save Link As" to save the XML and DTD files on your PC.
<p></p>
<p>
Insert XPath queries in <tt>xpath.java</tt> that answer the following:
</p><ol>
<li> Print the titles of all articles whose one of the authors is David Maier.
</li><li> Print the titles of all articles whose first author is David Maier.
</li><li> Print the titles of all articles whose authors include David Maier and Stanley B. Zdonik. 
</li><li> Print the titles of all articles in volume 19/number 2.
</li><li> Print the titles and the init/end pages of all articles in volume 19/number 2 whose authors include Jim Gray.
</li><li> Print the volume and number of all articles whose authors include David Maier.
(note: we need the number entry of an article, not the number of articles).
</li></ol>
</li><li> Consider the following XML document along with its DTD that describes recipes:
<ul>
<li> <a href="recipes.xml">recipes.xml</a>
</li><li> <a href="recipes.dtd">recipes.dtd</a>
</li></ul>
Write an XSLT program <tt>recipe.xsl</tt> to display the recipes nicely on a web browser. The XSLT should generate HTML code. You should display
all data except the related elements.
Use the Java program <a href="examples/xslt.java">xslt.java</a> to test your XSLT and then load
the resulting html output file on your web browser.
</li></ol>
