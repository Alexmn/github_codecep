# github_codecep
testing using codeception framework, the repo integration from api.github

**installation:**
ssh key or at least normal user account on github

the user and password for the "testing repos" can be found in `github_codecep/tests/_support/Page/ApiRoutesPage.php`

needed php installed for execution on mac or linux

git clone repository in www folder: https://github.com/Alexmn/github_codecep
 
go to the route of the testing folder: `/var/www/github_codecep`

installing dependencies `php composer.phar install` 

run following command: `php bin/codecept build`


**testing:** 

commands will be runned from the repo folder: `/var/www/github_codecep`

running with junit report:  `php bin/codecept run api --xml --debug --steps -vvv`

running with all reports: `php bin/codecept run api --xml --html --debug --steps -vvv`

reports will be found under this path: `/var/www/github_codecep/tests/_output/`

**testing plan**
Due to the fact that the test should be running multiple times, I set 2 special functions _before 
and _after that will do the cleanup. The idea is: _before runs at the start of the testing and 
_after at the end. 
I set the test to run with _before setup in order for you to see the output after the first run. 
The correct testing phase should run with _after, because at the end of the testing the data should 
not be altered.(if posible).
all you need to do is to comment / uncomment the code you want to run. I let the same disabled lines in the 
testing_phase for you to see if the script runs no matter what is the order of running steps.
The only mention i have to say is that for running, the codeception module works only from cest files 
and only for public functions. this is why i arranged all the testing phase in one public method 
and the rest in private ones.

Have fun! :) 