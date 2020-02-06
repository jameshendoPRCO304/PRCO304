import os
import socket


# Function to host LAN address
# IP address
def get_ip():
        s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
        try:
            # doesn't even have to be reachable
            s.connect(('10.255.255.255', 1))
            IP = s.getsockname()[0]
        except:
            IP = '127.0.0.1'
        finally:
            s.close()
        return IP


#split ip into list
iplist = get_ip().split(".")


#change last two digits to 0 to form network address
iplist[3] = '0'
iplist[2] = '0'
iplist.append("/24")


#Build Lan Network Broadcast address
x = (iplist[0] + '.' + iplist[1] + '.' + iplist[2] + '.' + iplist[3] + iplist[4])


# Function to run Nmap scan
def my_scan():
    os.system(r"nmap -oX C:\Users\james\Desktop\test1.xml " + x)


print(x)
my_scan()




