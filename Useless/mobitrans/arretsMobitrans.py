from bs4 import BeautifulSoup
import urllib2
import json
import sys
import urlparse

stations = dict()

def main():

	url = "http://tag.mobitrans.fr/index.php?p=49&I=a0249ta&id="

	print "Getting lines ID"
	linesID = getLinesId()

	print "Getting stations ID"
	stationsID = list()
	for lineID in linesID:
		sys.stdout.write("-") # Some progress feedback
		sys.stdout.flush()    #
		stationsID.extend(getStationsId(lineID))
	keys = {}
	for e in stationsID:
		keys[e] = 1
	stationsID = keys.keys()
	stationsID.sort()

	print "\nParsing the pages"
	#Iterate on stations to retrieve the data
	for aStationID in stationsID:
		currentUrl = url+str(aStationID)
		parseMobitrans(currentUrl,aStationID)

    #writting the result into a JSON file
	with open('data.txt', 'w') as outfile:
		json.dump(stations, outfile, sort_keys=True)



#Return the a list of ID of each bus line
#If something is wrong, it returns an empty list
def getLinesId():
	#The IDs are in a list of options within a HTML form

	#The form is available a this URL
	url = "http://tag.mobitrans.fr/index.php?p=13&I=c024evr"
	f = urllib2.urlopen(url)
	s = f.read()

	#Using BeautifulSoup to parse the DOM
	soup = BeautifulSoup(s)
	corpsDiv = soup.find("div", class_="corpsL")
	if not isValidPage(soup) :
		return list()

	formLigne = corpsDiv.find('form', attrs={'name':'f_ligne'})
	lignes = formLigne.findAll('option')

	resultList = list() #setting the list returned

	for ligne in lignes :
		#the ID we want are the value of the option field
		resultList.append(ligne.get('value'))
	return resultList



# Parameter : the ID of a line
# return : List of int ID of each station of the line
#If something is wrong, it returns an empty list
def getStationsId(lineID):
	url = "http://tag.mobitrans.fr/index.php?p=41&I=c024evn&ligne="+lineID
	f = urllib2.urlopen(url)

	#Using BeautifulSoup to parse the DOM
	s = f.read()
	soup = BeautifulSoup(s)
	corpsDiv = soup.find("div", class_="corpsL")
	if not isValidPage(soup) :
		return list()
	stations = corpsDiv.findAll("a", class_="white")

	resultList = list() #Setting the list returned
	for aStation in stations:
		#The id is within the url, first we retrieve the url
		stationUrl = aStation['href']

		#Then we parse the url to retrieve the id
		url = urlparse.urlparse(stationUrl)
		params = urlparse.parse_qs(url.query)
		if 'id' in params:
			resultList.append(int(params['id'][0])) #Appending IDs as int to sort them
	return resultList



def parseMobitrans(url,stationID):
	global stations

	f = urllib2.urlopen(url)
	s = f.read()
	soup = BeautifulSoup(s)
	corpsDiv = soup.find("div", class_="corpsL")
	if not isValidPage(soup) :
		print url
		print "-"
	else:
		station = stationName(corpsDiv)
		line = lineName(corpsDiv)
		if not station in stations :
			stations[station] = list()
		aDict = {"id":stationID, "line":line}
		stations[station].append(aDict.copy())
		#		print str(id) + " : " + stationName(corpsDiv) + lineName(corpsDiv)
		sys.stdout.write("+")
		sys.stdout.flush()
	f.close()


#Parameter : Mobitrans DOM as a SoupObject
#Return true if the page doesn't return an error
def isValidPage(soup):
	return (soup.find("div", class_="error") is None)

#Parameter : Result body node as SoupObject
#Return : the name of the station
def stationName(node):
	return node.findAll('span')[0].next.string[8:] #remove "arret : "

#Parameter : Result body node as SoupObject
#Return : the name of the line (Bus, tram etc.)
def lineName(node):
	return node.findAll('span')[2].next.string

if __name__ == '__main__':
	main();
