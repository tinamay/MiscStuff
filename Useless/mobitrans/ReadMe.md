# Messing with [(tag.)Mobitrans(.fr)](http://tag.mobitrans.fr)


## Intro 

[Mobitrans](tag.mobitrans.fr) is a website for mobile devices to retrieve bus/tram schedule. 

But it's an aweful website… 

Since there is no public API (OpenData where are you ?), I did some work to parse it's data to maybe reuse it in a another website / app / whatever. 

### Working with mobitrans 

Mobitrans displays for each Bus/Tram station the 2 next schedule in each direction. 

For a single station, this a different page for each line who serves the station. 

So the first thing to do is the retrieve every single page corresponding to a station. To do that we need to iterate all the stations of all the lines. 

* All the bus/tram lines are avaiable at `index.php?p=13&I=sessionID` (I don't know yet how the session ID are managed but `c024ey7` works for me) 
* Their id is are in options of the `f_ligne` form  
* from now on, let's call these lineIDs 

With these id we can acces all the station of a particular line 

* All the station are available at `index.php?p=41&I=sessionID&ligne=lineID`
* On this page we just need to retrive each StationID in each url in the `id` parameter of each url. 


## Python script 

`arretsMobitrans.py` : 

* It first retrieve the lineIDs
* Then retrieves the StationIDs 
* From every page we, the script retrieve the station name and puts it in a dictionnary 
* At the end it output a JSON file with a dictionary of every station with its name as a key. Each value is a list of dictionary (line, id) of lignes that server the station 



## PHP page 



