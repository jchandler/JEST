# Jason's Excellent Sasquatch Tracker - JEST

## How to Use

The final project JEST consists of 8 distinct endpoints (if you count different methods of hitting the same URL as different endpoints). The base URL for all endpoints, once the Docker container is running, should be:

`http://localhost:8080/api/sightings/`

The first five are the CRUD endpoints for Sightings.  I used GET for all endpoints that pull data, POST for creates, PUT for updates, and DELETE for deletes.  The other three are all GET endpoints that pull back Sightings data in different ways.  Here are examples for each:

`GET: http://localhost:8080/api/sightings/`
Should return all sightings and their data

`GET: http://localhost:8080/api/sightings/1`
Should return data for a single sighting. In this case, the one with `ID=1`

`POST: http://localhost:8080/api/sightings/`
This request should contain `form-data` with key-value pairs as defined below. If properly filled out, a new sighting should be created.

Parameters
* description (a string describing the sasquatch sighting)
* sighted_at (a date of the sighting, in this format: "2019-01-01 23:59:59")
* latitude (a float value of the latitude of the sighting location)
* longitude (a float value of the longitude of the sighting location)
* tags (a string with comma-separated tags, describing the sasquatch)

`PUT: http://localhost:8080/api/sightings/1`
This request should contain `x-www-form-urlencoded` with key-value pairs as defined above, the same as the POST.  If properly filled out, the sighting with `ID=1` should be updated with the new information.

`DELETE: http://localhost:8080/api/sightings/1`
This request should Delete the Sighting with `ID=1`, if it exists. 

`GET: http://localhost:8080/api/sightings/distance/1/2`
Should return the distance between the two sightings. And I JUST REALIZED as I'm typing this that the units of distance are latitude / longitude units. I didn't do the correct GeoSpatial calculations to get results in miles or km.

`GET: http://localhost:8080/api/sightings/tagsearch/brown,furry`
Should return sightings that are tagged either brown, furry, or both. Ran out of time for the option to require both.

`GET: http://localhost:8080/api/sightings/within/1/10`
Should return sightings within 10 units of the sighting with `ID=1`. Again this is using a bad unit of distance...

## Final Thoughts

This was a fun project, although the Docker setup was a bit frustrating. This was my first time using Docker.  I have mostly worked with Vagrant.  I chose to use the Lumen PHP framework, as I'm familiar with it, and it runs very fast.  

The time restriction seemed long at first, but quickly disappeared and I found myself having to choose between things to get done.  I don't think my choices reflect priorities in an actual job. So in that way maybe this project result isn't perfectly representative of how I work.  With time restricted I chose some parts that were more fun over parts that are important but less fun.  In retrospect, I should have stopped a half hour early and spent time on documentation and validation.  Oh well!

### Things I spent time on

* Lumen setup: Tried to properly set up migrations, models, routes and controllers
* Functionality: Wanted to get through as many endpoints as I could
* Testing: Wanted to try to be sure that if proper values came into the API that it would do what it said
* Messaging: Wanted user-friendly failure responses for some types of failures
* GeoSpatial stuff: I like working with geospatial data and would have liked to have time to do more of the geo endpoints. I could have spent much more time investigating the Grimzy library I found
* HTTP Response Codes: I only manually used 200 and 400 for successes and failures. 404 will be kicked off automatically by some of the eloquent query failures. And I believe 500 will be automatically used on any lingering code issues.  I could have probably done more here, but those cover the majority of cases.  

### Things I didn't spend time on, but would always do before launching an API or passing the code to anyone else

* Validation: The API doesn't validate parameters coming in to make sure the values are appropriate
* Documentation: The controller functions don't have docblocks or comments
* Indexing: For high load requests and especially the geospatial stuff I would have spent time tweaking db indexes
* Conversion to miles: Realized while typing up documentation that the API isn't converting (lat/long units) into miles or km. Without having a chance to test, I believe that I would just have to change the one Grimzy command from `Sighting::distance` to `Sighting::distanceSphere`, and then the raw DB call from `ST_Distance` to `ST_Distance_Sphere`

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

2019-02-18 23:43 - Just finishing up documentation and I'm going to copy my MySQL structure to that schemadump file so you don't have to run the migrations.
