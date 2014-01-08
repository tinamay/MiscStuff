# Messing with [(tag.)Mobitrans(.fr)](http://tag.mobitrans.fr)


## Intro 

[Mobitrans](tag.mobitrans.fr) is a website for mobile devices to retrieve bus/tram schedule. 

But it's an aweful website… 

Since there is no public API (OpenData where are you ?), I did some work to parse it's data to maybe reuse it in a another website / app / whatever. 


## PHP page 
There is a demo available at : ~~[tag.riegler.fr](tag.riegler.fr)~~ (actually broken since the original website was changed recently). 

* 4 PHP files to parse the data from the 4 main pages of mobitrans :
	* The list of lines 
	* The list of stations for a particular line 
	* The nearest stations for a particular geolocation
	* The remaing time for a particular line at a particular station
	
* 4 PHP file to display the parsed informations
* 1 misc php with some useful functions


## Python script 

`arretsMobitrans.py` : 

* It first retrieve the lineIDs
* Then retrieves the StationIDs 
* From every page we, the script retrieve the station name and puts it in a dictionnary 
* At the end it output a JSON file with a dictionary of every station with its name as a key. Each value is a list of dictionary (line, id) of lignes that server the station 






