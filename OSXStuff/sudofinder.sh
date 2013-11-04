#!/bin/bash
sudo echo
echo "*** You are running Finder as root! ***"
echo
echo Type ctrl-c in the Terminal window to end session.
echo
killall Finder && sudo /System/Library/CoreServices/Finder.app/Contents/MacOS/Finder
