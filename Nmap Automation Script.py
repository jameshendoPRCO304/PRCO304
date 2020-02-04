import os

x = " 127.0.0.1"

def myscan():
    os.system(r"nmap -oX C:\Users\james\Desktop\test2.xml" + x)


myscan()




