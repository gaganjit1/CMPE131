import pymysql

def sql():
    hostname = 'localhost'
    username = 'root'
    password = 'password'
    database = 'sjsu'
    connection = pymysql.connect(host=hostname, user=username, passwd=password, db=database)
    cur = connection.cursor()
    return cur, connection



