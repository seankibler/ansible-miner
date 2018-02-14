#! /bin/bash

ansible-playbook --ask-sudo-pass \
  -i hosts \
  playbook.yml $@
