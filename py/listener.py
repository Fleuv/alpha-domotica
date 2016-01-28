from config import *
from bottle import request, post, run
from RPi import GPIO as GPIO
import hashlib

# Setup the hardware
theLight = 4
GPIO.setmode(GPIO.BCM)
GPIO.setup(theLight, GPIO.OUT)
GPIO.output(theLight, GPIO.LOW)

# Setup the webserver so we can receive data
@post('/execute')
def do_execute():
    # Check if the login is valid
    output = ""
    if request.POST.get('user') == username and request.POST.get('pass') == hashlib.md5(password).hexdigest():
        if int(request.POST.get('lights')):
            GPIO.output(theLight, GPIO.HIGH)
            output += "Lights ON"
        else:
            GPIO.output(theLight, GPIO.LOW)
            output += "Lights OFF"

        output += " and "

        if int(request.POST.get('camera')):
            output += "Camera ON"
        else:
            output += "Camera OFF"
    else:
        output = "Invalid login credentials."

    print(output)

run(host=ip, port=port)

GPIO.cleanup()