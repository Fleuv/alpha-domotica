from config import *
def speaker():
	from time import sleep as sleep
	from RPi import GPIO as GPIO
	import urllib2, urllib

	try:
		# What will be send when the switch is triggered
		sendMessage = urllib.urlencode([
			('api', 'message'),
			('user', username),
			('pass', password),
		])

		# Use the numbering scheme
		GPIO.setmode(GPIO.BCM)

		# Define the PIN's
		switchAlertA = 5
		switchAlertB = 6

		# Setup the GPIO's
		GPIO.setup(switchAlertA, GPIO.IN)
		GPIO.setup(switchAlertB, GPIO.IN)

		while True:

			# When the switch is triggered send a message
			if GPIO.input(switchAlertA) or GPIO.input(switchAlertB):
				message = urllib2.Request(host, sendMessage)
				message.add_header('Content-type', 'application/x-www-form-urlencoded')
				print(urllib2.urlopen(message).read())
				sleep(5)

			# Do not use all the CPU
			sleep(0.1)

	# Code execution is interrupted
	except KeyboardInterrupt:
        # Data send to the webserver
	    sendShutdown = urllib.urlencode([
			('api', 'boot'),
			('user', username),
			('pass', password),
            ('ip', ip),
            ('port', port),
	        ('status', 0),
	    ])

        # Send te boot message
        shutdown = urllib2.Request(host, sendShutdown)
        shutdown.add_header('Content-type', 'application/x-www-form-urlencoded')
        print(urllib2.urlopen(shutdown).read())

		# Reset GPIO all settings
		GPIO.cleanup()