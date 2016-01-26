from time import sleep as sleep
import RPi.GPIO as GPIO
import urllib2, urllib

# Configuration
username = 'guest'
password = 'guest'
url = 'http://alphadomotica.ml/index.php'
ip = urllib2.urlopen('http://ipinfo.io').read()
port = 80

# While running
try:
	# Use the numbering scheme
	GPIO.setmode(GPIO.BCM)

	# Global variables
	statusLight = False
	dataBoot = urllib.urlencode([
		('api', 'boot'),
		('user', username),
		('pass', password),
		('ip', ip),
		('port', port),
	])
	dataMessage = urllib.urlencode([
		('api', 'message'),
		('user', username),
		('pass', password),
	])

	# Send te boot message
	boot = urllib2.Request(url, dataBoot)
	boot.add_header('Content-type', 'application/x-www-form-urlencoded')
	print(urllib2.urlopen(boot).read())


	# Define the PIN's
	theLight = 4
	switchAlert = 5
	switchLight = 6

	# Setup the GPIO's
	GPIO.setup(theLight, GPIO.OUT)
	GPIO.setup(switchAlert, GPIO.IN)
	GPIO.setup(switchLight, GPIO.IN)

	while True:

		# When the light switch is pressed
		if GPIO.input(switchLight) and not statusLight:
			statusLight = True

		if GPIO.input(switchAlert):
			message = urllib2.Request(url, dataMessage)
			message.add_header('Content-type', 'application/x-www-form-urlencoded')
			print(urllib2.urlopen(message).read())

		# Check if the light should be on or off
		if statusLight:
			GPIO.output(theLight, GPIO.HIGH)
		else:
			GPIO.output(theLight, GPIO.LOW)

		# Do not use all the CPU
		sleep(0.1)

# Code execution is interupted
except KeyboardInterrupt:
	# Reset all settings
	GPIO.cleanup()
