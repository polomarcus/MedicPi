import os
import time

print "Check new anomaly"
os.system("wget -q -O /dev/null http://localhost/MedicPi/data/createAnomalyMotion")
print "Attente"
time.sleep(1800) #toutes les heures on check