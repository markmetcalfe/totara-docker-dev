#!/bin/bash

COLOR_RESET="\033[0m"
COLOR_RED="\033[1;31m"
COLOR_GREEN="\033[1;32m"
COLOR_YELLOW="\033[1;33m"
COLOR_MAGENTA="\033[1;35m"
COLOR_GRAY="\033[0;2m"

underline_text() {
  # Save current style
  local prev_style=$(tput sgr0)
  # Print underlined text
  echo -e "\033[4m$*\033[0m${prev_style}"
}

echo_error() {
  echo -e "${COLOR_RED}$*${COLOR_RESET}"
}

echo_warning() {
  echo -e "${COLOR_YELLOW}$*${COLOR_RESET}"
}

echo_success() {
  echo -e "${COLOR_GREEN}$*${COLOR_RESET}"
}

echo_important() {
  echo -e "${COLOR_MAGENTA}$*${COLOR_RESET}"
}

echo_info() {
  echo -e "${COLOR_GRAY}$*${COLOR_RESET}"
}
