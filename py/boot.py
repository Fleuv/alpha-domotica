from config import *
import urllib2, urllib, os

# Data send to the webserver
sendBoot = urllib.urlencode([
	('api', 'boot'),
	('user', username),
	('pass', password),
	('ip', ip),
	('port', port),
	('status', 1),
])

# Send te boot message
boot = urllib2.Request(host, sendBoot)
boot.add_header('Content-type', 'application/x-www-form-urlencoded')
print(urllib2.urlopen(boot).read())