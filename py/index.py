from config import *
from boot import *
from speaker import speaker
from listener import listener

# Make the functions run parallel
from multiprocessing import Process

if __name__ == '__main__':
	p1 = Process(target=speaker)
	p1.start()
	p2 = Process(target=listener)
	p2.start()
	p1.join()
	p2.join()