#!/usr/bin/python
# -*- coding: utf-8 -*-

import os
import time
import socket
t0 = time.time()

cwd = os.path.dirname(os.path.abspath(__file__))

infile = os.path.join(cwd, 'hosts.txt')
outfile = os.path.join(cwd, 'hosts.out')
print(outfile)

txt = open(infile)
hostlist = []
for line in txt.readlines():
    line=line.strip('\n')
    # 跳过空行和注释
    if not len(line) or line.startswith('#'):
        continue
    # 去除含注释行尾部
    if '#' in line:
        line = line.split('#')[0].rstrip(' ')
    host = line.split(' ')[-1]
    hostlist.append(host)
#print(hostlist)
txt.close()

out = open(outfile, 'w')
out.truncate()
out.close()
out = open(outfile, 'a')
#updatetime = time.strftime('# Update Time  %Y-%m-%d %H:%M:%S  %Z%z\n\n')

# 转化为 UTC+8:00
import pytz
import datetime

tz = pytz.timezone('Asia/Shanghai')
dt = datetime.datetime.now(tz)
fmt = '# Update Time:  %Y-%m-%d %H:%M:%S  %Z %z\n\n'
updatetime = dt.strftime(fmt)
out.write(updatetime)
for host in hostlist:
    ip = socket.gethostbyname(host)
    #print(ip)
    ipmap = ip + ' '*(19-len(ip)) + host + '\n'
    out.write(ipmap)
out.close()

print('Time Used: %s s' % str(time.time()-t0))
