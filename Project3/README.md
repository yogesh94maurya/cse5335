<center>
<h1>Programming Assignment 3<br>
Web Mashup: Display House Prices on a Map</h1>
</center>
<hr>
<h2>Description</h2>
<p>
The goal of this project is to create a web mashup
that combines two web services: Google Maps and the Zillow API,
using JavaScript and AJAX. When you click on a house on the map,
your application will display the postal address and the estimated price of the house.
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
<h2>Platform</h2>
<p>
As in Project #2, you will develop this project on your PC/laptop using XAMPP.
Download the project3 zipped directory <a href="project3.zip">project3.zip</a>.
Unarchive the files inside your web server document root directory.
The project3 directory contains 3
files: <tt>proxy.php</tt>, <tt>map.html</tt>, and <tt>map.js</tt>.  As
in project #2 you should not change <tt>proxy.php</tt>.  All the web
service requests to zillow.com should go through this proxy. See the
example in <tt>map.js</tt>.  Your project is to edit <tt>map.html</tt>
and <tt>map.js</tt> as explained in the description of the web
application.
</p>
<h2>Web Services used by the Web Mashup</h2>
<p>
For this project, you will use the
</p><ul>
<li><a href="http://www.zillow.com/howto/api/APIOverview.htm" target="_top">Real Estate API</a> from the Zillow API (more specifically, GetSearchResults)
</li><li><a href="http://code.google.com/apis/maps/documentation/javascript/geocoding.html" target="_top">Geocoding and Reverse Geocoding</a> from the
<a href="https://developers.google.com/maps/documentation/javascript/tutorial" target="_top">Google Maps JavaScript API</a>
</li><li><a href="https://developers.google.com/maps/documentation/javascript/markers" target="_top">Google Map Markers</a>
</li></ul>
To use <a href="https://developers.google.com/maps/documentation/javascript/tutorial" target="_top">Google Maps</a>, you need to get an <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_top">API key</a> (you will need to login using your google account).
To use the Zillow API, you need to register and obtain a web service ID from
<a href="http://www.zillow.com/webservice/Registration.htm" target="_top">Zillow Web Services ID (ZWSID)</a>.
After you get the twp API keys, you put them in <tt>map.html</tt> and <tt>map.js</tt> (replace ???? with your keys), you start your XAMPP web server, and you
test your setup on your web browser by using the URL address
<a href="http://localhost/project3/map.html" target="_top">http://localhost/project3/map.html</a>
and by typing the address of some existing house (example: 904 Austin St, Arlington, TX 76012).
It will display the estimated value of this house (empty if the address is invalid).
<p>
</p><h2>Project Description</h2>
<p>
You need to edit the HTML file <tt>map.html</tt> and the JavaScript file <tt>map.js</tt>.
Your HTML web page must have 3 sections: 
</p><ol>
<li>a text input with two buttons: Find and Clear.</li>
<li>a Google map of size 600*500 pixels, initially centered at (32.75, -97.13) with zoom level 17</li>
<li>a text display area</li>
</ol>
<p></p>
<p>
Your program must insert an overlay marker on the Google
map pinned on the latest house that displays the house's
postal address and its Zestimate value (the house value) from
zillow.com. The text display area is the history log that 
displays all the houses (addresses and prices) that you have found so far (latest hous is last).
Each time you find a house, you erase the old marker from the map (if any),
you display a new marker on the map on the house location (with address and price),
and you append this information to the display area.
There are two ways to find a house:
</p><ol>
<li>by providing a valid postal address, say "904 Austin St, Arlington, TX 76012",
in the text input and you push the Find button.</li>
<li>by clicking on a house on the map.</li>
</ol>
To implement the first way, you need to get the address from the text input
and send an asynchronous request to the Zillow API
(<a href="http://www.zillow.com/howto/api/GetSearchResults.htm" target="_top">GetSearchResults API</a>)
to retrieve the Zestimate (in $), which is the estimated home value of the house at that address.
The address used by the GetSearchResults API must have two components: address and
citystatezip. This means that you must use JavaScript code to break
the address string from the input text area into these two strings.  
Then you clear the old marker and insert a new overlay marker on the map at
the latitude and longitude of this postal address, using
<a href="http://code.google.com/apis/maps/documentation/javascript/geocoding.html" target="_top">Geocoding</a>.
To implement the second way, when you click on the map,
your program must find the address of the point you clicked (using
<a href="http://code.google.com/apis/maps/documentation/javascript/geocoding.html#ReverseGeocoding" target="_top">Reverse Geocoding</a>)
and must send an asynchronous request to the Zillow API
(<a href="http://www.zillow.com/howto/api/GetSearchResults.htm">GetSearchResults API</a>)
to retrieve the Zestimate (in $), which is the estimated home
value of the house at that address. The you do the same as the first way.
<p></p>
<p>
Note that the call to the GetSearchResults API must be done using
Ajax: inside the callback function (the listener for the left click)
of the map, you should create an Ajax request that calls the
GetSearchResults API. When the result arrives (this is the callback of
the Ajax request), you extract the Zestimate and you display a new overlay marker on the
map at the point you clicked.  The overlay marker must display the
house postal address and its Zestimate.  The same information must be
appended at the end of the text display area (third section).  
Note also that the map must
display at most one marker and the text display area may
contain multiple addresses/zestimates. 
If it is an invalid address or there is no Zestimate value, you don't change anything.
Finally, the Clear button clears the text input only.
</p>
Hints:
<ul>
<li>How to URL-encode the address to send it to zillow: use the
method <tt>encodeURI(address)</tt>.</li>
<li>How to extract the Zestimate value from the zillow XML response: use the
method <tt>getElementsByTagName('amount')</tt>.</li>
</ul>
<p>
Note that everything should be done asynchronously and your web page
should never be redrawn completely. You need only one XMLHttpRequest object for sending a
request to Zillow, since Google Maps is already asynchronous.
</p>
