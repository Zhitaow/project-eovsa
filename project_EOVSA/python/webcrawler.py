# -*- coding: utf-8 -*-
"""
Created on Sun Apr 16 11:13:06 2017

@author: Zhitao
"""

import urllib2
from bs4 import BeautifulSoup

# search for keyword in url and sub-urls, return the result in list
def get_link(url, keyword, result):
    try: 
        page = urllib2.urlopen(url)
    except urllib2.HTTPError, e:
        #checksLogger.error('HTTPError = ' + str(e.code))
        return result;
        
    soup = BeautifulSoup(page)
    all_links = soup.find_all("a")
    # if current level contains no link return to upper level
    if len(all_links) == 0:
        return result;
    
    for i in range(len(all_links)):
        item = all_links[i].get("href")
        #item = item[1:]
        if len(item) > 1 and item[-1] == "/":
            # recursion into next subdirecotry
            result = get_link(url+item, keyword, result)
        elif keyword in item:
            if len(item) > 17 and item[0:3] == "XSP":
                prefix = "XSP"
                t = item[3:17]
                # convert to date
                date = t[0:4]+'-'+ t[4:6] + '-' + t[6:8]
                # convert to date time
                date_time = t[0:4]+'-'+ t[4:6] + '-' + t[6:8] + ' ' + t[8:10] + ':' \
                    + t[10:12] + ':' + t[12:14]

            elif len(item) > 11 and item[0:3]== "FLM":
                prefix = "FLM"
                t = item[3:11]
                # convert to date
                date = t[0:4]+'-'+ t[4:6] + '-' + t[6:8]
                # convert to date time
                date_time = t[0:4]+'-'+ t[4:6] + '-' + t[6:8] + ' 00:00:00'
            else:
                # if the filename's format does not match either XSPYYYYMMDDhhmmss or FLMYYYYMMDD
                prefix =""
                t = "00000000"
                date = []
                date_time=[]
            tmp = [prefix, long(t[0:8]), date, date_time, url+item]
            result.append(tmp)
    
    return result;
            