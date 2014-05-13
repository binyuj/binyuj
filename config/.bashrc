# ~/.bashrc: executed by bash(1) for non-login shells.
# see /usr/share/doc/bash/examples/startup-files (in the package bash-doc)
# for examples

# If not running interactively, don't do anything
case $- in
    *i*) ;;
      *) return;;
esac

# don't put duplicate lines or lines starting with space in the history.
# See bash(1) for more options
HISTCONTROL=ignoreboth

# append to the history file, don't overwrite it
shopt -s histappend

# for setting history length see HISTSIZE and HISTFILESIZE in bash(1)
HISTSIZE=1000
HISTFILESIZE=2000

# check the window size after each command and, if necessary,
# update the values of LINES and COLUMNS.
shopt -s checkwinsize

# If set, the pattern "**" used in a pathname expansion context will
# match all files and zero or more directories and subdirectories.
#shopt -s globstar

# make less more friendly for non-text input files, see lesspipe(1)
[ -x /usr/bin/lesspipe ] && eval "$(SHELL=/bin/sh lesspipe)"

# set variable identifying the chroot you work in (used in the prompt below)
if [ -z "${debian_chroot:-}" ] && [ -r /etc/debian_chroot ]; then
    debian_chroot=$(cat /etc/debian_chroot)
fi

# set a fancy prompt (non-color, unless we know we "want" color)
case "$TERM" in
    xterm-color) color_prompt=yes;;
esac

# uncomment for a colored prompt, if the terminal has the capability; turned
# off by default to not distract the user: the focus in a terminal window
# should be on the output of commands, not on the prompt
#force_color_prompt=yes

if [ -n "$force_color_prompt" ]; then
    if [ -x /usr/bin/tput ] && tput setaf 1 >&/dev/null; then
	# We have color support; assume it's compliant with Ecma-48
	# (ISO/IEC-6429). (Lack of such support is extremely rare, and such
	# a case would tend to support setf rather than setaf.)
	color_prompt=yes
    else
	color_prompt=
    fi
fi

if [ "$color_prompt" = yes ]; then
    PS1='${debian_chroot:+($debian_chroot)}\[\033[01;32m\]\u@\h\[\033[00m\]:\[\033[01;34m\]\w\[\033[00m\]\$ '
else
    PS1='${debian_chroot:+($debian_chroot)}\u@\h:\w\$ '
fi
unset color_prompt force_color_prompt

# If this is an xterm set the title to user@host:dir
case "$TERM" in
xterm*|rxvt*)
    PS1="\[\e]0;${debian_chroot:+($debian_chroot)}\u@\h: \w\a\]$PS1"
    ;;
*)
    ;;
esac

# enable color support of ls and also add handy aliases
if [ -x /usr/bin/dircolors ]; then
    test -r ~/.dircolors && eval "$(dircolors -b ~/.dircolors)" || eval "$(dircolors -b)"
    alias ls='ls --color=auto'
    #alias dir='dir --color=auto'
    #alias vdir='vdir --color=auto'

    alias grep='grep --color=auto'
    alias fgrep='fgrep --color=auto'
    alias egrep='egrep --color=auto'
fi

# some more ls aliases
alias ll='ls -alF'
alias la='ls -A'
alias l='ls -CF'

alias nslookup6='nslookup -type=AAAA'


# Add an "alert" alias for long running commands.  Use like so:
#   sleep 10; alert
alias alert='notify-send --urgency=low -i "$([ $? = 0 ] && echo terminal || echo error)" "$(history|tail -n1|sed -e '\''s/^\s*[0-9]\+\s*//;s/[;&|]\s*alert$//'\'')"'

# Alias definitions.
# You may want to put all your additions into a separate file like
# ~/.bash_aliases, instead of adding them here directly.
# See /usr/share/doc/bash-doc/examples in the bash-doc package.

if [ -f ~/.bash_aliases ]; then
    . ~/.bash_aliases
fi

# enable programmable completion features (you don't need to enable
# this, if it's already enabled in /etc/bash.bashrc and /etc/profile
# sources /etc/bash.bashrc).
if ! shopt -oq posix; then
  if [ -f /usr/share/bash-completion/bash_completion ]; then
    . /usr/share/bash-completion/bash_completion
  elif [ -f /etc/bash_completion ]; then
    . /etc/bash_completion
  fi
fi


# Here is bash color codes you can use
  black=$'\[\e[1;30m\]'
    red=$'\[\e[1;31m\]'
  green=$'\[\e[1;32m\]'
 yellow=$'\[\e[1;33m\]'
   blue=$'\[\e[1;34m\]'
magenta=$'\[\e[1;35m\]'
   cyan=$'\[\e[1;36m\]'
  white=$'\[\e[1;37m\]'
 normal=$'\[\e[m\]'


#区分命令与输出
#PS1="\[\e[35;47m\u: \e[01;34m\w   \e[01;30m****\t****         \e[0m\]\n\[\e[32;41m > \e[0m "
#PS1="\e[35;40m\u: \w > \e[0m "
#PS1="\e[32;40m\u: \w > \e[0m"
#PS1='\[\e[32;40m\]\u@\h:\W$ '
#PS1='\[\e[01;32m\][\[\e[01;31m\]\#\[\e[01;32m\]] \[\e[01;32m\]\u\e[m\e[1;33m@\e[m\e[1;35m\h\[\e[00m\]: \[\e[01;34m\]\w \[\e[01;31m\]\$\[\e[0m\] '
#PS1='${debian_chroot:+($debian_chroot)}\[\033[01;32m\]\u@\h\[\033[00m\]:\[\033[01;34m\]\w\[\033[00m\]\# \$ '
#PS1='\[\033[01;32m\]\u@\h\[\033[00m\]:\[\033[00m\]\w\[\033[01;31m\]\$ \[\033[0m\]'
#PS1='\[\033[34m\][\[\033[01;32m\]\u@\h\[\033[00m\]:\[\033[00m\]\w\[\033[34m\]]\[\033[01;31m\]\$ \[\033[0m\]'

#tty显示为英文
if [ `tty | grep tty` ]; then
 export LC_ALL="C"
 export LANGUAGE="en_US.UTF-8"
 export LANG="en_US.UTF-8"
fi

#export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/opt/kingsoft/wps-office/office6


PS1='\[\033[01;32m\][\[\033[01;31m\]\#\[\033[01;32m\]] \[\033[01;32m\]\u@\h\[\033[00m\]: \[\033[01;34m\]\w \[\033[01;31m\]\$\[\033[0m\] '

if [ -f ~/.git-prompt.sh ]; then
    #wget --no-check-certificate -O ~/.git-prompt.sh https://raw.github.com/git/git/master/contrib/completion/git-prompt.sh
    source ~/.git-prompt.sh
    PS1='\[\e]0;\w\a\]\n\[\033[01;32m\][\[\033[01;31m\]\#\[\033[01;32m\]] \[\033[01;32m\]\u@\h\[\033[00m\]: \[\033[01;34m\]\w\[\e[1;37m\]$(__git_ps1 " (%s)") \[\033[01;31m\]\$\[\033[0m\] '
    #export PS1='\[\e]0;\w\a\]\n\[\e[01;32m\]\u@\h\[\e[00;33m\] \w \[\e[1;37m\]$(__git_ps1 "(%s)")\n\[\e[1;$((31+3*!$?))m\]\$\[\e[00m\] '
fi
