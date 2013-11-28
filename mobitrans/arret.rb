require "rubygems"
require "json"

json = File.read('data.txt')
empls = JSON.parse(json)
puts empls['Victor Hugo']
