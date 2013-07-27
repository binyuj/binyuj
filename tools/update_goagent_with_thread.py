#!/usr/bin/env python
# -*- coding: utf-8 -*-
# Author:  binyuj
# Description： 使用多线程更新goagent

import urllib
import os
import threading

filelist = ['proxy.ini', 'proxy.py', 'goagent-gtk.py', 'cacert.pem','addto-startup.py', 'proxy.pac']


class Update(threading.Thread):
    def __init__(self, filename):
        threading.Thread.__init__(self)
        self.filename = filename

    def run(self):
        self.updatefile(self.filename)

    def updatefile(self, filename):
        fileurl = 'https://github.com/goagent/goagent/raw/3.0/local/'+filename
        print('Updating "%s" ... \n...from "%s"' % (filename, fileurl))
        content = urllib.urlopen(fileurl).read()
        target = open(filename, 'wb')
        target.write(content)
        target.close()
        print('Successful updated "%s" !' % filename)

        if filename == 'goagent-gtk.py':
            os.chmod(filename, 0755)
            print('chmod '+filename)
        if filename == 'proxy.ini' and appids:
            try:
                config.set('gae', 'appid', appids)
                with open('proxy.ini', 'wb') as fp:
                   config.write(fp)
                print('Successful wrote appids !')
            except Exception:
                print('wrote appids failed (T＿T)')

def main():
    import ConfigParser
    import re
    global config
    global appids
    ConfigParser.RawConfigParser.OPTCRE = re.compile(r'(?P<option>[^=\s][^=]*)\s*(?P<vi>[=])\s*(?P<value>.*)$')
    config = ConfigParser.ConfigParser()
    config.read('proxy.ini')
    appids = config.has_option('gae', 'appid') and config.get('gae', 'appid')
    print('Found appids:%s\n' % appids)

    for filename in filelist:
        thread = Update(filename)
        thread.start()

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('\nAbort')
        pass
