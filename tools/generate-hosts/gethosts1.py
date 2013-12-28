#!/usr/bin/python
# -*- coding: utf-8 -*-

import os
import time
import socket
t0 = time.time()

cwd = os.path.dirname(os.path.abspath(__file__))

infile = os.path.join(cwd, 'hosts.txt')
outfile = os.path.join(cwd, 'hosts.out1')
print(outfile)

txt = open(infile)
linelist = []
for line in txt.readlines():
    line=line.rstrip('\n')
    linelist.append(line)
txt.close()

hostslist = []
for line in linelist:
    # 空行和注释
    if not len(line.rstrip()) or line.startswith('#'):
        hostslist.append(line)
        continue
    # 去除含注释行尾部
    if '#' in line:
        line = line.split('#')[0].rstrip()
    host = line.split(' ')[-1]
    try:
        ip = socket.gethostbyname(host)
    except Exception:
        print(host)
    ipmap = ip + ' '*(19-len(ip)) + host
    hostslist.append(ipmap)


# 清空文件
out = open(outfile, 'w')
out.truncate()
out.close()
# 写文件
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

out.write('\n'.join(hostslist))

out.close()

print('Time Used: %s s' % str(time.time()-t0))
