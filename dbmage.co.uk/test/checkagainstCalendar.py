#!/usr/bin/python3
from __future__ import print_function
import os
import sys
import pytz
import json
import dateutil.parser
import datetime
import httplib2
from oauth2client import client
from oauth2client import tools
from oauth2client.file import Storage
import googleapiclient.discovery as discovery

# If modifying these scopes, delete your previously saved credentials
# at ~/.credentials/calendar-python-quickstart.json
SCOPES = 'https://www.googleapis.com/auth/calendar.readonly'
CLIENT_SECRET_FILE = 'credentials.json'
APPLICATION_NAME = 'alien'
jsonout = {}

def get_credentials():
    home_dir = os.path.expanduser('~')
    credential_dir = os.path.join(home_dir, '.credentials')
    if not os.path.exists(credential_dir):
        os.makedirs(credential_dir)
    credential_path = os.path.join(credential_dir,'calendar-python-quickstart.json')

    store = Storage(credential_path)
    credentials = store.get()
    if not credentials or credentials.invalid:
        flow = client.flow_from_clientsecrets(CLIENT_SECRET_FILE, SCOPES)
        flow.user_agent = APPLICATION_NAME
        if flags:
            credentials = tools.run_flow(flow, store, flags)
        else:  # Needed only for compatibility with Python 2.6
            credentials = tools.run(flow, store)
        print('Storing credentials to ' + credential_path)
    return credentials


def main():
    credentials = get_credentials()
    http = credentials.authorize(httplib2.Http())
    service = discovery.build('calendar', 'v3', http=http)

    # This code is to fetch the calendar ids shared with me
    # Src: https://developers.google.com/google-apps/calendar/v3/reference/calendarList/list
    page_token = None
    calendar_ids = {}
    while True:
        calendar_list = service.calendarList().list(pageToken=page_token).execute()
        for calendar_list_entry in calendar_list['items']:
#            if '@qxf2.com' in calendar_list_entry['id']:
            if calendar_list_entry['summary'] == 'Joe':
                calendar_ids[calendar_list_entry['id']] = calendar_list_entry['summary']
        page_token = calendar_list.get('nextPageToken')
        if not page_token:
            break
 
    # This code is to look for all-day events in each calendar for the month of September
    # Src: https://developers.google.com/google-apps/calendar/v3/reference/events/list
    # You need to get this from command line
    # Bother about it later!
#    start_date = datetime.datetime(
#        2017, 10, 01, 00, 00, 00, 0).isoformat() + 'Z'
#    end_date = datetime.datetime(2017, 12, 30, 23, 59, 59, 0).isoformat() + 'Z'
    name, number, desireddate = sys.argv[1:]
    if len(desireddate) < 1:
        print("No Date selected")
        return
    desireddate = pytz.utc.localize(datetime.datetime.strptime(desireddate, '%d/%m/%Y %I:%M %p'))
    nowdt = pytz.utc.localize(datetime.datetime.now())
    if desireddate < nowdt:
        print("Date has passed")
        return
 
    for calendar_id in calendar_ids:
        count = 0
#        print("%-10s %-30s %-20s %-20s %s" % ('Calendar', 'Creator', 'Start', 'End', 'Summary'))
        eventsResult = service.events().list(
            calendarId=calendar_id,
#            timeMin=start_date,
#            timeMax=end_date,
            singleEvents=True,
            orderBy='startTime').execute()
        events = eventsResult.get('items', [])
        if not events:
#            print('No upcoming events found.')
            continue
        for event in events:
            if 'dateTime' not in event['start']:
                continue
            print("%s - %s - %s" % ( event['start']['dateTime'], desireddate, event['end']['dateTime']))
            start = dateutil.parser.parse(event['start']['dateTime'])
            end = dateutil.parser.parse(event['end']['dateTime'])
#            print("%s - %s" % (start, end))
            if start < desireddate < end:
                print("Appointment Taken")
                return
        print("Appointment Created")
        return
#                start = event['start']['dateTime'].split('T')
#                start[1] = ':'.join(start[1].split(':')[0:2])
#                start = ' '.join(start)
#                end = event['end']['dateTime'].split('T')
#                end[1] = ':'.join(end[1].split(':')[0:2])
#                end = ' '.join(end)
#                print("%-10s %-30s %-20s %-20s %s" % (calendar_ids[calendar_id], event['creator']['displayName'], start, end, event['summary']))
if __name__ == '__main__':
    main()
