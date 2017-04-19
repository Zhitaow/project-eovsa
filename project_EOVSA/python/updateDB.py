# -*- coding: utf-8 -*-
"""
Created on Sun Apr 16 12:25:39 2017

@author: Zhitao
"""


import webcrawler as wc
import numpy as np
import MySQLdb
#import mysql.connector

# crawling the data starting from the parent url 
url = "http://ovsa.njit.edu/flaremon/"
ls = []
mylist = wc.get_link(url, ".png",ls)
# post-processing
myarray = np.asarray(mylist)#, dtype =dtype)
sortarray = myarray[myarray[:,1].argsort()[::-1][:len(myarray)]]
############################# separate the list into FLM and XSP ######################
FLMarr = sortarray[np.where(sortarray[:,0]=="FLM"),:]
XSParr = sortarray[np.where(sortarray[:,0]=="XSP"),:]
FLMarr = np.squeeze(FLMarr)
XSParr = np.squeeze(XSParr)

######################### now connect to the database ################################      

db = MySQLdb.connect(user='username', passwd='password',host='localhost', db='database')                      
############################ find the index of FLM_list ##############################
# check the latest data in the flm_list
cursor = db.cursor()
cursor.execute("SELECT * FROM flm_list ORDER BY date DESC")
# get the lastest date from the database
row = cursor.fetchone()
if row is not None:
    dbDate = long(row[1].strftime('%Y%m%d'))
    #print "######### Code Executed #########"
    # scan FLM array to find a maching date index
    for i in range(len(FLMarr)):
        if i == 0:
            print "dbDate", dbDate
            print "FLM date", FLMarr[i,1]
        if long(FLMarr[i,1]) == long(dbDate):
            flm_idx = i
            print "######### Code Executed #########"
            break
    # get the index from FLM list
    if flm_idx < len(FLMarr):
        # date macth with database's time, start from the database time to the newest date from the web search
        flm_btidx = 0
        flm_etidx = i+1
    else:
        # not a single record is found, insert them all into database
        flm_btidx = 0
        flm_etidx = len(FLMarr)
else:
    flm_btidx = 0
    flm_etidx = len(FLMarr)

############################ find the index of XSP_list ##############################
# check the latest data in the xps_list
cursor = db.cursor()
cursor.execute("SELECT * FROM xsp_list ORDER BY date DESC")
# get the lastest date from the database
row = cursor.fetchone()
print row
if row is not None:
    dbDate = long(row[1].strftime('%Y%m%d'))

    # scan XSP array to find a maching date index
    for i in range(len(XSParr)):
        if long(XSParr[i,1]) == long(dbDate):
            xsp_idx = i
            break
    # for XSP
    if xsp_idx < len(XSParr):
        # date macth with database's time, start from the database time to the newest date from the web search
        xsp_btidx = 0
        xsp_etidx = i+1
    else:
        # not a single record is found, insert them all into database
        xsp_btidx = 0
        xsp_etidx = len(XSParr)
else:
    xsp_btidx = 0
    xsp_etidx = len(XSParr)

print xsp_etidx
print flm_etidx
################################ update FLM_list ##############################
#cursor.execute("DELETE FROM XSP_list")
for i in range(flm_etidx - flm_btidx):
    try:
        cursor.execute("INSERT INTO flm_list (date, path) VALUES ('"+ FLMarr[i,2] +"', '" + FLMarr[i,4] +"')")
    except Exception, e1:
        print "MySQL Error: %s" % str(e1)
        try:
            cursor.execute("UPDATE flm_list SET path = '"+ FLMarr[i,4] + "')")
        except Exception, e2:
            print "MySQL Error: %s" % str(e2)

################################ update XSP_list ##############################
for i in range(xsp_etidx - xsp_btidx):
    try:
        cursor.execute("INSERT INTO xsp_list (date, date_time, path) VALUES ('"+ XSParr[i,2] +"', '" + XSParr[i,3] +"', '" + XSParr[i,4] +"')")
    except Exception, e1:
        print "MySQL Error: %s" % str(e1)
        try:
            cursor.execute("UPDATE xsp_list SET path = '"+ XSParr[i,4] + "')")
        except Exception, e2:
            print "MySQL Error: %s" % str(e2)

############################## print result ####################################
row = cursor.fetchone()
while row is not None:
    print row
    row = cursor.fetchone()

db.commit()
# disconnect from database
db.close()

