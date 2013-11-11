#!/bin/bash
#Choose random video file from $dir and opens it in default player
dir="/Volumes/MyBook/Videos/Movies"
list="$(find "$dir"  -type f -name "*.avi" -o -name "*.mp4" )" #add other filetypes with -o -name "*.ext"
length=$(wc -l <<< "$list")

module=$(($RANDOM % $length))
filepath=$(sed -n $module'p' <<< "$list")

open "$filepath"
sleep 1
#move the player to the top left corner (works with VLC & QuickTime)
osascript <<EOF
tell application "System Events"
tell process "Dock"
set dock_dimensions to size in list 1
set dock_width to item 1 of dock_dimensions
end tell
tell dock preferences
set dock_location to screen edge
end tell

set aApp to "QuickTime Player"
set frontApp to item 1 of (get name of processes whose frontmost is true)

if (aApp is frontApp) then
if dock_location = left then
set position of first window of application process aApp to {dock_width, 0}
else
set position of first window of application process aApp to {0, 0}
end if
end if

set aApp to "VLC"
if (aApp is frontApp) then
if dock_location = left then
set position of first window of application process aApp to {dock_width, 22}
else
set position of first window of application process aApp to {0, 0}
end if
end if
end tell

EOF
