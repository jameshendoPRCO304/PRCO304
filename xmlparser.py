import xml.etree.ElementTree as ET

tree = ET.parse('C:/Users/james/Desktop/test7.xml')
root = tree.getroot()

# print([elem.tag for elem in root.iter()])

# for host in root.iter('host'):
# #     print(host.attrib)

# print([elem.attrib for elem in root.iter('host')])

for host in root.findall("./host/):
    print(host[2])
