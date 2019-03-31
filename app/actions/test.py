import os

data = os.popen('gpio -g read 15').read()

print("Status is" + data)
