# ~/.bashrc: executed by bash(1) for non-login shells.
# see /usr/share/doc/bash/examples/startup-files (in the package bash-doc)
# for examples

# If not running interactively, don't do anything
[ -z "$PS1" ] && return

# Prevents this file to be runned more than once.
[ -n "$MY_BASH_RC" ] && return
MY_BASH_RC=1
[ -f ~/.profile ] && . ~/.profile

# MacPorts Installer addition on 2013-01-31_at_01:57:16: adding an appropriate PATH variable for use with MacPorts.
export PATH=/opt/local/bin:/opt/local/sbin:$PATH

# For emacs and others “console-graphical” applications, enables 256 colors.
export TERM='xterm-256color'


# check the window size after each command and, if necessary,
# update the values of LINES and COLUMNS.
shopt -s checkwinsize

# make less more friendly for non-text input files, see lesspipe(1)
[ -x /usr/bin/lesspipe ] && eval "$(SHELL=/bin/sh lesspipe)"

# MacPorts Bash shell command completion
if [ -f /opt/local/etc/profile.d/bash_completion.sh ]; then
  . /opt/local/etc/profile.d/bash_completion.sh
fi

if [ -f /opt/local/share/git-core/git-prompt.sh ]; then
    . /opt/local/share/git-core/git-prompt.sh
fi

COLOR_RED="\[\e[0;22;31m\]"
COLOR_GREEN="\[\e[0;22;32m\]"
COLOR_YELLOW="\[\e[33m\]"
COLOR_BLUE="\[\e[0;22;34m\]"
COLOR_PURPLE="\[\e[0;22;35m\]"
COLOR_CYAN="\[\e[0;22;36m\]"

COLOR_RED_BOLD="\[\e[0;1;31m\]"
COLOR_GREEN_BOLD="\[\e[0;1;32m\]"
COLOR_YELLOW_BOLD="\[\e[0;1;33m\]"
COLOR_BLUE_BOLD="\[\e[0;1;34m\]"
COLOR_PURPLE_BOLD="\[\e[0;1;35m\]"
COLOR_CYAN_BOLD="\[\e[0;1;36m\]"

COLOR_NONE="\[\e[0m\]"
COLOR_NONE_BOLD="\[\e[1m\]"

PS1="${COLOR_YELLOW}\u@${COLOR_PURPLE_BOLD}\h${COLOR_NONE}:${COLOR_PURPLE}\w\$(__git_ps1 \" ${COLOR_CYAN}(%s)\")${COLOR_NONE}\\\$ "

# If this is an xterm set the title to user@host:dir
case "$TERM" in
	xterm*|rxvt*)
		PS1="\[\e]0;\u@\h: \w\a\]$PS1"
		;;
	*)
		;;
esac


# Enables git information in the prompt.
if type __git_ps1 &> /dev/null; then
	GIT_PS1_SHOWDIRTYSTATE=1
else
	__git_ps1 ()
	{
		return # Does strictly nothing.
	}
fi

# Colored man pages.
export LESS_TERMCAP_md=$'\E[01;31m'    # Bold
export LESS_TERMCAP_us=$'\E[01;32m'    # Underline start
export LESS_TERMCAP_ue=$'\E[0m'        # Underline end
export LESS_TERMCAP_so=$'\E[01;44;33m' # Standout start
export LESS_TERMCAP_se=$'\E[0m'        # Standout end
export LESS_TERMCAP_mb=$'\E[01;31m'    # Blink
export LESS_TERMCAP_me=$'\E[0m'        # End

#Uses coreutils installed w/ MacPorts
if [ "$TERM" != "dumb" ]; then
    export LS_OPTIONS='--color=auto'
    eval `gdircolors ~/.dir_colors`
fi

alias ls='gls $LS_OPTIONS -F'
alias ll='ls -Fl'
alias la='ls -Fa'
alias rm='rm -i'

echo "         ¯\_(ツ)_/¯ Hello (again) "
