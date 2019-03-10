ICS 325-01 Spring 2019 - Assignment 6
=========================

Purpose
-------
* Learn how cookies and PHP sessions work.
* Use PHP sessions as part of a simple PHP program.
* Use twig to render the HTML output from a PHP program.
* Review the basics of using HTML forms and PHP together
* Review how to embed PHP in HTML

Resources and Examples
----------------------
* Chapter 22 in the book.
* The official twig [documentation](http://twig.sensiolabs.org/documentation).
* Some twig examples [http://twigfiddle.com/pr3mk1](http://twigfiddle.com/pr3mk1).
* The official PHP.net [documentation](http://php.net/manual/en/features.cookies.php) for cookies in PHP.
* The official PHP.net [documentation](http://php.net/manual/en/features.sessions.php) for sessions in PHP.
* w3schools.com has a good basic overview of HTML forms [here](http://www.w3schools.com/html/html_forms.asp).

Collaboration
-------------
You can work with 1 or 2 other students on this assignment.  Make sure to mention who you worked with when you submit your assignment in D2L.

Prerequisites
-------------
Use git to clone your assignment 6 repo to your computer.  Then in PhpStorm, use `File->Open Directory` and select your local repo.

Instructions
------------
### Instructions to set up the code to run
First you need to clone your git repository to your computer.  Open GitKraken and make sure you are logged into your github.com account.  Next go to `File->Clone Repo`.  Select the `GitHub.com` icon.  A list of your repositories in github.com should pop up.  Select your assignment 6 repo.  If you want, change `Where to clone to` by clicking browser and selecting a folder for your git repo to be cloned into.  Finally, hit the `Clone the repo!` button.  The repo should now clone to your computer.

Next you need to set up PhpStorm.  We will be using the built-in PHP CGI server for this assignment.  To do so, first make sure you have the git repo open in PhpStorm by using the Open Directory menu item under File in PhpStorm (`File->Open Directory`).  Next go to `Run->Edit Configurations...` Click the green `+` to create a new configuration.  Select `PHP Built-in Web Server`.  Change the name to `Cookies and Sessions Lab`.  Leave host as `localhost`.  Set the port to `8080`.  Set the `Document root` to your git repo directory by clicking the `...` button next to the field and using the file chooser to select it.  If there is a red ! icon near the bottom right of the window, click the `Fix` button and specify your PHP interpreter.  Once done, click `Ok` to exit the Edit Configurations window.  Next hit the green run button to start the PHP CGI web server.  Then go to your web browser and enter this url [http://localhost:8080/cookies_sessions_example.php](http://localhost:8080/cookies_sessions_example.php).  

The output from  `cookies_sessions_example.php` is broken down into 4 sections:
* Test Cookies and Sessions: Allows you to control the actions taken on cookies and sessions.
* Messages: Reports the action the PHP script took.
* Cookies Sent by Browser: The cookies the browser sent to the PHP script.
* PHP Session Data: The session data the PHP script had access to when it rendered the page.

In addition, there is a link on that page you can use to change the form submission type from POST to GET.

### Things to try (exactly the same as our lab from the class before the mid-term exam)
Open the developer tools built into your web browser and go to the network section.  You will need to look at the request and response headers.  Here are links on how to do that for [Firefox](https://developer.mozilla.org/en-US/docs/Tools/Network_Monitor) and [Chrome](http://stackoverflow.com/questions/4423061/view-http-headers-in-google-chrome).

Then go through the following steps:
1.  With the developer network tools open, fill in:
  * First Name
  * Last Name
  * Age
  * Gender
  * Select Set Cookie.
2. Hit submit.
3. Look at the response headers.  You should see Set-Cookie= followed by the data you entered.  This is the server telling your web browser to set a cookie.
4. Make sure that Do Nothing is selected for Cookie Action.  Then hit submit.
5. Look at the request headers.  You should see Cookie= followed by the data you entered.  That is your web browser sending the cookie back to the server.

Investigate the following questions by experimenting with the form and/or looking at the source code:
1. Which is available to the PHP script immediately after it is set (within the same running script): cookies or sessions?
2. When the web browser sends a cookie to the PHP script, and the PHP script deletes the cookie, is the original cookie available to the PHP script still?
3. What is the difference between Delete Session and Clear & Delete Session?

Make sure to review the source code as it is commented to explain how it works.  The PHP script can accept both GET and POST requests because it uses the `$_REQUEST` global variable instead of `$_POST` or `$_GET`.  You can experiment with the form using GET instead of POST by clicking on the link on that page that switches the form to using GET (only for the current request, you have to click it every time before you submit the form).  While reviewing the code, pay particular attention to the differences between how cookies are used in the code versus sessions.

### Assignment Work
You need to finish the PHP program that is partially complete.  It has 5 files that have been stubbed out for you:
* `step1_form.html`: The HTML form that sends the user input to PHP.
* `step2_process_form.php`: The PHP script that processes the form and sets the PHP session data.
* `step3_view_session_data.php`: The PHP script the retrieves the stored session data and displays this.
* `step3_view_session_data.twig`: A twig template used to render the HTML output for `step3_view_session_data.php`.
* `delete_session_data.php`: A PHP script that will delete the stored PHP session data.

You need to complete all the files except for `delete_session_data.php`.  Each file starts out working enough that you can go through the whole process and see how it works for First Name.

Once you have your local PHP web server running, you can start by going to this link: [http://localhost:8080/step1_form.html](http://localhost:8080/step1_form.html)

There is a twig example that shows you what you need to know to finish the twig template:
[http://twigfiddle.com/pr3mk1](http://twigfiddle.com/pr3mk1)

To see how to use twig and PHP together, look at the files:
* `twig_example.php`
* `twig_example_template.twig`

Grading
-------
Points|Requirement
------|-----------
3 | `step1_form.html` - add 3 input fields: Last Name, Age, and Favorite Numbers
5 | `step2_process_form.php` - fill in 5 `// your code here` sections
3 | `step3_view_session_data.php` - fill in 3 more session values to pass to twig to render (favorite numbers should be passed as an array)
1 | `step3_view_session_data.twig` - render first name capitalized using a twig filter
2 | `step3_view_session_data.twig` - render last name capitalized using a twig filter
1 | `step3_view_session_data.twig` - render age
2 | `step3_view_session_data.twig` - render favorite numbers separated by commas using a twig filter
4 | `step3_view_session_data.twig` - calculate and render the average of the favorite numbers using twig to do the calculation
5 |  Turn in via github.
**26**| **Total**
