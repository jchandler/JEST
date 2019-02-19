# Jason's Excellent Sasquatch Tracker - JEST

## How to Use

## Development Notes

2019-02-16 13:08 - Phew! Finally got my Docker setup working and I'm ready to start coding. I'm going to be creating JEST using PHP and the Lumen framework, with a MySQL backend.  Ready to kick things off.  Gonna start by getting my database schema in place.

2019-02-16 13:20 - Actually, needed to get my Github set up. So now I'm all connected up and ready to develop!

2019-02-16 13:53 - Basic schema and migration working. Starting on the manage sightings stuff - model, routes, controller, etc

2019-02-16 14:02 - Aah! Migration worked, but no db connection from the API. PDO_mysql doesn't seem to be installed? Checking further into what's going on here...

2019-02-16 14:10 - Got PDO_mysql added to the Dockerfile, but the API still doesn't want to connect to the db.  Command line works fine, but getting "Connection Refused" now in the API code

2019-02-16 14:18 - Break time. 1 hour, 10 minutes worked so far.

2019-02-16 16:52 - Back at it!  Still trying to figure out why the API can't connect to the database

2019-02-16 17:50 - This "Connection Refused" thing is killing me. This is still docker-related trouble, I think. So I've posted on Stack Overflow, which hopefully doesn't bend the rules too much.  If I can't get this figured out I'm going to have to start over.  If I need extra time, I'm planning to not count this hour of banging my head against the wall.  Hopefully this is fine.  I'm going to rest my brain and hopefully someone will respond to my question...

2019-02-16 22:09 - Holy crap it finally works. No one ever ended up responding to the Stack Overflow, but I found a Lumen / Docker / MySQL tutorial online and I've finally got a connection to the database.  I'm going to just call that all Docker work because I certainly didn't make any progress on the code since 2:00pm.  OK.  Kids are in bed and the connections are working.  Time to bang out some code.

2019-02-16 23:13 - Sightings API calls are coming along. GET works for one or all sightings. POST works to create a new sighting.  PUT works to update an existing sighting. And DELETE works to get rid of one. No validation yet, but the basics are there.

2019-02-16 23:58 - Time to go to sleep. Got some good work done on tags, but will need to pick it up in the morning. At about 3 hours.

2019-02-18 20:50 - Ready to finish up.  Need to get these tags working so I can move on to the fun geospatial stuff

2019-02-18 21:26 - Tags looking pretty good. GET,POST and PUT working.

2019-02-18 21:59 - Got the distance endpoint working.  These endpoints are all super bare bones.

2019-02-18 22:44 - Tag search has a bug, so I quickly did the find within distance endpoint.  Five more minutes on tag search, I may have to bag it.

2019-02-18 22:51 - OK, well, times up.  I got the tag search working one way but not the other.  Going to commit once more and then write up results.














# Backend Engineering Challenge

Thank you for your interest in joining the backend team at Jolt! We are a hard working bunch that is eager to learn and implement new technologies while also being willing to maintain legacy code.

***** **STOP** *****

If you're not familiar with Docker, please spend some time before actually starting the challenge. It will not count against your time. It makes our job *so* much easier if we can simply run `docker-compose up` to run your project. Get familiar with Docker and then start the assessment. Once you're comfortable with working with a `docker-compose.yml` file and a `Dockerfile` file, please procede:

You have five hours to make as much progress on the challenge as you can. We have designed the challenge so that it can't be completed in five hours, so please don't feel any stress to get it finished.

## Guidelines
* The purpose of this challenge is to help us evaluate your software engineering skills. We are looking for things like:
  * How well you architect your project structure
  * How well your solution might scale under heavy load and/or very large datasets
  * Do you understand basic programming and database principles
  * Do you understand best practices
  * Can you write readable and maintainable code
  * Can you research and implement new or unfamiliar concepts
  * Can you clearly explain your thoughts, and document your code
* You are allowed to use any non-human resource. Ex:
  * **Allowed:**
    * StackOverflow
    * Google
    * Reference code on Github, etc.
  * **Not Allowed:**
    * Chatting or calling your old boss
    * Using the code of your friend who already took this assessment
    * Using the code of someone who posted their solution on the internet

## Deliverables
Once you have completed the challenge (or used the allotted five hours), please fill out this Google form: http://bit.ly/sasquatch-sightings-submissions
For the code file, please submit a compressed directory with:
* Code
* Completed Docker Compose file
* Readme explaining your database schema, choice of technologies, any challenges, and the API URLs

## The Challenge
The "Society to Uncover and Spread the Truth" has hired you to build a backend to track Sasquatch sightings with an API to access this data. They need a system to track sightings, including some metadata about each sighting, and to provide some analytics to help them discover patterns.
These are their requirements:

* The database used to store the data should be a MySQL database
* The API should follow REST or GraphQL best practices
* The backend should be implemented in one of the following languages: NodeJS, PHP, Java
* Frameworks: You are free to use any frameworks you feel are appropriate for the task. Also, keep in mind that this is your opportunity to show off your software engineering skill and experience.
* The API should provide the following endpoints (please build these in this order)
    1. Manage sightings
        * Create new sightings, including:
            * The exact location (latitude and logitude) of the sighting
            * The time of the sighting
            * The eye-witness's discription of the sighting
            * A list of some short tags that are pertinent to the sighting, to the eye-witness, or to the geography (for example: "hill", "dark-brown", "cabbage-patch")
        * Read
            * All recorded sightings
            * The details of a single sighting
        * Update a recorded sighting by:
            * Changing the location or description
            * Adding or removing some tabs
        * Delete a sighting
    2. Distance
        * Get the distance between two recorded sightings: API receives two sighting ids, then returns the distance between them
    3. Search by tags. The client can send a list of one or more tags, and an additional parameter specifying that the API should return
        * All sightings that match at least one of the tags in the search request, or
        * All sightings that match all the the tags in the search request
    4. Closest sightings (you can do these two in either order)
        * Get all the recorded sightings within a given distance of a certain sighting: API recieves a sighting id and a distance, then returns a list of sightings that were within that distance
        * Get the closest X number of sightings to a given sighting: API receives a sighting id and a number (10 for example), and returns the closest X sightings (closest 10 sightings)
    5. Improve the "related sightings" endpoint from step 3. Add the ability for the client application and user to specify the following details (make these improvements in any order):
        * The client can optionally include a list of tags, and the API should only return sightings that have those tags
        * The client can specify that it only wants sightings that share all tags with the specified sighting
        * The client can specify that it only wants sightings that share at least one tag with the specified sighting
        * The client can optionally pass a date range (a start and end date), and the API should only return sightings in that range
        * The client can optionally pass a date range forward/backward from the specified sighting, and the API should only include sightings in that date range
    5. If you finish the tasks above (😳), feel free to make any further improvements, or just relax and submit the challenge

When you reach the five hour mark, please stop what you are working on, comment out any unfinished code that breaks the application, and write the required documentation (specified in the Deliverables section).

## Docker Instructions

To simplify setup and to show that you understand (or can at least figure out) Docker, we expect a Docker Compose file that will spin up your backend and port forward so that we can hit your endpoints from localhost. We provide you with a docker compose YAML file that will spin up your MySQL database to help get you started.
Instructions for docker compose:
* Make sure docker is installed
    * For Mac: https://www.docker.com/docker-mac
    * For Windows: https://www.docker.com/docker-windows
    * For Ubuntu: https://www.docker.com/docker-ubuntu
* Make sure you're in the same directory as this readme
* run `docker-compose up -d`
    * This will create a container called mysqldb
    * To verify it was created you can run `docker ps` -- it should show up in the list of containers
* To tear down your environment you can run `docker-compose down` so that you can spin it from scratch as you make changes
* In this same directory there is a schemadump.sql file which is where you should put the DDL for creating your schema. The database name is `test` which is consistent with what is specified in the docker-compose.yml file
* The schemadump.sql script should automatically run when the pod spins up
    * If you get an error like `ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2)` then just wait a minute or two for mysql to fully initialize and then try again
* To bash into your mysql container you can run `docker exec -it mysqldb bash` and you can either login to MySQL with user:root pass:root or user:test pass:test
* Complete the docker-compose.yml file with your api service
* Refer to https://docs.docker.com/compose/gettingstarted/ for the official Docker Compose tutorial

## Sample Data

If you want, you may use this sample data as you develop: http://bit.ly/sasquatch-sightings-data
NOTE: The sample data is in TSV (not CSV format)

## Feedback

After you've completed and submitted the challenge, we'd love it if you would give us some feedback regarding the challenge, by filling out this form anonymously: http://bit.ly/sasquatch-feedback
You can also come back and submit your feedback at a later time.

Thanks!
