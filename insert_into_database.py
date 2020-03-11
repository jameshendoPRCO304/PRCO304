from mysql.connector import MySQLConnection, Error
from python_mysql_dbconfig import read_db_config


def insert_device(device):
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


def main():
    device = [('123.456.789.101', '99.88.77.66.55.44', '2'),    # hardcoded variables
             ('726.978.134.2', 'qw.er.ty.ui.op.as', '2'),
             ('1.2.3.4', 'mn.bv.cx.zl.kj.hg', '2')]
    insert_device(device)


if __name__ == '__main__':
    main()