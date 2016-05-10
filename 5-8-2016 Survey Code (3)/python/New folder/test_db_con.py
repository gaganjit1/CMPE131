#!/usr/bin/python

hostname = 'localhost'
username = 'root'
password = 'password'
database = 'sjsu'
import pymysql


# Simple routine to run a query on a database and print the results:
def doQuery( conn ) :
    cur = conn.cursor()
    cur.execute("SELECT sjsuid, question1 FROM results")
    for sjsuid, question1 in cur.fetchall() :
        print sjsuid, question1

myConnection = pymysql.connect( host=hostname, user=username, passwd=password, db=database )
doQuery( myConnection )
myConnection.close()
