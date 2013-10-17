import os
import time

os.system("gpio mode 2 out")

print "Allumage LED"
os.system("gpio write 2 1")

time.sleep(5)

print "Eteind LED"
os.system("gpio write 2 0")
