#!/usr/bin/env python
# -*- encoding: utf-8 -*-

#FruxePi - Chart Data

# Packages
import pymysql.cursors
from time import gmtime, strftime


# Functions
# fetchData - Fetch from sql string
def fetchData(sql):

    # Connect to the database
    connection = pymysql.connect(host='localhost',
                                 user='frxpi',
                                 password='password',
                                 db='frx_db',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)
    try:
        with connection.cursor() as cursor:
            # Read a single record
            cursor.execute(sql)
            result = cursor.fetchone()
            return result
    finally:
        connection.close()


# updateDatabase function
def updateHistory(data):

    # Connect to the database
    connection = pymysql.connect(host='localhost',
                                 user='frxpi',
                                 password='password',
                                 db='frx_db',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)
    try:
        with connection.cursor() as cursor:
            # Create a new record
            sql = "INSERT INTO climate_history (date_time, temperature, humidity) VALUES (%s, %s, %s)"
            cursor.execute(sql, (data['date_time'], round(data['temperature']), round(data['humidity'])))

        connection.commit()
        print("Success!")
    finally:
        connection.close()


def parseHistory():

    tempQueryString = "SELECT AVG(temperature) as temperature, AVG(humidity) as humidity, date_time FROM grow_data WHERE date_time >= now() - interval 1 hour"
    tempData = fetchData(tempQueryString)

    return tempData


# Main
if __name__ == "__main__":

    #chartData
    hourlyData = parseHistory()

    #updateDatabase
    updateHistory(hourlyData)
