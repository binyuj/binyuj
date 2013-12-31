#!/usr/bin/env python
# coding:utf-8
# Author:  binyuj

# IPv6


import sys
import os
import time
import socket
t0 = time.time()

pwd = os.path.dirname(os.path.abspath(__file__))

infile = os.path.join(pwd, 'hosts6.txt')
outfile = os.path.join(pwd, 'hosts6.out.txt')
print(outfile)

txt = open(infile)
linelist = []
for line in txt.readlines():
    line=line.rstrip('\n')
    linelist.append(line)
txt.close()

hostslist = [] # 组成最终文件的行的列表
for line in linelist:
    # 空行和注释
    if not len(line.rstrip()) or line.startswith('#'):
        hostslist.append(line)
        continue
    # 去除含注释行尾部
    if '#' in line:
        line_ex = line.split('#')[0].rstrip()
        host = line_ex.split(' ')[-1] # 最终取得的域名
    else:
        host = line.split(' ')[-1]
    #ip = socket.gethostbyname(host)
    
    try:
        for res in socket.getaddrinfo(host, 80):
            ip = res[4][0]
            if ':' in ip:
                break
    except Exception,e:
        print('error: %s     %s' % (host, e))
        hostslist.append(line)
        continue
        #sys.exit(0)

    line = ' '.join([ip] + line.split(' ')[1:])
    #ipmap = ip + ' '*4 + host
    #hostslist.append(ipmap)
    hostslist.append(line)


# 清空文件
out = open(outfile, 'w')
out.truncate()
out.close()

# 未转换时区的时间
#updatetime = time.strftime('# Update Time:  %Y-%m-%d %H:%M:%S  %Z%z\n\n')

# 转化为 UTC+8:00
import pytz
import datetime

tz = pytz.timezone('Asia/Shanghai')
dt = datetime.datetime.now(tz)
fmt = '# Update Time:  %Y-%m-%d %H:%M:%S  %Z %z\n\n'
updatetime = dt.strftime(fmt)


# 写文件
out = open(outfile, 'a')
out.write(updatetime)

out.write('\n'.join(hostslist))

out.close()

print('Time Used: %s s' % str(time.time()-t0))
