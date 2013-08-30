#!/usr/bin/expect -f
# ssh auto login script
# need [expect] installed, sudo apt-get install expect

set PASSWD yourpassword
set timeout 20
spawn ssh -N -D 7070 username@hostname.net
expect {
    "(yes/no)?" {send "yes\r"; exp_continue}
    "password:" {send "$PASSWD\r"}
}

interact
