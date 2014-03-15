#!/usr/bin/env python
# -*- coding: utf-8 -*-
# Author:  binyuj
# Description： 使用多线程更新goagent

import urllib
import os
import re
import threading
try:
    import configparser
except ImportError:
    import ConfigParser as configparser
try:
    import urllib.request
except ImportError:
    import urllib
    urllib.request = __import__('urllib2')

filelist = ['proxy.ini', 'proxy.py', 'goagent-gtk.py', 'cacert.pem','addto-startup.py', 'proxy.pac']

configparser.RawConfigParser.OPTCRE = re.compile(r'(?P<option>[^=\s][^=]*)\s*(?P<vi>[=])\s*(?P<value>.*)$')
config = configparser.ConfigParser()
config.read('proxy.ini')
appids = config.has_option('gae', 'appid') and config.get('gae', 'appid')
gae_password = config.has_option('gae', 'password') and config.get('gae', 'password')
print('Found appids:%s\nGot Password:%s\n' % (appids, gae_password))
fetchserver = config.has_option('php', 'fetchserver') and config.get('php', 'fetchserver')
php_password = config.has_option('php', 'password') and config.get('php', 'password')
print('Found fetchserver:%s\nGot Password:%s\n' % (fetchserver, php_password))

class Update(threading.Thread):
    def __init__(self, filename):
        threading.Thread.__init__(self)
        self.filename = filename

    def run(self):
        self.updatefile(self.filename)

    def updatefile(self, filename):
        fileurl = 'https://github.com/goagent/goagent/raw/3.0/local/'+filename
        print('Updating "%s" ... \n...from "%s"' % (filename, fileurl))
        content = urllib.request.urlopen(fileurl).read()
        target = open(filename, 'wb')
        target.write(content)
        target.close()
        print('Successful updated "%s" !' % filename)

        if filename == 'goagent-gtk.py':
            os.chmod(filename, 0o775)
            print('chmod '+filename)
        if filename == 'proxy.ini' and appids:
            try:
                config.read('proxy.ini')
                config.set('gae', 'appid', appids)
                config.set('gae', 'password', gae_password)
                config.set('php', 'fetchserver', fetchserver)
                config.set('php', 'password', php_password)
                config.write(open('proxy.ini', 'wb'))
                print('Successful wrote appids !')
            except Exception as e:
                print('wrote appids failed (T＿T)\nError log: %s' % e)

def main():
    for filename in filelist:
        thread = Update(filename)
        thread.start()

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('\nAbort')
        pass
