import sys
import lxml.etree
import lxml.etree as ET
from os import path
import traceback
#from mysql.connector import MySQLConnection, Error
#from python_mysql_dbconfig import read_db_config

from mysql.connector import MySQLConnection, Error
from python_mysql_dbconfig import read_db_config

# value to store user_id

user_id = '7'


def insert_device(device):
    """
    method copyed from insert_into_database.py
    :param device:
    :return:
    """
    query = "INSERT INTO device (ip_address, mac_address, user_id) " \
            "VALUES(%s,%s,%s)"

    try:
        db_config = read_db_config()
        conn = MySQLConnection(**db_config)
        cursor = conn.cursor()
        cursor.executemany(query, device)
        conn.commit()
    except Error as e:
        print('Error:', e)

    finally:
        cursor.close()
        conn.close()


def insert_ports(ports):
    """
    method copyed from inser_imto_database.py
    :param ports:
    :return:
    """
    query = "INSERT INTO ports (port_no, ip_address, state, service, product, version_no) " \
            "VALUES(%s,%s,%s,%s,%s,%s)"

    try:
        db_config = read_db_config()
        conn = MySQLConnection(**db_config)
        cursor = conn.cursor()
        cursor.executemany(query, ports)
        conn.commit()
    except Error as e:
        print('Error:', e)

    finally:
        cursor.close()
        conn.close()


def get_path_to_xml():
    """
    check if argument exists and if path to XML exists
    :return:
    """
    if len(sys.argv) >= 1:
        path_to_xml = sys.argv[1]
        if path.exists(path_to_xml):
            print("PATH to XmL: {}".format(path_to_xml))
            return path_to_xml
        else:
            print("Path {} not exists".format(path_to_xml))
            exit()
    else:
        print("Please pass PATH to XML as parameter")
        exit()


def process_hosts(hosts):
    """
    process list of hosts to get IP and Mac
    :param hosts: list of <hosts> XML elements
    :return:
    """

    device = []
    # iterate through hosts
    for host in hosts:
        # set default values if IP/Mac not exists
        ip = '-:-:-:-'
        mac = '-:-:-:-'

        # check if IP exists with XPATH
        if host.xpath('.//address[@addrtype="ipv4"]/@addr'):
            ip = host.xpath('.//address[@addrtype="ipv4"]/@addr')[0]
        # check if Mac exists with XPATH

        if host.xpath('.//address[@addrtype="mac"]/@addr'):
            mac = host.xpath('.//address[@addrtype="mac"]/@addr')[0]

        print_host_report(ip, mac)
        device.append((str(ip), str(mac), str(user_id)))
        ports = host.xpath('.//ports/port')

        process_ports(ports, ip)

    # run method copyed from inser_imto_database.py
    insert_device(device)


def process_ports(ports, ip):
    """
    Process list of ports
    :param ports: list of XML elements <port>
    :return:
    """

    ports_list = []
    for port in ports:
        port_no = '-'
        state = '-'
        service = '-'
        product = '-'
        version_no = '-'

        # check if port_no  exists with XPATH
        if port.xpath('./@portid'):
            port_no = port.xpath('./@portid')[0]

        # check if state exists with XPATH
        if port.xpath('.//state/@state'):
            state = port.xpath('.//state/@state')[0]

        # check if service exists with XPATH
        if port.xpath('.//service/@name'):
            service = port.xpath('.//service/@name')[0]

        # check if product exists with XPATH
        if port.xpath('.//service/@product'):
            product = port.xpath('.//service/@product')[0]

        # check if version_no exists with XPATH
        if port.xpath('.//service/@version'):
            version_no = port.xpath('.//service/@version')[0]

        print_port_report(port_no, product, service, state, version_no)
        ports_list.append((str(port_no), str(ip), str(state), str(service), str(product), str(version_no)))
    insert_ports(ports_list)


def print_host_report(ip, mac):
    # print formatted report to console
    print("New host")
    print("IP : {}".format(ip))
    print("Mac : {}".format(mac))
    print('*' * 20)


def print_port_report(port_no, product, service, state, version_no):
    print("\tNew port")
    print("\tPort No : {}".format(port_no))
    print("\tState : {}".format(state))
    print("\tService : {}".format(service))
    print("\tProduct : {}".format(product))
    print("\tVersion No : {}".format(version_no))
    print('\t' + '*' * 20)


def main():
    try:
        # path_to_xml = get_path_to_xml()
        path_to_xml = r'C:\Users\james\Desktop\test7.xml'
        # parse XML to tree of elements with XPATH
        tree = lxml.etree.parse(path_to_xml, ET.XMLParser(remove_blank_text=True))
        # get list of all <hosts> elements
        hosts = tree.xpath('//host')
        process_hosts(hosts)
    except Exception as e:
        print(str(e))
        print(traceback.format_exc())


if __name__ == '__main__':
    main()
