import sys
import os
import time
DIR = '/var/www/html/tmp/'
dir_of_test = '/var/www/html/System_Tests/'
dir_of_task = '/var/www/html/Problems/'
code_extend = ['.cpp', '.pas', '.py', '.class']
dir_of_queue_room = '/var/www/html/queue/room'

def process_test (room):    
    for root, dirs, files in os.walk(DIR):
        for file in files:
            if file.endswith('.zip'):
                print('unzip {} -d {}'.format(file, dir_of_test))
                os.system ('unzip -n "{}" -d "{}"'.format(file, dir_of_test))
            elif file.endswith('.pdf'):
                print('cp {} {}{}'.format(file, dir_of_task, file))
                os.system('cp "{}" "{}{}"'.format(file, dir_of_task, file))
            else:
                for extend in code_extend:
                    if file.endswith(extend):
                        print('cp {} {}{}/{}'.format(file, dir_of_queue_room, room, file))
                        os.system('cp "{}" "{}{}/{}"'.format(file, dir_of_queue_room, room, file))
                        room = (room + 1) % 3
            os.system('rm "{}"'.format(file))
    return room

if __name__ == '__main__':
    print('Started')
    os.chdir(DIR)
    room = 0
    while (True):
        room = process_test (room)
        time.sleep(1)
