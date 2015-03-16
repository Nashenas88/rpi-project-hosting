# 4/22/09 #
Paul Jin: Unit Test for all test cases
Alex Dan: User Documentation

# 4/15/09 #
Interaction Diagrams
Static Class Diagram

# 4/8/09 #
Meet Sat. to finish Code
All: Finish Test Cases

# 4/1/09 #
Features:

  * All: database query with mysql\_reql\_escape -- done
  * All: form entries sanitized with htmlspecialchars() -- done
  * All: catch errors and display error messages -- done
  * be able to update remotely -- done
  * All: automated unit tests use www.PHPUNIT.de (make test for your own files) -- not done
  * All: comment code -- done
  * All: class diagram, sequence diagrams -- done
  * ## Test Case Specification -- done ##
  * Jin: flag\_comment, rate, remove\_comment, remove\_flag, comment
  * Alex: search, login, logout
  * Dan: upload, download
  * Paul: remove project, moderate, security, about page, terms of service
<br>
<ul><li>Jin and Paul: remove project -- done<br>
</li><li>Dan: terms of service page -- done<br>
</li><li>Paul: Download -- done<br>
</li><li>Jin: change priviledge -- done<br>
</li><li>minimum 1 admin -- done<br>
</li><li>Alex: about page -- done<br>
</li><li>Dan: max 500 in description -- done<br>
</li><li>Dan: max 50 for title -- done<br>
</li><li>Paul: login  -- done<br>
</li><li>Jin: rate 1-5 -- done<br>
</li><li>Apache2 and MYSQL5.0 database -- done<br>
</li><li>use same PHP file for every part of interface -- done<br>
</li><li>max upload size -- done<br>
</li><li>normalize database -- done<br>
</li><li>upload -- done<br>
</li><li>logout -- done<br>
</li><li>search -- done<br>
</li><li>comment -- done<br>
</li><li>moderate ban user -- done<br>
</li><li>moderate unban user -- done<br>
</li><li>flag comment -- done<br>
</li><li>remove flag -- done<br>
</li><li>remove comment -- done<br>
</li><li>rate -- done<br>
</li><li>one rate per user per project -- done<br>
</li><li>use PHP sessions -- done<br>
</li><li>use CAS for login -- done</li></ul>




Interface:<br>
worry later<br>
<br>
project construction:<br>
1.Comment codes<br>
<br>
<br>
<br>
<h1>2/25/09</h1>

Elaboration:<br>
Checked System Sequence Diagram.<br>
Checked Deployment Diagram.<br>
Checked Detailed Schedule.<br>
UseCase already done.<br>
Domain Model Diagram.<br>
Class Diagram<br>
<br>
<br>
Next Week:<br>
Dan: ModerateProject,AdminChangePrivilege,Domain Model<br>
Alex: Put Elaboration<br>
Jin: put User info to databsase, database diagram<br>
Paul: Upload, download.<br>
<br>
<br>
<br>
<h1>2/18/09</h1>

1.make classes:<br>
<br>
<blockquote>classes:</blockquote>

<ul><li>all_user:</li></ul>

<blockquote>variables: RCSID functions: mainPage, download, comment, rate, flag, login, logout, search.</blockquote>

<blockquote>Base on priority make classes:</blockquote>

<ul><li>Moderator:</li></ul>

<blockquote>functions: banUser, unBanUser, removeCommand,removeProject</blockquote>

<ul><li>Admin:</li></ul>

<blockquote>functions: change privilege level</blockquote>

<ul><li>non-rpi-user:</li></ul>

<blockquote>download,search,mainPage</blockquote>

<ul><li>Project:</li></ul>

<blockquote>variables: Title, Description, Size, Date, Project location (link, files), Downloads, Class, uploader, major, school functions: find_comment,cal_rate</blockquote>

2. Elaboration:<br>
<br>
<blockquote>Ask Prof. for opinion about Depolyment diagram, domain model diagram</blockquote>

3. Implementation:<br>
<br>
<blockquote>Jin: Search function: date rating is finished.</blockquote>

<blockquote>Database: add author for project, create database for moderate user and test data.</blockquote>

<blockquote>project's detail page UserComment?,FlagComment?,RemoveComment?. classes.</blockquote>

<blockquote>Alex: sort,ModeratorBan?,ModeratorUnBan?</blockquote>

<blockquote>Paul: UserUp?,UserDown?</blockquote>

<blockquote>Dan: ModerateProject?,AdminChangePrivilege?,finish upload.</blockquote>

4.Best practice<br>
<br>
<blockquote>check out unit test to see which one is best, discuss tmr. (upload to myrpi.org) Bug Tracking System-- google one, discuss tmr.</blockquote>



<h1>2/11/08</h1>

Discuss Inception Deliverable Elaboration Features to Implement by next week<br>
Details<br>
<br>
Inception Deliverable Everybody agree it is done.<br>
<br>
Elaboration Jin: update schedule<br>
<br>
Dan: Model domain diagram<br>
<br>
Paul: System Sequence diagram<br>
<br>
Alex: Deployment diagram<br>
<br>
Features to Implement by next week<br>
<br>
<ul><li>login/logout - Alex & Paul<br>
</li><li>some of search feature + rate, create some data for developing test- Jin<br>
</li><li>Dan learn php, mysql, do ModerateBan??</li></ul>

<h4>BestPractice</h4>
Best Practice needed!!<br>
Introduction<br>
<br>
In the syllabus, I just found we need 2 more items for the best practice: we have:<br>
<br>
<blockquote>project management sites, (google code)</blockquote>

<blockquote>code repository, (google code)</blockquote>

<blockquote>Documented coding standard.</blockquote>

We need 2 more from following<br>
<br>
<blockquote>Build Tools ,</blockquote>

<blockquote>Unit Test Tools ,</blockquote>

<blockquote>Bug Tracking System ,</blockquote>

<blockquote>Design Patterns ,</blockquote>



<h1>2/4/09 MeetingResult</h1>

Review everyone's work assigned, Project Inception: vision statement, UseCases, Glossary, Project Schedule, Project Budget.<br>
<br>
New Assignment:<br>
<br>
Paul: Design basic UI<br>
<br>
Alex: Think about use cases. Learn more php, mysql, see WebSys? link.<br>
<br>
Dan: Revise vision statement. Learn more php, mysql, see WebSys? link.<br>
<br>
Jin: Design database, upload schedule<br>
<br>
WebSys? Link: <a href='http://cgi2.cs.rpi.edu/~hollingd/websys/websys.php'>http://cgi2.cs.rpi.edu/~hollingd/websys/websys.php</a>


<h4>Database</h4>
User: RCSID, Password, Priviledge<br>
<br>
Project: Title, Description, Size, Date, Project location (link, files), Downloads, Class, uploader, major, school.<br>
<br>
Comment: User, Comment, Project, Date, Flag<br>
<br>
Rating: User, Rate, Project<br>
<br>
<br>
<br>
<h1>2/1/09</h1>

This is a list of work expected to finish by Wed Fed 04<br>
<br>
Jin: Finish the project schedule.<br>
<br>
Paul: Develop project budget.<br>
<br>
Alex: Design use cases<br>
<br>
Dan: Vision Statement<br>
<br>
All: Install and configure Apache, Mysql, php. Get to know Google code usage.