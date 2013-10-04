#!/bin/bash
# Script to transfort .itc files into images (JPG or PNG)
#
# .itc files are located in ~/Music/iTunes/Album Artwork

AlbumArtwork="${HOME}/Music/iTunes/Album Artwork"
DestinationDir="$AlbumArtwork/Images"
IFS=$'\n'

if [ ! -d "$DestinationDir" ]; then
	mkdir "$DestinationDir"
	echo "new Images dir"
fi

for file in `gfind "$AlbumArtwork" -name '*.itc'`; do

	isJPG=$( head $file | xxd | grep -i '6461 7461 ffd8');  #data..
	isPNG=$( head $file | xxd | grep -i '6461 7461 8950 4e47'); #data.PNG

	xbase=${file##*/} #file.etc
	xpref=${xbase%.*} #file prefix

	if [ -n "$isJPG" ]; then
		targetFile="$DestinationDir/$xpref.jpg"
		if [ ! -f "$targetFile" ]; then
			echo jpg
			gsed  's/^.*\xFF\xD8/\xFF\xD8/' $file > $targetFile
		fi
	elif [ -n "$isPNG" ]; then
		targetFile="$DestinationDir/$xpref.png"
		if [ ! -f "$targetFile" ]; then
			gsed 's/^.*\x89\x50\x4e\x47/\x89\x50\x4e\x47/' $file > $targetFile
			echo png
		fi
	else
		echo $file
	fi
done
