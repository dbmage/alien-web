from __future__ import print_function
import os
import sys
import json
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
            jsonout['0'] = 'No Events'
        for event in events:
            jsonout[event['id']] = event
#            if 'date' in event['start']:
#                print("%-10s %-30s %-20s %-20s %s" % (calendar_ids[calendar_id], event['creator']['displayName'], event['start']['date'], event['end']['date'], event['summary']))
#            else:
#                start = event['start']['dateTime'].split('T')
#                start[1] = ':'.join(start[1].split(':')[0:2])
#                start = ' '.join(start)
#                end = event['end']['dateTime'].split('T')
#                end[1] = ':'.join(end[1].split(':')[0:2])
#                end = ' '.join(end)
#                print("%-10s %-30s %-20s %-20s %s" % (calendar_ids[calendar_id], event['creator']['displayName'], start, end, event['summary']))
    print(json.dumps(jsonout))

if __name__ == '__main__':
    main()
