import os

# Configuration
username = 'guest'
password = 'guest'
host = 'http://192.168.178.23/repos/alpha-domotica/index.php'
ip = os.popen('ifconfig eth0 | grep "inet\ addr" | cut -d: -f2 | cut -d" " -f1').read().rstrip()
port = 4000