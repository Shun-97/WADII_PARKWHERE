# WADII_PARKWHERE
IS216 School Project

Intro:
With Parkwhere, we aimed to set up a working website which allows users to view 
carpark information either via search or location, to rate and review carparks, and 
to schedule a reminder to check carpark availability. 

Getting started:
Follow these steps to have a fully functioning webapp:
	Step 1: Open phpMyAdmin and import the SQL script at "/wad3_tproj/php/db/parkwhere.sql" in your file directory.

	Step 2: Download Required modules, telebot, MySQLdb Apscheduler. Open 
the command line to the folder "/wad3_tproj/Parkwhere" in the directory 
there and run the python script by entering "python3 Parkwhere.py".

	Detailed Steps 2:
	1)pip install mysqlclient 	or / || pip install C:\wamp64\www\wad3_tproj\Parkwhere\mysqlclient-1.4.6-cp39-cp39-win_amd64.whl 
	2)pip install pyTelegramBotAPI
	3)pip install APScheduler
	4) Navigate to your PATH Directory for Python and
	run this in cmd -> python C:\wamp64\www\wad3_tproj\Parkwhere\Parkwhere.py


	Step 3: (ONLY FOR MAC USERS!!!!!) Open VSCode or other text editors and set password to "root" in the file "wad3_tproj/php/include/ConnectionManager.php".


******Contact us @ @izhcong/@Shunhui/@night_skhye/@ckkh00/@nicolsc For the API Token******


	Step 4: (ONLY DO THIS STEP ONCE A MONTH!!! [See API below]) Open localhost to "/wad3_tproj/Update Database/Update.html" 
and press all three buttons to update the database on carparks. 



If any missing files please git pull from here or do contact us:
	https://bitbucket.org/nicolsc_/awesome_repo/src/master/

Extra explanations:
Users:
We have two types of users: guests and normal members. Normal 
members have access to more functionalities. 

Functionalities
We have several main functionalities:

      Find nearby carparks via pinpoint
       Users may click anywhere on the map (in Singapore) to find carparks in a 2.5 
kilometer radius. Clicking on the carpark pins shown will generate a pop-up of the 
carpark's info. 

      Find nearby carparks via search
       Users may search for a carpark in the search box. This is powered from a 
static database that pulls carpark information and subsequently matches it with the 
API calls for availability (Real time). 
	Show Carpark Only:
       The results will be generated in cards, each containing a button which 
redirects them to the carpark info page to make reviews, see pictures, etc. This 
information does not have the availability information as these are just general 
information for users.
	Show On Map: 
       Results will be printed on a map that tracks and contains carpark availability 
with a real-time API call.
      
‫	‬
‫      ‬Add new carpark locations
      	If users find new carparks not already in the Database, users will be 
able to suggest new carparks by inputting carpark details in a modal form.

	Note: We do have Server side administrators that maintain the integrity of nonsensical
carpark added to the maps. E.g. Naming a carpark name: Lollipop

‫      ‬Schedule reminder
       Users may indicate Location, time of departure, and preparation time in the 
website which will be tagged to a unique ID which will be sent to a database as a 
request. Users will access the telegram bot via @Parkwhere_Bot in which they will 
enter the unique ID presented to them upon submitting the form. This bot will 
access the database to set a reminder which notifies users near the departure 
time.  

      Add carpark reviews
	Each user is allowed exactly one review per carpark. They can rate AND 
review the carpark of their choice which will be stored in a database. 

And other side functionalities:

‫      ‬Login/Register/Logout
       Users are required to create accounts in order to perform some of the 
activities mentioned above: add new carpark locations, schedule a reminder and add 
carpark reviews‫.‬

‫      ‬View/edit own user profile
       Each user has his own profile page showing his previous posts and some 
personal info. He is allowed to customize his own profile page as well.


Pictures:
	Images are sourced from RoyaltyFree Websites such as 
	- freepik.com
	Others:
	- Wallpaper Engine

Music:
	- https://www.youtube.com/watch?v=kvBUaW7aQ8c&ab_channel=Rec0rderMast3r


API
  We made use of a couple of map screens, involving the use of API's. There were a 
few limitations due to the budget constraints of our project. For example, there is 
a limit to the search tokens per access key for the image_search API which 
exceeding will lead to an unfortunate billing/warning sent via email. 
  That leads us to our next APIs; we used 4 carpark APIs + 1 Json File in order to 
cover as wide a range of carparks as possible. On top, URAAPI needs an updated 
access key every day. This is the reason we had to manually input a load of carpark 
info as can be seen in the SQL script. Additionally, the info from the carpark APIs 
are only updated once a month. So, instead of constantly calling for updates, we 
created an update page which will update the database upon click.


Languages Used
HTML, CSS, JavaScript, PHP, SQL, Python


Animation Libraries:
https://github.com/protonet/jquery.inview
https://animate.style/


Framework used:
Curl,AJAX,JQuery,


Modules used:
telebot,MySQLdb,Apscheduler,Notifications,Date


API links‫:‬
https://github.com/Tzyinc/sg-carpark-bot (jsonfile)
http://datamall2.mytransport.sg/ltaodataservice/Cahttps://github.com/Tzyinc/sg-
carpark-bot (jsonfile)
http://datamall2.mytransport.sg/ltaodataservice/CarParkAvailabilityv2 
https://www.ura.gov.sg/uraDataService/invokeUraDS?service=Car_Park_Details 
https://data.gov.sg/api/action/datastore_search?resource_id=139a3035-e624-
4f56-b63f-89ae28d4ae4c&limit=9999rParkAvailabilityv2 
https://www.ura.gov.sg/uraDataService/invokeUraDS?service=Car_Park_Details 
https://data.gov.sg/api/action/datastore_search?resource_id=139a3035-e624-
4f56-b63f-89ae28d4ae4c&limit=9999
https://serpstack.com/
https://developers.google.com/places/web-service/autocomplete
https://developers.google.com/maps/documentation/javascript/overview
https://docs.onemap.sg/



Repository:
SourceTree
Bitbucket


