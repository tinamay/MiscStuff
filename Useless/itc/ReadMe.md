#.itc file format documentation 


##Intro 

Document made by [Kyro](http://matthieu.riegler.fr) with the help of [Simon Kennedy](http://www.sffjunkie.co.uk/python-itc.html)

.itc are files created by iTunes to store Album Artworks. <br/>
Most of them hold multiple images (3 images of different sizes) either as PNG, JPG or ARGB raw files. 

These files can be read as follow :  


##File header

284 Bytes as follows : 

* `0x00 0x00 0x01 0x1C` 
* `0x69 0x74 0x63 0x68` _"itch"_
*  16 Bytes of ? 
* `0x61 0x72 0x74 0x77` _"artw"_
* 256 Bytes of `0x00`


##Content

The content of the file are image wrapped with the following pattern : 

start is the offset the first byte bellow (first is `284 / 0x11C` )

* (start+0) 8 Bytes : 
	* 4 Bytes for the size of the next item 
	* 4 bytes for `0x69 0x74 0x65 0x6D` _"item"_
* (start+8) 4 Bytes : offset for the image, either
	* `0x00 0x00 0x00 0xD0` for iTunes 9 & above 
	* `0x00 0x00 0x00 0xD8` for older iTunes (not used ?)
* (start+12) 16 Bytes (or 20 but not used anymore)
* (start+28) 16 Bytes 
* (start+44) 4 Bytes (offset 328): Origin of the file 
	* `0x6c 0x6f 0x63 0x6c` _"locl"_ (local)
	* `0x64 0x6f 0x77 0x6e` _"down"_ (download)
	* `0x43 0x4c 0x4f 0x44` _"CLOD"_ (iCloud) 
	* `0x43 0x4C 0x50 0x55` _"CLPU"_ (iCloud Purchase)
* (start+48) 4 Bytes (offset 332):	filetype of the image
	* `0x50 0x4E 0x47 0x66` _"PNGf"_ or `0x00 0x00 0x00 0x0E` for PNG files 
	* `0x00 0x00 0x00 0x0D` for JPG files 
	* `0x41 0x52 0x47 0x62` _"ARGb"_ for ARGB files
* (start+52) 4 Bytes of `0x00`
* (start+56)2*4 Bytes : Size of the file 
	* 4 Bytes : width in pixel
	* 4 Bytes : height in pixel
* Bunch of `0x00` until offset (start + 208 ) (offset retrieved at start+8). <br /> Image file start after `0x64 0x61 0x74 0x61` _"data"_. 
* Size of the image is size retrieve at (start+0) - the offset retrieved at start+8 
* Next Byte is the new start. 	

## Misc 
You can check the fact above with some of the following commands : 

* offset of the image : `find . -name "*.itc" | gxargs -l -I{} xxd -s 292 -l 4 {} | sort | uniq`
* origin of the image : `find . -name "*.itc" | gxargs -l -I{} xxd -s 328 -l 4 {} | sort | uniq`
* filetype of the image : `find . -name "*.itc" | gxargs -l -I{} xxd -s 332 -l 4 {} | sort | uniq`	
