#!/usr/bin/expect -f
# ssh auto login script
# need [expect] installed, sudo apt-get install expect

set timeout 20
spawn ssh -N -D 7070 username@hostname.net
expect "password:"
send "yourpassword\r"
interact
